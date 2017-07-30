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
        name: 'postform',
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
                let action = this.isNew ? '/post/store' : `/post/${this.id}/update`;
            }
        },
        created() {

        }
    }
</script>
