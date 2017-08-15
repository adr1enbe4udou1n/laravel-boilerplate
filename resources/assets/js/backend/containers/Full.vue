<template>
    <div class="app">
        <AppHeader/>
        <div class="app-body">
            <Sidebar/>
            <main class="main">
                <div class="alert alert-warning alert-top mb-0" v-if="this.$root.isImpersonation">
                    <span v-html="$t('labels.alerts.login_as', {'name': this.$root.user.name, 'route': `${this.$root.homePath}/logout-as`, 'admin': this.$root.usurperName})"></span>
                </div>
                <div class="alert alert-warning alert-top mb-0" v-if="!this.$root.user.confirmed">
                    <span v-html="$t('labels.alerts.not_confirmed', {'route': '/user/confirmation/send' })"></span>
                </div>
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
