<template>
  <div class="sidebar-form">
    <b-form-input
      type="search"
      :placeholder="$t('labels.search')"
      @input="onSearch"
    ></b-form-input>
  </div>
</template>

<script>
export default {
  name: 'SidebarForm',
  methods: {
    onSearch(value) {
      this.$router.push({ path: '/search', query: { q: value } })
    }
  }
}
</script>
