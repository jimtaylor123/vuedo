import Vue from 'vue'
import App from './App.vue'
import store from './store'

import Zondicon from 'vue-zondicons';
Vue.component('Zondicon', Zondicon);

Vue.config.productionTip = false

new Vue({
  store,
  render: h => h(App),
}).$mount('#app')
