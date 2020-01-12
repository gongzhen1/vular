<template>
  <v-app v-if="app.selected" id="layout" app >
    <element-view v-for="(node, i) in app.modules" :key="i" v-if="node.selected" :value="node.element" ></element-view>
    <v-content >
      <div style="position:absolute;width: 100%;height: calc(100% - 2px );" 
        @dragover="rootNode.dragover($event)"
        @dragleave="rootNode.dragleave($event)"
        @drop="rootNode.drop($event)"
        @click="canvasClick($event)">
      </div>
      
      <element-view v-for="(element, i) in rootNode.children" :key="i" :style="{'margin-top':i == 0? state.editPadding:'' }" :value="element" ></element-view>
      
    </v-content>
  </v-app>
  <div v-else 
    class="canvas"
    :style="`padding:${state.editPadding}`"
    @dragover="rootNode.dragover($event)"
    @dragleave="rootNode.dragleave($event)"
    @drop="rootNode.drop($event)"
    @click="canvasClick($event)"
  > 
    <element-view v-for="(element, i) in rootNode.children" :key="i" :value="element" ></element-view>
  </div>

  
</template>

<script>
import Vue from 'vue'
import ElementView from './elements/ElementView';
import elementsStorage from './elements/ElementsStorage'
import {NavigationDrawerNode, ToolbarNode, ContentNode, FooterNode} from './elements/AppNodes'
import Element from './elements/Element'

