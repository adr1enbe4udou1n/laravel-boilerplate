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

        $.confirmSwal(e.currentTarget, () => {
          this.$emit('action', action)
        })
      }
    }
  }
</script>
