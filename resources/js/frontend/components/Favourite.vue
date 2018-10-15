<template>
  <b-btn @click="toggleFavourite" :title="getTitle">
    <font-awesome-icon
      :icon="icon"
      :color="getIconColor()"
    ></font-awesome-icon>
  </b-btn>
</template>
<script>
import { axios } from '../../axios-config'

export default {
  name: 'AddToFavourite',
  props: {
    itemId: {
      type: Number,
      required: true
    },
    icon: {
      type: String,
      default: 'star'
    },
    checked: {
      type: Boolean,
      required: true
    },
    url: {
      type: String,
      default: '/favourite/post'
    }
  },
  data: function() {
    return {
      isChecked: this.checked
    }
  },
  computed: {
    getIsChecked: function() {
      return this.isChecked
    },
    getTitle: function() {
      return this.getIsChecked ? 'Remove from favourites' : 'Add to favourites'
    }
  },
  methods: {
    toggleFavourite: function() {
      axios
        .post(this.url, {
          id: this.itemId,
          checked: !this.isChecked
        })
        .then(() => {
          this.isChecked = !this.isChecked
          this.$forceUpdate()
        })
        .catch(err => {
          const { status, statusText } = err.response

          if (status === 403) {
            swal(this.$i18n.t('exceptions.not_logged_in'))
          } else {
            swal(statusText)
          }
        })
    },
    getIconColor: function() {
      return this.getIsChecked ? 'gold' : 'white'
    }
  }
}
</script>
