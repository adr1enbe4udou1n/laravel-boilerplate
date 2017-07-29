<template>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="row">
                    <div class="col-lg-4 col-xs-6">
                        <div class="card card-inverse card-danger">
                            <div class="card-block pb-0">
                                <h4 class="mb-0">{{ new_posts_count }}</h4>
                                <p>{{ $t('labels.backend.dashboard.new_posts') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-6">
                        <div class="card card-inverse card-warning">
                            <div class="card-block pb-0">
                                <h4 class="mb-0">{{ pending_posts_count }}</h4>
                                <p>{{ $t('labels.backend.dashboard.pending_posts') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-6">
                        <div class="card card-inverse card-success">
                            <div class="card-block pb-0">
                                <h4 class="mb-0">{{ published_posts_count }}</h4>
                                <p>{{ $t('labels.backend.dashboard.published_posts') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-xs-6" v-if="user.can['manage users']">
                        <div class="card card-inverse card-primary">
                            <div class="card-block pb-0">
                                <h4 class="mb-0">{{ active_users_count }}</h4>
                                <p>{{ $t('labels.backend.dashboard.active_users') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-6" v-if="user.can['manage form_submissions']">
                        <div class="card card-inverse card-info">
                            <div class="card-block pb-0">
                                <h4 class="mb-0">{{ form_submissions_count }}</h4>
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
                                <td valign="top" colspan="6"
                                    class="text-center"> post ok
                                </td>
                            </tr>
                            </template>
                            <tr v-else>
                                <td valign="top" colspan="6"
                                    class="text-center">{{ $t('labels.no_results') }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <a href="admin.post.index"
                           class="btn btn-primary pull-right">{{ $t('labels.backend.dashboard.all_posts') }}</a>
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
                routes: window.settings.routes,
                new_posts_count: 0,
                pending_posts_count: 0,
                published_posts_count: 0,
                active_users_count: 0,
                form_submissions_count: 0,
                posts: [],
            }
        },
        mounted() {

        }
    }
</script>
