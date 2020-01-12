<template>
     <v-dialog
      v-if="mediasDialog"
      v-model="mediasDialog"
      scrollable 
      persistent :overlay="false"
      max-width="94%"
      transition="dialog-transition"
    >
      <v-card tile style="overflow:hidden;">
        <v-toolbar card>
          <v-toolbar-title>{{title}}</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn icon @click="mediasDialog = false">
            <v-icon>close</v-icon>
          </v-btn>
        </v-toolbar>
        <vular-medias
          :acceptMatch = "acceptMatch"
          :topTip = "topTip"
          :mediaType = "mediaType"
          :multiple = "multiple"
          @selectedChange = "selectedChange"
        ></vular-medias>
        <v-divider></v-divider>
        <v-footer height="100" color="transparent" class="pa-2">

          <v-spacer></v-spacer>
          <div v-if="medias.length>0" class="pr-3">
            {{medias.length}} {{typeName}} Selected
          </div>

          <v-btn
            v-if="medias.length>0"
            round 
            color="blue"
            dark
            @click="addToPage"
          >
            Add to Page
          </v-btn>

          <v-btn
            v-else
            round 
            disabled
          >
            Add to Page
          </v-btn>


        </v-footer>
      </v-card>
    </v-dialog>
</template>

<script>
export default {
  name: 'vular-medias-dialog',
  props:{
    acceptMatch:{
      type:String,
      default:'image/*',
    },
    topTip:{
      type:String,
      default:'Upload or drag and drop files. ',
    },
    title:String,
    typeName:{
      type:String,
      default:'files',
    },
    mediaType:{
      type:String,
      default:'image',
    },
    show:Boolean,
    multiple:{
      type:Boolean,
      default:true,
    }
  },
  components: {
    //VularMedias
  },

  data: function () {
    return {
      medias:[],
    }
  },

  computed:{
    mediasDialog: {
        get:function() {
          return this.show;
        },
        set:function(val) {
          if(val == false){
            this.$emit('close');
          }
        },
    },
  },

  methods: {
    selectedChange:function(selectedList){
      this.medias = selectedList
    },

    addToPage:function(){
      for(var i = 0; i < this.medias.length; i++){
        this.medias[i].src = mediaOriginalsPath + this.medias[i].file_name
        //this.medias[i].thumbnialSrc = mediaThumbnailsPath + this.medias[i].file_name
        //console.log(this.medias[i])
      }
      if(this.multiple){
        this.$emit('select', this.medias)
      }
      else{
        this.$emit('select', this.medias[0])
      }
      this.$emit('close');
    }
  }
};
</script>
