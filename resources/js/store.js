import Vue from 'vue'

import formPage from './test-data/formPage';
import tablePage from './test-data/tablePage';
import { setToStorage, get_fromStorage, clearStorage, removeFromStorage } from './storage'

import Vuex from 'vuex'

Vue.use(Vuex)

export default 
new Vuex.Store({
  state:{
    token:'',
    forms:{},
    pagesStack:[],
    //interactiveComponents:{},
    //dialogs:{},
    pageLoading:false,
  },

 
  mutations:{
    pushPage(state, page){
      state.pagesStack.push(page);
    },

    popPage(state){
      state.pagesStack.pop();
    },

    loggedin(state, token){
        state.token = token;
        setToStorage('access_token', state.token);
    },

    logout(state){
        clearStorage()
        state.token = ''
    },
    /*showDialog(state, vularId) {
      state.dialogs[vularId] = true;
    },

    closeDialog(state, vularId){
      state.dialogs[vularId] = false;//触发数据变化事件
      delete state.dialogs[vularId];
    },

    addInteractiveComponent(state, interactiveComponent) {
      state.interactiveComponents[interactiveComponent.model.vularId] = interactiveComponent;
    },

    removeInteractiveComponent(state, vularId){
      state.interactiveComponents[vularId] = {};//触发数据变化事件
      delete state.interactiveComponents[vularId];
    },*/

    clearPagesCache(state){
      //state.dialogs = {};
      state.pagesStack = [];
      //state.interactiveComponents = {};
    },

    showPageLoading(state){
      state.pageLoading = true;
    },

    hidePageLoading(state){
      state.pageLoading = false;
    },

  },
 
  actions: {
    loadPage(context, entry){
      context.commit('showPageLoading');
      setTimeout(() => {
        context.commit('hidePageLoading');
        if(entry.pageid == 'form'){
          context.commit('pushPage', formPage);
        }
        if(entry.pageid == 'table'){
          context.commit('pushPage', tablePage);
        }
      }, 100)
    },

    closePage(context){
      context.commit('popPage');
      context.commit('showPageLoading');
      setTimeout(() => {
        context.commit('hidePageLoading');
        let stackLength = this.state.pagesStack.length;
        if(stackLength > 0){
          let page = this.state.pagesStack[stackLength - 1];
          //reload 异步加载数据

          //refresh current page
          context.commit('popPage');
          context.commit('pushPage', page);
        }
      }, 100)
    },

    doPageAction(context, pageAction){

      if(pageAction.action == 'load'){
        context.dispatch('loadPage', pageAction);
      }
      else if(pageAction.action == 'close'){
        context.dispatch('closePage');
      }

      else if(pageAction.action == 'close_dialog'){
        context.commit('closeDialog', pageAction.params.vularId);
      }

      //do action on page, submmit by post method to keep page state
      else if(pageAction.vularId){
        let interactiveComponent = this.state.interactiveComponents[pageAction.vularId];
        console.log(interactiveComponent.phpclass+':'+ pageAction.action);
        interactiveComponent.model.items = [];
        interactiveComponent.model.loading = true;
        console.log(interactiveComponent.model.selected);
      }
    },

  },
})
