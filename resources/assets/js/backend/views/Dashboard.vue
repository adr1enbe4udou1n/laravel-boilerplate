<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-xl">
                <div class="row">
                    <div class="col-sm">
                        <div class="card text-white bg-danger">
                            <div class="card-body pb-0">
                                <h4 class="mb-0">{{ newPostsCount }}</h4>
                                <p>{{ $t('labels.backend.dashboard.new_posts') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card text-white bg-warning">
                            <div class="card-body pb-0">
                                <h4 class="mb-0">{{ pendingPostsCount }}</h4>
                                <p>{{ $t('labels.backend.dashboard.pending_posts') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card text-white bg-success">
                            <div class="card-body pb-0">
                                <h4 class="mb-0">{{ publishedPostsCount }}</h4>
                                <p>{{ $t('labels.backend.dashboard.published_posts') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm" v-if="this.$root.user.can['manage users']">
                        <div class="card text-white bg-primary">
                            <div class="card-body pb-0">
                                <h4 class="mb-0">{{ activeUsersCount }}</h4>
                                <p>{{ $t('labels.backend.dashboard.active_users') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm" v-if="this.$root.user.can['manage form_submissions']">
                        <div class="card text-white bg-info">
                            <div class="card-body pb-0">
                                <h4 class="mb-0">{{ formSubmissionsCount }}</h4>
                                <p>{{ $t('labels.backend.dashboard.form_submissions') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $t('labels.backend.dashboard.last_posts') }}</h4>
                    </div>
                    <div class="card-body">
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
                                        <router-link :to="`/post/${post.id}/edit`">
                                            {{ post.title }}
                                        </router-link>
                                    </td>
                                    <td><span :class="`badge badge-${post.state}`">{{ $t(post.status_label) }}</span></td>
                                    <td><span :class="`badge badge-${post.pinned ? 'success' : 'danger'}`">{{ post.pinned ? $t('labels.yes') : $t('labels.no') }}</span></td>
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
                        <router-link to="/post" class="btn btn-primary pull-right">
                            {{ $t('labels.backend.dashboard.all_posts') }}
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'dashboard',
        data() {
            return {
                newPostsCount: 0,
                pendingPostsCount: 0,
                publishedPostsCount: 0,
                activeUsersCount: 0,
                formSubmissionsCount: 0,
                posts: {},
            };
        },
        created() {
            if (this.$root.user.can['manage own posts']) {
                axios
                    .get(`${this.$root.adminPath}/post/draft-counter`)
                    .then(response => {
                        this.newPostsCount = response.data;
                    });
                axios
                    .get(`${this.$root.adminPath}/post/pending-counter`)
                    .then(response => {
                        this.pendingPostsCount = response.data;
                    });
                axios
                    .get(`${this.$root.adminPath}/post/published-counter`)
                    .then(response => {
                        this.publishedPostsCount = response.data;
                    });
                axios
                    .get(`${this.$root.adminPath}/post/latest`)
                    .then(response => {
                        this.posts = response.data;
                    });
            }

            if (this.$root.user.can['manage users']) {
                axios
                    .get(`${this.$root.adminPath}/user/active-counter`)
                    .then(response => {
                        this.activeUsersCount = response.data;
                    });
            }

            if (this.$root.user.can['manage form_submissions']) {
                axios
                    .get(`${this.$root.adminPath}/form-submission/counter`)
                    .then(response => {
                        this.formSubmissionsCount = response.data;
                    });
            }


        }
    };
</script>
