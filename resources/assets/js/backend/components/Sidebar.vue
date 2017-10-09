<template>
    <div class="sidebar">
        <nav class="sidebar-nav">
            <div slot="header"></div>
            <ul class="nav">
                <template v-for="(item, index) in navItems">
                    <template v-if="item.title">
                        <SidebarNavTitle :name="item.name"/>
                    </template>
                    <template v-else-if="item.divider">
                        <li class="divider"></li>
                    </template>
                    <template v-else>
                        <template v-if="item.children">
                            <SidebarNavDropdown :name="item.name" :url="item.url" :icon="item.icon">
                                <template v-for="(child, index) in item.children">
                                    <template v-if="child.children">
                                        <SidebarNavDropdown :name="child.name" :url="child.url" :icon="child.icon">
                                            <li class="nav-item" v-for="(child, index) in item.children">
                                                <SidebarNavLink :name="child.name" :url="child.url" :icon="child.icon" :badges="child.badges"/>
                                            </li>
                                        </SidebarNavDropdown>
                                    </template>
                                    <template v-else>
                                        <li class="nav-item">
                                            <SidebarNavLink :name="child.name" :url="child.url" :icon="child.icon" :badges="child.badges"/>
                                        </li>
                                    </template>
                                </template>
                            </SidebarNavDropdown>
                        </template>
                        <template v-else>
                            <li class="nav-item">
                                <SidebarNavLink :name="item.name" :url="item.url" :icon="item.icon" :badges="item.badges"/>
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
import SidebarNavDropdown from './SidebarNavDropdown'
import SidebarNavLink from './SidebarNavLink'
import SidebarNavTitle from './SidebarNavTitle'
export default {
  name: 'sidebar',
  props: {
    navItems: {
      type: Array,
      required: true,
      default: () => []
    }
  },
  components: {
    SidebarNavDropdown,
    SidebarNavLink,
    SidebarNavTitle
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
    cursor:pointer;
  }
</style>
