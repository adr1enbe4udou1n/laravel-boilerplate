<template>
    <label class="custom-control custom-radio">
        <input type="radio"
               :id="id || null"
               :name="name"
               :value="value"
               class="custom-control-input"
               :checked="isChecked"
               @change="handleChange">
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">
            <slot></slot>
        </span>
    </label>
</template>

<script>
  export default {
    model: {
      prop: 'checked',
      event: 'change'
    },
    props: {
      id: {
        default: null
      },
      name: {
        default: null
      },
      value: {
        default: true
      },
      uncheckedValue: {
        default: false
      },
      checked: {
        default: true
      }
    },
    computed: {
      isChecked () {
        return this.checked === this.value
      }
    },
    methods: {
      handleChange ({target: {checked}}) {
        this.$emit('change', checked ? this.value : this.uncheckedValue)
      }
    }
  }
</script>
