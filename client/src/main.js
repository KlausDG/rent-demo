import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'
// import Vuesax from 'vuesax'
import 'vuesax/dist/vuesax.css'
import 'bootstrap/dist/css/bootstrap.css'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'material-icons/iconfont/material-icons.css';
import PortalVue from 'portal-vue'

import {
  library
} from '@fortawesome/fontawesome-svg-core'
import {
  FontAwesomeIcon
} from '@fortawesome/vue-fontawesome'
import {
  faAcquisitionsIncorporated,
  faCreativeCommonsBy
} from '@fortawesome/free-brands-svg-icons'
import {
  faUserLock,
  faBookReader,
  faCog,
  faTimes
} from '@fortawesome/free-solid-svg-icons'
import {
  faClock,
  faMoneyBillAlt
} from '@fortawesome/free-regular-svg-icons'

require('@/store/subscriber')
require('bootstrap')

axios.defaults.baseURL = 'http://127.0.0.1:8000/api/'

library.add(faAcquisitionsIncorporated, faCreativeCommonsBy, faUserLock, faBookReader, faCog, faTimes, faClock, faMoneyBillAlt)

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

// Vue.use(Vuesax)
Vue.use(BootstrapVue)
Vue.use(PortalVue)

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('games', require('./views/Games.vue').default);
Vue.component('scroll-top', require('./components/ScrollTop.vue').default);
Vue.component('custom-footer', require('./components/Footer.vue').default);
Vue.component('login-modal', require('./components/LoginModal.vue').default);
Vue.component('add-game-modal', require('./components/Modal/AddGameModal.vue').default);
Vue.component('edit-game-modal', require('./components/Modal/EditGameModal.vue').default);
Vue.component('add-genre-modal', require('./components/Modal/AddGenreModal.vue').default);
Vue.component('add-difficulty-modal', require('./components/Modal/AddDifficultyModal.vue').default);
Vue.component('add-language-modal', require('./components/Modal/AddLanguageModal.vue').default);
Vue.component('add-filial-modal', require('./components/Modal/AddFilialModal.vue').default);
Vue.component('add-socio-modal', require('./components/Modal/AddSocioModal.vue').default);
Vue.component('edit-profile-modal', require('./components/Modal/EditProfileModal.vue').default);
Vue.component('edit-difficulties-modal', require('./components/Modal/EditDifficultiesModal.vue').default);

const EventBus = new Vue();
export default EventBus;

store.dispatch('auth/attempt', localStorage.getItem('token')).then(() => {

  new Vue({
    router,
    store,
    render: h => h(App)
  }).$mount('#app')

});