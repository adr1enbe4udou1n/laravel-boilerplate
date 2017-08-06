<template>
    <input :id="id" :name="name" type="file" class="form-control" @change="onFileChange">
</template>

<script>
    export default {
        props: {
            id: {
                type: String,
            },
            name: {
                type: String,
            },
        },
        data() {
            return {
                selectedFile: null
            };
        },
        watch: {
            selectedFile(newVal, oldVal) {
                if (newVal === oldVal) {
                    return;
                }
                this.$emit('input', newVal);
            }
        },
        methods: {
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length) return;

                let reader = new FileReader();
                let data = this.$data;

                reader.onload = (e) => {
                    data.selectedFile = e.target.result;
                };
                reader.readAsDataURL(files[0]);
            },
        }
    };
</script>