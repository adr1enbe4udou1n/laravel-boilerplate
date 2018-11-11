<template>
  <input
    type="text"
    class="form-control input text-right"
    :id="id"
    :class="inputClass"
    :name="name"
    :placeholder="placeholder"
    :required="required"
    v-model="mutableValue"
    data-input
  />
</template>

<script>
export default {
  props: {
    value: {
      type: String,
      default: null
    },
    config: {
      type: Object,
      default: () => ({
        wrap: false
      })
    },
    placeholder: {
      type: String,
      default: null
    },
    inputClass: {
      type: [String, Object],
      default: null
    },
    name: {
      type: String,
      default: null
    },
    required: {
      type: Boolean,
      default: false
    },
    id: {
      type: String,
      default: null
    }
  },
  data() {
    return {
      mutableValue: this.value,
      fp: null
    }
  },
  watch: {
    config(newConfig) {
      this.fp.config = Object.assign(this.fp.config, newConfig)
      this.fp.redraw()
      this.fp.setDate(this.value, true)
    },
    mutableValue(newValue) {
      this.$emit('input', newValue)
    },
    value(newValue) {
      this.fp && this.fp.setDate(newValue, true)
    }
  },
  mounted() {
    if (this.$app.locale === 'fr') {
      window.Flatpickr.localize(window.FlatpickrLocaleFr['fr'])
    }
    if (!this.fp) {
      let elem = this.config.wrap ? this.$el.parentNode : this.$el
      this.fp = new window.Flatpickr(elem, this.config)
    }
  },
  beforeDestroy() {
    if (this.fp) {
      this.fp.destroy()
      this.fp = null
    }
  }
}
</script>
