<template>
  <v-card-text  class="pa-0 ma-0"
   @click="viewMeida=null"
   >
   <input hidden ref="uploadThumbnail" type="file" accept="image/*" @change='uploadThumbnail'/>
    <vular-file-uploader
      :acceptMatch = "acceptMatch"
      :topTip="$t('media.tool-tip')"
      @task="receiveUploadTask"
    >
      <v-card-text class="pa-0 ma-0" >
        
          <v-layout row wrap>
            <v-flex class="md9 lg10">
              <v-toolbar dense flat color="transparent">
                <v-menu offset-y>
                  <v-btn
                    slot="activator"
                    flat
                    light
                    style="margin-left: -20px;"
                  >
                    {{$t('media.batchOperate')}}
                    <v-icon right>arrow_drop_down</v-icon>
                  </v-btn>
                  <v-list>
                    <v-list-tile
                      @click="batchRemove"
                    >
                      <v-list-tile-action>
                        <v-icon >delete_sweep</v-icon>
                      </v-list-tile-action>
                      <v-list-tile-title>{{$t('media.delete')}}</v-list-tile-title>
                    </v-list-tile>
                  </v-list>
                </v-menu>
                <div style="width: 300px;" class="pt-2">
                  <v-text-field 
                    append-icon='search'
                    :placeholder="$t('media.search')+'...'"
                    v-model.trim="keywords"
                    @keyup.enter="search"
                  ></v-text-field>
                </div>
                <v-spacer></v-spacer>
                <v-menu offset-y>
                  <v-btn
                    slot="activator"
                    flat
                    light
                    style="margin-left: -20px;"
                  >
                     <v-icon left>sort</v-icon>
                    {{$t('media.sort')}}
                    <v-icon right>arrow_drop_down</v-icon>
                  </v-btn>
                  <v-list>
                    <v-list-tile
                      @click="sortBy('a-z')"
                    >
                      <v-icon  v-if="model.sortBy == 'a-z'">arrow_right</v-icon>
                      <v-list-tile-title>A-Z</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile
                      @click="sortBy('z-a')"
                    >
                      <v-icon  v-if="model.sortBy == 'z-a'">arrow_right</v-icon>
                      <v-list-tile-title>Z-A</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile
                      @click="sortBy('newest')"
                    >
                      <v-icon  v-if="model.sortBy == 'newest'">arrow_right</v-icon>
                      <v-list-tile-title>{{$t('media.newest')}}</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile
                      @click="sortBy('oldest')"
                    >
                      <v-icon  v-if="model.sortBy == 'oldest'">arrow_right</v-icon>
                      <v-list-tile-title>{{$t('media.oldest')}}</v-list-tile-title>
                    </v-list-tile>
                  </v-list>
                </v-menu>
                <v-btn-toggle v-model="viewToggle">
                  <v-btn flat>
                    <v-icon>view_comfy</v-icon>
                  </v-btn>
                  <v-btn flat>
                    <v-icon>list</v-icon>
                  </v-btn>
                </v-btn-toggle>
              </v-toolbar>
              <v-divider></v-divider>
              <v-progress-linear v-show="operating"
                height="2"
                class="ma-0"
                :indeterminate="true"
              ></v-progress-linear>
              <v-container style="overflow: auto; height: calc(100vh - 220px);" 
                @scroll="onScroll($event)">

                <div v-if="selectedFolder">
                  {{selectedFolder.title}}
                </div>
                <v-layout v-if="medias.length == 0 && tasks.length == 0 && !loading" 
                  fill-height
                  align-center
                  justify-center
                  column
                  class="mt-2 drag-area-border"
                  style="min-height: 200px;"
                >
                  <v-icon style="font-size: 120px;color:#BBDEFB">photo_camera</v-icon>
                  <div>{{$t('media.drag-to-here').replace('{0}', typeName)}}</div>
                </v-layout>
                <v-layout row wrap>
                  <vular-media-grid-item
                    v-for="(task,i) in tasks"
                    :key="'t-'+i"
                    v-if="tasks[i].success"
                    v-model = "tasks[i]"
                    :grid = 'viewToggle==0'
                    @view="viewMeida= tasks[i]"
                    @remove="remove(tasks[i])"
                    @update="update(tasks[i])"
                    @dragMedia="drag(tasks[i])"
                    @endDragMedia="endDrag(tasks[i])"
                    @thumbnail = "changeThumbnail(tasks[i])"
                    @clickMedia = "clickMedia(tasks[i])"
                    >
                    
                  </vular-media-grid-item>
                  <v-flex 
                    v-else-if="!tasks[i].success && viewToggle!=0"
                  xs12>

                    <v-list-tile
                      avatar
                    >
                      <v-list-tile-avatar :tile='true' size="60" 
                       >
                        <img v-if="task.type=='image'" :src="task.thumbnail" aspect-ratio="1" class="mr-3 pa-1" />
                        <v-icon v-else size="50" style="margin-left: -20px;">videocam</v-icon>
                      </v-list-tile-avatar>

                      <v-list-tile-content >

                          {{ task.file.name }}
                          <span v-if="task.error" :title="task.error" style="color: red;font-size: 12px;">{{task.error}}</span>
                          <v-progress-linear
                            v-else
                              color="info"
                              height="10"
                              :value="task.progressValue"
                          ></v-progress-linear>                 

                      </v-list-tile-content>
                      <v-list-tile-action>
                        
                        <v-btn v-if="task.error" dark icon  flat 
                          @click="removeTask(i)">
                          <v-icon style="font-size:18px;" color="red">close</v-icon>
                        </v-btn>
                      </v-list-tile-action>
                    </v-list-tile>

                  </v-flex>
                  <v-flex
                    v-else
                    md3 xs4 lg2 d-flex pa-2
                    style="position: relative;">
                      <v-layout
                        fill-height
                        align-end
                        justify-center
                        ma-0
                        colomn
                        wrap
                        style="border: #ccc solid 1px; "
                        pa-1
                      >
                        <v-flex xs12 mt-2 style="text-align: center;">
                          <img style="max-height: 100px;max-width: 100px;"
                            :title="task.file.name" 
                            :src="task.thumbnail"/>
                        </v-flex>
                        <v-flex xs12 style="font-size: 12px;" class="cut-text">
                          <span :title="task.file.name">{{task.file.name}}</span>
                        </v-flex>
                        <v-flex xs12  class="cut-text">
                          <span v-if="task.error" :title="task.error" style="color: red;font-size: 12px;">{{task.error}}</span>
                          <v-progress-linear
                            v-else
                              color="info"
                              height="10"
                              :value="task.progressValue"
                          ></v-progress-linear>
                        </v-flex >

                      </v-layout>
                      <div  v-if="task.error" style="position: absolute;right:-5px;top:-3px;">
                        <v-btn dark icon  flat 
                          @click="removeTask(i)">
                          <v-icon style="font-size:18px;" color="red">close</v-icon>
                        </v-btn>
                      </div>

                  </v-flex>


                  <vular-media-grid-item
                      v-for = "(media,i) in medias"
                      :key = "i"
                      v-model="medias[i]"
                      :grid = 'viewToggle==0'
                      @view="viewMeida = media"
                      @remove="remove(media)"
                      @update="update(media)"
                      @dragMedia="drag(media)"
                      @endDragMedia="endDrag(media)"
                      @thumbnail = "changeThumbnail(media)"
                      @clickMedia = "clickMedia(media)"
                    >
                  </vular-media-grid-item>
                </v-layout>
                <div v-if="loading" style="height: 200px;">
                  <v-layout
                    fill-height
                    align-center
                    justify-center
                    ma-0
                  >
                    <v-progress-circular indeterminate color="blue lighten-1"></v-progress-circular>
                  </v-layout>
                </div>
                <vular-media-view :media="viewMeida" @close="viewMeida=null"></vular-media-view>

              </v-container>
            </v-flex>
            <v-flex class="md3 lg2" style="border-left:#e0e0e0 solid 1px;">
              <vular-sortable-list-editor
                :title="mediaType=='image'?$t('media.image-categories') : $t('media.video-categories')"
                :allItemText="mediaType=='image'?$t('media.all-images') : $t('media.all-videos')" 
                itemText = 'name'
                :getUrl="getCategoriesApi"
                :saveUrl="saveCategoriesApi"
                @selectItem="selectFolder"
                @dropOnItem="dropOnCategory"
              ></vular-sortable-list-editor>
            </v-flex>
          </v-layout>
        
      </v-card-text>
    </vular-file-uploader>
  </v-card-text>
