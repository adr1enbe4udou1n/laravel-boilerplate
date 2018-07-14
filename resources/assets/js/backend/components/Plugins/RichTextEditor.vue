<template>

  <div ref="editorEl" v-html="value"></div>

</template>

<script>
export default {
  props: {
    value: {
      type: String,
      default: null
    }
  },
  data () {
    return {
      editor: null
    }
  },
  watch: {
    value (newValue) {
      if (this.editor && newValue !== this.editor.getData()) {
        this.editor.setData(newValue)
      }
    }
  },
  mounted () {
    this.createInstance()
  },
  beforeDestroy () {
    if (this.editor) {
      this.editor.destroy()
    }
  },
  methods: {
    async createInstance () {
      if (!this.editor) {
        try {
          this.editor = await window.ClassicEditor.create(this.$refs.editorEl, {
            toolbar: [
              'heading',
              'bold',
              'italic',
              'link',
              'bulletedList',
              'numberedList',
              'imageUpload',
              'blockQuote',
              'undo',
              'redo'],
            image: {
              toolbar: [
                'imageTextAlternative',
                '|',
                'imageStyle:alignLeft',
                'imageStyle:full',
                'imageStyle:alignRight'],
              styles: [
                'full',
                'alignLeft',
                'alignRight'
              ]
            },
            ckfinder: {
              uploadUrl: this.$app.route('admin.images.upload')
            }
          })
        } catch (e) {
          throw e
        }

        if (this.editor) {
          this.editor.model.document.on('change', () => {
            this.$emit('input', this.editor.getData())
          })
        }
      }
    }
  }
}
</script>
