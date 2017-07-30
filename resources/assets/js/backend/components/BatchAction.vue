<template>
    <form class="form-inline">
        <div class="form-group form-group-sm">
            <select name="action" class="form-control mr-1">
                <option v-for="(option, value) in options" :value="value">{{ option }}</option>
            </select>
            <input type="submit" class="btn btn-danger btn-md">
        </div>
    </form>
</template>

<script>
    export default {
        props: {
            options: []
        },
        methods: {

        }
    }
</script>
