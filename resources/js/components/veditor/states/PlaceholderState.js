import ElementState from "./ElementState"

export default class PlaceholderState extends ElementState{
  constructor(element) {
    super(element)
  }

  rebuildClass(veiwClass){
    veiwClass['placeholder'] = true
    return veiwClass;
  }

  dragover(event){
    event.preventDefault()
  }

  isShowLabel(){
    return false
  }

}

