<template>
  <v-form ref="form" 
    v-model="valid"
    lazy-validation>
    <v-toolbar v-if="items.length == 0" light flat >
      <v-toolbar-title>{{title}} </v-toolbar-title>
    </v-toolbar>
    <div v-for="(item,index) in items">
      <v-toolbar light flat >
        <v-toolbar-title> {{title}} #{{index+1}}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn light icon @click="remove(index)">
          <v-icon>delete</v-icon>
        </v-btn>
      </v-toolbar>
      <v-divider></v-divider>
      <v-card-text>
          <v-layout row wrap>
            <v-flex v-for="(flex,i) in flexs" :class="flex.class" :key="i">
              <component v-bind:is="flex.field.name" v-bind="flex.field.props" :rules="transRules(flex.field.rules)" v-model="item[flex.field.field]">
              </component>
            </v-flex>
          </v-layout>
      </v-card-text>
    </div>
      <v-btn 
        fab
        bottom
        right
        absolute
        small
        color="info" @click="add">
        <v-icon>add</v-icon>
      </v-btn>
  </v-form>
</template>

<script>
export default {
  name: 'vular-has-many-panel',
  props:{
    flexs:Array,
    title:String,
    value:Array,
    owner:String,
  },

  data: function () {
    return {
      valid: false,
      items:this.value,
    }
  },
  created () {
    const self = this;
    //console.log(self.owner);
    if(self.owner){
      //console.log(self.schema.props.owner)
      //console.log(self.schema.name)
      $bus.$emit('registerInput', {input: self, owner: self.owner})
    }

  },

  methods: {

    add(){
      var item = {}
      for(var i = 0; i <this.flexs.length; i++){
        item[this.flexs[i].field.field] = null
      }
      this.items.push(item)
    },

    remove(i){
      if(confirm('Are you sure to delete?')){
        this.items.splice(i,1)
      }
    },

    validate(){
      //console.log(this.$refs)
      this.valid = this.$refs.form.validate()
      //console.log(this.valid)
      return this.valid
    },
  },


  watch: {
    items: {
      handler(newItems, oldItems) {
         this.$emit('input', newItems);
         //console.log(newItems)
      },
      //immediate: true,
      deep: true
    }
} 
};
</script>
