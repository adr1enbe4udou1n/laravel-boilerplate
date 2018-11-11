<template>
  <div>
    <b-row>
      <b-col md="4" class="mb-3">
        <b-form inline v-if="lengthChange">
          <label class="mr-2">{{
            $t('labels.datatables.show_per_page')
          }}</label>
          <b-form-select
            :options="pageOptions"
            v-model="perPage"
            class="mr-2"
            @input="onContextChanged"
          ></b-form-select>
          <label>{{ $t('labels.datatables.entries_per_page') }}</label>
        </b-form>
      </b-col>
      <b-col md="4" class="mb-3 text-center">
        <label class="mt-2" v-if="infos">{{
          $t('labels.datatables.infos', {
            offset_start: perPage * (currentPage - 1) + 1,
            offset_end: perPage * currentPage,
            total: totalRows
          })
        }}</label>
      </b-col>
      <b-col md="4" class="mb-3">
        <b-form
          inline
          v-if="search"
          class="d-flex justify-content-end"
          @submit.prevent
        >
          <label class="mr-2">{{ $t('labels.datatables.search') }}</label>
          <b-form-input
            v-model="searchQuery"
            @input="debounceInput"
          ></b-form-input>
        </b-form>
      </b-col>
    </b-row>
    <slot></slot>
    <b-row>
      <b-col md="4">
        <form class="form-inline" @submit.prevent="onBulkAction" v-if="actions">
          <div class="form-group">
            <b-form-select
              :options="actions"
              v-model="action"
              class="mr-1"
            ></b-form-select>
            <b-button type="submit" variant="danger">{{
              $t('labels.validate')
            }}</b-button>
          </div>
        </form>
      </b-col>
      <b-col md="4">
        <b-pagination
          :total-rows="totalRows"
          :per-page="perPage"
          v-model="currentPage"
          v-if="paging && totalRows > perPage"
          class="justify-content-center"
          @input="onContextChanged"
        ></b-pagination>
      </b-col>
      <b-col md="4">
        <div v-if="exportData" class="d-flex justify-content-end">
          <b-button @click.prevent="onExportData">
            <i class="fe fe-download"></i> {{ $t('labels.export') }}
          </b-button>
        </div>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import axios from 'axios'
import _ from 'lodash'

export default {
  props: {
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
    exportData: {
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
      default: () => {}
    },
    selected: {
      type: Array,
      default: () => []
    }
  },
  data() {
    return {
      currentPage: 1,
      perPage: 15,
      totalRows: 0,
      pageOptions: [5, 10, 15, 25, 50],
      searchQuery: null,
      action: null
    }
  },
  watch: {
    actions: {
      handler() {
        if (this.actions) {
          this.action = Object.keys(this.actions)[0]
        }
      },
      immediate: true
    }
  },
  methods: {
    debounceInput: _.debounce(function() {
      this.onContextChanged()
    }, 200),
    onContextChanged() {
      this.$emit('context-changed')
    },
    async loadData(sortBy, sortDesc) {
      try {
        let { data } = await axios.get(this.$app.route(this.searchRoute), {
          params: {
            page: this.currentPage,
            perPage: this.perPage,
            column: sortBy,
            direction: sortDesc ? 'desc' : 'asc',
            search: this.searchQuery
          }
        })

        this.totalRows = data.total
        return data.data
      } catch (e) {
        this.$app.error(e)
        return []
      }
    },
    onExportData() {
      window.location = this.$app.route(this.searchRoute, {
        search: this.searchQuery,
        exportData: true
      })
    },
    async deleteRow(params) {
      let result = await window.swal({
        title: this.$t('labels.are_you_sure'),
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: this.$t('buttons.cancel'),
        confirmButtonColor: '#dd4b39',
        confirmButtonText: this.$t('buttons.delete')
      })

      if (result.value) {
        try {
          let { data } = await axios.delete(
            this.$app.route(this.deleteRoute, params)
          )
          this.onContextChanged()
          this.$app.noty[data.status](data.message)
        } catch (e) {
          this.$app.error(e)
        }
      }
    },
    async onBulkAction() {
      let result = await window.swal({
        title: this.$t('labels.are_you_sure'),
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: this.$t('buttons.cancel'),
        confirmButtonColor: '#dd4b39',
        confirmButtonText: this.$t('buttons.confirm')
      })

      if (result.value) {
        try {
          let { data } = await axios.post(this.$app.route(this.actionRoute), {
            action: this.action,
            ids: this.selected
          })

          this.onContextChanged()
          this.$emit('update:selected', [])
          this.$app.noty[data.status](data.message)
        } catch (e) {
          this.$app.error(e)
        }
      }
    }
  }
}
</script>
