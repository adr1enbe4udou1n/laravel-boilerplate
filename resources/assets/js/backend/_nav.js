export default (app, i18n, newPostsCount, pendingPostsCount) => {
  return [
    {
      name: 'Dashboard',
      url: '/dashboard',
      icon: 'icon-speedometer',
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
      icon: 'icon-notebook',
      access: app.blogEnabled && app.user.can('view own posts'),
      badges: [
        {
          name: i18n.t('labels.backend.dashboard.new_posts'),
          variant: 'danger',
          text: newPostsCount
        },
        {
          name: i18n.t('labels.backend.dashboard.pending_posts'),
          variant: 'warning',
          text: pendingPostsCount
        }
      ]
    },
    {
      divider: true,
      access: true
    },
    {
      title: true,
      name: i18n.t('labels.backend.sidebar.forms'),
      access: app.user.can('view form_submissions') || app.user.can('view form_settings')
    },
    {
      name: i18n.t('labels.backend.form_submissions.titles.main'),
      url: '/form-submissions',
      icon: 'icon-list',
      access: app.user.can('view form_submissions')
    },
    {
      name: i18n.t('labels.backend.form_settings.titles.main'),
      url: '/form-settings',
      icon: 'icon-equalizer',
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
      icon: 'icon-people',
      access: app.user.can('view users')
    },
    {
      name: i18n.t('labels.backend.roles.titles.main'),
      url: '/roles',
      icon: 'icon-shield',
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
      icon: 'icon-tag',
      access: app.user.can('view metas')
    },
    {
      name: i18n.t('labels.backend.redirections.titles.main'),
      url: '/redirections',
      icon: 'icon-control-forward',
      access: app.user.can('view redirections')
    }
  ]
}
