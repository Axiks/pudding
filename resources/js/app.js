/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('index-page', require('./components/Index.vue').default);
Vue.component('first-page', require('./components/FirstPage.vue').default);
Vue.component('create-club', require('./components/CreateClub.vue').default);
Vue.component('create-meet', require('./components/CreateMeet.vue').default);
Vue.component('show-clubs', require('./components/ShowClubs.vue').default);
Vue.component('hub', require('./components/Hub.vue').default);
Vue.component('show-meets', require('./components/ShowMeetsClub.vue').default);
Vue.component('upload-files', require('./components/Upload.vue').default);
Vue.component('upload-cover', require('./components/UploadCover.vue').default);
Vue.component('show-me-clubs', require('./components/ShowMyClubs.vue').default);
Vue.component('destroy-avatar-club', require('./components/DestroyAvatarClub.vue').default);
Vue.component('show-club', require('./components/ShowClub.vue').default);
Vue.component('register-user', require('./components/firstPage/RegisterUser.vue').default);
Vue.component('head-component', require('./components/Header.vue').default);
Vue.component('footer-component', require('./components/Footer.vue').default);
Vue.component('map-view', require('./components/MapViewPoint.vue').default);
Vue.component('map-select', require('./components/MapSelectPoint.vue').default);


Vue.component('login-component', require('./components/firstPage/LoginComponent.vue').default);

//Vue.component('google-map', VueGoogleMaps.Map);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//import ApolloClient from 'apollo-boost';
 import { ApolloClient } from 'apollo-client'
import { InMemoryCache } from 'apollo-cache-inmemory'
import { createUploadLink } from 'apollo-upload-client'
import { ApolloLink } from 'apollo-link'
import VueRouter from 'vue-router'
import { BatchHttpLink } from "apollo-link-batch-http";


// Cache implementation
const cache = new InMemoryCache()

const defaultOptions = {
 watchQuery: {
   fetchPolicy: 'no-cache',
   errorPolicy: 'ignore',
 },
 query: {
   fetchPolicy: 'no-cache',
   errorPolicy: 'all',
 },
}

const token = localStorage.getItem('token');
const httpOptions = {
  //uri: 'http://pudding.io//graphql',
  uri: '/graphql',
  headers: {
    'authorization': token ? `Bearer ${token}` : ''
  }
}

const httpLink = ApolloLink.split(
  operation => operation.getContext().hasUpload,
  createUploadLink(httpOptions),
  new BatchHttpLink(httpOptions)
)

// Create the apollo client
const apolloClient = new ApolloClient({
 link: ApolloLink.from([
  httpLink
 ]),
 cache,
 defaultOptions: defaultOptions,
})

import Vue from 'vue'
import VueApollo from 'vue-apollo'
import gql from 'graphql-tag';

Vue.use(VueApollo)

const apolloProvider = new VueApollo({
   defaultClient: apolloClient,
 })

 //Google Map

//  import * as VueGoogleMaps from 'vue2-google-maps'
//  Vue.use(VueGoogleMaps, {
//   load: {
//     key: 'AIzaSyAlJ5TS7Ef614P_-PN_UQlbLemADXLOu9Q',
//     libraries: 'places', // This is required if you use the Autocomplete plugin
//     // OR: libraries: 'places,drawing'
//     // OR: libraries: 'places,drawing,visualization'
//     // (as you require)
//   },
//   installComponents: false
// });

//OpenMap
import { LMap, LTileLayer, LMarker } from 'vue2-leaflet';
import 'leaflet/dist/leaflet.js';
import 'leaflet/dist/leaflet.css';

import { Icon } from 'leaflet';


delete Icon.Default.prototype._getIconUrl;
Icon.Default.mergeOptions({
  iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
  iconUrl: require('leaflet/dist/images/marker-icon.png'),
  shadowUrl: require('leaflet/dist/images/marker-shadow.png'),
});

Vue.component('l-map', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-marker', LMarker);




/**
 * Router
*/
window.VueRouter = require('vue-router');

Vue.use(VueRouter);

var index = require('./components/Index.vue');
var uploadAvatarClub = require('./components/Upload.vue');
var createClub = require('./components/CreateClub.vue');
var Club = require('./components/ShowClub.vue');
var settingClub = require('./components/SettingClub.vue');
var Clubs = require('./components/ShowClubs.vue');
var My_Clubs = require('./components/ShowMyClubs.vue');
var Meet = require('./components/ShowMeet.vue');
var createMeet = require('./components/CreateMeet.vue');
var firstPage = require('./components/FirstPage.vue');
var registerUser = require('./components/firstPage/RegisterUser.vue');
var showUser = require('./components/ShowUser.vue');
var loginPage = require('./components/firstPage/LoginPageBoxComponent.vue');
var showMe = require('./components/ShowMe.vue');
var settingMe = require('./components/user/SettingUser.vue');
var error404 = require('./components/404.vue');


var router = new VueRouter({
  // mode: 'history',
  routes: [
    { path: '/', name: 'clubs', component: Clubs.default },
    { path: '/index', name: 'index', component: index.default },
    { path: '/club/create', name: 'clubCreate', component: createClub.default },
    { path: '/club/:id/avatarUpload', name: 'clubAvatarUpload', component: uploadAvatarClub.default },
    { path: '/club/:id', name: 'club', component: Club.default }, // /about => About.vue
    { path: '/club/:id/setting', name: 'settingClub', component: settingClub.default },
    { path: '/clubs', name: 'clubs', component: Clubs.default },
    { path: '/myclubs', name: 'myclubs', component: My_Clubs.default },
    { path: '/meet/create', name: 'createMeet', component: createMeet.default, props: true },
    { path: '/meet/:id', name: 'meet', component: Meet.default },
    { path: '/firstPage', name: 'firstPage', component: firstPage.default },
    { path: '/registration', name: 'registerUser', component: registerUser.default },
    { path: '/user/:id', name: 'user', component: showUser.default },
    { path: '/login', name: 'login', component: loginPage.default },
    { path: '/me', name: 'me', component: showMe.default},
    { path: '/setting', name: 'setting', component: settingMe.default},
    { path: '*', name: 'error404', component: error404.default },
  ]
})


  window.app3 = new Vue({
    el: '#app',
    router: router,
    apolloProvider,
    data: {
    }
});