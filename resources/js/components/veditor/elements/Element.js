import ActiveState from "../states/ActiveState"
import DraggedState from "../states/DraggedState"
import FocusState from "../states/FocusState"
import NormalState from "../states/NormalState"
import PlaceholderState from "../states/PlaceholderState"

export default class Element {
  constructor(name, handleTitle, handleIcon) {
    this.seedId()
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

    this.hasLabel = true
    //this.showLabel = true

    //this.setStatus('normal')
    this.editorState = {}
    this.setState(new NormalState(this))
  }

  seedId(){
    if(!Element.idSeed) Element.idSeed = 1
    Element.idSeed ++
    this._vid = Element.idSeed
  }


  setState( state ){
    this.state = state;
    this.sendChangeStateMessage()
  }

  sendChangeStateMessage(){
    if(window.$editorBus){
      window.$editorBus.$emit('stateChange', this)
    }
  }

  app(value = true){
    this.props.app =  value
    return this;
  }

  setEditorState(state){
    this.editorState = state
    //this.sendChangeStateMessage()
    return this;
  }

  isShowLabel(){
    return this.state.isShowLabel()
  }

  hasToolbar(){
    return this.state.hasToolbar()
  }


  accept(){
    return !this.recursionConflict(this.editorState.draggedElement) 
      && !this.hasChild(this.editorState.draggedElement)
  }

  acceptBefore(){
    let beforeElement = this.getBefore()
    if(beforeElement && 
      (beforeElement._vid === this.editorState.placeholder._vid || beforeElement._vid === this.editorState.draggedElement._vid)){
      return false
    }
    return true
  }

  acceptAfter(){
    let afterElement = this.getAfter()
    if(afterElement &&
      (afterElement._vid === this.editorState.placeholder._vid || afterElement._vid === this.editorState.draggedElement._vid)){
      return false
    }
    return true
  }

  getBefore(){
    let index = this.indexInParent();
    console.log('getBefore', index)
    if(this.parent && index > 0 ){
      return this.parent.children[index-1]
    }
  }

  getAfter(){
    let index = this.indexInParent();
    console.log('getAfter', index)
    if(this.parent && index < this.parent.children.length - 1){
      return this.parent.children[index+1]
    }
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

  addChild(node, index){
    //window.$editorBus.$emit('addChild', {parent:this, child:node, index:index})
    //console.log(node,node.state)
    node.parent = this
    if(index !== undefined){
      this.children.splice(index, 0, node)
    }
    else{
      this.children.push(node)
    }
    this.sendChangeStateMessage()
  }

  moveTo(targetParent, index){
    this.removeFromParent()
    if(targetParent) targetParent.addChild(this, index)
    //window.$editorBus.$emit('removeChild', {parent:this.parent, child:this})
    //window.$editorBus.$emit('addChild', {parent:targetParent, child:this, index:index})
  }

  removeFromParent(){
    //if(this.parent){
    //  window.$editorBus.$emit('removeChild', {parent:this.parent, child:this})
    //}
    if(this.parent){
      for (var i = 0; i < this.parent.children.length; i++) {
        if(this.parent.children[i]._vid == this._vid){
          let node = this.parent.children.splice(i, 1)
          //console.log(node.viewInEditor)
          break
        }
      }
      this.sendChangeStateMessage()
    }

  }

  insertPlaceholder(){
    if(this.accept(this.editorState.draggedElement) && !this.children.find(child => child.isPlaceholder)){
      this.editorState.placeholder.moveTo(this)
    }
  }

  hasChild(child){
    return this.children.find(myChild => myChild._vid === child._vid);
  }

  insertPlaceholderAfter(){
    let index = this.indexInParent() + 1
    this.editorState.placeholder.moveTo(this.parent, index)
  }

  insertPlaceholderBefore(){
    let index = this.indexInParent()
    //console.log(this.editorState.placeholder.state, index)
    //index = index > 0 ? index - 1 : 0
    //this.editorState.placeholder.toPlaceholderState()
    this.editorState.placeholder.moveTo(this.parent, index)
  }

  indexInParent(){
    if(!this.parent) return 0;

    for (var i = 0; i < this.parent.children.length; i++) {
      if (this.parent.children[i]._vid == this._vid) {
        return i;
      }
    }
  }

  makePlaceholder(){
    var placeHolder = Object.assign(this.make(), this)
    placeHolder.seedId()
    //placeHolder._orignalId = this._vid
    placeHolder.toPlaceholderState()
    var children = this.children

    placeHolder.children = []
    for(var i = 0; i < children.length; i++){
      placeHolder.children.push(children[i].makePlaceholder())
    }
    return placeHolder
  }

//-------------events--------------
  mouseover(event){
    this.state.mouseover(event)
  }

  mouseout(event){
    this.state.mouseout(event)
  }

  focusedElement(element){
    this.state.focusedElement(element)
  }

  unfocus(){
    this.state.unfocus()
  }

  dragstart(event){
    this.state.dragstart(event)
  }

  dragover(event){
    this.state.dragover(event)
  }

  drop(event){
    this.state.drop(event)
  }

  dragleave(event){
    //this.state.dragleave(event)
  }

  dragend(event){
    this.state.dragend(event)
  }

  click(event){
    this.state.click(event)
  }

//------------------------------------------

//---------------render sytles-------------
  getClass(){
    let veiwClass = Object.assign({}, this.class, this.editClass)
    veiwClass = this.state.rebuildClass(veiwClass)
    return veiwClass;
  }

  getLabelClass(){
    let veiwLabelClass = Object.assign({}, this.labelClass)
    veiwLabelClass = this.state.rebuildLabelClass(veiwLabelClass)
    return veiwLabelClass;
  }

  getStyle(){
    let veiwStyle = Object.assign({}, this.style, this.editStyle)
    if(this.withEditPadding){
      veiwStyle.padding = this.editorState.editPadding
    }
    if(this.state.isShowLabel()){
      veiwStyle.position = "relative"
    }
    veiwStyle = this.state.rebuildStyle(veiwStyle)
    return veiwStyle;
  }

  getProps(){
    let veiwProps = Object.assign({}, this.props, this.editProps)
    veiwProps = this.state.rebuildProps(veiwProps)
    return veiwProps;
  }

  getChildren(){
    return this.children;
  }

//----------------------------------------

//--------------state change-----------------
  toActiveState(){
    this.setState(new ActiveState(this))
    return this;
  }

  toDraggedState(){
    this.setState(new DraggedState(this))
    return this;
  }

  toFocusState(){
    this.setState(new FocusState(this))
    return this;
  }

  toNormalState(){
    this.setState(new NormalState(this))
    return this;
  }

  toPlaceholderState(){
    this.isPlaceholder = true
    this.setState(new PlaceholderState(this))
    return this;
  }
}