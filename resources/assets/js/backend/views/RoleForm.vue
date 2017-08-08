<template>
    <div class="animated fadeIn">
        <form @submit.prevent="onSubmit">
            <div class="row">
                <div class="col-xl-8 offset-xl-2">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ isNew ? $t('labels.backend.roles.titles.create') : $t('labels.backend.roles.titles.edit') }}</h4>
                        </div>

                        <div class="card-block">
                            <b-form-fieldset
                                    label-for="name"
                                    :label="$t('validation.attributes.name')"
                                    :horizontal="true"
                                    :label-cols="2"
                                    :state="validation.errors.hasOwnProperty('name') ? 'danger' : ''"
                                    :feedback="validation.errors.hasOwnProperty('name') ? validation.errors.name[0] : ''"
                            >
                                <div class="row">
                                    <div class="col-md-6">
                                        <b-form-input
                                                id="name"
                                                name="name"
                                                :required="true"
                                                :placeholder="$t('validation.attributes.name')"
                                                v-model="model.name"
                                        ></b-form-input>
                                    </div>
                                </div>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="display_name"
                                    :label="$t('validation.attributes.display_name')"
                                    :horizontal="true"
                                    :label-cols="2"
                                    :state="validation.errors.hasOwnProperty('display_name') ? 'danger' : ''"
                                    :feedback="validation.errors.hasOwnProperty('display_name') ? validation.errors.display_name[0] : ''"
                            >
                                <div class="row">
                                    <div class="col-md-6">
                                        <b-form-input
                                                id="display_name"
                                                name="display_name"
                                                :required="true"
                                                :placeholder="$t('validation.attributes.display_name')"
                                                v-model="model.display_name"
                                        ></b-form-input>
                                    </div>
                                </div>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="description"
                                    :label="$t('validation.attributes.description')"
                                    :horizontal="true"
                                    :label-cols="2"
                                    :state="validation.errors.hasOwnProperty('description') ? 'danger' : ''"
                                    :feedback="validation.errors.hasOwnProperty('description') ? validation.errors.description[0] : ''"
                            >
                                <div class="row">
                                    <div class="col-md-6">
                                        <b-form-input
                                                id="description"
                                                name="description"
                                                :placeholder="$t('validation.attributes.description')"
                                                v-model="model.description"
                                        ></b-form-input>
                                    </div>
                                </div>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="order"
                                    :label="$t('validation.attributes.order')"
                                    :horizontal="true"
                                    :label-cols="2"
                            >
                                <div class="row">
                                    <div class="col-md-3">
                                        <b-form-input
                                                id="order"
                                                name="order"
                                                type="number"
                                                :required="true"
                                                v-model="model.order"
                                        ></b-form-input>
                                    </div>
                                </div>
                            </b-form-fieldset>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">{{ $t('validation.attributes.permissions') }}</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-md-6 col-xl-4 mb-3" v-for="category in this.permissions">
                                            <h4>{{ $t(category.title) }}</h4>
                                            <div class="custom-controls-stacked">
                                                <b-form-checkbox
                                                        v-for="permission in category.permissions"
                                                        :key="permission.name"
                                                        name="permissions[]"
                                                        v-model="model.permissions"
                                                        :value="permission.name">
                                                    {{ $t(permission['display_name']) }}
                                                </b-form-checkbox>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <router-link to="/role" class="btn btn-danger btn-sm">{{ $t('buttons.back') }}</router-link>
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
    
    import _ from 'lodash';
    // eslint-disable-next-line no-unused-vars
    import { groupBy, forEach } from 'lodash/collection';

    export default {
        name: 'role_form',
        mixins: [form],
        data() {
            return {
                permissions: [],
                modelName: 'role',
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
                    display_name: null,
                    description: null,
                    order: 0,
                    permissions: null
                };
            },
        },
        created() {
            axios
                .get(`${this.$root.adminPath}/${this.modelName}/permissions`)
                .then(response => {
                    let categories = _.groupBy(_.forEach(response.data, (value, key) => {
                        value['name'] = key;
                    }), 'category');

                    this.permissions = Object.keys(categories).map(key => {
                        return new Object({
                            title: key,
                            permissions: categories[key]
                        });
                    });
                });

            this.fetchData();
        }
    };
</script>
