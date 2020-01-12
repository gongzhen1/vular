<template>
  <v-card
    @click="viewMeida = null"
  >
    <v-toolbar flat card>
      <v-toolbar-title>{{$t('media.imagesAndVideos')}}</v-toolbar-title>
      <v-spacer></v-spacer>
      

      <v-menu offset-y>
        <v-btn icon  slot="activator">
          <v-icon color="blue">more_horiz</v-icon>
        </v-btn>
        <v-list>
            <v-list-tile @click="editAlts">
              <v-list-tile-action>
                <v-icon >art_track</v-icon>
              </v-list-tile-action>
              <v-list-tile-title>{{$t('media.edit-alts')}}</v-list-tile-title>
            </v-list-tile>
           <v-list-tile
            @click="removeAll"
          >
            <v-list-tile-action>
              <v-icon >delete_sweep</v-icon>
            </v-list-tile-action>
            <v-list-tile-title>{{$t('media.delete-all')}}</v-list-tile-title>
          </v-list-tile>
        </v-list>
      </v-menu>

    </v-toolbar>
    <v-divider ></v-divider>
    <v-card-text>
      <v-container fluid grid-list-sm>
        <v-layout row wrap>
          <v-flex
              v-for="(media,i) in medias"
              :key="i"
              
              pa-2
              :class="imageFlexClass"
            >
            <v-hover>
              <v-card flat tile class="d-flex pa-0"
                slot-scope="{ hover }" 
                @dragover="allowDrop($event)"
                @drop="drop($event, media)"
              >
                <v-img
                  :src="mediaThumbnailsPath + media.thumbnail"
                  aspect-ratio="1"
                  class="grey lighten-2"
                  draggable='true'
                  @dragstart="drag($event, media)"
                  @dragend="dragend($event)"
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
                    class="blue darken-1 white--text"
                    style="height: 100%; filter:alpha(Opacity=60);-moz-opacity:0.6;opacity: 0.6; position:relative">
                    <div style="position: absolute;right:-4px;top:-2px;">
                      <v-tooltip top>
                        <v-btn slot="activator" flat icon  color="white" 
                          style="width: 28px;height: 28px;" @click.stop="remove(media)">
                          <v-icon style="font-size:18px;">clear</v-icon>
                          </v-btn>
                        <span>{{$t('media.delete')}}</span>
                      </v-tooltip>
                    </div>

                    <div style="position: absolute;left:-5px;bottom:-3px;">
                      <v-tooltip left>
                        <v-btn slot="activator" flat icon  color="white" 
                          style="width: 28px;height: 28px;" @click.stop="viewMeida=media">
                          <v-icon style="font-size:18px;">search</v-icon>
                          </v-btn>
                        <span>{{$t('media.view')}}</span>
                      </v-tooltip>

                    </div>

                    <v-layout
                      fill-height
                      align-center
                      justify-center
                      ma-0
                      style="cursor: move;"
                    >
                      <v-icon dark style="font-size: 30px; transform: rotate(45deg);">zoom_out_map</v-icon>
                    </v-layout>  
                  </div>
                  
                </v-img>
              </v-card>
            </v-hover>
          </v-flex>

          <v-flex
              
              pa-2
              d-flex
              :class="imageFlexClass"
            >
            <v-hover>
              <v-card flat tile dark fill-height class="light-blue  d-flex pa-2"
                slot-scope="{ hover }" 
                :class="`${hover ? 'darken-1' : 'lighten-1'}`" style="min-height: 120px;"
              >
                <div style="border: dashed 1px;">
                  <v-layout
                    fill-height
                    align-center
                    justify-center
                    ma-0
                  >
                    <v-menu offset-y>
                      <div slot="activator" style="cursor: pointer;" class="pa-3" >
                          <v-icon dark style="font-size: 40px;">add</v-icon>
                      </div>
                      <v-list>
                          <v-list-tile @click="imagesDialog = true">
                            <v-list-tile-action>
                              <v-icon >add_photo_alternate</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-title> {{$t('media.add-images')}}</v-list-tile-title>
                          </v-list-tile>
                         <v-list-tile
                          @click="videosDialog = true"
                        >
                          <v-list-tile-action>
                            <v-icon >video_call</v-icon>
                          </v-list-tile-action>
                          <v-list-tile-title>{{$t('media.add-videos')}}</v-list-tile-title>
                        </v-list-tile>
                      </v-list>
                    </v-menu>
                  </v-layout>  
                </div>
              </v-card>
            </v-hover>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card-text>   
    <vular-image-alt-editor :show="altDialog" @close="altDialog=false" v-model="medias"></vular-image-alt-editor>
    <vular-medias-dialog 
      :show="imagesDialog"
      acceptMatch = 'image/*'
      :title="$t('media.images')" 
      mediaType="image"
      @select="mediaSelected"
      @close="imagesDialog=false"></vular-medias-dialog>
    <vular-medias-dialog 
      :show="videosDialog" 
      acceptMatch = 'video/*' 
      :title="$t('media.videos')" 
      mediaType="video"
      @select="mediaSelected"
      @close="videosDialog=false"></vular-medias-dialog>
    <vular-media-view :media="viewMeida" @close="viewMeida=null"></vular-media-view>

  </v-card>
</template>

<script>
import VularImageAltEditor from './VularImageAltEditor'
import VularMediasDialog from './VularMediasDialog'
import VularMediaView from './VularMediaView'

export default {
  name: 'vular-image-select',
  components: {
    VularImageAltEditor,
    VularMediasDialog,
    VularMediaView,
  },
  props:{
    imageFlexClass:{
      type:String,
      default:'md3 xs4 lg2'
    },
    value:{
      type:Array,
      default:[]
    }
  },
  data: function () {
    return {
      medias:this.value,
      altDialog:false,
      imagesDialog:false,
      videosDialog:false,
      dragMedia:null,
      viewMeida:null,
      mediaThumbnailsPath:mediaThumbnailsPath,
    }
  },

  methods: {
    emitInput:function(){
      for(var $i = 0;$i < this.medias.length; $i++){
        this.medias[$i].pivot = this.medias[$i].pivot ? this.medias[$i].pivot :{}
        this.medias[$i].pivot.order = $i + 1;
      }

      this.$emit('input', this.medias)
    },
    mediaSelected:function(medias){
      this.medias.push.apply(this.medias, medias)
      this.emitInput()
    },
    drag:function(event,media){
      //event.dataTransfer.setData('media', media)
      this.dragMedia = media
    },
    drop:function(event, media){
      event.preventDefault();
      for(var i=0; i<this.medias.length; i++)
      {
        if(this.medias[i].id == this.dragMedia.id){
          this.$set(this.medias, i, media)
        } 
        else if(this.medias[i].id == media.id){
          this.$set(this.medias, i, this.dragMedia)
        } 
      }

      this.emitInput()
    },
    dragend:function(){
      this.dragMedia = null
    },
    allowDrop:function(event){
      event.preventDefault();
    },

    remove:function(media){
      for(var i=0; i<this.medias.length; i++)
      {
        if(this.medias[i].id == media.id){
          this.medias.splice(i, 1);
        }
      }

      this.emitInput()
    },

    removeAll:function(){
      this.medias = []

      this.emitInput()
    },

    editAlts:function(){
      this.altDialog = true
      //console.log(this.altDialog )
    },

  },

  watch: {
    medias: {
      handler() {
        //console.log(this.medias)
        this.emitInput();
      },
      //immediate: true,
      deep: true
    }
  }

}
</script>