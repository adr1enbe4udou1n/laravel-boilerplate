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
            Object.keys(response.data).forEach((key) => {
              if (key in this.model) {
                this.model[key] = response.data[key]
              }
            })
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

      let data = this.$app.objectToFormData(this.model)

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

          this.$app.error(error)
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
