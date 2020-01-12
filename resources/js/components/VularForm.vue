<template>
  <v-form>
    <slot></slot>
  </v-form>
</template>

<script>
export default {
  name: 'vular-form',
  props:{
    owner:String,
    vularId:String,
    pageId:String,
    //rootNode:Object,
    viewModel:Object
  },

  data: function () {
    return {
      //schema: this.rootNode,
      apiUrl:host + 'action/',
      inputs:[],
      //waitingEvents:[],
      model:this.viewModel,
      //sucessMsg : this.$t('operate.success'),//i18n未知空异常，只能把消息放在这里
    }
  },
  computed:{
    //rootRef: function (){
    //  return 'root' + this.vularId
    //},
  },

  methods: {
    load(event){
      const self =this

      $bus.$emit('loading');
      var viewModel = self.model
      //console.log(self.model)

      var url = self.apiUrl + self.pageId + '/' + event.action + '/' + self.vularId// + pageUrl;
      var axiosRequest = eval('axios.' + event.method);
      //this.model.output = {};
      console.log(url)
      viewModel.params = event.params
      axiosRequest(url, viewModel).then(
        (response)=> {
          if(response){
            self.emitEvents(response.data.beforeEvents)
            //console.log(response.data)
            if(response.data.errors){
              self.emitErrors(response.data.errors)
            }
            else if(response.data.viewModel){
              this.model = response.data.viewModel
              //console.log(this.model)
              this.emitValues(this.model)
            }
            self.emitEvents(response.data.afterEvents)
            
          }
          //console.log(self.schema)
          //self.loading = false;
          $bus.$emit('reload',self.vularId);
          $bus.$emit('finished');
         //$bus.$emit('success',self.sucessMsg);
        },
        error=>{
          $bus.$emit('finished');
          //self.loading = false;
          $bus.$emit('error', error.message);
         }
      )
    },

    emitErrors(errors){
      const self =this
      for(var i = 0; i < errors.length; i++){
         $bus.$emit('inputError', self.vularId ,errors[i])
      }
    },

    emitValues(model){
      for(var i = 0; i < this.inputs.length; i++){
        var field = this.inputs[i].schema ? this.inputs[i].schema.field : null
        if(model && field){
          var fieldNameArray = field.split('.')
          var value = model[field]
          if(fieldNameArray.length == 2){
            model[fieldNameArray[0]][fieldNameArray[1]] = model[field]
          }
          $bus.$emit('defaultValueChange', this.vularId , {field:field,value:value})
        }
      }
    },

    emitEvents(events){
      if(events){
        for(var i = 0; i < events.length; i++){
          $bus.$emit(events[i].action, events[i].params)
        }
      }
    },

    saveFieldValue(fieldName, value){
      var fieldNameArray = fieldName.split('.')
      if(fieldNameArray.length == 2){
        this.model[fieldNameArray[0]][fieldNameArray[1]] = value
      }
      
      this.model[fieldName] = value
    },

    input (event) {
      const self = this;
      var {value, owner, field} = event
      if(owner == self.vularId){
        //console.log(field, value)
        self.saveFieldValue(field, value)
        $bus.$emit('valueChange', self.vularId , {field:field,value:value})
      }
    },

    save (args) {
      if(args.vularId === this.vularId){
        if(args.valid){
          if(!this.validate()){
            return
          }
        }
        $bus.$emit('inputOk',{'vularId':this.owner, value:this.model})
        this.emitValues(this.model)
      }
    },

    registerInput (event) {
      const self = this;
      if(event.owner === self.vularId){
        self.inputs.push(event.input);
        //console.log(event)
      }
    }, 

    vularAction (event) {
      //const self = this;
      if(event.owner === this.vularId){

        if(event.confirm && !confirm(event.confirm)){
          return;
        }

        if(event.valid){
          if(!this.validate()){
            //self.load(event);
            return
          }
        }
        this.load(event);
      }
    },

    validate(){
      var validSuccess = true;
      for(var i = 0;i < this.inputs.length; i++){
        if(!this.inputs[i].validate()){
          validSuccess = false
        }
      }
      //console.log(this.inputs)
      return validSuccess;
    },

    clearInput(owner){
      if(owner === this.owner){
        $bus.$emit('clearInput', this.vularId)
      }
    },

  },

  destroyed() {
    $bus.$off('input', this.input)
    $bus.$off('save', this.save)
    $bus.$off('registerInput',this.registerInput)
    $bus.$off('vularAction',this.vularAction)
    $bus.$off('clearInput', this.clearInput)
  },

  created () {
    //console.log(this.model);
    this.inputs = [];
    $bus.$on('input', this.input)
    $bus.$on('save', this.save)
    $bus.$on('registerInput', this.registerInput)
    $bus.$on('vularAction', this.vularAction)
    $bus.$on('clearInput', this.clearInput)
    //console.log(this.viewModel)
  },
};
</script>
