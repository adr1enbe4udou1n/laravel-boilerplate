import axios from 'axios';

export default {
    props: ['id'],
    computed: {
        isNew() {
            return this.id === undefined;
        }
    },
    methods: {
        fetchData() {
            this.model = this.initModel();

            if (!this.isNew) {
                axios
                    .get(`${this.$root.adminPath}/${this.modelName}/${this.id}`)
                    .then(response => {
                        this.model = response.data;
                    });
            }
        },
        onSubmit() {
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
    },
    created() {
        this.fetchData();
    },
    watch: {
        '$route': 'fetchData'
    },
};