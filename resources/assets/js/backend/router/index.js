import Vue from 'vue'
import Router from 'vue-router'

// Containers
import Full from '../containers/Full'

// Views
import Dashboard from '../views/Dashboard'
import PostForm from '../views/PostForm'
import PostList from '../views/PostList'
import FormSettingForm from '../views/FormSettingForm'
import FormSettingList from '../views/FormSettingList'
import FormSubmissionShow from '../views/FormSubmissionShow'
import FormSubmissionList from '../views/FormSubmissionList'
import UserForm from '../views/UserForm'
import UserList from '../views/UserList'
import RoleForm from '../views/RoleForm'
import RoleList from '../views/RoleList'
import MetaForm from '../views/MetaForm'
import MetaList from '../views/MetaList'
import RedirectionForm from '../views/RedirectionForm'
import RedirectionList from '../views/RedirectionList'

Vue.use(Router)

export default (base, i18n) => {
  return new Router({
    mode: 'history',
    base: base,
    linkActiveClass: 'open active',
    scrollBehavior: () => ({y: 0}),
    routes: [
      {
        path: '/',
        redirect: '/dashboard',
        name: 'home',
        component: Full,
        meta: {
          title: i18n.t('labels.frontend.titles.administration')
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
            path: 'posts',
            component: {
              render (c) {
                return c('router-view')
              }
            },
            meta: {
              title: i18n.t('labels.backend.posts.titles.main')
            },
            children: [
              {
                path: '/',
                name: 'posts',
                component: PostList,
                meta: {
                  title: i18n.t('labels.backend.posts.titles.index')
                }
              },
              {
                path: 'create',
                name: 'posts_create',
                component: PostForm,
                meta: {
                  title: i18n.t('labels.backend.posts.titles.create')
                }
              },
              {
                path: ':id/edit',
                name: 'posts_edit',
                component: PostForm,
                props: true,
                meta: {
                  title: i18n.t('labels.backend.posts.titles.edit')
                }
              }
            ]
          },
          {
            path: 'form-submissions',
            component: {
              render (c) {
                return c('router-view')
              }
            },
            meta: {
              title: i18n.t('labels.backend.form_submissions.titles.main')
            },
            children: [
              {
                path: '/',
                name: 'form_submissions',
                component: FormSubmissionList,
                meta: {
                  title: i18n.t('labels.backend.form_submissions.titles.index')
                }
              },
              {
                path: ':id/show',
                name: 'form_submissions_show',
                component: FormSubmissionShow,
                props: true,
                meta: {
                  title: i18n.t('labels.backend.form_submissions.titles.show')
                }
              }
            ]
          },
          {
            path: 'form-settings',
            component: {
              render (c) {
                return c('router-view')
              }
            },
            meta: {
              title: i18n.t('labels.backend.form_settings.titles.main')
            },
            children: [
              {
                path: '/',
                name: 'form_settings',
                component: FormSettingList,
                meta: {
                  title: i18n.t('labels.backend.form_settings.titles.index')
                }
              },
              {
                path: 'create',
                name: 'form_settings_create',
                component: FormSettingForm,
                meta: {
                  title: i18n.t('labels.backend.form_settings.titles.create')
                }
              },
              {
                path: ':id/edit',
                name: 'form_settings_edit',
                component: FormSettingForm,
                props: true,
                meta: {
                  title: i18n.t('labels.backend.form_settings.titles.edit')
                }
              }
            ]
          },
          {
            path: 'users',
            component: {
              render (c) {
                return c('router-view')
              }
            },
            meta: {
              title: i18n.t('labels.backend.users.titles.main')
            },
            children: [
              {
                path: '/',
                name: 'users',
                component: UserList,
                meta: {
                  title: i18n.t('labels.backend.users.titles.index')
                }
              },
              {
                path: 'create',
                name: 'users_create',
                component: UserForm,
                meta: {
                  title: i18n.t('labels.backend.users.titles.create')
                }
              },
              {
                path: ':id/edit',
                name: 'users_edit',
                component: UserForm,
                props: true,
                meta: {
                  title: i18n.t('labels.backend.users.titles.edit')
                }
              }
            ]
          },
          {
            path: 'roles',
            component: {
              render (c) {
                return c('router-view')
              }
            },
            meta: {
              title: i18n.t('labels.backend.roles.titles.main')
            },
            children: [
              {
                path: '/',
                name: 'roles',
                component: RoleList,
                meta: {
                  title: i18n.t('labels.backend.roles.titles.index')
                }
              },
              {
                path: 'create',
                name: 'roles_create',
                component: RoleForm,
                meta: {
                  title: i18n.t('labels.backend.roles.titles.create')
                }
              },
              {
                path: ':id/edit',
                name: 'roles_edit',
                component: RoleForm,
                props: true,
                meta: {
                  title: i18n.t('labels.backend.roles.titles.edit')
                }
              }
            ]
          },
          {
            path: 'metas',
            component: {
              render (c) {
                return c('router-view')
              }
            },
            meta: {
              title: i18n.t('labels.backend.metas.titles.main')
            },
            children: [
              {
                path: '/',
                name: 'metas',
                component: MetaList,
                meta: {
                  title: i18n.t('labels.backend.metas.titles.index')
                }
              },
              {
                path: 'create',
                name: 'metas_create',
                component: MetaForm,
                meta: {
                  title: i18n.t('labels.backend.metas.titles.create')
                }
              },
              {
                path: ':id/edit',
                name: 'metas_edit',
                component: MetaForm,
                props: true,
                meta: {
                  title: i18n.t('labels.backend.metas.titles.edit')
                }
              }
            ]
          },
          {
            path: 'redirections',
            component: {
              render (c) {
                return c('router-view')
              }
            },
            meta: {
              title: i18n.t('labels.backend.redirections.titles.main')
            },
            children: [
              {
                path: '/',
                name: 'redirections',
                component: RedirectionList,
                meta: {
                  title: i18n.t('labels.backend.redirections.titles.index')
                }
              },
              {
                path: 'create',
                name: 'redirections_create',
                component: RedirectionForm,
                meta: {
                  title: i18n.t('labels.backend.redirections.titles.create')
                }
              },
              {
                path: ':id/edit',
                name: 'redirections_edit',
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
  })
}
