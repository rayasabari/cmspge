import Vue from 'vue'


Vue.component('example-comp', require('./components/example.vue').default);

// creating a vue instance
const app = new Vue({
  el: '#app'
});