export default {
  name: 'editor-core',
  components: {
    ElementView,
  },
  props:{
  },

  data: function () {
    return {
      app:{
        selected:false,
        modules:{
          leftDrawer:{
            selected:true,
            element:null,
          },
          toolbar:{
            selected:true,
            element:null,
          },
          rightDrawer:{
            selected:false,
            element:null,
          },
          footer:{
            selected:false,
            element:null,
          },
        },
      },
      state:{
        editPadding:'20px',
        showLabel:true,
        draggedElement:null,
        status:'normal',
        placeholder:null,
        undoCommands:[],
        redoCommonds:[],
      },
      //canvasActive:false,
      rootNode:new Element,
      createByDragElement:null,
      //focusElement:null,
      //wrapByApp: false,
      //toolbox: true,
      elementsStorage:elementsStorage,
    }
  },

  methods: {
    /*toolbarDrag (event, item) {
      if(this.status === 'preview'){
        return
      }
      this.createByDragElement = item
    },
    toolbarDragend (event, item) {
      if(this.status === 'preview'){
        return
      }
      this.createByDragElement = null
      //this.canvasActive = false;
    },*/

    /*canvasDragover(event){
      if(this.status === 'preview'){
        return
      }
      //this.canvasActive = true;
      event.preventDefault();
    },

    canvasDragLeave(event){
      if(this.status === 'preview'){
        return
      }
      //this.canvasActive = false;
      //console.log('canvasDragLeave',event)
      //console.log('canvasDragLeave',event)
    },

    dragovered(element){
      if(element._vid !== this.rootNode._vid){
        //this.canvasActive = false;
      }
    },

    canvasDrop(event){
      if(this.status === 'preview'){
        return
      }
      if(this.createByDragElement){
        this.createByDrag(this.rootNode)
        this.createByDragElement = null;
      }
      if(this.dragElement){
        this.dragElement.moveTo(this.rootNode)
        this.dragElement = null;
      }
      //this.canvasActive = false;
      //this.sendCanvasHeight();
    },*/

    canvasClick(event){
      if(this.state.status === 'preview'){
        return
      }
      $editorBus.$emit('unfocusAll')
      //this.sendCanvasHeight();
    },

   /* elementDragstart(event, node){
      this.dragElement = node
    },

    elementDragend(event, node){
      this.dragElement = null
    },

    elementDragover(event, node){
      let dragElement = this.dragElement ? this.dragElement : this.createByDragElement
      if(node.accept(dragElement)){
        event.preventDefault();
      }
    },*/

    //elementDragLeave(event, node){
      //this.sendCanvasHeight();
    //},

    elementDrop(event, node, isBefore, isAffter){
      if(this.createByDragElement){
        this.createByDrag(node, isBefore, isAffter)
        this.createByDragElement = null
      }

      if(this.dragElement){
        this.dragElement.moveTo(node)
        this.dragElement.setStatus('normal')
        this.dragElement = null
      }
      //this.canvasActive = false
    },

    elementClick(event, node){
      //this.sendCanvasHeight();
    },

    elementFocus(event, node){
      if(this.activeTab != 2) this.lastActiveTab = this.activeTab
      this.activeTab = 2
      this.focusElement = node
      //this.sendCanvasHeight();
    },

    elementUnfocus(node){
      if(this.focusElement&& node._vid == this.focusElement._vid) {
        this.focusElement = null
        this.activeTab = this.lastActiveTab
      }
      //this.sendCanvasHeight();
    },

    createByDrag(targetNode, isBefore, isAffter){
      let node = this.createByDragElement.make()
      node.setEditorState(this.state)
      //this.bindThingsToNode(node)
      if(isBefore){
        targetNode.parent.inertBefore(node, targetNode)
      }
      else if(isAffter){
        targetNode.parent.inertAfter(node, targetNode)

      }
      else{
        targetNode.addChild(node)
      }
      return node;
    },

    stateChange(state){
      this.state = state
    },

    sendCanvasHeight(){
      this.sendMessage({
          cmd: 'changCanvasHeight',
          params: {
            height: document.body.scrollHeight
          }
      });
    },

    sendMessage(message){
      window.parent.postMessage(message, '/');    
    },

    receiveMessage(event){
      var data = event.data;
      switch (data.cmd) {
        case 'dragFromToolbox':
          this.state.draggedElement = this.elementsStorage.getElementByName(data.params.name).make().setEditorState(this.state).toDraggedState()
          this.state.placeholder = this.state.draggedElement.makePlaceholder()
          break;

        case 'endDragFromToolbox':
          this.state.draggedElement = null
          if(this.state.placeholder) this.state.placeholder.removeFromParent()
          this.state.placeholder = null
          break;

        case 'changeAppLayout':
          let app = data.params
          this.app.selected = app.selected
          this.$set(this.app.modules.leftDrawer, 'selected', app.modules.leftDrawer.selected)
          this.$set(this.app.modules.toolbar, 'selected', app.modules.toolbar.selected)
          this.$set(this.app.modules.rightDrawer, 'selected', app.modules.rightDrawer.selected)
          this.$set(this.app.modules.footer, 'selected', app.modules.footer.selected)
          break;
         case 'setEditPadding':
          let padding = data.params
          this.state.editPadding = padding
          //$editorBus.$emit('setEditPadding', padding)
          break;

         case 'showLabel':
          let showLabel = data.params
          this.state.showLabel = showLabel
          //$editorBus.$emit('showLabel', showLabel)
          break;

         case 'preview':
          this.state.status = data.params ? 'preview' : 'normal'
          //$editorBus.$emit('preview', data.params)
          break;
        }

    },

  },

  created () {
    if(!window.$editorBus) window.$editorBus= new Vue()

    let element = new NavigationDrawerNode
    element.hasLabel = false
    element.noToolbar = true
    element.app()
    element.editStyle['height'] = "calc(100% - 4px)"
    element.editStyle['margin-left'] = "2px"
    element.editStyle['margin-top'] = "2px"
    element.parent = this.rootNode
    element.setEditorState(this.state)
    //this.bindThingsToNode(element)
    this.app.modules.leftDrawer.element = element

    element = new ToolbarNode
    element.hasLabel = false
    element.noToolbar = true
    element.app()
    element.editStyle['margin-top'] = "2px"
    element.parent = this.rootNode
    element.setEditorState(this.state)
    //this.bindThingsToNode(element)
    this.app.modules.toolbar.element = element

    element = new NavigationDrawerNode
    element.hasLabel = false
    element.noToolbar = true
    element.app().right()
    element.editStyle['height'] = "calc(100% - 4px)"
    element.editStyle['margin-right'] = "2px"
    element.editStyle['margin-top'] = "2px"
    element.parent = this.rootNode
    element.setEditorState(this.state)
    //this.bindThingsToNode(element)
    this.app.modules.rightDrawer.element = element

    element = new FooterNode
    element.hasLabel = false
    element.noToolbar = true
    element.app()
    element.editStyle['margin-bottom'] = "2px"
    element.parent = this.rootNode
    element.setEditorState(this.state)
    //this.bindThingsToNode(element)
    this.app.modules.footer.element = element
  },

  mounted () {
    const self = this;
    window.addEventListener("message", this.receiveMessage);
    this.sendCanvasHeight();
    this.rootNode.setEditorState(this.state)
    //this.rootNode.setDragover(this.canvasDragover)
    $editorBus.$on('dragovered', this.dragovered)
    $editorBus.$on('editorStateChange', this.stateChange)



  },

  updated: function () {
    this.sendCanvasHeight();
  },

  destoryed () {
    delete window.$editorBus
    window.removeEventListener("message", this.receiveMessage);
    $editorBus.$off('dragovered', this.dragovered)
    $editorBus.$off('editorStateChange', this.stateChange)
  },

  watch: {
    state: {
      handler(newState, oldState) {
        $editorBus.$emit('editorStateChange', newState)
      },
      deep:true
    },
  }
 
};
</script>

<style scoped  lang="stylus">
import './stylus/element.styl'

   
.tool-box{
  width: 200px;
  height: 300px;
  position:fixed;
  background: #383838;
  z-index: 1000;
  top: 100px;
  right:30px;
  border-radius: 0px;
  box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.3);
}

.canvas:empty::before{
  content: attr(placeholder);
  color: darkgrey;
} 
     
.canvas{
  width:100%;
  min-height:500px;
  position:absolute;
  top:0px;
  left:0px;
  border:#ddd solid 1px;
}

.drag-over-canvas{
  border:#F06292 solid 1px;
  background-color: #FCE4EC;
}




</style>