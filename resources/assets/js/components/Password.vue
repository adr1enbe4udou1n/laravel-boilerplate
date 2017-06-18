<template>
    <password v-model="password" :id="id" :name="name" :required="required" defaultClass="form-control" :placeholder="placeholder"></password>
</template>

<script>
    import Password from 'vue-password-strength-meter';

    export default {
        components: { Password },
        props: ['id', 'name', 'required', 'placeholder'],
        data () {
            return {
                password: null
            }
        },
        mounted() {
            $(this.$el).prev().hide();
        }
    }
</script>

<style>
    .Password {
        max-width: none;
        margin: 0;
    }

    .Password__badge {
        text-align: center;
        bottom: 28px;
        height: auto;
    }

    .Password__strength-meter {
        margin-bottom: 0;
    }

    .Password__badge.has-error {
        background: red;
    }
</style>
