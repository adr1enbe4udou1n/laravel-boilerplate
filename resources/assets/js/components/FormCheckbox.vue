<template>
    <label class="custom-control custom-checkbox">
        <input type="checkbox"
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
  if (!Array.isArray) {
    Array.isArray = arg => Object.prototype.toString.call(arg) === '[object Array]'
  }
  const arrayIncludes = (array, value) => array.indexOf(value) !== -1

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
        if (Array.isArray(this.checked)) {
          return arrayIncludes(this.checked, this.value)
        } else {
          return this.checked === this.value
        }
      }
    },
    methods: {
      handleChange ({target: {checked}}) {
        if (Array.isArray(this.checked)) {
          if (this.isChecked) {
            this.$emit('change', this.checked.filter(x => x !== this.value))
          } else {
            this.$emit('change', [...this.checked, this.value])
          }
        } else {
          this.$emit('change', checked ? this.value : this.uncheckedValue)
        }
      }
    }
  }
</script>
