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

                <b-card header="Line Chart">
                    <div class="chart-wrapper">
                        <line-example/>
                    </div>
                </b-card>
                <b-card header="Pie Chart">
                    <div class="chart-wrapper">
                        <pie-example/>
                    </div>
                </b-card>
            </div>

            <div class="col-xl" v-if="this.$app.user.can('view own posts')">
                <b-card>
                    <h4 slot="header">{{ $t('labels.backend.dashboard.last_posts') }}</h4>
                    <div class="table-responsive">
                        <b-table striped bordered hover show-empty :fields="post_fields" :items="posts"
                            :emptyText="$t('labels.no_results')">
                            <template slot="title" scope="row">
                                <router-link :to="`/posts/${row.item.id}/edit`">
                                    {{ row.value }}
                                </router-link>
                            </template>
                            <template slot="status" scope="row">
                                <b-badge :variant="row.item.state">{{ $t(row.item.status_label) }}</b-badge>
                            </template>
                            <template slot="pinned" scope="row">
                                <b-badge :variant="row.value ? 'success' : 'danger'">{{ row.value ? $t('labels.yes') : $t('labels.no') }}</b-badge>
                            </template>
                        </b-table>
                    </div>
                    <b-button to="/posts" variant="primary" class="pull-right">
                        {{ $t('labels.backend.dashboard.all_posts') }}
                    </b-button>
                </b-card>
            </div>
        </div>
    </div>
</template>

<script>
  import axios from 'axios'
  import LineExample from './charts/LineExample'
  import PieExample from './charts/PieExample'

  export default {
    name: 'dashboard',
    components: {
      LineExample,
      PieExample
    },
    data () {
      return {
        newPostsCount: 0,
        pendingPostsCount: 0,
        publishedPostsCount: 0,
        activeUsersCount: 0,
        formSubmissionsCount: 0,
        post_fields: {
          title: { label: this.$t('validation.attributes.title') },
          status: { label: this.$t('validation.attributes.status') },
          pinned: { label: this.$t('validation.attributes.pinned') },
          summary: { label: this.$t('validation.attributes.summary') },
          published_at: { label: this.$t('validation.attributes.published_at'), 'class': 'text-center' }
        },
        posts: []
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
