export default class Move {
  constructor(element, originalParent, originalIndex, targetParent, targetIndex) {
    this.element = element
    this.originalParent = originalParent
    this.originalIndex = originalIndex
    this.targetParent = targetParent
    this.targetIndex = targetIndex
  }

	do(){
    console.log(this)
    this.element.removeFromParent();
    this.targetParent.addChild(this.element, this.targetIndex)
	}

	undo(){
    this.element.removeFromParent();
    if(this.originalParent){
      this.originalParent.addChild(this.element, this.originalIndex)
    }
	}
}