import axios from 'axios';

export default {
    props: ['id'],
    data() {
        return {
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
        fetchData() {
            if (!this.isNew) {
                axios
                    .get(window.route(`admin.${this.modelName}.get`, { [this.modelName]: this.id }))
                    .then(response => {
                        this.model = response.data;
                    });
            }
        },
        feedback(name) {
            if (this.errors.has(name)) {
                return this.errors.first(name);
            }
            if (this.validation.errors.hasOwnProperty(name)) {
                return this.validation.errors[name][0];
            }
        },
        onSubmit() {
            this.$validator.validateAll().then(result => {
                if (result) {
                    let router = this.$router;
                    let action = this.isNew ? window.route(`admin.${this.modelName}.store`) : window.route(`admin.${this.modelName}.update`, { [this.modelName]: this.id });

                    let data = new FormData();
                    Object.keys(this.model).forEach(key => data.append(key, this.model[key]));

                    if (!this.isNew) {
                        data.append('_method', 'PATCH');
                    }

                    axios.post(action, data)
                        .then(response => {
                            window.toastr[response.data.status](response.data.message);
                            router.push(`/${this.modelName}`);
                        })
                        .catch(error => {
                            // Validation errors
                            if (error.response.status === 422) {
                                this.validation.errors = error.response.data;
                                return;
                            }

                            // Domain error
                            if (error.response.data.error !== undefined) {
                                window.toastr.error(error.response.data.error);
                                return;
                            }

                            // Generic error
                            window.toastr.error(this.$i18n.t('exceptions.general'));
                        });
                }
            });
        }
    },
    created() {
        this.fetchData();
    },
};