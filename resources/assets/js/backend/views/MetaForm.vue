<template>
    <div class="animated fadeIn">
        <form @submit.prevent="onSubmit">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                {{ isNew ? $t('labels.backend.metas.titles.create') : $t('labels.backend.metas.titles.edit')
                                }}</h4>
                        </div>

                        <div class="card-block">
                            <template v-if="this.meta.metable_type !== null">
                                <div class="form-group">
                                    <label class="control-label col-lg-3">{{ $t('validation.attributes.metable_type')
                                        }}</label>
                                    <div class="col-lg-9">
                                        <label class="control-label">{{ $t(`labels.morphs.${this.meta.metable_type}`, {'id': this.meta.metable_id})
                                            }}</label>
                                    </div>
                                </div>
                            </template>
                            <template v-else>
                                <b-form-fieldset
                                        label-for="route"
                                        :label="$t('validation.attributes.route')"
                                        :horizontal="true"
                                        :label-cols="3"
                                        :state="validation.errors.hasOwnProperty('route') ? 'danger' : ''"
                                        :feedback="validation.errors.hasOwnProperty('route') ? validation.errors.route[0] : ''"
                                >
                                    <v-select
                                            id="route"
                                            name="route"
                                            :options="routes"
                                            v-model="meta.route"
                                            :placeholder="$t('labels.placeholders.route')"
                                            :on-search="getRoutes"
                                    ></v-select>
                                </b-form-fieldset>
                            </template>

                            <b-form-fieldset
                                    label-for="title"
                                    :label="$t('validation.attributes.title')"
                                    :horizontal="true"
                                    :label-cols="3"
                                    :state="validation.errors.hasOwnProperty('title') ? 'danger' : ''"
                                    :feedback="validation.errors.hasOwnProperty('title') ? validation.errors.title[0] : ''"
                            >
                                <b-form-input
                                        id="title"
                                        name="title"
                                        :placeholder="$t('validation.attributes.title')"
                                        v-model="meta.title"
                                ></b-form-input>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="description"
                                    :label="$t('validation.attributes.description')"
                                    :horizontal="true"
                                    :label-cols="3"
                                    :state="validation.errors.hasOwnProperty('description') ? 'danger' : ''"
                                    :feedback="validation.errors.hasOwnProperty('description') ? validation.errors.description[0] : ''"
                            >
                                <b-form-input
                                        id="description"
                                        name="description[meta]"
                                        :textarea="true"
                                        :rows="5"
                                        :placeholder="$t('validation.attributes.description')"
                                        v-model="meta.description"
                                ></b-form-input>
                            </b-form-fieldset>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <router-link to="/meta" class="btn btn-danger btn-sm">{{ $t('buttons.back') }}
                                    </router-link>
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" class="btn btn-success btn-sm pull-right"
                                           :value="isNew ? $t('buttons.create') : $t('buttons.edit')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: 'meta_form',
        props: ['id'],
        data() {
            return {
                routes: [],
                meta: this.initMeta(),
                validation: {
                    errors: {}
                }
            }
        },
        computed: {
            isNew() {
                return this.id === undefined;
            }
        },
        methods: {
            initMeta() {
                return {
                    metable_type: null,
                    metable_id: null,
                    route: null,
                    title: null,
                    description: null
                };
            },
            fetchData() {
                this.routes = [];
                this.meta = this.initMeta();

                if (!this.isNew) {
                    axios
                        .get(`/${this.$root.adminPath}/meta/${this.id}`)
                        .then(response => {
                            this.meta = response.data;

                            if (this.meta.route) {
                                this.meta.route = {
                                    value: this.meta.route,
                                    label: this.$i18n.t(`routes.${this.meta.route}`)
                                };
                            }
                        });
                }
            },
            getRoutes(search) {
                axios
                    .get(`/${this.$root.adminPath}/routes/search`, {
                        params: {
                            q: search
                        }
                    })
                    .then(response => {
                        this.routes = response.data.items;
                    });
            },
            onSubmit() {
                let router = this.$router;
                let action = this.isNew ? `/${this.$root.adminPath}/meta` : `/${this.$root.adminPath}/meta/${this.id}`;

                let data = Object.assign({}, this.meta, {
                    route: this.meta.route.value
                });

                axios
                    [this.isNew ? 'post' : 'patch'](action, data)
                    .then(response => {
                        toastr[response.data.status](response.data.message);
                        router.push('/meta');
                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            this.validation.errors = error.response.data;
                            return;
                        }
                        toastr.error(error.response.data.error);
                    });
            }
        },
        created() {
            this.fetchData();
        },
        watch: {
            '$route': 'fetchData'
        }
    }
</script>
