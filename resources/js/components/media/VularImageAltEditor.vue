<template>
  <v-dialog
    v-if="dialog"
    v-model="dialog"
    max-width="660"
    style="overflow: hidden;"
    :scrollable="true"
  >
    <v-card style="overflow: hidden;">
      <v-toolbar flat card>
        <v-toolbar-title>{{$t('media.edit-alt-text-for-images')}}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn flat icon 
            @click="cancel" >
            <v-icon >clear</v-icon>
        </v-btn>
      </v-toolbar>
      <v-divider></v-divider>
      <v-card-text class="pa-4" style="max-height:500px; overflow: auto" >
          <div>
            {{$t('media.edit-alt-text-tip')}}
          </div>

          <v-list>
            <template v-for="(item, index) in medias">

              <v-list-tile
                :key="index"
                avatar
                class="pt-4 pb-4"
              >
                <v-list-tile-avatar :tile='true' size="60" class="pr-3">
                  <img :src="mediaThumbnailsPath + item.thumbnail">
                </v-list-tile-avatar>

                <v-list-tile-content>
                  <v-text-field v-if="index==0"
                      v-model="item.pivot.alt_text"
                      :label="$t('media.alt-text')"
                      style="width:100%;"
                    >
                      
                      <v-tooltip slot="append" top>
                        <v-icon slot="activator" color="blue" @click="copyToAll">file_copy</v-icon>
                        {{$t('media.copy-to-all-images')}}
                      </v-tooltip>
                      
                    </v-text-field>   

                  <v-text-field v-else
                      v-model="item.pivot.alt_text"
                      :label="$t('media.alt-text')"
                      style="width:100%;"
                    ></v-text-field>   
                    
                  
                </v-list-tile-content>
              </v-list-tile>
            </template>
          </v-list>

      </v-card-text>
      
      <v-footer height="auto" class="pa-2" color="transparent">
        <v-btn
          light
          flat
          color= 'blue'
          @click="cancel"
        >
          {{$t('vular.cancel')}}
        </v-btn>

        <v-spacer></v-spacer>

        <v-btn
          round 
          color="blue"
          dark
          @click="save"
        >
          {{$t('vular.save')}}
        </v-btn>
      </v-footer>
    </v-card>
  </v-dialog>    
</template>

<script>
//import Test from './Test'

export default {
  name: 'vular-image-alt-editor',
  props:{
    show:Boolean,
    value:Array,
  },

  data: function () {
    return {
      medias:[],
      mediaThumbnailsPath:mediaThumbnailsPath,
    }
  },

  computed:{
    dialog: {
        get:function() {
          return this.show;
        },
        set:function(val) {
          if(val == false){
            this.$emit('close', val);
          }
        },
    },
  },
  created () {
      this.init();
  },

  methods: {
    copyToAll:function(){
      for(var i=1; i<this.medias.length; i++)
      {
        let media = this.medias[i];
        media.pivot.alt_text = this.medias[0].pivot.alt_text;
        this.$set(this.medias, i, media)
      }
    },

    save:function(){
      var inputValue = this.value;
      for(var i=0; i<inputValue.length; i++)
      {
        inputValue[i].pivot = inputValue[i].pivot ? inputValue[i].pivot : {}; 
        inputValue[i].pivot.alt_text = this.medias[i].pivot.alt_text
      }
      //console.log(inputValue)
      this.$emit('input', inputValue)
      this.dialog = false
    },

    cancel:function(){
      this.init();
      this.dialog = false
    },

    init(){
      this.medias = []
      for( let i = 0; i < this.value.length; i++ )
      {
        let media = {}
        media.pivot = {}
        media.thumbnail = this.value[i].thumbnail
        media.pivot.alt_text = this.value[i].pivot ? this.value[i].pivot.alt_text : ""
        this.$set(this.medias, i, media)
      }
    }


  },

  watch: {
    value(){
      this.init();
    }
  },  
}
</script>