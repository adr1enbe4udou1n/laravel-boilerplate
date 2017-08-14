<template>
    <header class="app-header navbar navbar-expand-lg">
        <button class="navbar-toggler d-lg-none" type="button" @click="mobileSidebarToggle">
            &#9776;
        </button>
        <a class="navbar-brand" href="#"></a>
        <ul class="nav navbar-nav d-md-down-none mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#" @click="sidebarMinimize">&#9776;</a>
            </li>
        </ul>
        <ul class="nav navbar-nav ml-auto mr-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <span class="d-md-down-none">{{ $t('labels.language') }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" rel="alternate" v-for="(locale, index) in this.$root.locales" :hreflang="index"
                       :href="`/${index}/${$root.adminPathName}#${$router.currentRoute.fullPath}`">
                        {{ locale.native }}
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <img :src="this.$root.user.avatar" class="img-avatar" :alt="$t('labels.user.avatar')">
                    <span class="d-md-down-none">{{ this.$root.user.name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>{{ $t('labels.user.settings') }}</strong>
                    </div>

                    <a class="dropdown-item" :href="`${this.$root.homePath}/user/account`"><i class="icon-user"></i>
                        {{ $t('labels.user.profile') }}</a>
                    <a class="dropdown-item" :href="`${this.$root.adminPath}/logout`"><i class="icon-logout"></i>
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
            sidebarToggle(e) {
                e.preventDefault();
                document.body.classList.toggle('sidebar-hidden');
            },
            sidebarMinimize(e) {
                e.preventDefault();
                document.body.classList.toggle('sidebar-minimized');
            },
            mobileSidebarToggle(e) {
                e.preventDefault();
                document.body.classList.toggle('sidebar-mobile-show');
            },
            asideToggle(e) {
                e.preventDefault();
                document.body.classList.toggle('aside-menu-hidden');
            },
        }
    };
</script>
