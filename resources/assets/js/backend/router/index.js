import Vue from 'vue';
import Router from 'vue-router';

// Containers
import Full from '../containers/Full.vue';

// Views
import Dashboard from '../views/Dashboard.vue';
import PostCreate from '../views/post/PostCreate.vue';

Vue.use(Router);

export default (i18n) => {
    return new Router({
        mode: 'hash',
        linkActiveClass: 'open active',
        scrollBehavior: () => ({y: 0}),
        routes: [
            {
                path: '/',
                redirect: '/dashboard',
                name: i18n.t('labels.frontend.titles.home'),
                component: Full,
                children: [
                    {
                        path: 'dashboard',
                        name: i18n.t('labels.backend.titles.dashboard'),
                        component: Dashboard
                    },
                    {
                        path: 'post/create',
                        name: i18n.t('labels.backend.posts.titles.create'),
                        component: PostCreate
                    }
                ]
            }
        ]
    });
}
