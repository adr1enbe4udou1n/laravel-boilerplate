<template>
    <div class="animated fadeIn">
        <form @submit.prevent="onSubmit">
            <div class="row">

            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: 'redirectionform',
        props: ['id'],
        data() {
            return {

            }
        },
        computed: {
            isNew: function () {
                return this.id === undefined;
            }
        },
        methods: {
            onSubmit() {
                let action = this.isNew ? '/redirection/store' : `/redirection/${this.id}/update`;
            }
        },
        created() {

        }
    }
</script>
