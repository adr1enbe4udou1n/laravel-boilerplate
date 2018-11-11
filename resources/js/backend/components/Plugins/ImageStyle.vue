<template>
  <b-img
    :src="url"
    :alt="alt"
    :width="width"
    :height="height"
    :fluid="fluid"
    :thumbnail="thumbnail"
    :rounded="rounded"
  ></b-img>
</template>

<script>
export default {
  name: 'ImageStyle',
  props: {
    src: {
      type: String,
      default: ''
    },
    alt: {
      type: String,
      default: ''
    },
    width: {
      type: Number,
      default: 100
    },
    height: {
      type: Number,
      default: 100
    },
    fit: {
      type: String,
      default: 'crop'
    },
    fluid: {
      type: Boolean,
      default: false
    },
    thumbnail: {
      type: Boolean,
      default: false
    },
    rounded: {
      type: [Boolean, String],
      default: false
    }
  },
  computed: {
    url() {
      return `/img${this.src}?w=${this.width}&h=${this.height}&fit=${this.fit}`
    }
  }
}
</script>
