<template>
  <div v-if="isExternalLink">
    <a :href="url" :class="classList">
      <i class="nav-icon" :class="icon"></i> {{ name }}
      <b-badge v-if="badge && badge.text" :variant="badge.variant">{{ badge.text }}</b-badge>
    </a>
  </div>
  <div v-else>
    <router-link :to="url" :exact="navItems.map((item) => item['url']).includes($route.fullPath)" :class="classList">
      <i class="nav-icon" :class="icon"></i> {{ name }}
      <b-badge v-if="badge && badge.text" :variant="badge.variant">{{ badge.text }}</b-badge>
    </router-link>
  </div>
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
    navItems: {
      type: Array,
      required: true,
      default: () => []
    },
    badge: {
      type: Object,
      default: () => {}
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
