import Vue from 'vue'
import App from './App.vue'
import Router from './routes.js'
import VeeValidate from 'vee-validate';
import vueResourse from 'vue-resource';

Vue.use(VeeValidate);
Vue.use(vueResourse);


new Vue({
  el: '#app',
  render: h => h(App),
  router:Router
})

