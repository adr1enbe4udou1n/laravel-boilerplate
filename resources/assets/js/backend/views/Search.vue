<template>
  <div class="animated fadeIn">
    <template v-if="this.result.length">
      <div class="card" v-for="item in this.result">
        <div class="card-header">
          <router-link :to="`/posts/${item.id}/edit`">{{ item.title }}</router-link>
        </div>
        <div class="card-body">
          <span v-html="item.body"></span>
        </div>
      </div>
    </template>
    <div class="card" v-else>
      <div class="card-body">
        Aucun résultat
      </div>
    </div>
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
            .then(response => {
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
