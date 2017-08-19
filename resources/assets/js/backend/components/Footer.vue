<template>
    <footer class="app-footer">
        <strong>Copyright &copy; {{ new Date().getFullYear() }} <a
                href="/" target="_blank">{{ name }}</a>.
        </strong> {{ $t("labels.all_rights_reserved") }}
        <span class="float-right">

        <template v-if="editorName !== ''">
            <template v-if="editorSiteUrl !== ''">
            <i class="fa fa-code"></i> with <i class="fa fa-heart"></i> by <a
                    :href="editorSiteUrl" target="_blank"><strong>{{ editorName }}</strong></a>
            </template>
            <template v-else>
            <i class="fa fa-code"></i> with <i class="fa fa-heart"></i> by <strong>{{ editorName }}</strong>
            </template>
        </template>
    </span>
    </footer>
</template>
<script>
  export default {
    name: 'footer',
    props: ['name', 'editorName', 'editorSiteUrl']
  }
</script>
