<template>
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">{{ title }}</div>

            <div class="panel-body">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>