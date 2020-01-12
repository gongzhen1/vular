<template>
  <div class="editor" >
    <div class="v-messages__message" style="color:red;" v-for="(error,i) in errorMessages" :key="i">{{error}}</div>
    <editor-menu-bubble class="menububble" :editor="editor" @hide="hideLinkMenu">
      <div
        slot-scope="{ commands, isActive, getMarkAttrs, menu }"
        class="menububble"
        :class="{ 'is-active': menu.isActive }"
        :style="`left: ${menu.left}px; bottom: ${menu.bottom}px;`"
      >
        <form class="menububble__form" v-if="linkMenuIsActive" @submit.prevent="setLinkUrl(commands.link, linkUrl)">
          <input class="menububble__input" type="text" v-model="linkUrl" placeholder="https://" ref="linkInput" @keydown.esc="hideLinkMenu"/>
          <button class="menububble__button" @click="setLinkUrl(commands.link, linkUrl)" type="button">
            <v-icon color="white">check_circle_outline</v-icon>
          </button>
          <button class="menububble__button" @click="hideLinkMenu" type="button">
            <v-icon color="white">highlight_off</v-icon>
          </button>
        </form>

        <template v-else>
          <button
            @click="showLinkMenu(getMarkAttrs('link'))"
            :class="{ 'is-active': isActive.link(),'pr-2':true }"
          >
            
            <v-icon v-if="isActive.link()" color="white" class="">edit</v-icon>
            <v-icon v-else color="white" class="ml-2">link</v-icon>
          </button>
          <button v-if="isActive.link()" class="menububble__button" @click="setLinkUrl(commands.link, null)" type="button">
            
            <v-icon color="white">link_off</v-icon>
          </button>
        </template>

      </div>
    </editor-menu-bubble>

    <editor-menu-bar :editor="editor">
      <div class="menubar" slot-scope="{ commands, isActive }">
        <div class="toolbar">
            <v-menu offset-y v-model="showStyleMenu">
              <div slot="activator" :class="{'style-select':true,'common-over': showStyleMenu}">
                <span v-if="isActive.paragraph()" class="normal" >Normal</span>
                <span v-if="isActive.heading({ level: 1 })" class="h1" >Header 1</span>
                <span v-if="isActive.heading({ level: 2 })" class="h2" >Header 2</span>
                <span v-if="isActive.heading({ level: 3 })" class="h3" >Header 3</span>
                <v-icon>arrow_drop_down</v-icon>
              </div>
              <v-list>
                <v-list-tile @click="commands.heading({ level: 1 })">
                  <v-list-tile-title class="h1">Header 1 </v-list-tile-title>
                </v-list-tile>
                <v-list-tile @click="commands.heading({ level: 2 })">
                  <v-list-tile-title class="h2">Header 2 </v-list-tile-title>
                </v-list-tile>
                <v-list-tile @click="commands.heading({ level: 3 })">
                  <v-list-tile-title class="h3">Header 3 </v-list-tile-title>
                </v-list-tile>
                <v-list-tile @click="commands.paragraph">
                  <v-list-tile-title class="normal">Normal </v-list-tile-title>
                </v-list-tile>
              </v-list>
            </v-menu>
          

          <button
            class="menubar__button"
            :class="{ 'is-active': isActive.bold() }"
            @click="commands.bold"
          >
            <v-icon color="black">format_bold</v-icon>
          </button>

          <button
            class="menubar__button"
            :class="{ 'is-active': isActive.italic() }"
            @click="commands.italic"
          >
            <v-icon color="black">format_italic</v-icon>
          </button>

          <button
            class="menubar__button"
            :class="{ 'is-active': isActive.strike() }"
            @click="commands.strike"
          >
            <v-icon color="black">format_strikethrough</v-icon>
          </button>

          <button
            class="menubar__button"
            :class="{ 'is-active': isActive.underline() }"
            @click="commands.underline"
          >
            <v-icon color="black">format_underlined</v-icon>
          </button>

          <button
            class="menubar__button"
            :class="{ 'is-active': isActive.code() }"
            @click="commands.code"
          >
            <v-icon color="black">code</v-icon>
          </button>
          <button
            class="menubar__button"
            :class="{ 'is-active': isActive.bullet_list() }"
            @click="commands.bullet_list"
          >
            <v-icon color="black">format_list_bulleted</v-icon>
          </button>

          <button
            class="menubar__button"
            :class="{ 'is-active': isActive.ordered_list() }"
            @click="commands.ordered_list"
          >
            <v-icon color="black">format_list_numbered</v-icon>
          </button>

          <button
            class="menubar__button"
            :class="{ 'is-active': isActive.blockquote() }"
            @click="commands.blockquote"
          >
            <v-icon color="black">format_quote</v-icon>
          </button>

          <button
            class="menubar__button"
            :class="{ 'is-active': isActive.code_block() }"
            @click="commands.code_block"
          >
            <v-icon color="black">code</v-icon>
          </button>
          <button
            class="menubar__button"
            @click="showImageDialog = true"
          >
            <v-icon color="black">insert_photo</v-icon>
          </button>
          <v-menu offset-y v-model="tablePanel">

            <button
              :class="{'menubar__button':true,'common-over': tablePanel}"
              slot="activator"
            >
              <v-icon color="black">grid_on</v-icon>
            </button>
            <v-card>
              <v-card-text class="pa-2">
                <v-layout column>
                  <v-flex v-for="row in maxRows" :key="'row'+row">
                    <div v-for="column in maxColumns" :key="column" 
                      :class="{'table-panel-cell':true, 'selected':row<=overCell.row && column<=overCell.column}"  
                      @mouseenter="enter(row,column)" 
                      @click="commands.createTable({rowsCount: row, colsCount: column, withHeaderRow: true })"
                    >
                      <div>
                      </div>
                    </div>
                    
                  </v-flex>
                  <v-flex xs12 class="pt-2">
                    {{overCell.column}} X {{overCell.row}}
                  </v-flex>
                </v-layout>
              </v-card-text>
            </v-card>
          </v-menu>
          <button
            class="menubar__button"
            @click="commands.undo"
          >
            <v-icon color="black">undo</v-icon>
          </button>

          <button
            class="menubar__button"
            @click="commands.redo"
          >
            <v-icon color="black">redo</v-icon>
          </button>
          <div v-if="isActive.table()">
            <button
              class="menubar__button table_button"
              @click="commands.deleteTable"
            >
              <icon name="delete_table"/>
            </button>
            <button
              class="menubar__button table_button"
              @click="commands.addColumnBefore"
            >
              <icon name="add_col_before" />
            </button>
            <button
              class="menubar__button table_button"
              @click="commands.addColumnAfter"
            >
              <icon name="add_col_after" />
            </button>
            <button
              class="menubar__button table_button"
              @click="commands.deleteColumn"
            >
              <icon name="delete_col" />
            </button>
            <button
              class="menubar__button table_button"
              @click="commands.addRowBefore"
            >
              <icon name="add_row_before" />
            </button>
            <button
              class="menubar__button table_button"
              @click="commands.addRowAfter"
            >
              <icon name="add_row_after" />
            </button>
            <button
              class="menubar__button table_button"
              @click="commands.deleteRow"
            >
              <icon name="delete_row" />
            </button>
            <button
              class="menubar__button table_button"
              @click="commands.toggleCellMerge"
            >
              <icon name="combine_cells" />
            </button>
          </div>

        </div>
      </div>
    </editor-menu-bar>

    <v-divider></v-divider>

    <editor-content class="editor__content" :editor="editor" />
    <vular-medias-dialog 
      :show="showImageDialog"
      acceptMatch = 'image/*'
      :title="$t('media.images')" 
      :typeName="$t('media.images')"
      @close="showImageDialog=false"
      @select="imagesSelected"
      >
    </vular-medias-dialog>
  </div>
