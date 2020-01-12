import {ContainerElementNode} from "./ElementNode"

class ContainerNode extends ContainerElementNode{
    constructor() {
        super('v-container','Container','settings_overscan')
        this.editStyle['min-height'] = "40px"
    }
    make(){
        return new ContainerNode
    }
}

class LayoutNode extends ContainerElementNode{
    constructor() {
        super('v-layout', 'Layout', 'view_compact')
        this.editStyle['min-height'] = "40px"
        this.withEditPadding = true
    }

    make(){
        return new LayoutNode
    }
}


class FlexNode extends ContainerElementNode{
    constructor() {
        super('v-flex', 'Flex', 'crop_7_5')
        this.editStyle['min-height'] = "40px"
        this.withEditPadding = true
    }

    make(){
        return new FlexNode
    }
}

class DivNode extends ContainerElementNode{
    constructor() {
        super('div', 'Div', 'crop_3_2')
        this.editStyle['min-height'] = "40px"
        this.withEditPadding = true
    }

    make(){
        return new FlexNode
    }
}

export{
    ContainerNode,
    LayoutNode,
    FlexNode,
}
