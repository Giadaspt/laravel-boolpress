import Vue from 'vue';

import VueRouter from 'vue-router';

Vue.use(VueRouter);


import Home from './components/pages/Home';
import About from './components/pages/About';
import Contacts from './components/pages/Contacts';
import PostPage from './components/pages/PostPage';
import PostDetails from './components/pages/PostDetails';

const router = new VueRouter({
  mode: 'history',

  linkExactActiveClass: 'active',

  routes: [
    {
      path: '/',
      name: 'home',
      component: Home,
    },
    {
      path: '/about',
      name: 'about',
      component: About,
    },
    {
      path: '/contatti',
      name: 'contacts',
      component: Contacts,
    },
    {
      path: '/posts',
      name: 'posts',
      component: PostPage,
    },
    {
      path: '/detail/:slug',
      name: 'detail',
      component: PostDetails,
    },
  ]

});

export default router;