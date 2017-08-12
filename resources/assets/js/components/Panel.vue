<template>
    <div class="card mb-3">
        <div class="card-header">{{ title }}</div>

        <div class="card-body">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title']
    };
</script>