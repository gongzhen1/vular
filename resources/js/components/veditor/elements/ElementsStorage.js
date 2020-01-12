import {NavigationDrawerNode, ToolbarNode, ContentNode, FooterNode} from './AppNodes'
import {ContainerNode, LayoutNode, FlexNode} from './LayoutNodes'

var elementsStorage = {
  elements:[
    new NavigationDrawerNode,
    new ToolbarNode,
    new ContentNode,
    new FooterNode,
    new ContainerNode, 
    new LayoutNode, 
    new FlexNode,
  ],

  getElementByName(name){
    for (var i =0; i < this.elements.length; i++) {
      if(this.elements[i].name == name){
        return this.elements[i]
      }
    }
  }
};

export default elementsStorage;
