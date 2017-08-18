<template>
    <div class="animated fadeIn">
        <form @submit.prevent="onSubmit">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ isNew ? $t('labels.backend.users.titles.create') : $t('labels.backend.users.titles.edit') }}</h4>
                        </div>

                        <div class="card-body">
                            <b-form-fieldset
                                    name="name"
                                    :label="$t('validation.attributes.name')"
                                    :horizontal="true"
                                    :label-cols="3"
                                    :invalid-feedback="feedback('name')"
                            >
                                <b-input-group :left="iconUser">
                                    <input
                                            id="name"
                                            name="name"
                                            :placeholder="$t('validation.attributes.name')"
                                            class="form-control"
                                            v-model="model.name"
                                            v-validate="'required'"
                                    >
                                </b-input-group>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    name="email"
                                    :label="$t('validation.attributes.email')"
                                    :horizontal="true"
                                    :label-cols="3"
                                    :invalid-feedback="feedback('email')"
                            >
                                <b-input-group :left="iconEnvelope">
                                    <input
                                            id="email"
                                            name="email"
                                            type="email"
                                            :placeholder="$t('validation.attributes.email')"
                                            class="form-control"
                                            v-model="model.email"
                                            v-validate="'required|email'"
                                    >
                                </b-input-group>
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
                                    name="password"
                                    :label="$t('validation.attributes.password')"
                                    :horizontal="true"
                                    :label-cols="3"
                                    :invalid-feedback="feedback('password')"
                            >
                                <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        :placeholder="$t('validation.attributes.password')"
                                        class="form-control"
                                        data-toggle="password-strength-meter"
                                >
                            </b-form-fieldset>

                            <b-form-fieldset
                                    name="password_confirmation"
                                    :label="$t('validation.attributes.password_confirmation')"
                                    :horizontal="true"
                                    :label-cols="3"
                                    :invalid-feedback="feedback('password_confirmation')"
                            >
                                <input
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        type="password"
                                        :placeholder="$t('validation.attributes.password_confirmation')"
                                        class="form-control"
                                >
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
                model: {
                    name: null,
                    email: null,
                    active: true,
                    password: null,
                    confirm_password: null,
                    roles: []
                },
            };
        },
        created() {
            axios
                .get(this.route(`admin.${this.modelName}.get_roles`))
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
