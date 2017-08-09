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
                    .get(`${this.$root.adminPath}/${this.modelName}/${this.id}`)
                    .then(response => {
                        this.model = response.data;
                    });
            }
        },
        state(name) {
            if (this.errors.has(name) || this.validation.errors.hasOwnProperty(name)) {
                return 'danger';
            }
        },
        feedback(name) {
            if (this.errors.has(name)) {
                return this.errors.first(name);
            }
            if (this.validation.errors.hasOwnProperty('name')) {
                return this.validation.errors.name[0];
            }
        },
        onSubmit() {
            this.$validator.validateAll().then(result => {
                if (result) {
                    let router = this.$router;
                    let action = this.isNew ? `${this.$root.adminPath}/${this.modelName}` : `${this.$root.adminPath}/${this.modelName}/${this.id}`;

                    axios[this.isNew ? 'post' : 'patch'](action, this.model)
                        .then(response => {
                            window.toastr[response.data.status](response.data.message);
                            router.push(`/${this.modelName}`);
                        })
                        .catch(error => {
                            if (error.response.status === 422) {
                                this.validation.errors = error.response.data;
                                return;
                            }
                            window.toastr.error(error.response.data.error);
                        });
                }
            });
        }
    },
    created() {
        this.fetchData();
    },
};