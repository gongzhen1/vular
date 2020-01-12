<template>
  <v-card flat>
    <v-toolbar flat>

      <v-toolbar-title> {{title}} </v-toolbar-title>

      <v-spacer></v-spacer>
      <v-tooltip top style="z-index: 1000">
        <v-btn slot="activator" fab small depressed color="grey lighten-2"
          @click="addFolder"
        >
          <v-icon>add</v-icon>
        </v-btn>
        <span>{{$t('table.add-new')}}</span>
      </v-tooltip>
    </v-toolbar>
    <v-divider></v-divider>
    <v-progress-linear v-show="loading"
      height="2"
      class="ma-0"
      :indeterminate="true"
    ></v-progress-linear>
    <v-list dense class="pt-0">
        <v-list-tile
          @click="selectFolder(itemAll)"
          @dragover="allowDropAll($event)"
          @dragleave="dragLeave($event)"
          @drop="dropAtAll($event)"
          active-class="primary--text item-selected"
          :class="{'item-selected':selectedItem!=null && selectedItem.id == itemAll.id,
                   'item-over':overItem && overItem.id == itemAll.id}"
        >
          <v-list-tile-content>
            <v-list-tile-title class="folder-tile">
                {{itemAll[itemText]}}
            </v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      <v-hover v-for="(item,i) in items" :key="i">
        <v-list-tile
          draggable='true'
          slot-scope="{ hover }" 
          @click="selectFolder(item)"
          @dragover="allowDrop($event, item)"
          @dragleave="dragLeave($event)"
          @drop="drop($event, item)"
          @dragstart="drag($event, item)"
          @dragend="dragend($event)"
          active-class="primary--text item-selected"
          :class="{'item-selected':selectedItem && selectedItem.id==item.id,
                   'item-over':overItem && overItem.id == item.id}"
        >
          <v-list-tile-content>
            <v-list-tile-title class="folder-tile">
              <input v-if="item.editable" 
                v-model="item[itemText]" 
                class="folder-input"
                @keyup.enter="saveFolder(item)" 
                @click.stop="doNothing" />
              <template v-else>
                {{ item[itemText] }}
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
    title:String,
    allItemText:String,
    itemText:{
      type:String,
      default:'name'
    },
    getUrl:String,
    saveUrl:String,
  },

  data: function () {
    return {
      dragedItem:null,
      selectedItem:null,
      loading:false,
      overItem:null,
      itemAll: {},
      items: [
        //{ id:1, title: 'haha', icon: 'dashboard', editable: false },
        //{ id:2, title: '产品图片', icon: 'question_answer', editable: false },
        //{ id:3, title: '搞笑', icon: 'question_answer', editable: false },
        //{ id:4, title: '扯淡', icon: 'question_answer', editable: false }, id:0, title: this.allItemText, editable: false 
      ],
    }
  },

  created () {
    this.$set(this.itemAll,this.itemText, this.allItemText)
    this.$set(this.itemAll,'id', 0)
    this.$set(this.itemAll,'editable', false)

    this.selectFolder(this.itemAll);
    this.getData();

  },
  methods: {
    getData:function(){
      const self = this;
      self.loading = true;
      //console.log(host + self.getUrl)
      axios.get(host + self.getUrl).then(
        (response)=> {
          //console.log(response.data)
          self.items = response.data
          for(var i = 0;i < self.items.length; i++){
            self.items[i].editable = false; 
          }
          self.loading = false;
        },
        error=>{
          self.loading = false;
          $bus.$emit('error', error.message);
        }
      )
    },

    saveData:function(){
      const self = this;
      self.loading = true;
      //console.log(host + self.getUrl)
      axios.post(host + self.getUrl, self.items).then(
        (response)=> {
          self.loading = false;
          self.items = response.data
          for(var i = 0;i < self.items.length; i++){
            self.items[i].editable = false; 
          }
        },
        error=>{
          self.loading = false;
          $bus.$emit('error', error.message);
        }
      )
    },

    addFolder:function(){
      this.items.push({id:0,editable:true});
    },

    selectFolder:function(item){
      this.selectedItem = item
      this.$emit('selectItem', item)
    },

    drag:function(event,item){
      //event.dataTransfer.setData('media', media)
      this.dragedItem = item
    },
    drop:function(event, item){
      //console.log('listDrop', event)
      this.overItem = null; 
      event.preventDefault();
      if(this.dragedItem == null)
      {
        this.$emit('dropOnItem', item)
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

      this.saveData();
    },
    dragend:function(){
      this.dragedItem = null
      this.overItem = null; 
    },

    dragLeave:function(){
      this.overItem = null; 
    },

    allowDropAll:function(event, item){
      this.overItem = this.itemAll; 
      event.preventDefault();
    },

    dropAtAll:function(event){
      this.overItem = null; 
      this.$emit('dropOnItem', this.itemAll)
    },

    allowDrop:function(event, item){
      //console.log(event)
      this.overItem = item; 
      event.preventDefault();
    },

    editFolder:function(item){
      item.editable = true;
    },

    removeFolder:function(item){
      for(var i=0; i<this.items.length; i++)
      {
        if(this.items[i].id == item.id){
          this.items.splice(i, 1)
          if(this.selectedItem && this.selectedItem.id == item.id){
            this.selectFolder(this.itemAll);
          }
          break;
        }
      }      
      this.saveData();
    },

    saveFolder:function(item){
      item.editable = false
      this.saveData();
    },

    doNothing:function(){
    },

  }
};
</script>

<style scoped  lang="stylus">
  .item-selected{
    background-color: #039BE5;
    color:#fff;
  }
  .item-over{
    background-color: #BBDEFB;
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