<template>
  <button class="sidebar-minimizer" type="button" @click="onClick()"></button>
</template>
<script>

export default {
  name: 'SidebarMinimizer',
  methods: {
    onClick () {
      this.sidebarMinimize()
      this.brandMinimize()
    },
    sidebarMinimize () {
      document.body.classList.toggle('sidebar-minimized')
      document.querySelector('.sidebar-nav section').classList.toggle('ps')
    },
    brandMinimize () {
      document.body.classList.toggle('brand-minimized')
    }
  }
}
</script>