</template>

<script>
import VularSortableListEditor from '../util/VularSortableListEditor'
import VularFileUploader from '../util/VularFileUploader'
import VularMediaView from '../media/VularMediaView'
import VularMediaGridItem from './VularMediaGridItem'

export default {
  name: 'vular-medias',
  props:{
    acceptMatch:{
      type:String,
      default:'image/*',
    },
    mediaType:{
      type:String,
      default:'image',
    },
    typeName:{
      type:String,
      default:'files',
    },

    uploadApi:{
      type:String,
      default:window.uploadMediaApi,
    },
    getApi:{
      type:String,
      default:window.mediasApi,
    },
    removeApi:{
      type:String,
      default:window.removeMediaApi,
    },
    updateApi:{
      type:String,
      default:window.updateMediaApi,
    },
    getCategoriesApi:{
      type:String,
      default:window.getMediaCateogriesApi,
    },
    saveCategoriesApi:{
      type:String,
      default:window.saveMediaCateogriesApi,
    },
    uploadThumbnailApi:{
      type:String,
      default:window.uploadMediaThumbnailApi,
    },

    multiple:{
      type:Boolean,
      default:true,
    }
  },

  components: {
    VularSortableListEditor,
    VularFileUploader,
    VularMediaView,
    VularMediaGridItem
  },

  data: function () {
    return {
      model:{
        keywords:"",
        sortBy:'',
        categoryId:0,
        mediaType:this.mediaType,
      },
      keywords:"",
      viewToggle:0,
      medias:[],
      viewMeida:null,
      selectedFolder:null,
      page:0,
      hasMore:true,
      loading:false,
      operating:false,
      selectedCount:0,
      mediaBuffer:null,
      tasks:[],
      dragedMedia:null
    }
  },

  created () {
    //window.addEventListener('scroll', this.onScroll);
    //this.loadNextPage();
  },
  methods: {
    reload:function(){
      this.tasks = []
      this.medias = []
      this.page = 0;
      this.hasMore = true;
      this.loadNextPage()

    },

    search:function(){
      this.model.keywords = this.keywords
      this.reload()
    },

    sortBy:function(sortBy){
      this.model.sortBy = this.model.sortBy == sortBy ? '' :sortBy
      this.reload()
    },

    update:function(media){
      const self = this;
      var url = host + self.updateApi;
      //console.log(url)
      self.operating = true;
      axios.post(url, media).then(
        (response)=> {
          self.operating = false;
        },
        error=>{
          self.operating = false;
          $bus.$emit('error', error.message);
        }
      )
    },

    remove:function(media){
      if(confirm(this.$t("media.confirm-remove"))){
        this.removeByIds([media.id]);
      }
    },

    batchRemove:function(){
      if(confirm(this.$t("media.confirm-remove"))){
        var ids = [];
        for(var i = 0; i < this.medias.length; i++){
          if(this.medias[i].selected){
            ids.push(this.medias[i].id)
          }
        }

        for(var i = 0; i < this.tasks.length; i++){
          if(this.tasks[i].selected){
            ids.push(this.tasks[i].id)
          }
        }
        this.removeByIds(ids)
      }
    },

    removeByIds:function(ids){
      const self = this;
      var url = host + self.removeApi;
      //console.log(url)
      self.operating = true;

      axios.post(url, ids).then(
        (response)=> {
          self.hideMedias(ids)
          self.operating = false;
        },
        error=>{
          self.operating = false;
          $bus.$emit('error', error.message);
        }
      )
    },

    hideMedias:function(ids){
      const self = this;
      self.tasks = self.tasks.filter(function(task){
        return !ids.find(function(id){ return id == task.id})
      })

      self.medias = self.medias.filter(function(media){
        return !ids.find(function(id){ return id == media.id})
      })
    },


    clickMedia:function(media){
      //console.log(media)
      //media.selected = !media.selected
      if(!this.multiple){
        for(var i = 0; i < this.medias.length; i++){
          if(this.medias[i].id != media.id){
            this.medias[i].selected = false;
          }
        }
        for(var i = 0; i < this.tasks.length; i++){
          if(this.tasks[i].id != media.id){
            this.tasks[i].selected = false;
          }
        }
      }
      this.$emit('selectedChange', this.getSelected())
    },

    removeTask:function(i){
      this.tasks.splice(i,1)
    },

    receiveUploadTask:function(task){
      this.tasks.unshift(task);

      var form = new FormData()
      form.append('file', task.file)
      form.append('media_type',this.mediaType);
      //form.append('folder',this.info.folder);
      form.append('category_id',this.selectedFolder?this.selectedFolder.id:0);
      form.append('mime_type',task.file.type);
      var config = {
       onUploadProgress: progressEvent => {
        var complete = progressEvent.loaded / progressEvent.total * 100 | 0
        task.progressValue = complete
       }
      }
      axios.post(host + this.uploadApi,
        form, config).then((res) => {
          task.id = res.data.id;
          task.name = res.data.name;
          task.thumbnail = res.data.thumbnail;
          task.file_name = res.data.file_name;
          task.media_type = res.data.media_type;
          task.success = true;
          //console.log(res.data)
        },
        (error)=>{
          task.error = error.message
        }
      )

    },

    selectFolder:function(item){
      if(this.selectedFolder && this.selectedFolder.id == item.id){
        return
      }
      this.selectedFolder = item
      this.reload()
    },

    dropOnCategory:function(item){
      //console.log(item)
      if(this.dragedMedia){
        this.dragedMedia.category_id = item.id;
        this.update(this.dragedMedia)

        if(this.selectedFolder && this.selectedFolder.id != 0 
          && this.selectedFolder.id != item.id){
          this.hideMedias([this.dragedMedia.id])
        }
      }
    },

    drag:function(media){
      this.dragedMedia = media
    },

    endDrag:function(media){
      this.dragedMedia = null
    },

    getSelected:function(){
      var medias = []
      for(var i =0; i < this.medias.length; i++){
        if(this.medias[i].selected){
          medias.push(this.medias[i])
        }
      }
      for(var i =0; i < this.tasks.length; i++){
        if(this.tasks[i].selected){
          medias.push(this.tasks[i])
        }
      }
      return medias
    },

    changeThumbnail:function(media){
      this.mediaBuffer = media;
      this.$refs.uploadThumbnail.click();
    },

    uploadThumbnail:function(){
      if(!this.mediaBuffer){
        return
      }
      var media = this.mediaBuffer
      this.mediaBuffer = null
      this.operating = true

      var form = new FormData()
      form.append('file', this.$refs.uploadThumbnail.files[0])
      //form.append('media_type',this.mediaType);
      //form.append('folder',this.info.folder);
      form.append('media_id',media.id);

      axios.post(host + this.uploadThumbnailApi,
        form).then((res) => {
          media.thumbnail = res.data.thumbnail;
          this.operating = false
        },
        (error)=>{
          this.operating = false
          $bus.$emit('error', error.message) 
        }
      )
    },


    loadNextPage:function(){
      const self = this
      if(self.hasMore){
        self.page++
        self.loading = true
        var url = host + this.getApi + "?page=" + this.page;
        //console.log(url)
        if(self.selectedFolder){
          self.model.categoryId = this.selectedFolder.id
        }
        axios.post(url, self.model).then(
          (response)=> {

            //console.log(response.data)
            var medias = response.data.data;
            if(medias && medias.length){
              for (var i = 0; i < medias.length; i++) {
                medias[i].selected = false;
                medias[i].editable = false;
              }
            }

            //task中显示了，此处滤掉
            medias = medias.filter(function(media){
              for(var j = 0; j < self.tasks.length; j++){
                if(self.tasks[i].id == media.id){
                  return false
                }
              }
              return true;
            })

            self.medias.push.apply(self.medias, medias);
            self.hasMore = !!response.data.next_page_url
            self.loading = false
          },
          error=>{
            self.loading = false
            self.hasMore = false
            $bus.$emit('error', error.message);
           }
        )
      }
    },

    onScroll:function(event){
      if(!this.hasMore){
        this.loading = false
        //console.log(this.loading)
        return
      }

      var offsetHeight = event.currentTarget.offsetHeight,
      scrollHeight = event.target.scrollHeight,
      scrollTop = event.target.scrollTop

      //console.log(scrollHeight, offsetHeight + '+' + scrollTop)

      if((scrollHeight <= offsetHeight + scrollTop + 1) && this.loading==false){
        this.loading = true
        this.loadNextPage()
      }

    },

    doNothing:function(){

    },
  },
}
</script>

<style scoped   lang="stylus">
  .cut-text{
    overflow: hidden;text-overflow:ellipsis; white-space: nowrap;
  }
  
  .image-icon
    font-size: 18px
  

  .drag-over .drag-area-border
    border:#F06292 dashed 2px !important
  

  .drag-area-border
    border:#BBDEFB dashed 2px; 
  


</style>
