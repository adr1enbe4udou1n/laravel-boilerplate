<template>
    <div :class="['form-group','row',inputState]">
        <label v-if="label"
               :for="name"
               :class="[labelSrOnly ? 'sr-only' : 'col-form-label',labelLayout,labelAlignClass]"
        >
            <span v-html="label"></span>
        </label>
        <div :class="inputLayout">
            <slot></slot>
            <div v-if="invalidFeedback"
                 class="invalid-feedback"
            >
                <span v-html="invalidFeedback"></span>
            </div>
            <small v-if="description"
                   class="form-text text-muted"
            >
                <span v-html="description"></span>
            </small>
        </div>
    </div>
</template>

<script>
  export default {
    data () {
      return {
        validation: {
          errors: {}
        }
      }
    },
    computed: {
      inputState () {
        return this.invalidFeedback ? 'is-invalid' : ''
      },
      computedLabelCols () {
        return this.labelCols
      },
      labelLayout () {
        if (this.labelSrOnly) {
          return null
        }
        return this.horizontal ? ('col-sm-' + this.computedLabelCols) : 'col-12'
      },
      labelAlignClass () {
        if (this.labelSrOnly) {
          return null
        }
        return this.labelTextAlign ? `text-${this.labelTextAlign}` : null
      },
      inputLayout () {
        return this.horizontal ? ('col-sm-' + (12 - this.computedLabelCols)) : 'col-12'
      }
    },
    props: {
      name: {
        type: String,
        default: null
      },
      horizontal: {
        type: Boolean,
        default: false
      },
      labelCols: {
        type: Number,
        default: 3
      },
      labelTextAlign: {
        type: String,
        default: null
      },
      label: {
        type: String,
        default: null
      },
      labelSrOnly: {
        type: Boolean,
        default: false
      },
      description: {
        type: String,
        default: null
      },
      invalidFeedback: {
        type: String,
        default: null
      }
    }
  }
</script>
