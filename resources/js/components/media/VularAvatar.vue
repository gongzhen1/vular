<template>
  <div>
    <img v-if="media" :style="{width:width+'px',height:height+'px',cursor: 'pointer'}" :src="mediaThumbnailsPath + media.thumbnail" @click="popUp" />
    <v-hover v-else>
      <v-card flat tile dark  class="light-blue  d-flex pa-2"
        slot-scope="{ hover }" 
        :class="`${hover ? 'darken-1' : 'lighten-1'}`"
        :style="{width:width+'px',height:height+'px'}"

        @click="popUp"
      >
        <div style="border: dashed 1px;">
          <v-layout
            fill-height
            align-center
            justify-center
            ma-0
          >
              <div slot="activator" style="cursor: pointer;" class="pa-3" >
                  <v-icon dark style="font-size: 40px;">add</v-icon>
              </div>
          </v-layout>  
        </div>
      </v-card>
    </v-hover>
    <div class="pt-2 pb-2" color="grey">{{label}}</div>
    <vular-medias-dialog 
      :show="imagesDialog"
      acceptMatch = 'image/*'
      :title="$t('media.images')" 
      mediaType="image"
      :multiple="false"
      @select="mediaSelected"
      @close="imagesDialog=false"></vular-medias-dialog>
    <vular-medias-dialog 
      :show="videosDialog" 
      acceptMatch = 'video/*' 
      :title="$t('media.videos')" 
      mediaType="video"
      :multiple="false"
      @select="mediaSelected"
      @close="videosDialog=false"></vular-medias-dialog>
    
  </div>
</template>

<script>
export default {
  name: 'vular-avatar',
  props:{
    width:{
      type:Number,
      default:120
    },

    height:{
      type:Number,
      default:120
    },

    label:{
      type:String,
      default:'Image',
    },

    mediaType:{
      type:String,
      default:'image',
    },

    value:Object,
  },

  data: function () {
    return {
      media: this.value,
      imagesDialog:false,
      videosDialog:false,
      mediaThumbnailsPath:mediaThumbnailsPath,
    }
  },

  methods: {
    mediaSelected:function(media){
      this.media = media
      this.$emit('input', this.media)
    },
    popUp () {
      if(this.mediaType == 'image'){
        this.imagesDialog = true;
      }
      else{
        this.videosDialog = true;
      }
    },
  }
};
</script>
