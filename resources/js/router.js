import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Home from './pages/Home';
import About from './pages/About';
import Contact from './pages/Contact';

const router = new VueRouter({
  mode: "history",

  routes:[
    {
      path: '/',
      name: "home",
      component: Home //assegna questa route al componente Home.vue
    },
    {
      path: '/chi-siamo',
      name: "about",
      component: About
    },
    {
      path: '/contatti',
      name:"contact",
      component: Contact
    }

  ]
});

export default router;