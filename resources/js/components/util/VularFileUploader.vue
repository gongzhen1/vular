<template>
    <v-card
      flat 
      :class="{'pa-0':true, 'ma-0':true, 'drag-over':fileDragOver}"
      @dragleave = "onFileDragLeave($event)"
      @drop = "onFileDrop($event)"
      @dragenter = "onFileDragLEnter($event)"
      @dragover = "onFileDragOver($event)"
    >
      <v-toolbar flat  color="transparent" class="pa-0 ma-0">
        <div>
          {{topTip}}
        </div>
        <v-spacer></v-spacer>
        <v-btn round color="red darken-1" dark class="mr-2" @click="uploadClick">
          <v-icon left dark>cloud_upload</v-icon>
          {{$t('media.upload')}}
        </v-btn>
        <input ref="uploadInput" hidden multiple type="file" :accept="acceptMatch" 
           @change='addFile'
         />
      </v-toolbar>
      <v-divider></v-divider>
      <v-card-text class="pa-0 ma-0" >
        <slot></slot>
      </v-card-text>


    </v-card>
</template>

<script>
export default {
  name: 'vular-file-uploader',
  props:{
    acceptMatch:{
      type:String,
      default:'image/*',
    },
    topTip:{
      type:String,
      default:'Upload or drag and drop files.',
    },
  },

  data: function () {
    return {
      fileDragOver:false,
      //tasks:[],
      //taskPanel:false,
    }
  },

  methods: {
    uploadClick:function(){
      this.$refs.uploadInput.click()
    },

    addFile: function(event){
      this.createTasks(event.target.files)
    },

    onFileDragLeave:function(event){
      //console.log(event)
      event.stopPropagation();
      event.preventDefault();
      this.fileDragOver = false
    },

    onFileDrop:function(event){
      //console.log(event)
      event.stopPropagation();
      event.preventDefault();
      this.fileDragOver = false
      this.createTasks(event.dataTransfer.files)
    },

    createTasks:function(files){
      for (var i = 0; i !== files.length; i++) {
        //this.uploadFile(dt.files[i]);
        //console.log(data.files[i])
        if(files[i].type.match(this.acceptMatch)){
          var task = {
              file:files[i], 
              progressValue:0, 
              error:'', 
              thumbnail:"", 
              success:false,
              id:0,
              name:"",
              file_name:"",
              selected:false,
              editable:false,
            };
          //if(i==2){
          //  task.status="error"
          //  task.message='文件太大'
          //}
          this.loadThumbnail(task);
          //this.tasks.push(task)
          this.$emit('task', task)
        }
      }
    },

    onFileDragLEnter:function(event){
      //console.log(event)
      event.stopPropagation();
      event.preventDefault();
      this.fileDragOver = true
      //console.log(event.dataTransfer)
      //const data = event.dataTransfer.files;  
      //if (data.length >= 1) {
      //  this.fileDragOver = true
      //}
    },

    onFileDragOver:function(event){
      //console.log(event)
      //event.stopPropagation();
      event.preventDefault();
     //const data = event.dataTransfer.files;  
      //console.log(event.dataTransfer)
      //if (data.length >= 1) {
      this.fileDragOver = true
      //}
    },

    loadThumbnail:function(item){
      if(item.file.type.match('image/*'))
      {
        item.media_type="image"
        var reader = new FileReader();  
        reader.readAsDataURL(item.file); 
        reader.onload = function(e){
            item.thumbnail = e.target.result;
        }
      }

      else if(item.file.type.match('video/*'))
      {
        item.media_type="video"
      }
      else{
        item.media_type="file"
      }

    },

    //killTask:function(item, index){
    //  this.tasks.splice(index, 1)
    //  if(this.tasks.length == 0){
    //    this.taskPanel = false
    //  }
    //},

    doNothing:function(){

    },

  }
};
</script>

<style scoped  lang="stylus">
  .task-panel{
    position: fixed; 
    top:50%;
    left:50%; 
    margin-left:-240px;
    margin-top:-260px;
    z-index: 1100;
  }

  .error-msg{
    color: red;
  }

</style>