</template>
<script>
  import Icon from './Icon'
  import { Editor, EditorContent, EditorMenuBar, EditorMenuBubble} from 'tiptap'
  import {
    Blockquote,
    CodeBlock,
    HardBreak,
    Heading,
    OrderedList,
    BulletList,
    ListItem,
    TodoItem,
    TodoList,
    Bold,
    Code,
    Italic,
    Link,
    Image,
    Table,
    TableHeader,
    TableCell,
    TableRow,
    Strike,
    Underline,
    History,
    Placeholder,
  } from 'tiptap-extensions'
export default {
  name: 'vular-tiptap-editor',
  components: {
    EditorContent,
    EditorMenuBar,
    Icon,
    EditorMenuBubble,
  },
  props:{
    value:String,
    error:Boolean,
    errorCount:Number,
    errorMessages:Array,
    defaultRowCounts:{
      type:Number,
      default:2,
    },
    defaultColumnCounts:{
      type:Number,
      default:2,
    },
  },
  data() {
    return {
      tablePanel:false,
      maxRows:this.defaultRowCounts,
      maxColumns:this.defaultColumnCounts,
      overCell:{row:0,column:0},
      showStyleMenu:false,
      x: 0,
      y: 0,
      showImageDialog:false,
      editor: new Editor({
      extensions: [
          new Blockquote(),
          new BulletList(),
          new CodeBlock(),
          new HardBreak(),
          new Heading({ levels: [1, 2, 3] }),
          new ListItem(),
          new OrderedList(),
          new TodoItem(),
          new TodoList(),
          new Bold(),
          new Code(),
          new Italic(),
          new Link(),
          new Strike(),
          new Underline(),
          new History(),
          new Image(),
          new Table(),
          new TableHeader(),
          new TableCell(),
          new TableRow(),
          new Placeholder({
            emptyClass: 'is-empty',
            emptyNodeText: 'Write something here…',
            showOnlyWhenEditable: true,
          }),
      ],
      content: this.value,
      onUpdate: ({ getJSON, getHTML }) => {
          this.html = getHTML()
          this.$emit('input', this.html)
        },
      }),
      html: '',
      linkUrl: null,
      linkMenuIsActive: false,
    }
  },
  methods: {
    showLinkMenu(attrs) {
      this.linkUrl = attrs.href
      this.linkMenuIsActive = true
      this.$nextTick(() => {
        this.$refs.linkInput.focus()
      })
    },
    hideLinkMenu() {
      this.linkUrl = null
      this.linkMenuIsActive = false
    },
    setLinkUrl(command, url) {
      command({ href: url })
      this.hideLinkMenu()
      this.editor.focus()
    },
    imagesSelected:function (images) {
      for(var i = 0; i < images.length; i++){
        this.editor.focus();
        this.editor.commands.image({ src:images[i].src })
      }
    },
    enter:function (row,column){
      if(row >= this.maxRows -1 ){
         this.maxRows = this.maxRows >=20 ? 20: this.maxRows + 1
      }
      if(column >= this.maxColumns -1 ){
         this.maxColumns = this.maxColumns >=20 ? 20: this.maxColumns + 1
      }
      if(row < this.maxRows -1 ){
         this.maxRows = this.maxRows <=2 ? 2: this.maxRows - 1
      }
      if(column < this.maxColumns -1 ){
         this.maxColumns = this.maxColumns <=2? 2: this.maxColumns - 1
      }

      this.overCell={row:row,column:column}
    },

  },

  watch:{
    tablePanel(newValue, oldValue){
      if(!newValue){
        this.maxColumns = this.defaultColumnCounts
        this.maxRows = this.defaultRowCounts
        this.overCell={row:0,column:0}
      }

    }

  },

  beforeDestroy() {
    this.editor.destroy()
  },
}
</script>

