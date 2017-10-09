<template>
  <router-link :to="url" :class="classList">
    <i :class="icon"></i> {{name}}
    <template v-for="badge in badges">
      <span :class="`badge badge-${badge.variant}`"
            :title="badge.name">{{ badge.text }}</span>
    </template>
  </router-link>
</template>

<script>
  export default {
    name: 'sidebar-nav-link',
    props: {
      name: {
        type: String,
        default: ''
      },
      url: {
        type: String,
        default: ''
      },
      icon: {
        type: String,
        default: ''
      },
      badges: {
        type: Array,
        default: () => []
      },
      variant: {
        type: String,
        default: ''
      }
    },
    computed: {
      classList () {
        return [
          'nav-link',
          this.linkVariant
        ]
      },
      linkVariant () {
        return this.variant ? `nav-link-${this.variant}` : ''
      }
    }
  }
</script>
