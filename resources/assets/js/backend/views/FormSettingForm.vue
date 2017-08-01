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
                                        data-toggle="select2"
                                        :data-placeholder="$t('validation.attributes.form_type')"
                                        :options="formTypes"
                                        v-model="setting.name"
                                ></b-form-select>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="recipients"
                                    :label="$t('validation.attributes.recipients')"
                                    :description="$t('labels.backend.form_settings.descriptions.recipients')"
                                    :horizontal="true"
                                    :label-cols="3"
                            >
                                <b-form-input
                                        id="recipients"
                                        name="recipients"
                                        :textarea="true"
                                        :rows="5"
                                        :required="true"
                                        :placeholder="$t('validation.attributes.recipients')"
                                        v-model="setting.recipients"
                                ></b-form-input>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="message"
                                    :label="$t('validation.attributes.message')"
                                    :description="$t('labels.backend.form_settings.descriptions.message')"
                                    :horizontal="true"
                                    :label-cols="3"
                            >
                                <b-form-input
                                        id="message"
                                        name="message"
                                        :textarea="true"
                                        :rows="5"
                                        :required="true"
                                        :placeholder="$t('validation.attributes.message')"
                                        v-model="setting.message"
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
    export default {
        name: 'form_setting_form',
        props: ['id'],
        data() {
            return {
                formTypes: [],
                setting: {
                    name: null,
                    recipients: null,
                    message: null
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
                let action = this.isNew ? '/form-setting/store' : `/form-setting/${this.id}/update`;
            }
        },
        created() {
            axios
                .get(`/admin/form-setting/form-types`)
                .then(response => {
                    this.formTypes = response.data;
                });

            if (!this.isNew) {
                axios
                    .get(`/admin/form-setting/${this.id}`)
                    .then(response => {
                        this.setting = response.data;
                    });
            }
        },
        mounted() {
            $.initPlugins();
        }
    }
</script>
