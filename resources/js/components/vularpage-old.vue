<template>

  <vular-node v-if="show" :schema="schema"></vular-node>

</template>

<script>
import 'quill/dist/quill.core.css';
import 'quill/dist/quill.snow.css';
import 'quill/dist/quill.bubble.css';
import formPage from '../test-data/formPage';
import tablePage from '../test-data/tablePage';

export default {
  name: 'vular-page',

  data: () => ({
    //schema:'',
    pagesStack:[],
    show:true,
    apiUrl:host + 'page/'
  }),

  computed:{
    schema(){
      let stackLength = this.pagesStack.length;
      if(stackLength > 0){
        return this.pagesStack[stackLength - 1].data;
      }
      return '';
    },
  },

  methods: {
    init(){
      //console.log(this.$route.params.pageid);
      this.load({
        method:'get',
        params:{pageid : this.$route.params.pageid} 
      });
    },

    load(event){
      this.show = false;
      $bus.$emit('loading');
      var url = this.apiUrl + event.params.pageid;
      var axiosRequest = eval('axios.' + event.method);
      axios.post(url, event.params).then(
        (response)=> {
          //console.log(response.data);
          this.pagesStack.push({
            event:event,
            data:response.data
          })
          $bus.$emit('finished');
          this.show = true;
       },
        error=>{
          $bus.$emit('finished');

          if (error.response) {
            var errorMessage = error.response.status + ':' +error.message
            $bus.$emit('error', errorMessage);
          } 
          else {
            var errorMessage = error.message;
            $bus.$emit('error', errorMessage);
          }
        }
      )
    },


    closePage(){
      this.show = false;
      $bus.$emit('loading');
      this.pagesStack.pop();
      let stackLength = this.pagesStack.length;
      if(stackLength > 0){
        let page = this.pagesStack[stackLength - 1];
          //reload 异步加载数据

          //refresh current page
        this.pagesStack.pop();
        this.pagesStack.push(page);
      }
      this.show = true;
      $bus.$emit('finished');

    }
  },

  created () {
    this.init();
    const self = this;

    $bus.$on('vularEvent', function (event) {
      if(event.action === 'toPage'){
        self.load(event);
      }
      if(event.action === 'closePage'){
        self.closePage();
      }
    })

  },
  watch: {
    "$route": "init",
  }

};
</script>
