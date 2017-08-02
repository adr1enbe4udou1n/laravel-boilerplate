<template>
    <div class="animated fadeIn">
        <form @submit.prevent="onSubmit">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ isNew ? $t('labels.backend.metas.titles.create') : $t('labels.backend.metas.titles.edit') }}</h4>
                        </div>

                        <div class="card-block">
                            <template v-if="this.meta.metable_type !== null">
                                <div class="form-group">
                                    <label class="control-label col-lg-3">{{ $t('validation.attributes.metable_type') }}</label>
                                    <div class="col-lg-9">
                                        <label class="control-label">{{ $t(`labels.morphs.${this.meta.metable_type}`, { 'id': this.meta.metable_id }) }}</label>
                                    </div>
                                </div>
                            </template>
                            <template v-else>
                                <b-form-fieldset
                                        label-for="route"
                                        :label="$t('validation.attributes.route')"
                                        :horizontal="true"
                                        :label-cols="3"
                                >
                                    <b-form-select
                                            id="route"
                                            name="route"
                                            :required="true"
                                            :options="this.options()"
                                            v-model="meta.route"
                                            data-toggle="autocomplete"
                                            :data-placeholder="$t('labels.placeholders.route')"
                                            data-ajax-url="/admin/routes/search"
                                            :data-minimum_input_length="2"
                                            data-item-value="name"
                                            data-item-label="uri"
                                    ></b-form-select>
                                </b-form-fieldset>
                            </template>

                            <b-form-fieldset
                                    label-for="title"
                                    :label="$t('validation.attributes.title')"
                                    :horizontal="true"
                                    :label-cols="3"
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
                            >
                                <b-form-input
                                        id="description"
                                        name="description"
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
                                    <router-link to="/meta" class="btn btn-danger btn-sm">{{ $t('buttons.back') }}</router-link>
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
        name: 'meta_form',
        props: ['id'],
        data() {
            return {
                meta: {
                    metable_type: null,
                    metable_id: null,
                    route : null,
                    title: null,
                    description: null
                }
            }
        },
        computed: {
            isNew() {
                return this.id === undefined;
            }
        },
        methods: {
            options() {
                let options = [];
                if (this.meta.route) {
                    options[this.meta.route] = this.$i18n.t(`routes.${meta.route}`);
                }
                return options;
            },
            onSubmit() {
                let action = this.isNew ? '/meta/store' : `/meta/${this.id}/update`;
            }
        },
        created() {
            if (!this.isNew) {
                axios
                    .get(`/admin/meta/${this.id}`)
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
