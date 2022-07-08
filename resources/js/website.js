import Vue from 'vue'


Vue.component('example-comp', require('./components/Example.vue').default);

// creating a vue instance
const app = new Vue({
  el: '#app'
});