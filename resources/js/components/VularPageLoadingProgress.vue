<template>
  <div 
    v-if="show" 
    style="    
      position: fixed ;
      top:50%;
      left:50%;
      z-index: 1000;
      background-color: #f0f4f7;
      padding: 20px;
    "
>
    <v-progress-circular
      :size="50"
      color="primary"
      indeterminate
    ></v-progress-circular>
  </div>
</template>

<script>
export default {
  name: 'vular-page-loading-progress',
  props: {
    active: {
      type: Boolean,
      default: true
    },
    backgroundColor: {
      type: String,
      default: null
    },
    backgroundOpacity: {
      type: [Number, String],
      default: null
    },
    bufferValue: {
      type: [Number, String],
      default: 100
    },
    color: {
      type: String,
      default: 'primary'
    },
    height: {
      type: [Number, String],
      default: 7
    },
    indeterminate: Boolean,
    query: Boolean,
    value: {
      type: [Number, String],
      default: 0
    }
  },
  data: function () {
    return {
      show:false,
    }
  },

  computed:{
    inputValue: {
        get:function() {
          if(this.value){
            return this.value;
          }
          return {};//防止空值异常
        },
        set:function(val) {
          this.$emit('input', val);
        },
    },
  },

  created () {
    const $this = this;
    $bus.$on('loading', function () {
      $this.show = true;
    })
    $bus.$on('finished', function () {
      $this.show = false;
    })
  },

}
</script>