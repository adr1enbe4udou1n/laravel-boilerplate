<template>
    <footer class="app-footer">
        <strong>Copyright &copy; {{ new Date().getFullYear() }} <a
                href="/" target="_blank">{{ name }}</a>.
        </strong> {{ $t("labels.all_rights_reserved") }}
        <span class="float-right">

        <template v-if="editor_name !== ''">
            <template v-if="editor_site_url !== ''">
            <i class="fa fa-code"></i> with <i class="fa fa-heart"></i> by <a
                :href="editor_site_url" target="_blank"><strong>{{ editor_name }}</strong></a>
            </template>
            <template v-else>
            <i class="fa fa-code"></i> with <i class="fa fa-heart"></i> by <strong>{{ editor_name }}</strong>
            </template>
        </template>
    </span>
    </footer>
</template>
<script>
    export default {
        name: 'footer',
        data() {
            return {
                name: window.settings.app.name,
                editor_name: window.settings.app.editor_name,
                editor_site_url: window.settings.app.editor_site_url
            }
        }
    }
</script>
