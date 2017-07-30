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
                name: 'home',
                component: Full,
                meta: {
                    title: i18n.t('labels.frontend.titles.home')
                },
                children: [
                    {
                        path: 'dashboard',
                        name: 'dashboard',
                        component: Dashboard,
                        meta: {
                            title: i18n.t('labels.backend.titles.dashboard')
                        }
                    },
                    {
                        path: 'post',
                        redirect: '/post/list',
                        name: 'post',
                        component: {
                            render (c) { return c('router-view') }
                        },
                        meta: {
                            title: i18n.t('labels.backend.posts.titles.main')
                        },
                        children: [
                            {
                                path: 'list',
                                name: 'post_list',
                                component: PostList,
                                meta: {
                                    title: i18n.t('labels.backend.posts.titles.index')
                                },
                            },
                            {
                                path: 'create',
                                name: 'post_create',
                                component: PostForm,
                                meta: {
                                    title: i18n.t('labels.backend.posts.titles.create')
                                }
                            },
                            {
                                path: ':id/edit',
                                name: 'post_edit',
                                component: PostForm,
                                props: true,
                                meta: {
                                    title: i18n.t('labels.backend.posts.titles.edit')
                                }
                            }
                        ]
                    },
                    {
                        path: 'form-submission',
                        redirect: '/form-submission/list',
                        name: 'form_submissions',
                        component: {
                            render (c) { return c('router-view') }
                        },
                        meta: {
                            title: i18n.t('labels.backend.form_submissions.titles.main')
                        },
                        children: [
                            {
                                path: 'list',
                                name: 'form_submission_list',
                                component: FormSubmissionList,
                                meta: {
                                    title: i18n.t('labels.backend.form_submissions.titles.index')
                                },
                            },
                            {
                                path: ':id/show',
                                name: 'form_submission_show',
                                component: FormSubmissionShow,
                                props: true,
                                meta: {
                                    title: i18n.t('labels.backend.form_submissions.titles.show')
                                }
                            }
                        ]
                    },
                    {
                        path: 'form-setting',
                        redirect: '/form-setting/list',
                        name: 'form_setting',
                        component: {
                            render (c) { return c('router-view') }
                        },
                        meta: {
                            title: i18n.t('labels.backend.form_settings.titles.main')
                        },
                        children: [
                            {
                                path: 'list',
                                name: 'form_setting_list',
                                component: FormSettingList,
                                meta: {
                                    title: i18n.t('labels.backend.form_settings.titles.index')
                                },
                            },
                            {
                                path: 'create',
                                name: 'form_setting_create',
                                component: FormSettingForm,
                                meta: {
                                    title: i18n.t('labels.backend.form_settings.titles.create')
                                }
                            },
                            {
                                path: ':id/edit',
                                name: 'form_setting_edit',
                                component: FormSettingForm,
                                props: true,
                                meta: {
                                    title: i18n.t('labels.backend.form_settings.titles.edit')
                                }
                            }
                        ]
                    },
                    {
                        path: 'user',
                        redirect: '/user/list',
                        name: 'user',
                        component: {
                            render (c) { return c('router-view') }
                        },
                        meta: {
                            title: i18n.t('labels.backend.users.titles.main')
                        },
                        children: [
                            {
                                path: 'list',
                                name: 'user_list',
                                component: UserList,
                                meta: {
                                    title: i18n.t('labels.backend.users.titles.index')
                                },
                            },
                            {
                                path: 'create',
                                name: 'user_create',
                                component: UserForm,
                                meta: {
                                    title: i18n.t('labels.backend.users.titles.create')
                                }
                            },
                            {
                                path: ':id/edit',
                                name: 'user_edit',
                                component: UserForm,
                                props: true,
                                meta: {
                                    title: i18n.t('labels.backend.users.titles.edit')
                                }
                            }
                        ]
                    },
                    {
                        path: 'role',
                        redirect: '/role/list',
                        name: 'role',
                        component: {
                            render (c) { return c('router-view') }
                        },
                        meta: {
                            title: i18n.t('labels.backend.roles.titles.main')
                        },
                        children: [
                            {
                                path: 'list',
                                name: 'role_list',
                                component: RoleList,
                                meta: {
                                    title: i18n.t('labels.backend.roles.titles.index')
                                },
                            },
                            {
                                path: 'create',
                                name: 'role_create',
                                component: RoleForm,
                                meta: {
                                    title: i18n.t('labels.backend.roles.titles.create')
                                }
                            },
                            {
                                path: ':id/edit',
                                name: 'role_edit',
                                component: RoleForm,
                                props: true,
                                meta: {
                                    title: i18n.t('labels.backend.roles.titles.edit')
                                }
                            }
                        ]
                    },
                    {
                        path: 'meta',
                        redirect: '/meta/list',
                        name: 'meta',
                        component: {
                            render (c) { return c('router-view') }
                        },
                        meta: {
                            title: i18n.t('labels.backend.metas.titles.main')
                        },
                        children: [
                            {
                                path: 'list',
                                name: 'meta_list',
                                component: MetaList,
                                meta: {
                                    title: i18n.t('labels.backend.metas.titles.index')
                                },
                            },
                            {
                                path: 'create',
                                name: 'meta_create',
                                component: MetaForm,
                                meta: {
                                    title: i18n.t('labels.backend.metas.titles.create')
                                }
                            },
                            {
                                path: ':id/edit',
                                name: 'meta_edit',
                                component: MetaForm,
                                props: true,
                                meta: {
                                    title: i18n.t('labels.backend.metas.titles.edit')
                                }
                            }
                        ]
                    },
                    {
                        path: 'redirection',
                        redirect: '/redirection/list',
                        name: 'redirection',
                        component: {
                            render (c) { return c('router-view') }
                        },
                        meta: {
                            title: i18n.t('labels.backend.redirections.titles.main')
                        },
                        children: [
                            {
                                path: 'list',
                                name: 'redirection_list',
                                component: RedirectionList,
                                meta: {
                                    title: i18n.t('labels.backend.redirections.titles.index')
                                },
                            },
                            {
                                path: 'create',
                                name: 'redirection_create',
                                component: RedirectionForm,
                                meta: {
                                    title: i18n.t('labels.backend.redirections.titles.create')
                                }
                            },
                            {
                                path: ':id/edit',
                                name: 'redirection_edit',
                                component: RedirectionForm,
                                props: true,
                                meta: {
                                    title: i18n.t('labels.backend.redirections.titles.edit')
                                }
                            }
                        ]
                    }
                ]
            }
        ]
    });
}
