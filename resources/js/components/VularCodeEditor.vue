<template>
  
   <prism-editor v-model="inputValue" language="html" :line-numbers="lineNumbers" class="my-editor" />
  
</template>

<script>
import PrismEditor from "vue-prism-editor";
export default {
  name: 'vular-code-editor',
  components: {
    PrismEditor
  },
  props:{
    value:String,
  },
  data(){
    return {
      code: null,
      lineNumbers: true,
    }
  },
  computed:{
    inputValue: {
        get:function() {
            return this.value;
        },
        set:function(val) {
          this.code = val;
          this.$emit('input', val);
        },
    },
  }
};
</script>

<style>
.my-editor{
  height: 600px;
}

code{
  white-space: pre-wrap !important;
}
</style>

