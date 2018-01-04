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
          .then((response) => {
            this.model = response.data
            this.onModelChanged()
          })
      }
    },
    onModelChanged () {
    },
    feedback (name) {
      if (this.state(name)) {
        return this.validation.errors[name][0]
      }
    },
    state (name) {
      return this.validation.errors !== undefined && this.validation.errors.hasOwnProperty(name)
        ? 'invalid'
        : null
    },
    onSubmit () {
      this.pending = true
      let router = this.$router
      let action = this.isNew ? this.$app.route(
        `admin.${this.modelName}s.store`) : this.$app.route(
        `admin.${this.modelName}s.update`, {[this.modelName]: this.id})

      let data = new FormData()
      Object.keys(this.model).forEach((key) => {
        if (this.model[key] === null) {
          data.append(key, '')
          return
        }
        if (typeof (this.model[key]) === 'boolean') {
          data.append(key, this.model[key] ? 1 : 0)
          return
        }
        if (Array.isArray(this.model[key])) {
          this.model[key].forEach((val) => {
            data.append(`${key}[]`, val)
          })
          return
        }

        data.append(key, this.model[key])
      })

      if (!this.isNew) {
        data.append('_method', 'PATCH')
      }

      axios.post(action, data)
        .then((response) => {
          this.$app.noty[response.data.status](response.data.message)
          if (this.listPath) {
            router.push(this.listPath)
          }
        })
        .catch((error) => {
          // Validation errors
          if (error.response.status === 422) {
            this.validation = error.response.data
            return
          }

          // Not allowed error
          if (error.response.status === 403) {
            this.$app.error(this.$t('exceptions.unauthorized'))
            return
          }

          // Domain error
          if (error.response.data.message !== undefined) {
            this.$app.error(error.response.data.message)
            return
          }

          // Generic error
          this.$app.error(this.$t('exceptions.general'))
        })
        .then(() => {
          this.pending = false
        })
    }
  },
  created () {
    this.fetchData()
  }
}
