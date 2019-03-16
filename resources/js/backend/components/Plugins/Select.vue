<template>
  <div :class="['custom-multiselect', stateClass]">
    <div
      class="input-wrapper position-relative"
      :class="{
        dropup: openDirection === 'up',
        dropright: openDirection === 'right',
        dropleft: openDirection === 'left'
      }"
    >
      <input
        type="text"
        :id="id"
        :name="name"
        :class="['form-control', stateClass]"
        :placeholder="placeholder"
        v-model="search"
        autocomplete="off"
        @focus="showOptions = true"
        @keydown.enter.prevent="onAddNew()"
        @input="onSearch"
      />
      <div class="dropdown-menu d-block" v-if="showOptions && options.length">
        <a
          href="#"
          class="dropdown-item"
          v-for="(item, index) in options"
          :key="index"
          @click.prevent="onAdd(item)"
        >
          {{ label ? item[label] : item }}
        </a>
      </div>
    </div>
    <div class="tags mt-2" v-if="multiple && mutableValue.length">
      <div class="tag" v-for="(item, index) in mutableValue" :key="index">
        {{ label ? item[label] : item }}
        <a href="#" class="tag-addon" @click.prevent="onDelete(item)">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    value: {
      type: [Array, Object],
      default: () => []
    },
    options: {
      type: Array,
      required: true
    },
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
    label: {
      type: String,
      default: null
    },
    trackBy: {
      type: String,
      default: null
    },
    multiple: {
      type: Boolean,
      default: false
    },
    tags: {
      type: Boolean,
      default: false
    },
    openDirection: {
      type: String,
      default: null
    },
    state: {
      type: [Boolean, String],
      default: null
    }
  },
  data() {
    return {
      mutableValue: this.value,
      showOptions: false,
      search: this.getSearchValue(this.value)
    }
  },
  computed: {
    computedState() {
      const state = this.state
      if (state === true || state === 'valid') {
        return true
      } else if (state === false || state === 'invalid') {
        return false
      }
      return null
    },
    stateClass() {
      const state = this.computedState
      if (state === true) {
        return 'is-valid'
      } else if (state === false) {
        return 'is-invalid'
      }
      return null
    }
  },
  watch: {
    mutableValue(newValue) {
      this.$emit('input', newValue)

      this.search = this.getSearchValue(newValue)
    },
    value(newValue) {
      this.mutableValue = newValue
    },
    search() {
      if (this.search === '' && !this.multiple) {
        this.mutableValue = null
      }
    }
  },
  mounted() {
    document.addEventListener('click', e => {
      if (this.$el.contains(e.target)) return

      this.showOptions = false
    })
  },
  methods: {
    onSearch() {
      if (this.search !== '') {
        this.$emit('search-change', this.search, this.id)
      }
    },
    getSearchValue(newValue) {
      return this.multiple
        ? ''
        : (this.label && newValue ? newValue[this.label] : newValue) || ''
    },
    onDelete(item) {
      this.mutableValue = this.mutableValue.filter(i => {
        return this.trackBy
          ? i[this.trackBy] !== item[this.trackBy]
          : i !== item
      })
    },
    onAddNew() {
      if (this.tags) {
        this.onAdd(this.search)
      }
    },
    onAdd(item) {
      if (this.multiple) {
        let existingItem = this.mutableValue.filter(i => {
          return this.trackBy
            ? i[this.trackBy] === item[this.trackBy]
            : i === item
        })

        if (!existingItem.length) {
          this.mutableValue.push(item)
        }
      } else {
        this.mutableValue = item
      }
      this.clearInput()
    },
    clearInput() {
      this.search = ''
      this.showOptions = false
    }
  }
}
</script>
