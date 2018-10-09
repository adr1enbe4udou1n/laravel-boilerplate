<template>
  <b-btn-group>
    <b-btn v-for="item in map" :key="item" @click="share(item)">
      <font-awesome-icon :icon="['fab', item]"></font-awesome-icon>
    </b-btn>
  </b-btn-group>
</template>
<script>
import { share, MAP } from './index'
export default {
  name: 'SocialShareIcon',
  props: {
    url: {
      type: String,
      required: true
    },
    title: {
      type: String,
      required: true
    },
    description: {
      type: String,
      required: true
    },
    tags: {
      type: Array,
      default: () => []
    }
  },
  data: () => {
    return {
      map: MAP
    }
  },
  computed: {
    shareParams: function() {
      return {
        url: this.url,
        title: this.title,
        description: this.description,
        tags: this.tags
      }
    },
    getTitle: function() {
      return this.title
    }
  },
  methods: {
    share: function(serviceName) {
      share(serviceName, this.shareParams)
    }
  }
}
</script>
