<template>
  <v-card flat>
    <v-toolbar flat>
      <v-list>
        <v-list-tile>
          <v-list-tile-title class="title">
            Folders
          </v-list-tile-title>
        </v-list-tile>
      </v-list>
      <v-spacer></v-spacer>
      <v-tooltip top style="z-index: 1000">
        <v-btn slot="activator" fab small depressed color="grey lighten-2"
          @click="addFolder"
        >
          <v-icon>add</v-icon>
        </v-btn>
        <span>新建文件夹</span>
      </v-tooltip>
    </v-toolbar>
    <v-divider></v-divider>

    <v-list dense class="pt-0">

      <v-hover v-for="(item,i) in items" :key="i">
        <v-list-tile
          v-if="i >0"
          draggable='true'
          slot-scope="{ hover }" 
          @click="selectFolder(item)"
          @dragover="allowDrop($event)"
          @drop="drop($event, item)"
          @dragstart="drag($event, item)"
          @dragend="dragend($event)"
          active-class="primary--text item-selected"
         
        >
          <v-list-tile-content>
            <v-list-tile-title class="folder-tile">
              <input v-if="item.editable" 
                v-model="item.title" 
                class="folder-input"
                @keyup.enter="saveFolder(item)" 
                @click.stop="doNothing" />
              <template v-else>
                {{ item.title }}
              </template>
            </v-list-tile-title>
          </v-list-tile-content>

          <v-list-tile-action v-if="hover">
            <div v-if="selectedItem && item.id == selectedItem.id" style="width: 50px;">
              <v-icon small color="white" @click.stop="editFolder(item)">edit</v-icon>
              <v-icon small color="white" class="ml-1" @click.stop="removeFolder(item)">delete</v-icon>
            </div>
            <div v-else style="width: 50px;">
              <v-icon small color="grey darken-1" @click.stop="editFolder(item)">edit</v-icon>
              <v-icon small color="grey darken-1" class="ml-1" @click.stop="removeFolder(item)">delete</v-icon>
            </div>
          </v-list-tile-action>                
        </v-list-tile>
      </v-hover>
    </v-list>
  </v-card>
</template>

<script>
export default {
    name: 'vular-sortable-list-editor',
    props:{
    },

  data: function () {
    return {
      dragedItem:null,
      selectedItem:null,
      items: [
        { id:0, title: '全部图片', icon: 'dashboard', editable: false },
        { id:1, title: 'haha', icon: 'dashboard', editable: false },
        { id:2, title: '产品图片', icon: 'question_answer', editable: false },
        { id:3, title: '搞笑', icon: 'question_answer', editable: false },
        { id:4, title: '扯淡', icon: 'question_answer', editable: false },
      ],
    }
  },

  created () {
    //this.selectFolder(this.items[0]);
  },
  methods: {
    addFolder:function(){
      this.items.push({id:10,editable:true});
    },

    selectFolder:function(item){
      this.selectedItem = item
      //this.$emit('selectItem', item)
    },

    drag:function(event,item){
      //event.dataTransfer.setData('media', media)
      this.dragedItem = item
    },
    drop:function(event, item){
      event.preventDefault();
      if(this.dragedItem == null)
      {
        return;
      }

      for(var i=0; i<this.items.length; i++)
      {
        if(this.items[i].id == this.dragedItem.id){
          this.$set(this.items, i, item)
        } 
        else if(this.items[i].id == item.id){
          this.$set(this.items, i, this.dragedItem)
        } 
      }
    },
    dragend:function(){
      this.dragedItem = null
    },
    allowDrop:function(event){
      event.preventDefault();
    },

    editFolder:function(item){
      item.editable = true;
    },

    removeFolder:function(item){
      if(alert("文件夹不是空的")){
        return
      }
    },

    saveFolder:function(item){
      item.editable = false
    },
  }
};
</script>

<style scoped>
  .item-selected{
    background-color: #039BE5;
    color:#fff;
  }

  .folder-tile{
    height: 50px;line-height: 40px;
  }

  .folder-input{
    line-height: 20px;background-color: #fff;color:#000;border:#ddd solid 1px; padding:3px;
  }

  .image-selected{
    border:#0288D1 solid 2px !important;
  }

</style>