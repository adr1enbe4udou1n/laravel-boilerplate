<template>
  <a :href="url" :class="classList" v-if="isExternalLink">
    <i :class="icon"></i> {{ name }}
    <b-badge v-for="(badge, index) in badges" :key="index" :variant="badge.variant" :title="badge.name">{{ badge.text }}</b-badge>
  </a>
  <router-link :to="url" :class="classList" v-else>
    <i :class="icon"></i> {{ name }}
    <b-badge v-for="(badge, index) in badges" :key="index" :variant="badge.variant" :title="badge.name">{{ badge.text }}</b-badge>
  </router-link>
</template>

<script>
export default {
  name: 'SidebarNavLink',
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
