<template>

    <textarea
            :id="id"
            :name="name"
            :value="value"
    ></textarea>

</template>

<script type="text/javascript">
    export default {
        props: {
            value: {
                default: null,
                required: true,
            },
            id: {
                type: String,
            },
            name: {
                type: String,
            },
        },
        computed: {
            instance() {
                return CKEDITOR.instances[this.id];
            }
        },
        methods: {
            updateData() {
                if (this.value === null) {
                    this.instance.setData('');
                }
                this.instance.setData(this.value);
            }
        },
        beforeUpdate() {
            this.updateData();
        },
        mounted() {
            let plugins = ['autogrow', 'image2', 'uploadimage'];

            CKEDITOR.replace(this.id, {
                extraPlugins: plugins.join(','),
                removePlugins: 'resize',
                language: locale,
                toolbar: [
                    {name: 'basicstyles', items: ['Bold', 'Italic']},
                    {name: 'links', items: ['Link', 'Unlink']},
                    {name: 'paragraph', items: ['NumberedList', 'BulletedList']},
                    {name: 'insert', items: ['Blockquote', 'Image']},
                    {name: 'styles', items: ['Format']},
                    {name: 'document', items: ['Source']},
                ],
                uploadUrl: '/admin/images/upload',
                autoGrow_minHeight: 200,
                autoGrow_maxHeight: 600,
                autoGrow_onStartup: true
            });

            this.instance.on('blur', () => {
                this.$emit('input', this.instance.getData());
            });
            this.instance.on('instanceReady', () => {
                this.updateData();
            });
        },
        beforeDestroy() {
            if (this.instance) {
                this.instance.focusManager.blur(true);
                this.instance.removeAllListeners();
                this.instance.destroy();
            }
        }
    };
</script>