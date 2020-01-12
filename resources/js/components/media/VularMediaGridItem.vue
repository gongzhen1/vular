<template>
  <v-flex
    v-if="grid"
      md3
      xs4
      lg2
      d-flex
      pa-2
          @dragover="allowDrop($event)"
          @dragleave="dragleave($event)"
          @drop="drop($event)"
          @dragstart="drag($event)"
          @dragend="dragend($event)"
    >
    <v-hover>
      <v-card flat tile 
        class="d-flex pa-0"
        slot-scope="{ hover }" 
      >
        <v-img
          :src="'uploads/thumbnails/' + inputValue.thumbnail"
          aspect-ratio="1"
          class="grey lighten-2"
          draggable='true'
        >
          <v-layout
            slot="placeholder"
            fill-height
            align-center
            justify-center
            ma-0
          >
            <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
          </v-layout>
          <div v-if="hover"
            class="white--text"
            style="height: 100%;"
            @click="click"
          >
            <v-layout
              fill-height
              align-center
              justify-center
              ma-0
              style="cursor: pointer; position: relative;"
            >
              <div class="grid-image-name-bar" style="filter:alpha(Opacity=60);">
                <template v-if="inputValue.editable">
                  <input
                    v-model="inputValue.name"
                    box
                    autofocus="autofocus"
                    style="background-color:#fff;color:#000;caret-color: #000;"
                    @click.stop="doNothing"
                    @keyup.enter="saveName"
                  ></input>
                </template>
                <template v-else>{{inputValue.name}}</template>
              </div>
              <div class="grid-image-toolbar">
                <v-icon 
                  color="white" 
                  class="image-icon"
                  @click.stop="viewIt">search</v-icon>
                <v-icon color="white" class="image-icon "  @click.stop="editName">edit</v-icon>
                <v-icon color="white" class="image-icon "  @click.stop="remove">delete_outline</v-icon>
                <a :href="'/uploads/originals/'+ inputValue.file_name" target="_blank" style="text-decoration: none;">
                  <v-icon color="white" class="image-icon ">save_alt</v-icon>
                </a>
                <v-icon v-if="inputValue.media_type=='video'" color="white" class="image-icon " 
                  @click.stop="$emit('thumbnail')"
                >photo</v-icon>
              </div>
            </v-layout>  
          </div>

          <div 
            class="white--text"
            style="height: 100%;cursor:pointer;"
            @click="click"
          >
            <div v-if="inputValue.selected" style="position: absolute;right:-2px;top:0px;">
              <v-btn dark icon  color="white" 
                style="width: 26px;height: 26px;">
                <v-icon style="font-size:18px;" color="light-blue darken-4">check</v-icon>
              </v-btn>
            </div>
          </div>
        </v-img>
      </v-card>
    </v-hover>
  </v-flex>
  <v-flex 
    v-else
    xs12
          @dragover="allowDrop($event)"
          @dragleave="dragleave($event)"
          @drop="drop($event)"
          @dragstart="drag($event)"
          @dragend="dragend($event)"
    >

    <v-list-tile
      avatar
      @click="click"
    >
      <v-list-tile-avatar :tile='true' size="60" 
       >
        <img :src="'uploads/thumbnails/' + inputValue.thumbnail" aspect-ratio="1"  class="mr-3 pa-1 " style="width: 100%"  />
        <div v-if="inputValue.selected" style="position: absolute;right:8px;top:3px;">
          <v-btn slot="activator" dark icon  color="white" 
            style="width: 14px;height: 14px;">
            <v-icon style="font-size:8px;" color="light-blue darken-4">check</v-icon>
          </v-btn>
        </div>
      </v-list-tile-avatar>

      <v-list-tile-content :class="{'image-list-selected':inputValue.selected}" >
        <div  v-if="inputValue.editable" style="width: 100%">
          <v-text-field 
            v-model="inputValue.name"
            autofocus
            @keyup.enter="saveName" 
            @click.stop="doNothing" />
        </div>
        <template v-else>
          {{ inputValue.name }}
        </template>                        
      </v-list-tile-content>
      <v-list-tile-action>
        <div style="width: 150px;" >
          <v-icon 
              light 
              class="image-icon"
              @click.stop="viewIt">search</v-icon>
          <v-icon light class="image-icon ml-2"  @click.stop="editName">edit</v-icon>
          <v-icon light class="image-icon ml-2"  @click.stop="remove">delete_outline</v-icon>
          <a :href="inputValue.src" target="_blank" style="text-decoration: none;">
            <v-icon light class="image-icon ml-2">save_alt</v-icon>
          </a>
          <v-icon v-if="inputValue.media_type=='video'" light class="image-icon ml-2" 
              @click.stop="$emit('thumbnail')"
            >photo</v-icon>
        </div>
      </v-list-tile-action>
    </v-list-tile>
  </v-flex>
</template>

<script>
export default {
  name: 'vular-media-grid-item',
  props:{
    value:Object,
    grid:{
      type:Boolean,
      default:true
    },
  },

  data: function () {
    return {
      //fab: false,
    }
  },
  computed:{
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
    click:function(){
      this.inputValue.selected = !this.inputValue.selected
      this.$emit('clickMedia')
    },
    remove:function(){
      this.$emit('remove')
    },

    viewIt:function(){
      this.$emit('view')
    },

    editName:function(){
      if(this.inputValue.editable){
        this.saveName()
      }
      else{
        this.inputValue.editable = true;
      }
    },

    saveName:function(){
      this.inputValue.editable = false;
      this.$emit('update')
    },

    drag:function(event){
      //console.log('drag', event)
      //event.dataTransfer.setData('media', this.inputValue)
      this.$emit('dragMedia')
    },
    dragleave:function(event){
      //console.log('dragleave', event)
      //event.dataTransfer.setData('media', media)
    },
    drop:function(event){
      //console.log('drop', event)
      event.preventDefault();
    },
    dragend:function(){
      //console.log('dragend', event)
      this.$emit('endDragMedia')
    },
    allowDrop:function(event){
      //console.log('allowDrop', event)
      //console.log(event)
      event.preventDefault();
    },

    doNothing:function(){

    },
  }
};
</script>
<style scoped   lang="stylus">
 
  .grid-image-name-bar
    position:absolute; 
    top:0
    height: 50px
    background:linear-gradient(rgba(0,0,0,3),rgba(0,0,0,0))
    width:100%
    padding:3px
    font-size: 12px
    line-height: 26px
    
    -moz-opacity:0.6
    opacity: 0.6
    display:block
    overflow:hidden
    word-break:keep-all
    white-space:nowrap
    text-overflow:ellipsis
  

  .grid-image-toolbar
    position:absolute
    bottom:0
    height: 32px
    background-color:rgba(0,0,0,0.6)
    width:100%
    padding-top: 7px
    padding-left: 5px
  
  .image-list-selected
    color: #42A5F5

  .image-icon
    font-size: 18px;
  
</style>
