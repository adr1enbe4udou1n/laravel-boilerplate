import Vue from 'vue'
import Vuex from 'vuex'

import { createActions } from './actions'
import mutations from './mutations'

Vue.use(Vuex)

export function createStore(route) {
  const actions = createActions(route)

  return new Vuex.Store({
    state: {
      counters: {
        newPostsCount: 0,
        pendingPostsCount: 0,
        publishedPostsCount: 0,
        activeUsersCount: 0,
        formSubmissionsCount: 0
      }
    },
    actions,
    mutations
  })
}
