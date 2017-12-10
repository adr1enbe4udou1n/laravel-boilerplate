<template>

  <div :id="id"></div>

</template>

<script>
  export default {
    props: {
      id: {
        type: String
      },
      placeholder: {
        type: String,
        default: null
      },
      value: {
        default: null
      }
    },
    data () {
      return {
        editor: null
      }
    },
    mounted () {
      let toolbarOptions = [
        [{'header': [1, 2, 3, 4, 5, 6, false]}],
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],

        [{'list': 'ordered'}, {'list': 'bullet'}],
        [{'script': 'sub'}, {'script': 'super'}],

        ['link', 'image', 'video', 'formula']
      ]

      this.editor = new window.Quill(`#${this.id}`, {
        modules: {
          toolbar: toolbarOptions
        },
        placeholder: this.placeholder,
        theme: 'snow'
      })

      this.editor.on('text-change', () => {
        this.$emit('input', this.editor.root.innerHTML)
      })
    },
    watch: {
      value (newValue) {
        this.editor.clipboard.dangerouslyPasteHTML(newValue)
      }
    }
  }
</script>
