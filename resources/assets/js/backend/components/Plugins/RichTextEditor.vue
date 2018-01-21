<template>

  <textarea :id="id" :name="name" :value="value"></textarea>

</template>

<script>
export default {
  props: {
    id: {
      type: String,
      default: null
    },
    name: {
      type: String,
      default: null
    },
    placeholder: {
      type: String,
      default: null
    },
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
      if (newValue !== this.editor.getData()) {
        this.editor.setData(newValue)
      }
    }
  },
  mounted () {
    window.ClassicEditor
      .create(document.querySelector(`#${this.id}`), {
        toolbar: [ 'headings', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ],
        heading: {
          options: [
            { modelElement: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
            { modelElement: 'heading2', viewElement: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
            { modelElement: 'heading3', viewElement: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
          ]
        },
        image: {
          toolbar: [ 'imageStyleFull', 'imageStyleAlignLeft', 'imageStyleAlignCenter', 'imageStyleAlignRight', '|', 'imageTextAlternative' ],
          styles: [
            'imageStyleFull',
            'imageStyleAlignLeft',
            'imageStyleAlignCenter',
            'imageStyleAlignRight'
          ]
        },
        ckfinder: {
          uploadUrl: this.$app.route('admin.images.upload')
        }
      })
      .then((editor) => {
        editor.document.on('change', () => {
          this.$emit('input', editor.getData())
        })
        this.editor = editor
      })
  },
  beforeDestroy () {
    this.editor.destroy()
  }
}
</script>
