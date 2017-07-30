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
        name: 'role_form',
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
                let action = this.isNew ? '/role/store' : `/role/${this.id}/update`;
            }
        },
        created() {

        }
    }
</script>
