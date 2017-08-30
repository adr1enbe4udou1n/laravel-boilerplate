import axios from 'axios'

export default {
  props: ['id'],
  data () {
    return {
      validation: {},
      pending: false
    }
  },
  computed: {
    isNew () {
      return this.id === undefined
    }
  },
  methods: {
    fetchData () {
      if (!this.isNew) {
        axios
          .get(this.$app.route(`admin.${this.modelName}s.show`,
            {[this.modelName]: this.id}))
          .then(response => {
            this.model = response.data
          })
      }
    },
    feedback (name) {
      if (this.errors.has(name)) {
        return this.errors.first(name)
      }
      if (this.validation.errors !== undefined && this.validation.errors.hasOwnProperty(name)) {
        return this.validation.errors[name][0]
      }
    },
    onSubmit () {
      this.$validator.validateAll().then(result => {
        if (result) {
          this.pending = true
          let router = this.$router
          let action = this.isNew ? this.$app.route(
            `admin.${this.modelName}s.store`) : this.$app.route(
            `admin.${this.modelName}s.update`, {[this.modelName]: this.id})

          let data = new FormData()
          Object.keys(this.model).forEach(key => {
            if (this.model[key] === null) {
              data.append(key, '')
              return
            }
            if (typeof (this.model[key]) === 'boolean') {
              data.append(key, this.model[key] ? 1 : 0)
              return
            }

            data.append(key, this.model[key])
          })

          if (!this.isNew) {
            data.append('_method', 'PATCH')
          }

          axios.post(action, data)
            .then(response => {
              window.toastr[response.data.status](response.data.message)
              if (this.listPath) {
                router.push(this.listPath)
              }
            })
            .catch(error => {
              // Validation errors
              if (error.response.status === 422) {
                this.validation = error.response.data
                return
              }

              // Not allowed error
              if (error.response.status === 403) {
                window.toastr.error(this.$i18n.t('exceptions.unauthorized'))
                return
              }

              // Domain error
              if (error.response.data.message !== undefined) {
                window.toastr.error(error.response.data.message)
                return
              }

              // Generic error
              window.toastr.error(this.$i18n.t('exceptions.general'))
            })
            .then(() => {
              this.pending = false
            })
        }
      })
    }
  },
  created () {
    this.fetchData()
  }
}
