<template>
    <div class="animated fadeIn">
        <form @submit.prevent="onSubmit">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ isNew ? $t('labels.backend.users.titles.create') : $t('labels.backend.users.titles.edit') }}</h4>
                        </div>

                        <div class="card-block">
                            <b-form-fieldset
                                    label-for="name"
                                    :label="$t('validation.attributes.name')"
                                    :horizontal="true"
                                    :label-cols="3"
                                    :state="validation.errors.hasOwnProperty('name') ? 'danger' : ''"
                                    :feedback="validation.errors.hasOwnProperty('name') ? validation.errors.name[0] : ''"
                            >
                                <b-input-group :left="iconUser">
                                    <b-form-input
                                            id="name"
                                            name="name"
                                            :required="true"
                                            :placeholder="$t('validation.attributes.name')"
                                            v-model="model.name"
                                    ></b-form-input>
                                </b-input-group>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="email"
                                    :label="$t('validation.attributes.email')"
                                    :horizontal="true"
                                    :label-cols="3"
                                    :state="validation.errors.hasOwnProperty('email') ? 'danger' : ''"
                                    :feedback="validation.errors.hasOwnProperty('email') ? validation.errors.email[0] : ''"
                            >
                                <b-input-group :left="iconEnvelope">
                                    <b-form-input
                                            id="email"
                                            name="email"
                                            type="email"
                                            :required="true"
                                            :placeholder="$t('validation.attributes.email')"
                                            v-model="model.email"
                                    ></b-form-input>
                                </b-input-group>
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
                                        v-model="model.active"
                                ></b-form-toggle>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="password"
                                    :label="$t('validation.attributes.password')"
                                    :horizontal="true"
                                    :label-cols="3"
                                    :state="validation.errors.hasOwnProperty('password') ? 'danger' : ''"
                                    :feedback="validation.errors.hasOwnProperty('password') ? validation.errors.password[0] : ''"
                            >
                                <b-form-input
                                        id="password"
                                        name="password"
                                        type="password"
                                        :placeholder="$t('validation.attributes.password')"
                                        data-toggle="password-strength-meter"
                                ></b-form-input>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="password_confirmation"
                                    :label="$t('validation.attributes.password_confirmation')"
                                    :horizontal="true"
                                    :label-cols="3"
                                    :state="validation.errors.hasOwnProperty('password_confirmation') ? 'danger' : ''"
                                    :feedback="validation.errors.hasOwnProperty('password_confirmation') ? validation.errors.password_confirmation[0] : ''"
                            >
                                <b-form-input
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        type="password"
                                        :placeholder="$t('validation.attributes.password_confirmation')"
                                ></b-form-input>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    :label="$t('validation.attributes.roles')"
                                    :horizontal="true"
                                    :label-cols="3"
                            >
                                <div class="custom-controls-stacked">
                                    <b-form-checkbox
                                            v-for="role in roles"
                                            :key="role.id"
                                            name="roles[]"
                                            v-model="model.roles"
                                            :value="role.id"
                                    >
                                        {{ role.display_name }}
                                    </b-form-checkbox>
                                </div>
                            </b-form-fieldset>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <router-link to="/user" class="btn btn-danger btn-sm">{{ $t('buttons.back') }}</router-link>
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
        name: 'user_form',
        mixins: [form],
        data() {
            return {
                iconUser: '<i class="icon-user"></i>',
                iconEnvelope: '<i class="icon-envelope"></i>',
                roles: {},
                modelName: 'user',
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
                    email: null,
                    active: null,
                    password: null,
                    confirm_password: null,
                    roles: []
                };
            },
        },
        created() {
            axios
                .get(`${this.$root.adminPath}/${this.modelName}/roles`)
                .then(response => {
                    this.roles = response.data;
                });

            this.fetchData();
        },
        mounted() {
            $('#password').pwstrength({
                ui: {
                    bootstrap4: true
                }
            });
        }
    };
</script>
