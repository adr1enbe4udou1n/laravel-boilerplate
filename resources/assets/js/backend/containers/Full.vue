<template>
    <div class="app">
        <AppHeader/>
        <div class="app-body">
            <Sidebar/>
            <main class="main">
                <b-alert variant="warning" show v-if="isImpersonation">
                    <span v-html="$t('labels.alerts.login_as', {'name': user.name, 'route': '/admin/logout-as', 'admin': usurperName})"></span>
                </b-alert>
                <b-alert variant="warning" show v-if="!user.confirmed">
                    <span v-html="$t('labels.alerts.not_confirmed', {'route': '/user/confirmation/send' })"></span>
                </b-alert>
                <breadcrumb :list="list"/>
                <div class="container-fluid">
                    <router-view></router-view>
                </div>
            </main>
        </div>
        <AppFooter/>
    </div>
</template>

<script>
    import AppHeader from '../components/Header.vue'
    import Sidebar from '../components/Sidebar.vue'
    import AppFooter from '../components/Footer.vue'
    import Breadcrumb from '../components/Breadcrumb.vue'

    export default {
        name: 'full',
        components: {
            AppHeader,
            Sidebar,
            AppFooter,
            Breadcrumb
        },
        data() {
            return {
                user: window.settings.user,
                isImpersonation: window.settings.is_impersonation,
                usurperName: window.settings.usurper_name,
            }
        },
        computed: {
            name() {
                return this.$route.name
            },

            list() {
                return this.$route.matched
            }
        }
    }
</script>
