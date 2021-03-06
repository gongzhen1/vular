import Element from "./Element"

class AppNode extends Element{
    constructor() {
        super('v-app', 'App', 'view_quilt')
        this.app()
        this.hasLabel = false
        this.noToolbar = true
    }

    make(){
        return new AppNode
    }
}

class NavigationDrawerNode extends Element{
    constructor() {
        super('v-navigation-drawer','Drawer','vertical_split')
        this.editStyle['min-height'] = "40px"
        this.withEditPadding = true
    }

    make(){
        return new NavigationDrawerNode
    }

    left(value = true){
        this.props.left =  value
        return this
    }

    right(value = true){
        this.props.right =  value
        return this
    }
}

class ToolbarNode extends Element{
    constructor() {
        super('v-toolbar', 'Toolbar', 'straighten')
    }

    make(){
        return new ToolbarNode
    }
}

class ContentNode extends Element{
    constructor() {
        super('v-content', 'Content', 'web_asset')
        this.editStyle['min-height'] = "40px"
        this.withEditPadding = true
        this.hasLabel = false
        this.noToolbar = true
    }

    make(){
        return new ContentNode
    }
}

class FooterNode extends Element{
     constructor() {
        super('v-footer', 'Footer', 'crop_7_5')
        this.withEditPadding = true
    }

    make(){
        return new FooterNode
    }
}

export{
    AppNode,
    NavigationDrawerNode,
    ToolbarNode,
    ContentNode,
    FooterNode
}
