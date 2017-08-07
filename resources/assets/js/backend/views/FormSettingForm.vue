<template>
    <div class="animated fadeIn">
        <form @submit.prevent="onSubmit">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ isNew ? $t('labels.backend.form_settings.titles.create') : $t('labels.backend.form_settings.titles.edit') }}</h4>
                        </div>

                        <div class="card-block">
                            <b-form-fieldset
                                    label-for="name"
                                    :label="$t('validation.attributes.form_type')"
                                    :horizontal="true"
                                    :label-cols="3"
                            >
                                <b-form-select
                                        id="name"
                                        name="name"
                                        :required="true"
                                        :options="formTypes"
                                        v-model="model.name"
                                ></b-form-select>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="recipients"
                                    :label="$t('validation.attributes.recipients')"
                                    :description="$t('labels.backend.form_settings.descriptions.recipients')"
                                    :horizontal="true"
                                    :label-cols="3"
                                    :state="validation.errors.hasOwnProperty('recipients') ? 'danger' : ''"
                                    :feedback="validation.errors.hasOwnProperty('recipients') ? validation.errors.recipients[0] : ''"
                            >
                                <b-form-input
                                        id="recipients"
                                        name="recipients"
                                        :textarea="true"
                                        :rows="5"
                                        :required="true"
                                        :placeholder="$t('validation.attributes.recipients')"
                                        v-model="model.recipients"
                                ></b-form-input>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="message"
                                    :label="$t('validation.attributes.message')"
                                    :description="$t('labels.backend.form_settings.descriptions.message')"
                                    :horizontal="true"
                                    :label-cols="3"
                                    :state="validation.errors.hasOwnProperty('message') ? 'danger' : ''"
                                    :feedback="validation.errors.hasOwnProperty('message') ? validation.errors.message[0] : ''"
                            >
                                <b-form-input
                                        id="message"
                                        name="message"
                                        :textarea="true"
                                        :rows="5"
                                        :required="true"
                                        :placeholder="$t('validation.attributes.message')"
                                        v-model="model.message"
                                ></b-form-input>
                            </b-form-fieldset>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <router-link to="/form-setting" class="btn btn-danger btn-sm">{{ $t('buttons.back') }}</router-link>
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
        name: 'form_setting_form',
        mixins: [form],
        data() {
            return {
                formTypes: [
                    {
                        value: null,
                        text: `-- ${this.$i18n.t('validation.attributes.form_type')} --`
                    }
                ],
                modelName: 'form-setting',
                model: this.initModel(),
                validation: {
                    errors: {}
                }
            };
        },
        methods: {
            initModel() {
                return {
                    name: null,
                    recipients: null,
                    message: null
                };
            },
        },
        created() {
            axios
                .get(`${this.$root.adminPath}/${this.modelName}/form-types`)
                .then(response => {
                    for(let propertyName in response.data) {
                        this.formTypes.push({
                            value: propertyName,
                            text: response.data[propertyName]
                        });
                    }
                });

            this.fetchData();
        }
    };
</script>
