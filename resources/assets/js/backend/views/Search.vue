<template>
  <div class="animated fadeIn">
    <template v-if="this.result.length">
      <b-card v-for="item in this.result" :key="item.id">
        <router-link :to="`/posts/${item.id}/edit`" slot="header">{{ item.title }}</router-link>
        <span v-html="item.body"></span>
      </b-card>
    </template>
    <b-card v-else>
      Aucun résultat
    </b-card>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'search',
  data () {
    return {
      result: []
    }
  },
  created () {
    this.fetchData()
  },
  methods: {
    fetchData () {
      if (this.$route.query.q) {
        axios
          .get(this.$app.route('admin.search'), {
            params: {
              q: this.$route.query.q
            }
          })
          .then((response) => {
            this.result = response.data
          })
      }
    }
  },
  watch: {
    '$route': 'fetchData'
  }
}
</script>
