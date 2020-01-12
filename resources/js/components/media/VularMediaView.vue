<template>
  <div v-if="media" class="view-image" @click.stop="doNothing">
    <v-card class="pa-2" style="position: relative;">
      <v-btn icon color="white" 
        style="position: absolute;right: 3px; top:5px;z-index: 1100"
        @click.stop="$emit('close')"
      >
        <v-icon>clear</v-icon>
      </v-btn>
      <v-layout column>
        <v-img v-if="media.media_type=='image'"
          aspect-ratio="1"
          :src="'/uploads/originals/'+ media.file_name"
        ></v-img>
        <video v-else-if="media.media_type=='video'"
          :src="'/uploads/originals/'+ media.file_name"
          width = "100%"
          controls="controls" preload="metadata"
        >
        </video>

        <div class="pt-1 pl-2">{{media.name}} size:{{media.size}}</div>
        <div class="pt-1 pl-2"> url:{{'/uploads/originals/'+ media.file_name}}</div>
      </v-layout>
    </v-card>

  </div>
</template>

<script>
export default {
  name: 'vular-media-view',
  props:{
    media:Object
  },

  data: function () {
    return {
      //fab: false,
    }
  },

  methods: {
    doNothing:function(){

    },
  }
};
</script>

<style scoped  lang="stylus">
  .view-image
    width: 480px
    height: 480px
    position: fixed 
    top:80px
    left:50%
    margin-left:-240px
    z-index: 1000
  
</style>