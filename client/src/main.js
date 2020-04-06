import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'

require('@/store/subscriber')

axios.defaults.baseURL = 'http://127.0.0.1:8000/api/'

Vue.config.productionTip = false

var VueScrollTo = require('vue-scrollto');
Vue.use(VueScrollTo, {
  container: "body",
  duration: 500,
  easing: "ease",
  offset: 0,
  force: true,
  cancelable: true,
  onStart: false,
  onDone: false,
  onCancel: false,
  x: false,
  y: true
})

Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('games', require('./views/Games.vue').default);
Vue.component('scroll-top', require('./components/ScrollTop.vue').default);
Vue.component('custom-footer', require('./components/Footer.vue').default);
Vue.component('login-modal', require('./components/LoginModal.vue').default);

  const EventBus = new Vue();
  export default EventBus;

store.dispatch('auth/attempt', localStorage.getItem('token')).then(() => {

  new Vue({
    router,
    store,
    render: h => h(App)
  }).$mount('#app')

});