<template>
  <v-card color="#EEEEEE">
    <v-navigation-drawer
      v-model="toolbox"
      app
      right
      :clipped="true"
      width="240"
      dark
    >
      <v-toolbar dense>
        工具箱
        <v-spacer></v-spacer>
        <v-btn icon small @click="toolbox = false"><v-icon small>close</v-icon></v-btn>
      </v-toolbar>
      <v-tabs v-model="activeTab">
        <v-tab ripple>
          <v-avatar
          size="18"
        >
          <img src="https://vuetifyjs.com/apple-touch-icon-180x180.png" alt="avatar">
        </v-avatar>

        </v-tab>
        <v-tab
          ripple
        >
          H5

        </v-tab>
        <v-tab ripple>
          <v-icon small>list_alt</v-icon>
        </v-tab>
        <v-tab-item
        >
          <v-card flat>
            <v-list>
              <v-subheader>Vueify控件</v-subheader>
              <v-list-group
                v-for="item in items"
                :key="item.title"
                v-model="item.active"
                :prepend-icon="item.active?'remove':'add'"
                no-action
              >
                
                  <v-list-tile slot='activator'>
                    <v-list-tile-content>
                      <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                    </v-list-tile-content>
                  </v-list-tile>
                  <v-container>
                    <v-layout row wrap>
                      <v-flex v-for="(subItem, i) in item.items" :key="i" xs6 class="text-xs-center pb-2 pt-1 pl-1 pr-2">
                        <v-hover>
                          <v-card 
                            slot-scope="{ hover }"
                            draggable="true" 
                            :class="`text-xs-center pt-1 pb-2 elevation-${hover ? 12 : 2}`" 
                            style="cursor: move"
                            @dragstart="toolbarDrag($event, subItem)"
                            @dragend="toolbarDragend($event, subItem)"
                          >
                            <v-icon x-large :color="`${hover ? '#F06292' : ''}`">{{subItem.handle.icon}}</v-icon>
                            <div :style="`color:${hover ? '#F06292' : ''}`">{{subItem.handle.title}}</div>
                          </v-card>
                        </v-hover>
                      </v-flex>
                    </v-layout>
                  </v-container>
               </v-list-group>
            </v-list>      
          </v-card>
        </v-tab-item>

        <v-tab-item>
        </v-tab-item>
        <v-tab-item>
          <v-list>
              <v-subheader>属性编辑</v-subheader>
              <v-list-group
                prepend-icon="add"
                no-action
              >
                  <v-list-tile slot='activator'>
                    <v-list-tile-content>
                      <v-list-tile-title>布局属性</v-list-tile-title>
                    </v-list-tile-content>
                  </v-list-tile>
                  <v-container>
                    <v-slider          
                      :min="16"
                      :max="256"
                      label="Size"
                      thumb-label
                      class="pa-0 ma-0"
                    ></v-slider>
                    <v-switch primary label="Dark" class="pa-0 ma-0"></v-switch>
                  </v-container>
              </v-list-group>
            
          </v-list> 
        </v-tab-item>
      </v-tabs>
    </v-navigation-drawer>    
    <v-toolbar dense flat >
      <v-btn-toggle
        class="transparent"
        v-model="deviceButtons"
        mandatory
      >
        <v-btn flat @click="canvasWidth='100%'"><v-icon>desktop_windows</v-icon></v-btn>   
        <v-btn flat @click="canvasWidth='1024px'"><v-icon>laptop</v-icon></v-btn>   
        <v-btn flat @click="canvasWidth='768px'"><v-icon>tablet</v-icon></v-btn>   
        <v-btn flat @click="canvasWidth='425px'"><v-icon>phone_iphone</v-icon></v-btn>   
      </v-btn-toggle>
      <v-divider  class="mr-1 ml-1" vertical></v-divider>
      <v-btn-toggle :value="appToolbar?0:1" class="transparent mr-1">
        <v-btn flat @click="appToolbar = !appToolbar"><v-icon>view_quilt</v-icon></v-btn>
      </v-btn-toggle>   
      <v-bottom-sheet v-model="bottomSheet" hide-overlay persistent>
       <v-btn-toggle :value="bottomSheet?0:-1" class="transparent mr-1" slot="activator">
          <v-btn flat>
            <v-icon>device_hub</v-icon>
          </v-btn>
        </v-btn-toggle>
        
        <v-list dark>
          <v-subheader>子节点</v-subheader>
        </v-list>
      </v-bottom-sheet>
      <v-btn-toggle :value="hidePadding?0:1" class="transparent mr-1">
        <v-btn flat @click="changePadding"><v-icon >leak_remove</v-icon></v-btn>
      </v-btn-toggle>   
      <v-btn-toggle :value="showLabel?1:0" class="transparent mr-1">
        <v-btn flat @click="changShowLabel"><v-icon >label_off</v-icon></v-btn>
      </v-btn-toggle>   
      <v-btn-toggle :value="preview?0:1" class="transparent mr-1">
        <v-btn flat @click="changePreview"><v-icon >visibility</v-icon></v-btn>
      </v-btn-toggle>   
      <v-btn-toggle :value="toolbox?0:-1" class="transparent mr-1">
        <v-btn flat @click="toolbox = !toolbox"><v-icon>phonelink_setup</v-icon></v-btn>
      </v-btn-toggle>
      <v-btn icon><v-icon >undo</v-icon></v-btn>   
      <v-btn icon><v-icon >redo</v-icon></v-btn>   
      <v-spacer></v-spacer>
      <v-btn icon><v-icon >fullscreen</v-icon></v-btn>
      <v-btn icon><v-icon >cloud_download</v-icon></v-btn>   
      <v-btn icon><v-icon >screen_share</v-icon></v-btn>   
      <v-btn icon><v-icon>settings</v-icon></v-btn>
    </v-toolbar>
    <v-divider></v-divider>
    <v-toolbar v-show="appToolbar" dense flat>
      <v-btn-toggle class="transparent mr-1">
        <v-btn flat @click="moduleSelect(app)">
          <v-icon v-if="app.selected" color="primary">check_box</v-icon> 
          <v-icon v-else >check_box_outline_blank</v-icon> 
          APP
        </v-btn>
      </v-btn-toggle>  
      <v-divider v-show="app.selected" class="mr-2 ml-1" vertical></v-divider>
      <v-btn-toggle v-show="app.selected" v-for="(com, key) in app.modules" :key="key" :value="com.selected?0:-1" class="transparent mr-1">
        <v-btn flat @click="moduleSelect(com)">
          <v-icon v-if="com.selected" color="primary">check_box</v-icon> 
          <v-icon v-else="com.selected" >check_box_outline_blank</v-icon> 
          {{com.title}}
        </v-btn>
      </v-btn-toggle>  
      <v-spacer></v-spacer>
      <v-btn icon small @click="appToolbar = false"><v-icon small>close</v-icon></v-btn>
    </v-toolbar>
    <v-divider></v-divider>
    
    <v-layout column wrap>
      <v-flex text-xs-center>
        <iframe ref="canvas" :width="canvasWidth" :height="canvasHeight + 'px'" src="javascript:0"  frameborder="no" border="0" allowtransparency="no"   scrolling="no"></iframe>
      </v-flex>
      <v-flex>
      </v-flex>    
    </v-layout> 
       
    
  </v-card>
