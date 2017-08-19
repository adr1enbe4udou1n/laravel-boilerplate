<template>
    <form class="form-inline" @submit.prevent="onSubmit"
          :data-trans-title="$t('labels.are_you_sure')"
          :data-trans-button-cancel="$t('buttons.cancel')"
          :data-trans-button-confirm="$t('buttons.apply')"
    >
        <div class="form-group form-group-sm">
            <select name="action" class="form-control mr-1" v-model="action">
                <option v-for="(option, value) in options" :value="value">{{ option }}</option>
            </select>
            <input type="submit" class="btn btn-danger btn-md">
        </div>
    </form>
</template>

<script>
  import axios from 'axios'

  export default {
    props: ['options', 'url', 'datatable'],
    data () {
      return {
        action: Object.keys(this.options)[0]
      }
    },
    methods: {
      onSubmit (e) {
        let dataTable = $(`#${this.datatable}`).DataTable()
        let url = this.url
        let action = this.action

        $.confirmSwal(e.target, () => {
          axios.post(url, {
            action: action,
            ids: dataTable.rows({selected: true}).ids().toArray()
          }).then(response => {
            // Reload Datatables and keep current pager
            dataTable.ajax.reload(null, false)
            window.toastr[response.data.status](response.data.message)
          }).catch(error => {
            window.toastr.error(error.response.data.error)
          })
        })
      }
    }
  }
</script>
