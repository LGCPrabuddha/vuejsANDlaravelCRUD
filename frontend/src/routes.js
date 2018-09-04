
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Home from './components/Home.vue'
import AddProduct from './components/AddProduct.vue'
import About from './components/About.vue'
import Contact from './components/Contact.vue'
import List from './components/List.vue'
import Edit from './components/Edit.vue'

const router = new VueRouter({
  mode:'history',
  routes:[
    { path:"",component:Home},
    { path:"/add",component:AddProduct},
    { path:"/about",component:About},
    { path:"/contact",component:Contact},
    { path:"/list",component:List},
    { path:"/edit/:id",component:Edit},
  ]
});

export default router
