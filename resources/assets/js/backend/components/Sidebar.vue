<template>
  <div class="sidebar">
    <SidebarHeader></SidebarHeader>
    <SidebarForm></SidebarForm>
    <nav class="sidebar-nav">
      <ul class="nav">
        <template v-for="(item, index) in navItems">
          <template v-if="item.access">
            <template v-if="item.title">
              <SidebarNavTitle :key="index" :name="item.name" :classes="item.class" :wrapper="item.wrapper"></SidebarNavTitle>
            </template>
            <template v-else-if="item.divider">
              <SidebarNavDivider :key="index" :classes="item.class"></SidebarNavDivider>
            </template>
            <template v-else>
              <template v-if="item.children">
                <!-- First level dropdown -->
                <SidebarNavDropdown :key="index" :name="item.name" :url="item.url" :icon="item.icon">
                  <template v-for="(childL1, index) in item.children">
                    <template v-if="childL1.children">
                      <!-- Second level dropdown -->
                      <SidebarNavDropdown :key="index" :name="childL1.name" :url="childL1.url" :icon="childL1.icon">
                        <li class="nav-item" v-for="(childL2, index) in childL1.children" :key="index">
                          <SidebarNavLink :name="childL2.name" :url="childL2.url" :icon="childL2.icon"
                                          :badges="childL2.badges" :variant="item.variant"></SidebarNavLink>
                        </li>
                      </SidebarNavDropdown>
                    </template>
                    <template v-else>
                      <SidebarNavItem :key="index" :classes="item.class">
                        <SidebarNavLink :name="childL1.name" :url="childL1.url" :icon="childL1.icon"
                                        :badges="childL1.badges" :variant="item.variant"></SidebarNavLink>
                      </SidebarNavItem>
                    </template>
                  </template>
                </SidebarNavDropdown>
              </template>
              <template v-else>
                <SidebarNavItem :key="index" :classes="item.class">
                  <SidebarNavLink :name="item.name" :url="item.url" :icon="item.icon" :badges="item.badges"
                                  :variant="item.variant"></SidebarNavLink>
                </SidebarNavItem>
              </template>
            </template>
          </template>
        </template>
      </ul>
    </nav>
    <button class="sidebar-minimizer" type="button" @click="sidebarMinimize();brandMinimize()"></button>
  </div>
</template>
<script>
import SidebarForm from './SidebarForm'
import SidebarHeader from './SidebarHeader'
import SidebarMinimizer from './SidebarMinimizer'
import SidebarNavDivider from './SidebarNavDivider'
import SidebarNavDropdown from './SidebarNavDropdown'
import SidebarNavLink from './SidebarNavLink'
import SidebarNavTitle from './SidebarNavTitle'
import SidebarNavItem from './SidebarNavItem'

export default {
  name: 'AppSidebar',
  components: {
    SidebarForm,
    SidebarHeader,
    SidebarMinimizer,
    SidebarNavDivider,
    SidebarNavDropdown,
    SidebarNavLink,
    SidebarNavTitle,
    SidebarNavItem
  },
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
