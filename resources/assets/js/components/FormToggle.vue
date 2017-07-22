<template>
    <label class="switch switch-text switch-primary">
        <input type="checkbox"
               :id="id || null"
               :name="name"
               :value="value"
               class="switch-input"
               :checked="checked">
        <span data-on="On" data-Off="Off" class="switch-label"></span>
        <span class="switch-handle"></span>
    </label>
</template>

<script>
    export default {
        props: {
            id: {
                default: null
            },
            name: {
                default: null
            },
            value: {
                default: true
            },
            checked: {
                default: true
            },
        },
    };
</script>