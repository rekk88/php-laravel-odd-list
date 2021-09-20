import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Home from './pages/Home';

const router = new VueRouter({
  mode: "history",

  routes:[
    {
      path: '/',
      name: "home",
      component: Home //assegna questa route al componente Home.vue
    },
    {
      path: 'chi-siamo',
      name: "about",
      component: About
    }
  ]
});

export default router;