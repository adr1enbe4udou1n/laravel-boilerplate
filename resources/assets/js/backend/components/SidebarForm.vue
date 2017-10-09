<template>
  <div class="sidebar-form">
    <input type="search" class="form-control" :placeholder="$t('labels.search')" @keyup="onSearch"
           v-model="query"/>
  </div>
</template>
<script>
  export default {
    name: 'sidebar-form',
    data () {
      return {
        query: null
      }
    },
    methods: {
      onSearch () {
        this.$router.push({path: '/search', query: {q: this.query}})
      }
    }
  }
</script>
