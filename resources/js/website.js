import Vue from 'vue'
import axios from 'axios'
import { Notify } from "notiflix/build/notiflix-notify-aio";

// Notify Init Customization
Notify.init({
  useFontAwesome: true,
  opacity: 0.85
})

Vue.component('welcome-dashboard', require('./components/WelcomeDashboard.vue').default);

// Pages 
Vue.component('home-front', require('./components/Pages/HomeFront.vue').default);
Vue.component('pages-index', require('./components/Pages/Index.vue').default);
Vue.component('pages-add', require('./components/Pages/Add.vue').default);

Vue.prototype.$axios = axios;
Vue.prototype.Notify = Notify;

// creating a vue instance
const app = new Vue({
  el: '#app'
});