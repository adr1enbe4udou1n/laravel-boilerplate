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
      <b-button type="submit" variant="danger">{{ $t('labels.validate') }}</b-button>
    </div>
  </form>
</template>

<script>
  import sweetalert2 from 'sweetalert2'

  export default {
    props: ['options', 'url', 'datatableId'],
    data () {
      return {
        action: Object.keys(this.options)[0]
      }
    },
    methods: {
      onSubmit (e) {
        let action = this.action

        sweetalert2({
          title: this.$t('labels.are_you_sure'),
          type: 'warning',
          showCancelButton: true,
          cancelButtonText: this.$t('buttons.cancel'),
          confirmButtonColor: '#dd4b39',
          confirmButtonText: this.$t('buttons.delete')
        }).then(
          () => {
            this.$emit('action', action)
          },
          () => {}
        )
      }
    }
  }
</script>
