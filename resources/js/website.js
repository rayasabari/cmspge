import Vue from 'vue'
import axios from 'axios'
import { Notify } from "notiflix/build/notiflix-notify-aio";
import { Confirm } from 'notiflix/build/notiflix-confirm-aio';

// Notify Init Customization
Notify.init({
  useFontAwesome: true,
  opacity: 0.85,
  fontFamily: 'poppins',
})

Confirm.init({
  borderRadius: '8px',
  titleColor: '#2F95E8',
  okButtonBackground: '#2F95E8',
  fontFamily: 'poppins',
})

Vue.component('welcome-dashboard', require('./components/WelcomeDashboard.vue').default);

// Pages 
Vue.component('pages-index', require('./components/Pages/Index.vue').default);
Vue.component('pages-content-manager', require('./components/Pages/ContentManager.vue').default);

// Collections
Vue.component('collections-services', require('./components/Collections/Services/Index.vue').default);
Vue.component('collections-staff', require('./components/Collections/Staff/Index.vue').default);
Vue.component('collections-expertise', require('./components/Collections/Expertise/Index.vue').default);
Vue.component('collections-values', require('./components/Collections/Values/Index.vue').default);
Vue.component('collections-achievements', require('./components/Collections/Achievements/Index.vue').default);

Vue.prototype.$axios = axios;
Vue.prototype.Notify = Notify;
Vue.prototype.Confirm = Confirm;

// creating a vue instance
const app = new Vue({
  el: '#app'
});