import Vue from 'vue';
import Router from 'vue-router';

// Containers
import Full from '../containers/Full.vue';

// Views
import Dashboard from '../views/Dashboard.vue';
import PostForm from '../views/PostForm.vue';
import PostList from '../views/PostList.vue';
import FormSettingForm from '../views/FormSettingForm.vue';
import FormSettingList from '../views/FormSettingList.vue';
import FormSubmissionShow from '../views/FormSubmissionShow.vue';
import FormSubmissionList from '../views/FormSubmissionList.vue';
import UserForm from '../views/UserForm.vue';
import UserList from '../views/UserList.vue';
import RoleForm from '../views/RoleForm.vue';
import RoleList from '../views/RoleList.vue';
import MetaForm from '../views/MetaForm.vue';
import MetaList from '../views/MetaList.vue';
import RedirectionForm from '../views/RedirectionForm.vue';
import RedirectionList from '../views/RedirectionList.vue';

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
                        path: 'post',
                        name: i18n.t('labels.backend.posts.titles.index'),
                        component: PostList,
                        children: [
                            {
                                path: 'create',
                                name: i18n.t('labels.backend.posts.titles.create'),
                                component: PostForm
                            },
                            {
                                path: ':id/edit',
                                name: i18n.t('labels.backend.posts.titles.edit'),
                                component: PostForm,
                                props: true
                            }
                        ]
                    },
                    {
                        path: 'form-submission',
                        name: i18n.t('labels.backend.form_submissions.titles.index'),
                        component: FormSubmissionList,
                        children: [
                            {
                                path: ':id/show',
                                name: i18n.t('labels.backend.form_submissions.titles.create'),
                                component: FormSubmissionShow,
                                props: true
                            }
                        ]
                    },
                    {
                        path: 'form-setting',
                        name: i18n.t('labels.backend.form_settings.titles.index'),
                        component: FormSettingList,
                        children: [
                            {
                                path: 'create',
                                name: i18n.t('labels.backend.form_settings.titles.create'),
                                component: FormSettingForm
                            },
                            {
                                path: ':id/edit',
                                name: i18n.t('labels.backend.form_settings.titles.edit'),
                                component: FormSettingForm,
                                props: true
                            }
                        ]
                    },
                    {
                        path: 'user',
                        name: i18n.t('labels.backend.users.titles.index'),
                        component: UserList,
                        children: [
                            {
                                path: 'create',
                                name: i18n.t('labels.backend.users.titles.create'),
                                component: UserForm
                            },
                            {
                                path: ':id/edit',
                                name: i18n.t('labels.backend.users.titles.edit'),
                                component: UserForm,
                                props: true
                            }
                        ]
                    },
                    {
                        path: 'role',
                        name: i18n.t('labels.backend.roles.titles.index'),
                        component: RoleList,
                        children: [
                            {
                                path: 'create',
                                name: i18n.t('labels.backend.roles.titles.create'),
                                component: RoleForm
                            },
                            {
                                path: ':id/edit',
                                name: i18n.t('labels.backend.roles.titles.edit'),
                                component: RoleForm,
                                props: true
                            }
                        ]
                    },
                    {
                        path: 'meta',
                        name: i18n.t('labels.backend.metas.titles.index'),
                        component: MetaList,
                        children: [
                            {
                                path: 'create',
                                name: i18n.t('labels.backend.metas.titles.create'),
                                component: MetaForm
                            },
                            {
                                path: ':id/edit',
                                name: i18n.t('labels.backend.metas.titles.edit'),
                                component: MetaForm,
                                props: true
                            }
                        ]
                    },
                    {
                        path: 'redirection',
                        name: i18n.t('labels.backend.redirections.titles.index'),
                        component: RedirectionList,
                        children: [
                            {
                                path: 'create',
                                name: i18n.t('labels.backend.redirections.titles.create'),
                                component: RedirectionForm
                            },
                            {
                                path: ':id/edit',
                                name: i18n.t('labels.backend.redirections.titles.edit'),
                                component: RedirectionForm,
                                props: true
                            }
                        ]
                    }
                ]
            }
        ]
    });
}
