<template>
    <label class="switch switch-text switch-primary">
        <input type="checkbox"
               :id="id || null"
               :name="name"
               :value="value"
               class="switch-input"
               :checked="checked"
               @change="handleChange">
        <span data-on="On" data-Off="Off" class="switch-label"></span>
        <span class="switch-handle"></span>
    </label>
</template>

<script>
    export default {
        model: {
            prop: 'checked',
            event: 'change'
        },
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
            uncheckedValue: {
                default: false
            },
            checked: {
                default: true
            },
        },
        methods: {
            handleChange({ target: { checked } }) {
                this.$emit('change', checked ? this.value : this.uncheckedValue);
            }
        }
    };
</script>