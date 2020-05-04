import Vue from 'vue'
import App from './App.vue'
import router from './router/index'
import store from './store'
import axios from 'axios'

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
  faTimes,
  faGlobeAmericas,
  faCaretDown,
  faSearch
} from '@fortawesome/free-solid-svg-icons'
import {
  faClock,
  faMoneyBillAlt,
} from '@fortawesome/free-regular-svg-icons'

require('@/store/subscriber')

// axios.defaults.baseURL = 'http://localhost:8000/api/'
axios.defaults.baseURL = 'https://hidden-ridge-55617.herokuapp.com/api/'

library.add(faAcquisitionsIncorporated, faCreativeCommonsBy, faUserLock, faBookReader, faCog, faTimes, faGlobeAmericas, faCaretDown, faSearch, faClock, faMoneyBillAlt)

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

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('games', require('./views/Games.vue').default);
Vue.component('scroll-top', require('./components/ScrollTop.vue').default);
Vue.component('login-modal', require('./components/Modal/LoginModal.vue').default);
Vue.component('add-game-modal', require('./components/Modal/AddGameModal.vue').default);
Vue.component('edit-game-modal', require('./components/Modal/EditGameModal.vue').default);
Vue.component('add-filial-modal', require('./components/Modal/AddFilialModal.vue').default);
Vue.component('add-user-modal', require('./components/Modal/AddUserModal.vue').default);
Vue.component('edit-profile-modal', require('./components/Modal/EditProfileModal.vue').default);
Vue.component('edit-difficulties-modal', require('./components/Modal/EditDifficultiesModal.vue').default);
Vue.component('edit-genres-modal', require('./components/Modal/EditGenresModal.vue').default);
Vue.component('edit-languages-modal', require('./components/Modal/EditLanguagesModal.vue').default);
Vue.component('all-filials-modal', require('./components/Modal/AllFilialsModal.vue').default);
Vue.component('edit-filial-modal', require('./components/Modal/EditFilialModal.vue').default);
Vue.component('all-users-modal', require('./components/Modal/AllUsersModal.vue').default);
Vue.component('edit-user-modal', require('./components/Modal/EditUserModal.vue').default);

const EventBus = new Vue();
export default EventBus;

store.dispatch('auth/attempt', localStorage.getItem('token')).then(() => {

  new Vue({
    router,
    store,
    render: h => h(App)
  }).$mount('#app')

});