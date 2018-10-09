import Vue from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'

import { faHome, faStar } from '@fortawesome/free-solid-svg-icons'

import {} from '@fortawesome/free-regular-svg-icons'

import {
  faFacebook,
  faTwitter,
  faGoogle,
  faLinkedin,
  faGithub,
  faBitbucket,
  faPinterest,
  faGooglePlus,
  faVk,
  faWhatsapp,
  faTumblr,
  faGetPocket,
  faBlogger,
  faTelegram,
  faViber
} from '@fortawesome/free-brands-svg-icons'

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(
  faHome,
  faFacebook,
  faTwitter,
  faGoogle,
  faLinkedin,
  faGithub,
  faBitbucket,
  faPinterest,
  faStar,
  faGooglePlus,
  faVk,
  faWhatsapp,
  faTumblr,
  faGetPocket,
  faBlogger,
  faTelegram,
  faViber
)

Vue.component('font-awesome-icon', FontAwesomeIcon)
