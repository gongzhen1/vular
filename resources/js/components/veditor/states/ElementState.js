import Move from "../commands/Move"

export default class ElementState {
  constructor(element) {
    this.element = element
  }

  rebuildClass(veiwClass){
    return veiwClass;
  }

  rebuildLabelClass(veiwLabelClass){
    return veiwLabelClass;
  }

  rebuildStyle(veiwStyle){
    return veiwStyle;
  }

  rebuildProps(veiwProps){
    return veiwProps;
  }


  mouseover(event){
  }

  mouseout(event){
  }

  focusedElement(element){
  }

  unfocus(){

  }

  dragstart(event){
  }

  dragover(event){
  }

  drop(event){
    let element = this.element.editorState.draggedElement
    let placeholder = this.element.editorState.placeholder
    let targetParent = placeholder.parent
    let targetIndex = placeholder.indexInParent()
    placeholder.removeFromParent()
    let cmd = new Move( element, element.parent, element.indexInParent(), 
                        targetParent, targetIndex)
    cmd.do()
    placeholder.toNormalState()//解决画面不刷新的bug,多调用一次此方法
    element.toNormalState()
    this.element.editorState.undoCommands.push(cmd)
    this.element.editorState.draggedElement = null
    this.element.editorState.placeholder = null
    window.$editorBus.$emit('editorStateChange', this.element.editorState)
  }

  dragleave(event){
    //this.setStatus('normal')
    //if(this.dragleaveHandler){
    //  this.dragleaveHandler(event, this)
    //}
  }


  dragend(event){
    //if(this.status !== 'preview'){
    //  this.dragendHandler(event, this)
    //}
  }

  click(event){
  }

  isShowLabel(){
    return this.element.editorState.showLabel && this.element.hasLabel
  }

  hasToolbar(){
    return false
  }


}