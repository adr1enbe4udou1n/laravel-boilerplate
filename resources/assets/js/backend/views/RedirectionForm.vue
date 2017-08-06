<template>
    <div class="animated fadeIn">
        <form @submit.prevent="onSubmit">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ isNew ? $t('labels.backend.redirections.titles.create') : $t('labels.backend.redirections.titles.edit') }}</h4>
                        </div>

                        <div class="card-block">
                            <b-form-fieldset
                                    label-for="source"
                                    :label="$t('validation.attributes.source_path')"
                                    :horizontal="true"
                                    :label-cols="3"
                                    :state="validation.errors.hasOwnProperty('source') ? 'danger' : ''"
                                    :feedback="validation.errors.hasOwnProperty('source') ? validation.errors.source[0] : ''"
                            >
                                <b-form-input
                                        id="source"
                                        name="source"
                                        :required="true"
                                        :placeholder="$t('validation.attributes.source_path')"
                                        v-model="redirection.source"
                                ></b-form-input>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="active"
                                    :label="$t('validation.attributes.active')"
                                    :horizontal="true"
                                    :label-cols="3"
                            >
                                <b-form-toggle
                                        id="active"
                                        name="active"
                                        value="1"
                                        v-model="redirection.active"
                                ></b-form-toggle>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="target"
                                    :label="$t('validation.attributes.target_path')"
                                    :horizontal="true"
                                    :label-cols="3"
                                    :state="validation.errors.hasOwnProperty('target') ? 'danger' : ''"
                                    :feedback="validation.errors.hasOwnProperty('target') ? validation.errors.target[0] : ''"
                            >
                                <b-form-input
                                        id="target"
                                        name="target"
                                        :required="true"
                                        :placeholder="$t('validation.attributes.target_path')"
                                        v-model="redirection.target"
                                ></b-form-input>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    :label="$t('validation.attributes.redirect_type')"
                                    :horizontal="true"
                                    :label-cols="3"
                            >
                                <b-form-radio
                                        name="type"
                                        :required="true"
                                        :stacked="true"
                                        :options="redirectionTypes"
                                        v-model="redirection.type"
                                ></b-form-radio>
                            </b-form-fieldset>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <router-link to="/redirection" class="btn btn-danger btn-sm">{{ $t('buttons.back') }}</router-link>
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" class="btn btn-success btn-sm pull-right" :value="isNew ? $t('buttons.create') : $t('buttons.edit')">
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
    import axios from 'axios';

    export default {
        name: 'redirection_form',
        props: ['id'],
        data() {
            return {
                redirectionTypes: {},
                redirection: this.initRedirection(),
                validation: {
                    errors: {}
                }
            };
        },
        computed: {
            isNew() {
                return this.id === undefined;
            }
        },
        methods: {
            initRedirection() {
                return {
                    source: null,
                    active: null,
                    target: null,
                    type: null
                };
            },
            fetchData() {
                this.redirection = this.initRedirection();

                if (!this.isNew) {
                    axios
                        .get(`/${this.$root.adminPath}/redirection/${this.id}`)
                        .then(response => {
                            this.redirection = response.data;
                        });
                }
            },
            onSubmit() {
                let router = this.$router;
                let action = this.isNew ? `/${this.$root.adminPath}/redirection` : `/${this.$root.adminPath}/redirection/${this.id}`;

                axios[this.isNew ? 'post' : 'patch'](action, this.redirection)
                    .then(response => {
                        window.toastr[response.data.status](response.data.message);
                        router.push('/redirection');
                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            this.validation.errors = error.response.data;
                            return;
                        }
                        window.toastr.error(error.response.data.error);
                    });
            }
        },
        created() {
            axios
                .get(`/${this.$root.adminPath}/redirection/redirection-types`)
                .then(response => {
                    this.redirectionTypes = response.data;
                });

            this.fetchData();
        },
        watch: {
            '$route': 'fetchData'
        }
    };
</script>
