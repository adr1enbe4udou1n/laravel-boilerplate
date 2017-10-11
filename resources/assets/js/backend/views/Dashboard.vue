<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-xl">
                <div class="row" v-if="this.$app.user.can('view own posts')">
                    <div class="col-sm">
                        <b-card bg-variant="danger" text-variant="white">
                            <h4 class="mb-0">{{ newPostsCount }}</h4>
                            <p>{{ $t('labels.backend.dashboard.new_posts') }}</p>
                        </b-card>
                    </div>
                    <div class="col-sm">
                        <b-card bg-variant="warning" text-variant="white">
                            <h4 class="mb-0">{{ pendingPostsCount }}</h4>
                            <p>{{ $t('labels.backend.dashboard.pending_posts') }}</p>
                        </b-card>
                    </div>
                    <div class="col-sm">
                        <b-card bg-variant="success" text-variant="white">
                            <h4 class="mb-0">{{ publishedPostsCount }}</h4>
                            <p>{{ $t('labels.backend.dashboard.published_posts') }}</p>
                        </b-card>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm" v-if="this.$app.user.can('view users')">
                        <b-card bg-variant="primary" text-variant="white">
                            <h4 class="mb-0">{{ activeUsersCount }}</h4>
                            <p>{{ $t('labels.backend.dashboard.active_users') }}</p>
                        </b-card>
                    </div>
                    <div class="col-sm" v-if="this.$app.user.can('view form_submissions')">
                        <b-card bg-variant="info" text-variant="white">
                            <h4 class="mb-0">{{ formSubmissionsCount }}</h4>
                            <p>{{ $t('labels.backend.dashboard.form_submissions') }}</p>
                        </b-card>
                    </div>
                </div>
            </div>

            <div class="col-xl" v-if="this.$app.user.can('view own posts')">
                <b-card>
                    <h4 slot="header">{{ $t('labels.backend.dashboard.last_posts') }}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>{{ $t('validation.attributes.title') }}</th>
                                <th>{{ $t('validation.attributes.status') }}</th>
                                <th>{{ $t('validation.attributes.pinned') }}</th>
                                <th>{{ $t('validation.attributes.summary') }}</th>
                                <th class="text-center" style="width: 100px">{{ $t('labels.published_at') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <template v-if="posts.length > 0">
                                <tr v-for="post in posts">
                                    <td>
                                        <router-link :to="`/posts/${post.id}/edit`">
                                            {{ post.title }}
                                        </router-link>
                                    </td>
                                    <td><span :class="`badge badge-${post.state}`">{{ $t(post.status_label)
                                        }}</span></td>
                                    <td><span
                                            :class="`badge badge-${post.pinned ? 'success' : 'danger'}`">{{ post.pinned ? $t('labels.yes') : $t('labels.no')
                                        }}</span></td>
                                    <td>{{ post.summary }}</td>
                                    <td class="text-center">{{ post.published_at }}</td>
                                </tr>
                            </template>
                            <tr v-else>
                                <td valign="top" colspan="6"
                                    class="text-center">{{ $t('labels.no_results') }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <router-link to="/posts" class="btn btn-primary pull-right">
                        {{ $t('labels.backend.dashboard.all_posts') }}
                    </router-link>
                </b-card>
            </div>
        </div>
    </div>
</template>

<script>
  import axios from 'axios'

  export default {
    name: 'dashboard',
    data () {
      return {
        newPostsCount: 0,
        pendingPostsCount: 0,
        publishedPostsCount: 0,
        activeUsersCount: 0,
        formSubmissionsCount: 0,
        posts: {}
      }
    },
    created () {
      if (this.$app.user.can('view own posts')) {
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
        axios
          .get(this.$app.route('admin.posts.published.counter'))
          .then(response => {
            this.publishedPostsCount = response.data
          })
        axios
          .get(this.$app.route('admin.posts.latest'))
          .then(response => {
            this.posts = response.data
          })
      }

      if (this.$app.user.can('view users')) {
        axios
          .get(this.$app.route('admin.users.active.counter'))
          .then(response => {
            this.activeUsersCount = response.data
          })
      }

      if (this.$app.user.can('view form_submissions')) {
        axios
          .get(this.$app.route('admin.form_submissions.counter'))
          .then(response => {
            this.formSubmissionsCount = response.data
          })
      }
    }
  }
</script>
