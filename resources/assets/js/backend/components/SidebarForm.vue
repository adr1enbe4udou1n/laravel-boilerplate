<template>
  <div class="sidebar-form">
    <b-form-input type="search" :placeholder="$t('labels.search')" @keyup="onSearch"
                  v-model="query"></b-form-input>
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
