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
                                        :checked="redirection.active"
                                ></b-form-toggle>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="target"
                                    :label="$t('validation.attributes.target_path')"
                                    :horizontal="true"
                                    :label-cols="3"
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
    export default {
        name: 'redirection_form',
        props: ['id'],
        data() {
            return {
                redirectionTypes: null,
                redirection: {
                    source: null,
                    active: null,
                    target: null,
                    type: null
                }
            }
        },
        computed: {
            isNew() {
                return this.id === undefined;
            }
        },
        methods: {
            onSubmit() {
                let action = this.isNew ? '/redirection/store' : `/redirection/${this.id}/update`;
            }
        },
        created() {
            axios
                .get(`/admin/redirection/redirection-types`)
                .then(response => {
                    this.redirectionTypes = response.data;
                });

            if (!this.isNew) {
                axios
                    .get(`/admin/redirection/${this.id}`)
                    .then(response => {
                        this.redirection = response.data;
                    });
            }
        }
    }
</script>
