<template>
    <div class="animated fadeIn">
        <form @submit.prevent="onSubmit">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ isNew ? $t('labels.backend.redirections.titles.create') : $t('labels.backend.redirections.titles.edit') }}</h4>
                        </div>

                        <div class="card-body">
                            <b-form-fieldset
                                    name="source"
                                    :label="$t('validation.attributes.source_path')"
                                    :horizontal="true"
                                    :label-cols="3"
                                    :invalid-feedback="feedback('source')"
                            >
                                <b-form-input
                                        id="source"
                                        name="source"
                                        v-validate="'required'"
                                        :placeholder="$t('validation.attributes.source_path')"
                                        v-model="model.source"
                                ></b-form-input>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    name="active"
                                    :label="$t('validation.attributes.active')"
                                    :horizontal="true"
                                    :label-cols="3"
                            >
                                <b-form-toggle
                                        id="active"
                                        name="active"
                                        value="1"
                                        v-model="model.active"
                                ></b-form-toggle>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    name="target"
                                    :label="$t('validation.attributes.target_path')"
                                    :horizontal="true"
                                    :label-cols="3"
                                    :invalid-feedback="feedback('target')"
                            >
                                <b-form-input
                                        id="target"
                                        name="target"
                                        v-validate="'required'"
                                        :placeholder="$t('validation.attributes.target_path')"
                                        v-model="model.target"
                                ></b-form-input>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    :label="$t('validation.attributes.redirect_type')"
                                    :horizontal="true"
                                    :label-cols="3"
                            >
                                <b-form-radio
                                        name="type"
                                        v-validate="'required'"
                                        :stacked="true"
                                        :options="redirectionTypes"
                                        v-model="model.type"
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
    import form from '../mixins/form';

    export default {
        name: 'redirection_form',
        mixins: [form],
        data() {
            return {
                redirectionTypes: {},
                modelName: 'redirection',
                model: {
                    source: null,
                    active: true,
                    target: null,
                    type: 301
                }
            };
        },
        created() {
            axios
                .get(`${this.$root.adminPath}/${this.modelName}/redirection-types`)
                .then(response => {
                    this.redirectionTypes = response.data;
                });

            this.fetchData();
        }
    };
</script>
