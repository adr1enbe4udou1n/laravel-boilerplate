<template>
  <li :class="classList">
    <slot></slot>
  </li>
</template>

<script>
export default {
  name: 'SidebarNavItem',
  props: {
    classes: {
      type: String,
      default: ''
    }
  },
  computed: {
    classList () {
      return [
        'nav-item',
        ...this.itemClasses
      ]
    },
    itemClasses () {
      return this.classes ? this.classes.split(' ') : ''
    }
  }
}
</script>
