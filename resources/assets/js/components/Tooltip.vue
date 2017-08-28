<template>
    <span :data-placement="placement" :title="title">
        <slot></slot>
    </span>
</template>

<script>
  export default {
    props: {
      placement: {
        type: String,
        default: 'top'
      },
      title: {
        type: String,
        default: null
      }
    },
    mounted () {
      $(this.$el).tooltip()
    }
  }
</script>
