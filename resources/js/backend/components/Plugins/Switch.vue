<template>
  <label class="custom-switch">
    <input
      type="checkbox"
      :name="name"
      class="custom-switch-input"
      :value="value"
      :checked="isChecked"
      @change="handleChange"
    />
    <span class="custom-switch-indicator"></span>
    <span class="custom-switch-description" v-if="description">{{
      description
    }}</span>
  </label>
</template>

<script>
export default {
  model: {
    prop: 'checked',
    event: 'change'
  },
  props: {
    value: {
      type: Boolean,
      default: true
    },
    uncheckedValue: {
      type: Boolean,
      default: false
    },
    checked: {
      type: Boolean,
      default: false
    },
    name: {
      type: String,
      default: null
    },
    description: {
      type: String,
      default: null
    }
  },
  computed: {
    isChecked() {
      return this.checked === this.value
    }
  },
  methods: {
    handleChange({ target: { checked } }) {
      this.$emit('change', checked ? this.value : this.uncheckedValue)
    }
  }
}
</script>