</template>

<script>
import Vue from 'vue'
import {NavigationDrawerNode, ToolbarNode, ContentNode, FooterNode} from './elements/AppNodes'
import {ContainerNode, LayoutNode, FlexNode} from './elements/LayoutNodes'

export default {
  name: 'vular-editor',
  components: {
  },
  props:{
    jsFile:{
      type: String,
      default: "vular/js/vular-editor-core.js"
    },
  },

  data: function () {
    return {
      appToolbar:true,
      app:{
        selected:false,
        modules:{
          leftDrawer:{
            title:'Left Drawer',
            selected:false,
          },
          toolbar:{
            title:'Toolbar',
            selected:false,
          },
          rightDrawer:{
            title:'Right Drawer',
            selected:false,
          },
          footer:{
            title:'Footer',
            selected:false,
          },
        },
      },
      bottomSheet:false,
      hidePadding:false,
      showLabel:true,
      preview:false,
      deviceButtons:0,
      canvasWidth:'100%',
      canvasHeight:'',
      activeTab:0,
      lastActiveTab:0,
      rootElements:[],
      createByDragElement:null,
      dragOverElement:null,
      focusElement:null,
      carveActive:false,
      wrapByApp: false,
      toolbox: true,
        items: [
          {
            title: 'Grid布局',
            active: true,
            items: [
              new ContainerNode, 
              new LayoutNode, 
              new FlexNode,
              new NavigationDrawerNode,
              new ToolbarNode,
              new FooterNode,
            ]
          },
        ],
    }
  },

  methods: {
    toolbarDrag (event, item) {
      //console.log('toolbarDrag',event)
      this.sendMessageToCanvas({
          cmd: 'dragFromToolbox',
          params: {name:item.name}
        })

    },
    toolbarDragend (event, item) {
      //console.log('toolbarDragend', event)
      this.sendMessageToCanvas({
          cmd: 'endDragFromToolbox',
          params: {}
        })
    },

    sendMessageToCanvas(message){
      let iframe = this.$refs.canvas;
      if(iframe){
        iframe.contentWindow.postMessage(message, '/')
      }
    },

    receiveCanvasMessage(event){
      var data = event.data;
      switch (data.cmd) {
        case 'changCanvasHeight':
            this.canvasHeight = data.params.height
            break;
        }
    },

    moduleSelect(theModule){
      theModule.selected = !theModule.selected
      this.sendMessageToCanvas({
          cmd: 'changeAppLayout',
          params: this.app
        })
    },

    changePadding(){
      this.hidePadding = !this.hidePadding
      let padding = this.hidePadding?'2px':'20px'
      this.sendMessageToCanvas({
          cmd: 'setEditPadding',
          params: padding
        })
    },

    changShowLabel(){
      this.showLabel = !this.showLabel
      this.sendMessageToCanvas({
          cmd: 'showLabel',
          params: this.showLabel
        })
    },

    changePreview(){
      this.preview = !this.preview
      this.sendMessageToCanvas({
          cmd: 'preview',
          params: this.preview
        })
    },

    doNothing(){

    }
  },

  mounted () {
    let iframedocument =  this.$refs.canvas.contentDocument;//contentWindow.document;
    //let iframeWindow = iframe.contentWindow;
    iframedocument.open();
    iframedocument.write('<html><head><title>im in_poll</title></head><body style="background-color:#FFF;padding:2px;"><div id="canvas"></div><script type="text/javascript" src="' + this.jsFile +'"><\/script></body></html>');
    iframedocument.close();
    if(!window.$editorBus) window.$editorBus= new Vue()
    window.addEventListener("message", this.receiveCanvasMessage);
  },

  destoryed () {
    delete window.$editorBus
    window.removeEventListener("message", this.receiveCanvasMessage);
  },
 
};
</script>

<style scoped  lang="stylus">
 


</style>