<style lang="scss">
@import './assets/sass/main.scss'; 
.editor p.is-empty:first-child::before {
  content: attr(data-empty-text);
  float: left;
  color: #aaa;
  pointer-events: none;
  height: 0;
  font-style: italic;
}

.toolbar{
  justify-content:flex-start;
  display:flex;
  flex-wrap: wrap;
  padding:0; 
  margin:0;
}

.ProseMirror-selectednode{
  border:#90CAF9 solid 2px ;
}

.menubar__button{
  margin-top:3px;
  margin-bottom:3px;
}

.table_button{
  height:32px;
  line-height:26px;
  padding-top:0px;
  width:32px;
  display:inline-flex;
  justify-content:flex-start;
}


.table-panel-cell{
  padding:2px; 
  cursor: pointer;
  float: left; 
}

.table-panel-cell div{
  height: 15px;
  width: 15px;
  border:#ccc solid 1px; 
  cursor: pointer;
}

.table-panel-cell.selected div{
  background-color:#BBDEFB;
  border:#BBDEFB solid 1px; 
}

.style-select{
  margin-top:0px;
  border: #ccc solid 1px;
  cursor:pointer;
  height:30px;
  line-height:30px;
  width: 120px;
  margin-right:10px;
  justify-content:space-between;
  display:flex;
  margin-top:3px;
  margin-bottom:3px;
}
.style-select:hover{
  border:solid 1 px #bbb;
  background-color:#f2f2f2;
}

.common-over{
  background-color:#f2f2f2;
}


.h1{
  font-weight:bold;
  font-size:16px;
}
.h2{
  font-weight:bold;
  font-size:14px;
}
.h3{
  font-weight:bold;
  font-size:12px;
}

.normal{
  font-size:12px;
}

.editor__content{
  margin-top:6px;
}
</style>