import './stylus/element.styl'

import ElementLabel from './ElementLabel'

export default {
  name: 'element-node-view',
  components: {
    ElementLabel,
  },

  props:['value'],
  data: function () {
    return {
      children:this.value.children,
      classes:{},
      styles:{},
      nodProps:{},
      labelClass:{},
      isShowLabel:false,
      hasToolbar:false,
    }
  },

  computed: {
    inputValue: {
      get:function() {
          return this.value;
      },
      set:function(val) {
        this.$emit('input', val);
      },
    },
  },

  methods: {
 
     getOn(){
      const self = this;
      var on = {}
      if(this.inputValue.isPlaceholder){
        return on
      }
      on.mousemove = function(event){
        self.inputValue.mouseover(event)
        event.stopPropagation()
      },

      on.mouseout = function(event){
        self.inputValue.mouseout(event)
      },

      on.dragover =  function (event) {
        
        event.stopPropagation()
        self.inputValue.dragover(event)
      }

      on.dragleave = function(event){
        self.inputValue.dragleave(event)
      }
      on.drop = function(event){
        event.stopPropagation()
        self.inputValue.drop(event)
      }
      on.dragstart = function(event){
        event.stopPropagation()
        self.inputValue.dragstart(event)
      }
      on.dragend = function(event){
        self.inputValue.dragend(event)
      }

      on.click = function(event){
        self.inputValue.click(event)
        event.stopPropagation()
      }

      return on;
    },

    focused(element){
      if(element._vid !== this.inputValue._vid){
        this.inputValue.unfocus()
      }
    },

    dragovered(element){
      if(element._vid !== this.inputValue._vid){
        if(!(this.status == "insert-before" || this.status == "insert-after")){
          this.inputValue.setStatus('normal')
        }
      }
    },

    insertBeforeOrAfter(element){
      if(element._vid !== this.inputValue._vid){
        if(this.status == "insert-before" || this.status == "insert-after"){
          //this.inputValue.setStatus('normal')
        }
      }
    },

    dragged(element){
      this.inputValue.setDraggedElement(element)
    },

    unfocusAll(){
      this.inputValue.unfocus()
    },

    setEditPadding(padding){
      this.inputValue.setEditPadding(padding)
    },

    showLabel($isShow){
      this.inputValue.setShowLabel($isShow)
    },

    preview($isPreview){
      this.inputValue.preview($isPreview)
    },

    statusChange(node){
      if(node._vid === this.inputValue._vid){
        this.classes = node.getClass()
        this.styles = node.getStyle()
        this.nodProps = node.getProps()
        this.labelClass = node.getLabelClass()
        this.isShowLabel = node.isShowLabel()
        this.hasToolbar = node.hasToolbar()
        this.children = node.getChildren()
      }
    },
  },


  created () {
    $editorBus.$on('focused', this.focused)
    $editorBus.$on('dragovered', this.dragovered)
    $editorBus.$on('dragged', this.dragged)
    $editorBus.$on('insertBeforeOrAfter', this.insertBeforeOrAfter)
    $editorBus.$on('unfocusAll', this.unfocusAll)
    $editorBus.$on('setEditPadding', this.setEditPadding)
    $editorBus.$on('showLabel', this.showLabel)
    $editorBus.$on('preview', this.preview)
    $editorBus.$on('statusChange', this.statusChange)
  },

  mounted(){
    this.statusChange(this.inputValue)
  },

  destoryed () {
    $editorBus.$off('focused', this.focused)
    $editorBus.$off('dragovered', this.dragovered)
    $editorBus.$off('dragged', this.dragged)
    $editorBus.$off('insertBeforeOrAfter', this.insertBeforeOrAfter)
    $editorBus.$off('unfocusAll', this.unfocusAll)
    $editorBus.$off('showLabel', this.showLabel)
    $editorBus.$off('preview', this.preview)
    $editorBus.$off('statusChange', this.statusChange)
  },

  render: function (createElement) {
    const self = this
    const children = [];
    if(self.isShowLabel){
      children.push(createElement('element-label',{props:{label:self.inputValue.name},'class':self.labelClass}))
    }

    if(self.hasToolbar){
      children.push(createElement('element-toolbar',{}))
    }

    if(self.children){
      self.children.forEach(function (com) {
        if(com){
          if(com.text){
            children.push(com.text)
          }
          else{
            children.push(createElement(
                'element-node-view', 
                {
                  props:{ 'value':com },
                  on: {
                  },
                  scopedSlots:com.scopedSlots,
                  slot:com.slot,

                }
              )
            )
          }
        }
      })
    }


    var vNode = createElement(
      self.inputValue.name, 
      {
        'class': self.classes,
        style:self.styles,
        props:self.nodProps,
        attrs:self.inputValue.attrs,
        domProps:self.inputValue.domProps,
        on: self.getOn(),
        nativeOn: self.getOn(),
        //directives:self.inputValue.directives,
        scopedSlots:self.inputValue.scopedSlots,
        slot:self.inputValue.slot,
        key:self.inputValue.key,
        ref:self.inputValue.ref,
        refInFor:true,
      }, 
      children
    )

    return vNode;
  },

}

