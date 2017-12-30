<template>
  <div class="table-container">
    <b-row>
      <b-col md="4" class="mb-3">
        <b-form inline v-if="lengthChange">
          <label class="mr-2">{{ $t('labels.datatables.show_per_page') }}</label>
          <b-form-select :options="pageOptions" v-model="perPage" class="mr-2" @input="refresh"></b-form-select>
          <label>{{ $t('labels.datatables.entries_per_page') }}</label>
        </b-form>
      </b-col>
      <b-col md="4" class="mb-3 text-center">
        <label class="mt-2" v-if="infos">{{ $t('labels.datatables.infos', { offset_start: perPage * (currentPage - 1) + 1, offset_end: perPage * currentPage, total: totalRows }) }}</label>
      </b-col>
      <b-col md="4" class="mb-3">
        <b-form inline v-if="search" class="d-flex justify-content-end">
          <label class="mr-2">{{ $t('labels.datatables.search') }}</label>
          <b-form-input v-model="searchQuery" @input="refresh"></b-form-input>
        </b-form>
      </b-col>
    </b-row>
    <slot></slot>
    <b-row>
      <b-col md="4">
        <b-batch-action v-if="actions" :options="actions" @action="onBulkAction"></b-batch-action>
      </b-col>
      <b-col md="4">
        <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" v-if="paging && totalRows > perPage"
                      class="justify-content-center" @input="refresh"></b-pagination>
      </b-col>
    </b-row>
  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    props: {
      sortBy: {
        type: String,
        default: null
      },
      sortDesc: {
        type: Boolean,
        default: false
      },
      lengthChange: {
        type: Boolean,
        default: true
      },
      paging: {
        type: Boolean,
        default: true
      },
      infos: {
        type: Boolean,
        default: true
      },
      search: {
        type: Boolean,
        default: true
      },
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
        currentSortBy: this.sortBy,
        currentSortDesc: this.sortDesc,
        currentPage: 1,
        perPage: 15,
        totalRows: 0,
        pageOptions: [ 5, 10, 15, 25, 50 ],
        searchQuery: null,
        selected: []
      }
    },
    mounted () {
      this.refresh()
    },
    methods: {
      sort (sortBy, sortDesc) {
        this.currentSortBy = sortBy
        this.currentSortDesc = sortDesc
        console.log(sortDesc)
        this.refresh()
      },
      refresh () {
        axios.get(this.$app.route(this.searchRoute), {
          params: {
            page: this.currentPage,
            perPage: this.perPage,
            column: this.currentSortBy,
            direction: this.currentSortDesc ? 'desc' : 'asc',
            search: this.searchQuery
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
                this.refresh()
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
        axios.post(this.$app.route(this.actionRoute), {
          action: name,
          ids: this.selected
        }).then((response) => {
          this.refresh()
          this.$emit('bulk-action-success')
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
