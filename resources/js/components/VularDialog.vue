<template>
  <v-dialog 
    v-model="dialog"
    :disabled = 'disabled'
    :persistent= 'persistent'
    :fullscreen = 'fullscreen'
    :fullWidth = 'fullWidth'
    :noClickAnimation = 'noClickAnimation'
    :light = 'light'
    :dark = 'dark'
    :maxWidth = 'maxWidth'
    :origin = 'origin'
    :width = 'width'
    :scrollable = 'scrollable'
    :transition = 'transition'
  >
    <div slot="activator">
      <slot name="activator"></slot>
    </div>
    <slot></slot>
  </v-dialog>
</template>

<script>

export default {
  name: 'vular-dialog',
  props: {
    disabled: Boolean,
    persistent: Boolean,
    fullscreen: Boolean,
    fullWidth: Boolean,
    noClickAnimation: Boolean,
    light: Boolean,
    dark: Boolean,
    maxWidth: {
      type: [String, Number],
      default: 'none'
    },
    origin: {
      type: String,
      default: 'center center'
    },
    width: {
      type: [String, Number],
      default: 'auto'
    },
    scrollable: Boolean,
    transition: {
      type: [String, Boolean],
      default: 'dialog-transition'
    },
    model:Object,
    vularId:String,
    owner:String,
    field:String,
  },


  data: () => ({
      dialog:false,
  }),

  methods: {
    close(args){
      if(args.vularId == this.vularId){
        $bus.$emit('clearInput', this.vularId)
        this.dialog = false;
      }
    },

    inputOk(args){
      if(args.vularId == this.vularId){
        this.$emit('input',args.value)
        this.dialog = false;
      }
    }
  },

  created () {
    $bus.$on('close', this.close)
    $bus.$on('inputOk', this.inputOk)
    
  },
  destroyed() {
    $bus.$off('close', this.close)
    $bus.$off('inputOk', this.inputOk)
  },

}
</script>