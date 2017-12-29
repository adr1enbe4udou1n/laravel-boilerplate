<template>
  <div class="animated fadeIn">
    <b-card>
      <template slot="header">
        <div class="pull-right mt-2" v-if="this.$app.user.can('create users')">
          <b-button to="/users/create" variant="success" size="sm">
            <i class="icon-plus"></i> {{ $t('buttons.users.create') }}
          </b-button>
        </div>
        <h4 class="mt-1">{{ $t('labels.backend.users.titles.index') }}</h4>
      </template>
      <b-row>
        <b-col md="4" class="mb-3">
          <b-form inline>
            <label class="mr-2">{{ $t('labels.show') }}</label>
            <b-form-select :options="pageOptions" v-model="perPage" class="mr-2" @input="this.loadDataTable"></b-form-select>
            <label >{{ $t('labels.entries') }}</label>
          </b-form>
        </b-col>
      </b-row>
      <b-table striped
               bordered
               show-empty
               stacked="md"
               no-local-sorting
               :empty-text="$t('labels.no_results')"
               :empty-filtered-text="$t('labels.no_results')"
               :items="items"
               :fields="fields"
               :sort-by="sortBy"
               :sort-desc="sortDesc"
               @sort-changed="onSort"
      >
        <template slot="name" slot-scope="row">
          <router-link :to="`/users/${row.item.id}/edit`">
            {{row.value}}
          </router-link>
        </template>
        <template slot="confirmed" slot-scope="row">
          <b-badge :variant="row.value ? 'success' : 'danger'">{{ row.value ? $t('labels.yes') : $t('labels.no') }}</b-badge>
        </template>
        <template slot="active" slot-scope="row">
          <b-badge :variant="row.value ? 'success' : 'danger'">{{ row.value ? $t('labels.yes') : $t('labels.no') }}</b-badge>
        </template>
        <template slot="roles" slot-scope="row">
          {{ formatRoles(row.value) }}
        </template>
        <template slot="actions" slot-scope="row">
          <b-button size="sm" variant="primary" :to="`/users/${row.item.id}/edit`" v-b-tooltip.hover :title="$t('buttons.edit')" class="mr-1">
            <i class="icon-pencil"></i>
          </b-button>
          <b-button size="sm" variant="danger" v-b-tooltip.hover :title="$t('buttons.delete')" @click.stop="onDelete(row.value.id)">
            <i class="icon-trash"></i>
          </b-button>
        </template>
      </b-table>
      <b-row>
        <b-col md="4">
          <b-batch-action :options="actions" @action="onBulkAction"></b-batch-action>
        </b-col>
        <b-col md="4">
          <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" v-if="totalRows > perPage"
                        :class="[ 'justify-content-center' ]" @input="this.loadDataTable"></b-pagination>
        </b-col>
      </b-row>
    </b-card>
  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    name: 'user_list',
    data () {
      return {
        items: [],
        fields: [
          { key: 'name', label: this.$t('validation.attributes.name'), sortable: true },
          { key: 'email', label: this.$t('validation.attributes.email'), sortable: true },
          { key: 'confirmed', label: this.$t('validation.attributes.confirmed'), 'class': 'text-center' },
          { key: 'roles', label: this.$t('validation.attributes.roles') },
          { key: 'last_access_at', label: this.$t('labels.last_access_at'), 'class': 'text-center', sortable: true },
          { key: 'active', label: this.$t('validation.attributes.active'), 'class': 'text-center' },
          { key: 'created_at', label: this.$t('labels.created_at'), 'class': 'text-center', sortable: true },
          { key: 'updated_at', label: this.$t('labels.updated_at'), 'class': 'text-center', sortable: true },
          { key: 'actions', label: this.$t('labels.actions') }
        ],
        currentPage: 1,
        perPage: 10,
        sortBy: 'updated_at',
        sortDesc: true,
        totalRows: 0,
        pageOptions: [ 5, 10, 15, 25, 50 ],
        actions: {
          destroy: this.$t('labels.backend.users.actions.destroy'),
          enable: this.$t('labels.backend.users.actions.enable'),
          disable: this.$t('labels.backend.users.actions.disable')
        }
      }
    },
    mounted () {
      this.loadDataTable()
    },
    methods: {
      formatRoles (roles) {
        return roles.map((key) => {
          return key.display_name
        }).join(', ')
      },
      onSort (ctx) {
        this.sortBy = ctx.sortBy
        this.sortDesc = ctx.sortDesc
        this.loadDataTable()
      },
      loadDataTable () {
        axios.get(this.$app.route('admin.users.search', {
          page: this.currentPage,
          perPage: this.perPage,
          column: this.sortBy,
          direction: this.sortDesc ? 'desc' : 'asc'
        }))
          .then((response) => {
            this.items = response.data.data
            this.totalRows = response.data.total
          })
          .catch((error) => {
            // Domain error
            if (error.response.data.error !== undefined) {
              window.toastr.error(error.response.data.error)
              return
            }

            // Generic error
            window.toastr.error(this.$t('exceptions.general'))
          })
      },
      onDelete (id) {
        window.swal({
          title: this.$t('labels.are_you_sure'),
          type: 'warning',
          showCancelButton: true,
          cancelButtonText: this.$t('buttons.cancel'),
          confirmButtonColor: '#dd4b39',
          confirmButtonText: this.$t('buttons.delete')
        }).then((result) => {
          if (result.value) {
            axios.delete(this.$app.route('admin.users.destroy', { id }))
              .then((response) => {
                // Reload Datatables and keep current pager
                window.toastr[response.data.status](response.data.message)
              })
              .catch((error) => {
                // Not allowed error
                if (error.response.status === 403) {
                  window.toastr.error(this.$t('exceptions.unauthorized'))
                  return
                }

                // Domain error
                if (error.response.data.error !== undefined) {
                  window.toastr.error(error.response.data.error)
                  return
                }

                // Generic error
                window.toastr.error(this.$t('exceptions.general'))
              })
          }
        })
      },
      onBulkAction (name) {
        // Récupérer les éléments sélectionnés ??
        let ids = []

        axios.post(this.$app.route('admin.users.batch_action'), {
          action: name,
          ids
        }).then((response) => {
          // Reload Datatables and keep current pager
          window.toastr[response.data.status](response.data.message)
        }).catch((error) => {
          // Not allowed error
          if (error.response.status === 403) {
            window.toastr.error(this.$t('exceptions.unauthorized'))
            return
          }

          // Domain error
          if (error.response.data.message !== undefined) {
            window.toastr.error(error.response.data.message)
            return
          }

          // Generic error
          window.toastr.error(this.$t('exceptions.general'))
        })
      }
    }
  }
</script>
