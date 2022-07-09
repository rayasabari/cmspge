import Vue from 'vue'


Vue.component('welcome-dashboard', require('./components/WelcomeDashboard.vue').default);

// creating a vue instance
const app = new Vue({
  el: '#app'
});