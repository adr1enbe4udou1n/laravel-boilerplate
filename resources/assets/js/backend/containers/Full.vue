<template>
  <div class="app">
    <AppHeader/>
    <div class="app-body">
      <Sidebar :navItems="nav"/>
      <main class="main">
        <b-alert variant="warning" class="alert-top mb-0" :show="this.$app.isImpersonation">
          <span
            v-html="$t('labels.alerts.login_as', {'name': this.$app.user.name, 'route': this.$app.route('logout-as'), 'admin': this.$app.usurperName})"></span>
        </b-alert>
        <b-alert variant="warning" class="alert-top mb-0" :show="!this.$app.user.confirmed">
          <span
            v-html="$t('labels.alerts.not_confirmed', {'route': this.$app.route('user.confirmation.send') })"></span>
        </b-alert>
        <breadcrumb :list="list"/>
        <b-container fluid>
          <router-view :key="this.$route.name"></router-view>
        </b-container>
      </main>
      <AppAside/>
    </div>
    <AppFooter :name="this.$app.appName" :editor-name="this.$app.editorName"
               :editor-site-url="this.$app.editorSiteUrl"/>
  </div>
</template>

<script>
  import axios from 'axios'
  import nav from '../_nav'

  import AppAside from '../components/Aside'
  import Breadcrumb from '../components/Breadcrumb'
  import AppFooter from '../components/Footer'
  import AppHeader from '../components/Header'
  import Sidebar from '../components/Sidebar'

  export default {
    name: 'full',
    components: {
      AppHeader,
      Sidebar,
      AppAside,
      AppFooter,
      Breadcrumb
    },
    data () {
      return {
        nav: [],
        newPostsCount: 0,
        pendingPostsCount: 0
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
    created () {
      this.initNav()
      this.fetchData()
    },
    methods: {
      initNav () {
        this.nav = nav(this.$app, this.$i18n, this.newPostsCount, this.pendingPostsCount)
      },
      fetchData () {
        if (this.$app.user.can('view own posts')) {
          axios
            .get(this.$app.route('admin.posts.draft.counter'))
            .then(response => {
              this.newPostsCount = response.data
              this.initNav()
            })
          axios
            .get(this.$app.route('admin.posts.pending.counter'))
            .then(response => {
              this.pendingPostsCount = response.data
              this.initNav()
            })
        }
      }
    },
    watch: {
      '$route': 'fetchData'
    }
  }
</script>
