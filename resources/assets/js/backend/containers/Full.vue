<template>
  <div class="app">
    <AppHeader></AppHeader>
    <div class="app-body">
      <Sidebar :nav-items="nav"></Sidebar>
      <main class="main">
        <b-alert variant="warning" class="alert-top mb-0" :show="$app.isImpersonation">
          <span v-html="$t('labels.alerts.login_as', {'name': $app.user.name, 'route': $app.route('admin.logout'), 'admin': $app.usurperName})"></span>
        </b-alert>
        <b-alert variant="warning" class="alert-top mb-0" :show="!$app.user.confirmed">
          <span v-html="$t('labels.alerts.not_confirmed', {'route': $app.route('user.confirmation.send') })"></span>
        </b-alert>
        <breadcrumb :list="list"></breadcrumb>
        <b-container fluid>
          <router-view :key="$route.name"></router-view>
        </b-container>
      </main>
      <AppAside></AppAside>
    </div>
    <AppFooter :name="$app.appName" :editor-name="$app.editorName"
               :editor-site-url="$app.editorSiteUrl"></AppFooter>
  </div>
</template>

<script>
import nav from '../_nav'

import AppAside from '../components/Aside'
import Breadcrumb from '../components/Breadcrumb'
import AppFooter from '../components/Footer'
import AppHeader from '../components/Header'
import Sidebar from '../components/Sidebar/Sidebar'

export default {
  name: 'Full',
  components: {
    AppHeader,
    Sidebar,
    AppAside,
    AppFooter,
    Breadcrumb
  },
  data () {
    return {
      nav: []
    }
  },
  computed: {
    name () {
      return this.$route.name
    },
    list () {
      return this.$route.matched
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
