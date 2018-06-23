<template>
  <div class="app">
    <AppHeader></AppHeader>
    <div class="app-body">
      <Sidebar fixed>
        <div class="sidebar-header">
          <i class="fe fe-user"></i>&nbsp;&nbsp;{{ $app.user.name }}
        </div>
        <SidebarNav :nav-items="nav"></SidebarNav>
        <SidebarFooter></SidebarFooter>
        <SidebarMinimizer></SidebarMinimizer>
      </Sidebar>
      <main class="main">
        <b-alert variant="warning" class="alert-top mb-0" :show="$app.isImpersonation">
          <span v-html="$t('labels.alerts.login_as', {'name': $app.user.name, 'route': $app.route('admin.logout'), 'admin': $app.usurperName})"></span>
        </b-alert>
        <b-alert variant="warning" class="alert-top mb-0" :show="!$app.user.confirmed">
          <span v-html="$t('labels.alerts.not_confirmed', {'route': $app.route('user.confirmation.send') })"></span>
        </b-alert>
        <breadcrumb :list="$route.matched"></breadcrumb>
        <div class="container-fluid">
          <router-view :key="$route.name"></router-view>
        </div>
      </main>
      <Aside fixed></Aside>
    </div>
    <AppFooter :name="$app.appName" :editor-name="$app.editorName"
               :editor-site-url="$app.editorSiteUrl"></AppFooter>
  </div>
</template>

<script>
import nav from '../_nav'

import AppFooter from '../components/Footer'
import AppHeader from '../components/Header'

export default {
  name: 'Full',
  components: {
    AppHeader,
    AppFooter
  },
  data () {
    return {
      nav: []
    }
  },
  watch: {
    '$route': 'fetchData'
  },
  created () {
    this.initNav()
    this.fetchData()
  },
  methods: {
    initNav () {
      this.nav = nav(
        this.$app,
        this.$i18n,
        this.$store.state.counters.newPostsCount,
        this.$store.state.counters.pendingPostsCount
      )
    },
    async fetchData () {
      await this.$store.dispatch('LOAD_COUNTERS')
      this.initNav()
    }
  }
}
</script>
