<template>
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-title">{{ $t('labels.general') }}</li>
                <li class="nav-item">
                    <router-link to="/dashboard" class="nav-link">
                        <i class="icon-speedometer"></i> {{ $t('labels.backend.titles.dashboard') }}
                    </router-link>
                </li>

                <template v-if="this.$app.blogEnabled && this.$app.user.can['manage own posts']">
                    <li class="nav-title">{{ $t('labels.backend.sidebar.content') }}</li>
                    <li class="nav-item">
                        <router-link to="/posts/create" class="nav-link">
                            <i class="icon-plus"></i> {{ $t('labels.backend.posts.titles.create') }}
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/posts" class="nav-link">
                            <i class="icon-notebook"></i> {{ $t('labels.backend.posts.titles.main') }}
                            <span class="badge badge-danger"
                                  :title="$t('labels.backend.dashboard.new_posts')">{{ newPostsCount }}</span>
                            <span class="badge badge-warning"
                                  :title="$t('labels.backend.dashboard.pending_posts')">{{ pendingPostsCount }}</span>
                        </router-link>
                    </li>
                </template>

                <template
                        v-if="this.$app.user.can['manage form_submissions'] || this.$app.user.can['manage form_settings']">
                    <li class="nav-title">{{ $t('labels.backend.sidebar.forms') }}</li>
                    <li class="nav-item" v-if="this.$app.user.can['manage form_submissions']">
                        <router-link to="/form-submissions" class="nav-link">
                            <i class="icon-list"></i> {{ $t('labels.backend.form_submissions.titles.main') }}
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="this.$app.user.can['manage form_settings']">
                        <router-link to="/form-settings" class="nav-link">
                            <i class="icon-equalizer"></i> {{ $t('labels.backend.form_settings.titles.main') }}
                        </router-link>
                    </li>
                </template>

                <template v-if="this.$app.user.can['manage users'] || this.$app.user.can['manage roles']">
                    <li class="nav-title">{{ $t('labels.backend.sidebar.access') }}</li>
                    <li class="nav-item" v-if="this.$app.user.can['manage users']">
                        <router-link to="/users/create" class="nav-link">
                            <i class="icon-plus"></i> {{ $t('labels.backend.users.titles.create') }}
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="this.$app.user.can['manage users']">
                        <router-link to="/users" class="nav-link">
                            <i class="icon-people"></i> {{ $t('labels.backend.users.titles.main') }}
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="this.$app.user.can['manage roles']">
                        <router-link to="/roles" class="nav-link">
                            <i class="icon-shield"></i> {{ $t('labels.backend.roles.titles.main') }}
                        </router-link>
                    </li>
                </template>

                <template v-if="this.$app.user.can['manage metas'] || this.$app.user.can['manage redirections']">
                    <li class="nav-title">{{ $t('labels.backend.sidebar.seo') }}</li>
                    <li class="nav-item" v-if="this.$app.user.can['manage metas']">
                        <router-link to="/metas/create" class="nav-link">
                            <i class="icon-plus"></i> {{ $t('labels.backend.metas.titles.create') }}
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="this.$app.user.can['manage metas']">
                        <router-link to="/metas" class="nav-link">
                            <i class="icon-tag"></i> {{ $t('labels.backend.metas.titles.main') }}
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="this.$app.user.can['manage redirections']">
                        <router-link to="/redirections" class="nav-link">
                            <i class="icon-control-forward"></i> {{ $t('labels.backend.redirections.titles.main') }}
                        </router-link>
                    </li>
                </template>
            </ul>
        </nav>
    </div>
</template>
<script>
  import axios from 'axios'

  export default {
    name: 'sidebar',
    data () {
      return {
        newPostsCount: 0,
        pendingPostsCount: 0
      }
    },
    created () {
      this.fetchData()
    },
    methods: {
      fetchData () {
        if (this.$app.user.can['manage own posts']) {
          axios
            .get(this.$app.route('admin.posts.draft.counter'))
            .then(response => {
              this.newPostsCount = response.data
            })
          axios
            .get(this.$app.route('admin.posts.pending.counter'))
            .then(response => {
              this.pendingPostsCount = response.data
            })
        }
      },
      handleClick (e) {
        e.preventDefault()
        e.target.parentElement.classList.toggle('open')
      }
    },
    watch: {
      '$route': 'fetchData'
    }
  }
</script>

<style lang="css">
    .nav-link {
        cursor: pointer;
    }
</style>
