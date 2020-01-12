//import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader
import Vue from 'vue'
import VueRouter from 'vue-router';
import './plugins/vuetify'
import Vuex from 'vuex'
//import axios from 'axios'

import i18n from './util/i18n'
import utils from './util/functions'
import store from './store';    
import App from './App.vue'

//import VuePrismEditor from "vue-prism-editor";
//load prism somewhere
import "prismjs";
import "prismjs/themes/prism-tomorrow.css";
//vue-prism-editor dependency
import "vue-prism-editor/dist/VuePrismEditor.css";
//Vue.component("PrismEditor", VuePrismEditor);

import VularNode from './VularNode'
import VularFullscreenButton from './components/VularFullscreenButton'
//import VularSearchbox from './components/VularSearchbox'
import VularAppfab from './components/VularAppfab'
//import VularThemeSetting from './components/VularThemeSetting'
import VularPage from './components/VularPage'
//import VularForm from './components/VularForm'
import VularDrawer from './components/VularDrawer'
import VularDrawerToolbar from './components/VularDrawerToolbar'
//import VularInteractiveComponent from './components/VularInteractiveComponent'
import VularDataTable from './components/VularDataTable'
import VularDataTableFilter from './components/VularDataTableFilter'
import VularDialog from './components/VularDialog'
import VularTreeSelect from './components/VularTreeSelect'
import VularTreeEditor from './components/VularTreeEditor'
import VularMediaSelect from './components/media/VularMediaSelect'
import VularPageLoadingProgress from './components/VularPageLoadingProgress'
import VularHasManyPanel from './components/VularHasManyPanel'
import VularHasManyTable from './components/VularHasManyTable'
//import VueQuillEditor from 'vue-quill-editor'
import VularTiptapEditor from './components/tiptap/VularTiptapEditor'
import VularMediasDialog from './components/media/VularMediasDialog'
import VularTopMessage from './components/VularTopMessage'
import VularForm from './components/VularForm'
import VularMedias from './components/media/VularMedias'
import VularAvatar from './components/media/VularAvatar'

import VularLogin from './components/VularLogin'
import VularLabel from './components/VularLabel'
import VularSlug from './components/VularSlug'
import VularEditor from './components/veditor/VularEditor'
import VularCodeEditor from './components/VularCodeEditor'
//import EditorCore from './components/veditor/EditorCore'
//import ElementToolbar from './components/veditor/elements/ElementToolbar'

import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'


Vue.use(VueRouter)
Vue.use(Vuex)
Vue.use(Vuetify)//Vue.use(VueQuillEditor)
//Vue.component('VuePerfectScrollbar', VuePerfectScrollbar)

Vue.component('VularTiptapEditor', VularTiptapEditor)
//Vue.component('dynamic-component',DynamicComponent);
Vue.component('VularNode',VularNode);
Vue.component('VularFullscreenButton',VularFullscreenButton);
//Vue.component('vular-searchbox',VularSearchbox);
Vue.component('VularAppfab',VularAppfab);
//Vue.component('vular-theme-setting',VularThemeSetting);
//Vue.component('VularPage',VularPage);
//Vue.component('vular-form',VularForm);
Vue.component('VularDrawer',VularDrawer);
Vue.component('VularDrawerToolbar',VularDrawerToolbar);
//Vue.component('VularInteractiveComponent',VularInteractiveComponent);
Vue.component('VularDataTable',VularDataTable);
Vue.component('VularDataTableFilter',VularDataTableFilter);
Vue.component('VularDialog',VularDialog);
Vue.component('VularTreeSelect',VularTreeSelect);
Vue.component('VularTreeEditor',VularTreeEditor);
Vue.component('VularMediaSelect',VularMediaSelect);
Vue.component('VularPageLoadingProgress',VularPageLoadingProgress);
Vue.component('VularHasManyPanel',VularHasManyPanel);
Vue.component('VularHasManyTable',VularHasManyTable);
Vue.component('VularMediasDialog',VularMediasDialog);
Vue.component('VularTopMessage',VularTopMessage);
Vue.component('VularForm',VularForm);
Vue.component('VularMedias',VularMedias);
Vue.component('VularAvatar',VularAvatar);

Vue.component('VularLogin',VularLogin);
Vue.component('VularLabel',VularLabel);
Vue.component('VularSlug',VularSlug);
Vue.component('VularEditor',VularEditor);
Vue.component("VularCodeEditor", VularCodeEditor);
//Vue.component('EditorCore',EditorCore);
//Vue.component('ElementToolbar',ElementToolbar);

const routes = [
  //{ path: '/form2', component: VularForm },
  { path: '/', redirect: {name:'adminpage', params:{pageid:window.indexPage/*后台View中定义*/}} },
  { path: '/page/:pageid', name:'adminpage', component: VularPage },
  { path: '/login', name:'login', component: VularLogin },
]

const router = new VueRouter({
  routes 
})

Vue.config.productionTip = false

//window.host = apiHost;
window.$bus= new Vue();
window.utils = utils;

window.axios = require('axios');

//window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
//var csrfMeta = document.head.querySelector(
//    'meta[name="csrf-token"]'
//)

//window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfMeta ? csrfMeta.content : null

axios.defaults.withCredentials = true

// http request 拦截器
axios.interceptors.request.use(
    config => {
        //console.log("拦截：")
        if (store.state.token) {  // 判断是否存在token，如果存在的话，则每个http header都加上token
            config.headers.Authorization = 'Bearer ' + store.state.token
            config.headers.Accept = 'application/json'
        }
        return config;
    },
    err => {
        //config.log("请求也有错吗？")
        return Promise.reject(err);
    });

window.axios.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (error.response) {
            switch (error.response.status) {
                case 401:
                    $bus.$emit('logout');
                    return;
                    break
                case 422:
                    //返回422错误，不处理，相关页面自行处理
                    //return Promise.reject(error);
                    break
                case 403:
                    //errorMessage = "没有访问权";
                    //return Promise.reject(error);
                    break
                case 500:
                    ////console.log(error)
                    //返回422错误，不处理，相关页面自行处理
                    //return Promise.reject(error);
                    break
                default:
                //errorMessage = errorMessage + "错误代码:" + error.response.status
            }
            //console.log("错误拦截" + error.response.status)
        }
        console.log(error.response.request.response)
        return Promise.reject(error)   // 返回接口返回的错误信息
    });

Vue.prototype.transRules = function (rules){
  if(rules){
    for (var i = 0; i < rules.length; i++) {
      rules[i] = eval(rules[i])
    }
  }
  return rules
}

new Vue({
  router,
  i18n,
  store,
  render: h => h(App),
}).$mount('#app')
