<template>
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none" type="button" @click="mobileSidebarToggle">
            &#9776;
        </button>
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none mr-auto" type="button" @click="sidebarToggle">&#9776;</button>
        <ul class="nav navbar-nav ml-auto mr-4">
            <li class="nav-item dropdown px-2">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <span class="d-md-down-none"><i class="icon-plus"></i> {{ $t('labels.add_new') }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <router-link class="dropdown-item" to="/posts/create" v-if="this.$app.user.can('create posts')">
                        <i class="icon-notebook"></i> {{ $t('labels.backend.new_menu.post') }}
                    </router-link>
                    <router-link class="dropdown-item" to="/form-settings/create" v-if="this.$app.user.can('create form_settings')">
                        <i class="icon-equalizer"></i> {{ $t('labels.backend.new_menu.form_setting') }}
                    </router-link>
                    <router-link class="dropdown-item" to="/users/create" v-if="this.$app.user.can('create users')">
                        <i class="icon-people"></i> {{ $t('labels.backend.new_menu.user') }}
                    </router-link>
                    <router-link class="dropdown-item" to="/roles/create" v-if="this.$app.user.can('create roles')">
                        <i class="icon-shield"></i> {{ $t('labels.backend.new_menu.role') }}
                    </router-link>
                    <router-link class="dropdown-item" to="/metas/create" v-if="this.$app.user.can('create metas')">
                        <i class="icon-tag"></i> {{ $t('labels.backend.new_menu.meta') }}
                    </router-link>
                    <router-link class="dropdown-item" to="/redirections/create" v-if="this.$app.user.can('create redirections')">
                        <i class="icon-control-forward"></i> {{ $t('labels.backend.new_menu.redirection') }}
                    </router-link>
                </div>
            </li>
            <li class="nav-item dropdown px-2">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <span class="d-md-down-none">{{ $t('labels.language') }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" rel="alternate" :key="index" v-for="(locale, index) in this.$app.locales"
                       :hreflang="index"
                       :href="`/${index}/${$app.adminPathName}${$route.fullPath}`">
                        {{ locale.native }}
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown px-2">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <img :src="this.$app.user.avatar" class="img-avatar" :alt="$t('labels.user.avatar')">
                    <span class="d-md-down-none">{{ this.$app.user.name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>{{ $t('labels.user.settings') }}</strong>
                    </div>

                    <a class="dropdown-item" :href="$app.route('user.account')"><i class="icon-user"></i>
                        {{ $t('labels.user.profile') }}</a>
                    <a class="dropdown-item" :href="$app.route('admin.logout')"><i class="icon-logout"></i>
                        {{ $t('labels.user.logout') }}</a>
                </div>
            </li>
        </ul>
    </header>
</template>

<script>
  export default {
    name: 'header',
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
