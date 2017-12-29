<template>
  <div class="table-container">
    <b-row>
      <b-col md="4" class="mb-3">
        <b-form inline>
          <label class="mr-2">{{ $t('labels.show') }}</label>
          <b-form-select :options="pageOptions" v-model="perPage" class="mr-2" @input="onPagerChanged"></b-form-select>
          <label >{{ $t('labels.entries') }}</label>
        </b-form>
      </b-col>
    </b-row>
    <slot></slot>
    <b-row>
      <b-col md="4">
        <b-batch-action :options="actions" @action="onBulkAction"></b-batch-action>
      </b-col>
      <b-col md="4">
        <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" v-if="totalRows > perPage"
                      :class="[ 'justify-content-center' ]" @input="onPagerChanged"></b-pagination>
      </b-col>
    </b-row>
  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    props: {
      searchRoute: {
        type: String,
        default: null
      },
      deleteRoute: {
        type: String,
        default: null
      },
      actionRoute: {
        type: String,
        default: null
      },
      actions: {
        type: Object,
        default: null
      }
    },
    data () {
      return {
        sortBy: null,
        sortDesc: false,
        currentPage: 1,
        perPage: 10,
        totalRows: 0,
        pageOptions: [ 5, 10, 15, 25, 50 ]
      }
    },
    methods: {
      onPagerChanged () {
        this.refresh(this.sortBy, this.sortDesc)
      },
      refresh (sortBy, sortDesc) {
        this.sortBy = sortBy
        this.sortDesc = sortDesc

        axios.get(this.$app.route(this.searchRoute), {
          params: {
            page: this.currentPage,
            perPage: this.perPage,
            column: this.sortBy,
            direction: this.sortDesc ? 'desc' : 'asc'
          }
        })
          .then((response) => {
            this.totalRows = response.data.total

            this.$emit('data-loaded', response.data.data)
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
      deleteRow (id) {
        window.swal({
          title: this.$t('labels.are_you_sure'),
          type: 'warning',
          showCancelButton: true,
          cancelButtonText: this.$t('buttons.cancel'),
          confirmButtonColor: '#dd4b39',
          confirmButtonText: this.$t('buttons.delete')
        }).then((result) => {
          if (result.value) {
            axios.delete(this.$app.route(this.deleteRoute, {id}))
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

        axios.post(this.$app.route(this.actionRoute), {
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
