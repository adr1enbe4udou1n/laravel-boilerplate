<template>
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <template v-for="item in navItems">
                    <template v-if="item.access">
                        <template v-if="item.title">
                            <li class="nav-title">{{ item.name }}</li>
                        </template>
                        <template v-else>
                            <li class="nav-item">
                                <router-link :to="item.url" class="nav-link">
                                    <i :class="item.icon"></i> {{ item.name }}
                                    <template v-for="badge in item.badges">
                                        <span :class="`badge badge-${badge.variant}`"
                                              :title="badge.name">{{ badge.text }}</span>
                                    </template>
                                </router-link>
                            </li>
                        </template>
                    </template>
                </template>
            </ul>
        </nav>
        <button class="sidebar-minimizer" type="button" @click="sidebarMinimize();brandMinimize()"></button>
    </div>
</template>
<script>
  export default {
    name: 'sidebar',
    props: {
      navItems: {
        type: Array,
        required: true,
        default: () => []
      }
    },
    methods: {
      handleClick (e) {
        e.preventDefault()
        e.target.parentElement.classList.toggle('open')
      },
      sidebarMinimize () {
        document.body.classList.toggle('sidebar-minimized')
      },
      brandMinimize () {
        document.body.classList.toggle('brand-minimized')
      }
    }
  }
</script>

<style lang="css">
    .nav-link {
        cursor: pointer;
    }
</style>
