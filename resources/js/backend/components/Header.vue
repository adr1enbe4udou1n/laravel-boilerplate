<template>
  <AppHeader fixed>
    <SidebarToggler class="d-lg-none" display="md" mobile></SidebarToggler>
    <a class="navbar-brand" :href="$app.homePath" target="_blank">
      <img
        class="navbar-brand-full"
        src="../../../sass/vendor/tabler/brand/logo.png"
        height="30"
        alt="Laravel Admin"
      />
      <img
        class="navbar-brand-minimized"
        src="../../../sass/vendor/tabler/brand/logo-symbol.png"
        width="30"
        height="30"
        alt="Laravel Admin"
      />
    </a>
    <SidebarToggler class="d-md-down-none" display="lg"></SidebarToggler>
    <b-navbar-nav class="ml-auto">
      <HeaderDropdown right class="px-3 d-none d-md-block">
        <template slot="header">
          <span class="d-md-down-none">
            <i class="fe fe-plus-circle"></i>&nbsp;&nbsp;{{
              $t('labels.add_new')
            }}
          </span>
        </template>
        <template slot="dropdown">
          <b-dropdown-item
            to="/posts/create"
            v-if="this.$app.user.can('create posts')"
          >
            <i class="fe fe-book"></i>&nbsp;&nbsp;{{
              $t('labels.backend.new_menu.post')
            }}
          </b-dropdown-item>
          <b-dropdown-item
            to="/form-settings/create"
            v-if="this.$app.user.can('create form_settings')"
          >
            <i class="fe fe-sliders"></i>&nbsp;&nbsp;{{
              $t('labels.backend.new_menu.form_setting')
            }}
          </b-dropdown-item>
          <b-dropdown-item
            to="/users/create"
            v-if="this.$app.user.can('create users')"
          >
            <i class="fe fe-users"></i>&nbsp;&nbsp;{{
              $t('labels.backend.new_menu.user')
            }}
          </b-dropdown-item>
          <b-dropdown-item
            to="/roles/create"
            v-if="this.$app.user.can('create roles')"
          >
            <i class="fe fe-shield"></i>&nbsp;&nbsp;{{
              $t('labels.backend.new_menu.role')
            }}
          </b-dropdown-item>
          <b-dropdown-item
            to="/metas/create"
            v-if="this.$app.user.can('create metas')"
          >
            <i class="fe fe-tag"></i>&nbsp;&nbsp;{{
              $t('labels.backend.new_menu.meta')
            }}
          </b-dropdown-item>
          <b-dropdown-item
            to="/redirections/create"
            v-if="this.$app.user.can('create redirections')"
          >
            <i class="fe fe-fast-forward"></i>&nbsp;&nbsp;{{
              $t('labels.backend.new_menu.redirection')
            }}
          </b-dropdown-item>
        </template>
      </HeaderDropdown>
      <HeaderDropdown right class="px-3 d-none d-md-block">
        <template slot="header">
          <span class="d-md-down-none">{{ $t('labels.language') }}</span>
        </template>
        <template slot="dropdown">
          <b-dropdown-item
            :key="index"
            v-for="(locale, index) in this.$app.locales"
            :hreflang="index"
            :href="`/${index}/${$app.adminPathName}${$route.fullPath}`"
          >
            {{ locale.native }}
          </b-dropdown-item>
        </template>
      </HeaderDropdown>
      <HeaderDropdown right class="px-3">
        <template slot="header">
          <img
            :src="this.$app.user.avatar"
            class="img-avatar"
            :alt="$t('labels.user.avatar')"
          />
          <span class="d-md-down-none"> {{ this.$app.user.name }} </span>
        </template>
        <template slot="dropdown">
          <b-dropdown-item :href="$app.route('user.account')">
            <i class="fe fe-user"></i>&nbsp;&nbsp;{{
              $t('labels.user.profile')
            }}
          </b-dropdown-item>
          <b-dropdown-item :href="$app.route('admin.logout')">
            <i class="fe fe-log-out"></i>&nbsp;&nbsp;{{
              $t('labels.user.logout')
            }}
          </b-dropdown-item>
        </template>
      </HeaderDropdown>
    </b-navbar-nav>
    <AsideToggler class="d-none d-lg-block"></AsideToggler>
  </AppHeader>
</template>

<script>
import AppHeader from '../../vendor/coreui/components/Header/Header'
export default {
  name: 'Header',
  components: {
    AppHeader
  }
}
</script>
