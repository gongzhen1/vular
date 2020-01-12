<template>
  <div>
    {{text}}
  </div>
</template>

<script>
export default {
  name: 'vular-label',
  props:{
    value:String,
    maxLength:{
      type:Number,
      default:0,
    },
    ellipsisSymbol:{
      type:String,
      default:'...'
    }
  },
  computed:{
    text(){
      if(!this.value){
        return ''
      }
      
      if(this.value.length <= this.maxLength || this.maxLength == 0){
        return this.value
      }

      return this.value.substring(0, this.maxLength) + this.ellipsisSymbol
    }
  }
};
</script>
