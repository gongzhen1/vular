<template>
  <v-form v-model="valid">
    <slot></slot>
  </v-form>
</template>

<script>
import 'quill/dist/quill.core.css';
import 'quill/dist/quill.snow.css';
import 'quill/dist/quill.bubble.css';
//import formPage from '@/test-data/formPage';

export default {
  name: 'vular-form',
  props:['schema','value'],

  data: () => ({
    //schema:formPage.schema,
    valid: false,
    //form:formPage.data,

    editorOption: {

    },
  }),
  
  //备忘：
  //创建时，根据Form vularId缓存,方便以后提交


  computed:{
    inputValue: {
        get:function() {
          return this.value;
        },
        set:function(val) {
          this.$emit('input', val);
        },
    },
  },

  methods: {
      dosomthing(){
          //
      }
  }
};
</script>
