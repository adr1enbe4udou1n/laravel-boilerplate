<template>
  <div>
    <template v-if="result.length">
      <b-card v-for="item in result" :key="item.id">
        <router-link :to="`/posts/${item.id}/edit`" slot="header">{{
          item.title
        }}</router-link>
        <span v-html="item.body"></span>
      </b-card>
    </template>
    <b-card v-else> Aucun résultat </b-card>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'Search',
  data() {
    return {
      result: []
    }
  },
  watch: {
    $route: 'fetchData'
  },
  created() {
    this.fetchData()
  },
  methods: {
    async fetchData() {
      if (this.$route.query.q) {
        let { data } = await axios.get(this.$app.route('admin.search'), {
          params: {
            q: this.$route.query.q
          }
        })
        this.result = data
      }
    }
  }
}
</script>
