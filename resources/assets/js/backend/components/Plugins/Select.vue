<template>

  <div>
    <div class="tags mb-1" v-if="mutableValue.length">
      <div class="tag" v-for="(item, index) in mutableValue" :key="index">
        {{ item }} <a href="#" class="tag-addon" @click.prevent="onDelete(item)"><i class="fe fe-x"></i></a>
      </div>
    </div>
    <div class="input-wrapper position-relative">
      <input type="text"
             class="form-control"
             :id="id"
             :name="name"
             :placeholder="placeholder"
             v-model="input"
             @keyup.enter="onAdd(input)">
      <div class="dropdown-menu d-block" v-if="results.length">
        <a href="#" class="dropdown-item" v-for="(item, index) in results" :key="index" @click.prevent="onAdd(item)">{{ item }}</a>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  props: {
    value: {
      type: Array,
      default: () => []
    },
    placeholder: {
      type: String,
      default: null
    },
    name: {
      type: String,
      default: null
    },
    id: {
      type: String,
      default: null
    },
    minSearchLength: {
      type: Number,
      default: 3
    },
    onSearch: {
      type: Function,
      default: () => []
    }
  },
  data () {
    return {
      mutableValue: this.value,
      results: [],
      input: ''
    }
  },
  watch: {
    mutableValue (newValue) {
      this.$emit('input', newValue)
    },
    value (newValue) {
      this.mutableValue = newValue
    },
    async input (newValue) {
      this.results = []
      if (newValue.length >= this.minSearchLength) {
        this.results = await this.onSearch(newValue)
      }
    }
  },
  methods: {
    onDelete (item) {
      this.mutableValue = this.mutableValue.filter((i) => {
        return i !== item
      })
    },
    onAdd (item) {
      let existingItem = this.mutableValue.filter((i) => {
        return i === item
      })
      if (!existingItem.length) {
        this.mutableValue.push(item)
      }
      this.clearInput()
    },
    clearInput () {
      this.input = ''
      this.results = []
    }
  }
}
</script>
