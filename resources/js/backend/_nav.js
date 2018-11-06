export default (app, i18n, newPostsCount, pendingPostsCount) => {
  return [
    {
      name: i18n.t('labels.backend.titles.dashboard'),
      url: '/dashboard',
      icon: 'fe fe-trending-up',
      access: true
    },
    {
      divider: true,
      access: true
    },
    {
      title: true,
      name: i18n.t('labels.backend.sidebar.content'),
      access: app.blogEnabled && app.user.can('view own posts')
    },
    {
      name: i18n.t('labels.backend.posts.titles.main'),
      url: '/posts',
      icon: 'fe fe-book',
      access: app.blogEnabled && app.user.can('view own posts')
    },
    {
      divider: true,
      access: true
    },
    {
      title: true,
      name: i18n.t('labels.backend.sidebar.forms'),
      access:
        app.user.can('view form_submissions') ||
        app.user.can('view form_settings')
    },
    {
      name: i18n.t('labels.backend.form_submissions.titles.main'),
      url: '/form-submissions',
      icon: 'fe fe-list',
      access: app.user.can('view form_submissions')
    },
    {
      name: i18n.t('labels.backend.form_settings.titles.main'),
      url: '/form-settings',
      icon: 'fe fe-sliders',
      access: app.user.can('view form_settings')
    },
    {
      divider: true,
      access: true
    },
    {
      title: true,
      name: i18n.t('labels.backend.sidebar.access'),
      access: app.user.can('view users') || app.user.can('view roles')
    },
    {
      name: i18n.t('labels.backend.users.titles.main'),
      url: '/users',
      icon: 'fe fe-users',
      access: app.user.can('view users')
    },
    {
      name: i18n.t('labels.backend.roles.titles.main'),
      url: '/roles',
      icon: 'fe fe-shield',
      access: app.user.can('view roles')
    },
    {
      divider: true,
      access: true
    },
    {
      title: true,
      name: i18n.t('labels.backend.sidebar.seo'),
      access: app.user.can('view metas') || app.user.can('view redirections')
    },
    {
      name: i18n.t('labels.backend.metas.titles.main'),
      url: '/metas',
      icon: 'fe fe-tag',
      access: app.user.can('view metas')
    },
    {
      name: i18n.t('labels.backend.redirections.titles.main'),
      url: '/redirections',
      icon: 'fe fe-fast-forward',
      access: app.user.can('view redirections')
    }
  ]
}
