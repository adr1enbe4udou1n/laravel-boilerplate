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
        required: true
      },
      id: {
        type: String
      },
      name: {
        type: String
      }
    },
    computed: {
      instance () {
        return window.CKEDITOR.instances[this.id]
      }
    },
    methods: {
      updateData () {
        if (this.value === null) {
          this.instance.setData('')
        }
        this.instance.setData(this.value)
      }
    },
    beforeUpdate () {
      this.updateData()
    },
    mounted () {
      let plugins = ['autogrow', 'divarea', 'image2', 'uploadimage']

      window.CKEDITOR.replace(this.id, {
        extraPlugins: plugins.join(','),
        removePlugins: 'resize,wysiwygarea',
        language: this.$app.locale,
        toolbar: [
          {name: 'basicstyles', items: ['Bold', 'Italic']},
          {name: 'links', items: ['Link', 'Unlink']},
          {name: 'paragraph', items: ['NumberedList', 'BulletedList']},
          {name: 'insert', items: ['Blockquote', 'Image']},
          {name: 'styles', items: ['Format']},
          {name: 'document', items: ['Source']}
        ],
        uploadUrl: `${this.$root.adminPath}/images/upload`
      })

      this.instance.on('blur', () => {
        this.$emit('input', this.instance.getData())
      })
      this.instance.on('instanceReady', () => {
        this.updateData()
      })
    },
    beforeDestroy () {
      if (this.instance) {
        setTimeout(() => {
          this.instance.removeAllListeners()
          this.instance.destroy()
        })
      }
    }
  }
</script>
