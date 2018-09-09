import Vue from 'vue'
import Breadcrumb from './Breadcrumb/Breadcrumb'
import Callout from './Callout/Callout'
import Footer from './Footer/Footer'
import Switch from './Switch/Switch'

import { Aside, AsideToggler } from './Aside'
import { Header, HeaderDropdown } from './Header'
import { Sidebar, SidebarFooter, SidebarForm, SidebarHeader, SidebarMinimizer, SidebarNav, SidebarNavDivider, SidebarNavItem, SidebarNavDropdown, SidebarNavLabel, SidebarNavLink, SidebarNavTitle, SidebarToggler } from './Sidebar'

// Register components with vue
Vue.component('Aside', Aside)
Vue.component('AsideToggler', AsideToggler)
Vue.component('Breadcrumb', Breadcrumb)
Vue.component('Callout', Callout)
Vue.component('Footer', Footer)
Vue.component('Header', Header)
Vue.component('HeaderDropdown', HeaderDropdown)
Vue.component('Sidebar', Sidebar)
Vue.component('SidebarFooter', SidebarFooter)
Vue.component('SidebarForm', SidebarForm)
Vue.component('SidebarHeader', SidebarHeader)
Vue.component('SidebarMinimizer', SidebarMinimizer)
Vue.component('SidebarNav', SidebarNav)
Vue.component('SidebarNavDivider', SidebarNavDivider)
Vue.component('SidebarNavDropdown', SidebarNavDropdown)
Vue.component('SidebarNavItem', SidebarNavItem)
Vue.component('SidebarNavLabel', SidebarNavLabel)
Vue.component('SidebarNavLink', SidebarNavLink)
Vue.component('SidebarNavTitle', SidebarNavTitle)
Vue.component('SidebarToggler', SidebarToggler)
Vue.component('SwitchToggle', Switch)
