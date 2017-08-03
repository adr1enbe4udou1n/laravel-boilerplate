<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="row">
                    <div class="col-lg-4 col-xs-6">
                        <div class="card card-inverse card-danger">
                            <div class="card-block pb-0">
                                <h4 class="mb-0">{{ newPostsCount }}</h4>
                                <p>{{ $t('labels.backend.dashboard.new_posts') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-6">
                        <div class="card card-inverse card-warning">
                            <div class="card-block pb-0">
                                <h4 class="mb-0">{{ pendingPostsCount }}</h4>
                                <p>{{ $t('labels.backend.dashboard.pending_posts') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-6">
                        <div class="card card-inverse card-success">
                            <div class="card-block pb-0">
                                <h4 class="mb-0">{{ publishedPostsCount }}</h4>
                                <p>{{ $t('labels.backend.dashboard.published_posts') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-xs-6" v-if="user.can['manage users']">
                        <div class="card card-inverse card-primary">
                            <div class="card-block pb-0">
                                <h4 class="mb-0">{{ activeUsersCount }}</h4>
                                <p>{{ $t('labels.backend.dashboard.active_users') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-6" v-if="user.can['manage form_submissions']">
                        <div class="card card-inverse card-info">
                            <div class="card-block pb-0">
                                <h4 class="mb-0">{{ formSubmissionsCount }}</h4>
                                <p>{{ $t('labels.backend.dashboard.form_submissions') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $t('labels.backend.dashboard.last_posts') }}</h4>
                    </div>
                    <div class="card-block">
                        <table class="table">
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
                                <td><b-badge :variant="post.state">{{ $t(post.status_label) }}</b-badge></td>
                                <td><b-badge :variant="post.pinned ? 'success' : 'danger'">{{ post.pinned ? $t('labels.yes') : $t('labels.no') }}</b-badge></td>
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
                        <router-link to="/post/index" class="btn btn-primary pull-right">
                            {{ $t('labels.backend.dashboard.all_posts') }}
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'dashboard',
        data() {
            return {
                user: window.settings.user,
                newPostsCount: 0,
                pendingPostsCount: 0,
                publishedPostsCount: 0,
                activeUsersCount: 0,
                formSubmissionsCount: 0,
                posts: {},
            }
        },
        created() {
            axios
                .get('/admin/post/draft-counter')
                .then(response => {
                    this.newPostsCount = response.data;
                });
            axios
                .get('/admin/post/pending-counter')
                .then(response => {
                    this.pendingPostsCount = response.data;
                });
            axios
                .get('/admin/post/published-counter')
                .then(response => {
                    this.publishedPostsCount = response.data;
                });
            axios
                .get('/admin/user/active-counter')
                .then(response => {
                    this.activeUsersCount = response.data;
                });
            axios
                .get('/admin/form-submission/counter')
                .then(response => {
                    this.formSubmissionsCount = response.data;
                });
            axios
                .get('/admin/post/latest')
                .then(response => {
                    this.posts = response.data;
                });
        }
    }
</script>
