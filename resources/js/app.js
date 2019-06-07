
/***
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import NProgress from 'nprogress';
import { Form, HasError, AlertError } from 'vform';
import moment from 'moment';
import swal from 'sweetalert2'
window.swal = swal;
window.NProgress = NProgress;
window.Fire = new Vue();

 
const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
window.toast = toast;

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.filter('humanDate', function(created){
  return moment(created).format('MMMM Do YYYY, h:mm:ss a');
})

// let str = '';
// Vue.filter('removeSpace', function(){
//   return  str.replace(/ /g, '-');
// })



const routes = [
    { name: 'all-patients', path: '/patients', component: require('./components/patients.vue').default },
    { name: 'add-biodata', path: '/add-biodata', component: require('./components/add-biodata.vue').default },
    { name: 'add-vital', path: '/add-vital', component: require('./components/add-vitals.vue').default },
    { name: 'vitals', path: '/vitals', component: require('./components/vitals.vue').default },
    { name: 'add-hospital', path: '/add-hospital', component: require('./components/add-hospital.vue').default },
    { name: 'hospital', path: '/hospital', component: require('./components/hospital.vue').default },
    { name: 'add-surgery', path: '/add-surgery', component: require('./components/add-surgery.vue').default },
    { name: 'surgery', path: '/surgery', component: require('./components/surgery.vue').default },
    { name: 'complain', path: '/complain', component: require('./components/complain.vue').default },
    { name: 'diagnosed', path: '/diagnosed', component: require('./components/diagnosed.vue').default },
    { name: 'lab-test', path: '/lab-test', component: require('./components/lab-test.vue').default },
    { name: 'labresult', path: '/labresult', component: require('./components/labresult.vue').default },
    { name: 'pham-test', path: '/pham-test', component: require('./components/pham-test.vue').default },
    { name: 'medication', path: '/medication', component: require('./components/medication.vue').default },
    { name: 'give-injection', path: '/give-injection', component: require('./components/give-injection.vue').default },
    { name: 'billing', path: '/billing', component: require('./components/billing.vue').default },
    { name: 'staff', path: '/staff', component: require('./components/staff.vue').default },
    { name: 'all-staffs', path: '/all-staffs', component: require('./components/all-staff.vue').default },
    { name: 'profile', path: '/profile', component: require('./components/profile.vue').default },
  ]

  const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
  })
  

  router.beforeResolve((to, from, next) => {
    if (to.name) {
        NProgress.start()
        NProgress.set(0.4); // To set a progress percentage, call .set(n), where n is a number between 0..1
        NProgress.inc(); // To increment the progress bar, just use .inc(). This increments it with a random amount. This will never get to 100%: use it for every image load (or similar).If you want to increment by a specific value, you can pass that as a parameter
        NProgress.configure({ ease: 'ease', speed: 500 }); // Adjust animation settings using easing (a CSS easing string) and speed (in ms). (default: ease and 200)
        NProgress.configure({trickleSpeed: 800 }); //Adjust how often to trickle/increment, in ms.
    }
    next()
  })
  
  
  router.afterEach((to, from) => {
    setTimeout(function(){
      NProgress.done()
     }, 3000);    
  })



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({    
    el: '#app',
    router
});
