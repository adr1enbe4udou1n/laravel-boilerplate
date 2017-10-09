<template>
    <router-link :to="url" class="nav-link">
        <i :class="icon"></i> {{ name }}
        <template v-for="badge in badges">
            <span :class="`badge badge-${badge.variant}`"
                  :title="badge.name">{{ badge.text }}</span>
        </template>
    </router-link>
</template>

<script>
export default {
  name: 'sidebar-nav-link',
  props: {
    name: {
      type: String,
      default: ''
    },
    url: {
      type: String,
      default: ''
    },
    icon: {
      type: String,
      default: ''
    },
    badges: {
      type: Array,
      default: () => []
    }
  }
}
</script>
