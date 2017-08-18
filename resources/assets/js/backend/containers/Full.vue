<template>
    <div class="app">
        <AppHeader/>
        <div class="app-body">
            <Sidebar/>
            <main class="main">
                <div class="alert alert-warning alert-top mb-0" v-if="this.$app.isImpersonation">
                    <span v-html="$t('labels.alerts.login_as', {'name': this.$app.user.name, 'route': `${this.$app.homePath}/logout-as`, 'admin': this.$app.usurperName})"></span>
                </div>
                <div class="alert alert-warning alert-top mb-0" v-if="!this.$app.user.confirmed">
                    <span v-html="$t('labels.alerts.not_confirmed', {'route': '/user/confirmation/send' })"></span>
                </div>
                <breadcrumb :list="list"/>
                <div class="container-fluid">
                    <router-view :key="this.$route.name"></router-view>
                </div>
            </main>
        </div>
        <AppFooter :name="this.$app.appName" :editor-name="this.$app.editorName" :editor-site-url="this.$app.editorSiteUrl" />
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
