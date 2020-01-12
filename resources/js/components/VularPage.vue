<template>
  <v-content>
    <vular-page-loading-progress height="2" class="mt-0"></vular-page-loading-progress>
    <vular-node v-if="currentPage" :schema="currentPage"></vular-node>
  </v-content>
</template>

<script>
//import 'quill/dist/quill.core.css';
//import 'quill/dist/quill.snow.css';
//import 'quill/dist/quill.bubble.css';
//import formPage from '../test-data/formPage';
//import tablePage from '../test-data/tablePage';

export default {
  name: 'vular-page',

  data: () => ({
    //schema:'',
    pagesStack:[],
    apiUrl:host + 'page/',
    currentPage:'',
  }),

  computed:{
    //schema(){
    //  let stackLength = this.pagesStack.length;
    //  if(stackLength > 0){
    //    return this.pagesStack[stackLength - 1];
    //  }
    //  return '';
    //},
  },

  methods: {
    init(){
      this.currentPage = ''
      //this.pagesStack = [];
      //console.log(this.$route.params.pageid);
      this.load({
        method:'get',
        params:{pageid : this.$route.params.pageid} 
      });
    },

    load(event){
      $bus.$emit('loading');
      var url = this.apiUrl + utils.urlencode(event.params, true);
      //console.log(url)
      //var axiosRequest = eval('axios.' + event.method);
      axios.get(url).then(
        (response)=> {
          //console.log(response.data);
          this.currentPage = response?response.data:{}
          this.currentPage.event = event
          this.pagesStack.push(this.currentPage)

          //console.log(this.pagesStack)
          $bus.$emit('finished');
       },
        error=>{
          $bus.$emit('finished');
          $bus.$emit('error', error.message);
          console.log(error.response.request.response)
        }
      )
    },


    closePage(){
      this.pagesStack.pop();
      let stackLength = this.pagesStack.length;
      this.currentPage = this.pagesStack[stackLength - 1];
    },

    vularAction (event) {
     const self = this;
     if(event.action === 'toPage'){
        self.load(event);
      }
    },

  },

  created () {
    this.init();
    const self = this;

    $bus.$on('closePage', self.closePage)
    $bus.$on('vularAction', self.vularAction)

  },

  destroyed() {
    $bus.$off('closePage', this.closePage)
    $bus.$off('vularAction', this.vularAction)
  },

  watch: {
    "$route": "init",
  }

};
</script>
