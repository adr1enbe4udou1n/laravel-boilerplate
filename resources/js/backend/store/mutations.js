export default {
  SET_COUNTER: (state, { type, counter }) => {
    state.counters[type] = counter
  }
}
