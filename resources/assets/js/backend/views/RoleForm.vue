<template>
    <div class="animated fadeIn">
        <form @submit.prevent="onSubmit">
            <div class="row">
                <div class="col-md-8 offset-md-2">
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
                            >
                                <b-form-input
                                        id="name"
                                        name="name"
                                        :required="true"
                                        :placeholder="$t('validation.attributes.name')"
                                        v-model="role.name"
                                ></b-form-input>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="display_name"
                                    :label="$t('validation.attributes.display_name')"
                                    :horizontal="true"
                                    :label-cols="2"
                            >
                                <b-form-input
                                        id="display_name"
                                        name="display_name"
                                        :required="true"
                                        :placeholder="$t('validation.attributes.display_name')"
                                        v-model="role.display_name"
                                ></b-form-input>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="description"
                                    :label="$t('validation.attributes.description')"
                                    :horizontal="true"
                                    :label-cols="2"
                            >
                                <b-form-input
                                        id="description"
                                        name="description"
                                        :placeholder="$t('validation.attributes.description')"
                                        v-model="role.description"
                                ></b-form-input>
                            </b-form-fieldset>

                            <b-form-fieldset
                                    label-for="order"
                                    :label="$t('validation.attributes.order')"
                                    :horizontal="true"
                                    :label-cols="2"
                            >
                                <b-form-input
                                        id="order"
                                        name="order"
                                        type="number"
                                        :required="true"
                                        :placeholder="$t('validation.attributes.order')"
                                        v-model="role.order"
                                ></b-form-input>
                            </b-form-fieldset>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">{{ $t('validation.attributes.permissions') }}</label>
                                <div class="col-lg-10">
                                    <div class="row" v-for="categories in this.permissions">
                                        <div class="col-md-3" v-for="category in categories">
                                            <h4>{{ $t(category.title) }}</h4>
                                            <div class="custom-controls-stacked">

                                                <b-form-checkbox
                                                        v-for="permission in category.permissions"
                                                        :key="permission.name"
                                                        name="permissions[]"
                                                        :checked="role.permissions"
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
    import _ from 'lodash';

    export default {
        name: 'role_form',
        props: ['id'],
        data() {
            return {
                permissions: [],
                role: {
                    name: null,
                    display_name: null,
                    description: null,
                    permissions: null
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
                let action = this.isNew ? '/role/store' : `/role/${this.id}/update`;
            }
        },
        created() {
            axios
                .get(`/admin/role/permissions`)
                .then(response => {
                    let categories = _.groupBy(_.forEach(response.data, (value, key) => {
                        value['name'] = key;
                    }), 'category');

                    let data = Object.keys(categories).map(key => {
                        return new Object({
                            title: key,
                            permissions: categories[key]
                        });
                    });

                    this.permissions = _.chunk(data, 4);
                });

            if (!this.isNew) {
                axios
                    .get(`/admin/role/${this.id}`)
                    .then(response => {
                        this.meta = response.data;
                    });
            }
        },
        mounted() {
            $.initPlugins();
        }
    }
</script>
