<template>
    <div class="app">
        <AppHeader/>
        <div class="app-body">
            <Sidebar/>
            <main class="main">
                <b-alert variant="warning" show v-if="this.$root.isImpersonation">
                    <span v-html="$t('labels.alerts.login_as', {'name': user.name, 'route': '/admin/logout-as', 'admin': usurperName})"></span>
                </b-alert>
                <b-alert variant="warning" show v-if="!this.$root.user.confirmed">
                    <span v-html="$t('labels.alerts.not_confirmed', {'route': '/user/confirmation/send' })"></span>
                </b-alert>
                <breadcrumb :list="list"/>
                <div class="container-fluid">
                    <router-view :key="this.$route.name"></router-view>
                </div>
            </main>
        </div>
        <AppFooter :name="this.$root.appName" :editor-name="this.$root.editorName" :editor-site-url="this.$root.editorSiteUrl" />
    </div>
</template>

<script>
    import AppHeader from '../components/Header.vue';
    import Sidebar from '../components/Sidebar.vue';
    import AppFooter from '../components/Footer.vue';
    import Breadcrumb from '../components/Breadcrumb.vue';

    export default {
        name: 'full',
        components: {
            AppHeader,
            Sidebar,
            AppFooter,
            Breadcrumb
        },
        computed: {
            name() {
                return this.$route.name;
            },

            list() {
                return this.$route.matched;
            }
        }
    };
</script>
