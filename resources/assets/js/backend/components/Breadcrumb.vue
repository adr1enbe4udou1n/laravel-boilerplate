<template>
  <b-breadcrumb :items="items"></b-breadcrumb>
</template>

<script>
export default {
  props: {
    list: {
      type: Array,
      required: true,
      default: () => []
    }
  },
  computed: {
    items () {
      let items = [
        {
          text: this.$t('labels.frontend.titles.home'),
          href: this.$app.homePath
        }
      ]

      this.list.forEach((element) => {
        items.push({
          text: this.showName(element),
          to: element.path === '' ? '/' : element.path
        })
      })

      return items
    }
  },
  methods: {
    showName (item) {
      if (item.meta && item.meta.title) {
        item = item.meta && item.meta.title
      }
      if (item.name) {
        item = item.name
      }
      return item
    }
  }
}
</script>
