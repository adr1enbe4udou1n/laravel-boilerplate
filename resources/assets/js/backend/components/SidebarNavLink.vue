<template>
  <div v-if="isExternalLink">
    <a :href="url" :class="classList">
      <i :class="icon"></i> {{name}}
      <template v-for="badge in badges">
        <b-badge :variant="badge.variant" :title="badge.name">{{ badge.text }}</b-badge>
      </template>
    </a>
  </div>
  <div v-else>
    <router-link :to="url" :class="classList">
      <i :class="icon"></i> {{name}}
      <template v-for="badge in badges">
        <b-badge :variant="badge.variant" :title="badge.name">{{ badge.text }}</b-badge>
      </template>
    </router-link>
  </div>
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
      },
      classes: {
        type: String,
        default: ''
      }
    },
    computed: {
      classList () {
        return [
          'nav-link',
          this.linkVariant,
          ...this.itemClasses
        ]
      },
      linkVariant () {
        return this.variant ? `nav-link-${this.variant}` : ''
      },
      itemClasses () {
        return this.classes ? this.classes.split(' ') : []
      },
      isExternalLink () {
        if (this.url.substring(0, 4) === 'http') {
          return true
        } else {
          return false
        }
      }
    }
  }
</script>
