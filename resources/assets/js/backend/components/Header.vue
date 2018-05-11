<template>
  <header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none" type="button" @click="mobileSidebarToggle">
      <span class="navbar-toggler-icon"></span>
    </button>
    <b-link class="navbar-brand" to="#"></b-link>
    <button class="navbar-toggler sidebar-toggler d-md-down-none mr-auto" type="button" @click="sidebarToggle">
      <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav ml-auto">
      <b-dropdown class="px-2" variant="link">
        <template slot="text">
          <i class="fe fe-plus-circle"></i>&nbsp;{{ $t('labels.add_new') }}
        </template>
        <b-dropdown-item to="/posts/create" v-if="this.$app.user.can('create posts')">
          <i class="fe fe-book"></i>&nbsp;{{ $t('labels.backend.new_menu.post') }}
        </b-dropdown-item>
        <b-dropdown-item to="/form-settings/create" v-if="this.$app.user.can('create form_settings')">
          <i class="fe fe-sliders"></i>&nbsp;{{ $t('labels.backend.new_menu.form_setting') }}
        </b-dropdown-item>
        <b-dropdown-item to="/users/create" v-if="this.$app.user.can('create users')">
          <i class="fe fe-users"></i>&nbsp;{{ $t('labels.backend.new_menu.user') }}
        </b-dropdown-item>
        <b-dropdown-item to="/roles/create" v-if="this.$app.user.can('create roles')">
          <i class="fe fe-shield"></i>&nbsp;{{ $t('labels.backend.new_menu.role') }}
        </b-dropdown-item>
        <b-dropdown-item to="/metas/create" v-if="this.$app.user.can('create metas')">
          <i class="fe fe-tag"></i>&nbsp;{{ $t('labels.backend.new_menu.meta') }}
        </b-dropdown-item>
        <b-dropdown-item to="/redirections/create" v-if="this.$app.user.can('create redirections')">
          <i class="fe fe-fast-forward"></i>&nbsp;{{ $t('labels.backend.new_menu.redirection') }}
        </b-dropdown-item>
      </b-dropdown>
      <b-dropdown class="px-2" variant="link">
        <template slot="text">
          <span class="d-md-down-none">{{ $t('labels.language') }}</span>
        </template>
        <b-dropdown-item :key="index" v-for="(locale, index) in this.$app.locales"
                         :hreflang="index"
                         :href="`/${index}/${$app.adminPathName}${$route.fullPath}`">
          {{ locale.native }}
        </b-dropdown-item>
      </b-dropdown>
      <b-dropdown class="px-2" variant="link">
        <template slot="text">
          <img :src="this.$app.user.avatar" class="img-avatar" :alt="$t('labels.user.avatar')">
          <span class="d-md-down-none">{{ this.$app.user.name }}</span>
        </template>
        <b-dropdown-item :href="$app.route('user.account')">
          <i class="fe fe-user"></i>&nbsp;{{ $t('labels.user.profile') }}
        </b-dropdown-item>
        <b-dropdown-item :href="$app.route('admin.logout')">
          <i class="fe fe-log-out"></i>&nbsp;{{ $t('labels.user.logout') }}
        </b-dropdown-item>
      </b-dropdown>
    </ul>
    <button class="navbar-toggler aside-menu-toggler d-md-down-none" type="button" @click="asideToggle">
      <span class="navbar-toggler-icon"></span>
    </button>
  </header>
</template>

<script>
export default {
  name: 'AppHeader',
  methods: {
    sidebarToggle (e) {
      e.preventDefault()
      document.body.classList.toggle('sidebar-hidden')
    },
    sidebarMinimize (e) {
      e.preventDefault()
      document.body.classList.toggle('sidebar-minimized')
    },
    mobileSidebarToggle (e) {
      e.preventDefault()
      document.body.classList.toggle('sidebar-mobile-show')
    },
    asideToggle (e) {
      e.preventDefault()
      document.body.classList.toggle('aside-menu-hidden')
    }
  }
}
</script>
