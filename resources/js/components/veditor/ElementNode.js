class ElementNode {
  constructor(name, handleTitle, handleIcon) {
    if(!ElementNode.idSeed) ElementNode.idSeed = 1
    ElementNode.idSeed ++
    this._vid = ElementNode.idSeed 
    this.name = name
    this.handle = {
      title:handleTitle,
      icon:handleIcon,
    }

    this.props = {}
    this.style = {}
    this.class = {}
    this.editProps = {}
    this.editStyle = {}
    this.editClass = {}
    this.labelClass = {}
    this.children = []

    this.editClass['element-outline'] = true
    this.hasLabel = true
    this.showLabel = true

    this.setStatus('normal')
  }

  //----------------------------------------------------
  // 控件有如下几个状态
  // + normal  正常
  // + dragover 拖放悬停
  // + mouseover 鼠标悬停
  // + focused  选中
  // + preview 预览
  // + dragged 被拖拽
  // + insert-before 
  // + insert-affter
  //----------------------------------------------------
  setStatus(status){
    this.status = status
    this.sendChangeStatusMessage()
  }

  sendChangeStatusMessage(){
    if(window.$editorBus){
      window.$editorBus.$emit('statusChange', this)
    }
  }

  mouseover(event){
    if(this.status !== 'focused' && this.status !== 'preview'){
      this.setStatus('mouseover')
    }
  }

  mouseout(event){
    if(this.status !== 'focused' && this.status !== 'preview'){
      this.setStatus('normal')
    }
  }
  dragstart(event){
    if(this.status === 'preview') return;
    
    this.dragstartHandler(event, this)
  }

  //$emit('removeAllPlaceholder')
  //parent.insertPlaceholderBefore
  //parent.insertPlaceholderAfter
  //parent.removePlaceholder

  dragover(event){
    if(this.status === 'preview' || this.status === 'placeholder'){
      return
    }

    //console.log(parseInt(event.srcElement.clientWidth - event.offsetX), parseInt(event.srcElement.clientHeight - event.offsetY))
    if(this.parent){
      if(this.atBefore(event)){
          //event.preventDefault()
          //this.parent.setStatus('dragover')
        this.setStatus('insert-before')
        this.parent.passDragover(event,this, this.atBefore(event))
        window.$editorBus.$emit('insertBeforeOrAfter', this)
        return
      }

      if(this.atAfter(event)){
        this.setStatus('insert-after')
        this.parent.passDragover(event,this, this.atBefore(event))
        window.$editorBus.$emit('insertBeforeOrAfter', this)
        return
      }
    }

    this.toDragoverState(event)
  }

  atCenter(event){
    return !(this.atBefore(event) || this.atAfter(event));
  }

  atBefore(event){
    var margin = 8;
    return event.offsetX <= margin
        ||event.offsetY <= margin
  }

  atAfter(event){
    var margin = 8;
    return event.srcElement.clientWidth - event.offsetX <= margin
        || event.srcElement.clientHeight - event.offsetY <= margin
  }

  passDragover(event, node, isBefore){
    this.toDragoverState(event)
  }

  toDragoverState(event){
    this.setStatus('dragover')
    this.dragoverHandler(event, this)
    window.$editorBus.$emit('dragovered', this)
  }

  drop(event){
    if(this.status == 'preview') return;
    
    this.setStatus('normal')
    this.dropHandler(event, this, this.atBefore(event), this.atAfter(event))
  }

  dragleave(event){
    if(this.status === 'preview'){
      return
    }
    this.setStatus('normal')
    if(this.dragleaveHandler){
      this.dragleaveHandler(event, this)
    }
  }


  dragend(event){
    if(this.status !== 'preview'){
      this.dragendHandler(event, this)
    }
  }

  setDraggedElement(element){
    this.draggedElement = element
  }

  click(event){
    if(this.status !== 'preview'){
      window.$editorBus.$emit('focused', this)
      this.setStatus('focused')
    }
  }

  unfocus(event){
    this.setStatus('normal')
  }

  getClass(){

    let veiwClass = Object.assign({}, this.class, this.editClass)

    switch (this.status) {
      case 'mouseover':
        veiwClass['mouse-over'] = true
        break;

      case 'dragover':
        veiwClass['drag-over'] = true
        break;

      case 'focused':
        veiwClass['focus-it'] = true
        break;

      case 'insert-before':
        veiwClass['insert-before'] = true
        break;

      case 'insert-after':
        veiwClass['insert-after'] = true
        break;

      case 'preview':
        return this.class;
    }

    if(this.isPlaceholder){
      veiwClass['placeholder'] = true
    }

    return veiwClass;
  }

  getLabelClass(){
    let veiwLabelClass = Object.assign({}, this.labelClass)

    switch (this.status) {
      case 'mouseover':
        veiwLabelClass['mouse-over-label'] = true
        break;

      case 'dragover':
        veiwLabelClass['drag-over-label'] = true
        break;

      case 'focused':
        veiwLabelClass['focus-it-label'] = true
        break;
    }

    return veiwLabelClass;
  }

  getStyle(){
    if(this.status === 'preview'){
        return this.style;
    }
    let veiwStyle = Object.assign({}, this.style, this.editStyle)
   return veiwStyle;
  }

  getProps(){
    if(this.status === 'preview'){
        return this.props;
    }
    let veiwProps = Object.assign({}, this.props, this.editProps)
    return veiwProps;
  }

  getChildren(){
    return this.children;
  }

  preview(isPreview){
    if(isPreview){
      this.setStatus('preview')
    }
    else{
      this.setStatus('normal')
    }
    this.sendChangeStatusMessage()
  }

  setShowLabel(isShow){
    this.showLabel = isShow
    this.sendChangeStatusMessage()
  }

  isShowLabel(){
    return this.showLabel && this.hasLabel && this.status != 'preview'
  }

  hasToolbar(){
    return !this.noToolbar && this.status === 'focused' && this.status !== 'preview'
  }

  app(value = true){
    this.props.app =  value
    return this;
  }

  accept(node){
    return !this.recursionConflict(node)
  }

  recursionConflict(node){
    if(this._vid == node._vid){
      return true
    }
    else if(this.parent){
      return this.parent.recursionConflict(node)
    }

    return false
  } 

  setEditPadding(padding){
    if(this.withEditPadding) this.editStyle.padding = padding
    this.sendChangeStatusMessage()
    return this;
  }

  addChild(node){
    node.parent = this
    this.children.push(node)
    this.sendChangeStatusMessage()
  }

  inertBefore(child, refence){
    for(var i = 0; i < this.children.length; i++){
      if(this.children[i]._vid == refence._vid){
        this.children.splice(i, 0, child)
        this.sendChangeStatusMessage()
        return;
      }
    }
  }

  inertAfter(child, refence){
    for(var i = 0; i < this.children.length; i++){
      if(this.children[i]._vid == refence._vid){
        this.children.splice(i + 1, 0, child)
        this.sendChangeStatusMessage()
        return;
      }
    }
  }

  setDragover(eventHandler){
    this.dragoverHandler = eventHandler
  }

  setDragleave(eventHandler){
    this.dragleaveHandler = eventHandler
  }

  setDrop(eventHandler){
    this.dropHandler = eventHandler
  }

  setDragstart(eventHandler){
    this.dragstartHandler = eventHandler
  }

  setDragend(eventHandler){
    this.dragendHandler = eventHandler
  }

  moveTo(targetParent){
    this.removeFromParent()
    targetParent.addChild(this)
  }

  removeFromParent(){
    if(this.parent){
      for (var i = 0; i < this.parent.children.length; i++) {
        if(this.parent.children[i]._vid == this._vid){
          let node = this.parent.children.splice(i, 1)
          //console.log(node.viewInEditor)
          break
        }
      }
      this.sendChangeStatusMessage()
    }

  }
  
}

class ContainerElementNode extends ElementNode{
  constructor(name, handleTitle, handleIcon) {
    super(name, handleTitle, handleIcon)
    this.editClass['container-element'] = true
  }
}

export{
  ElementNode,
  ContainerElementNode
}


