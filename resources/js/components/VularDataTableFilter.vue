<template>
  <v-menu
    offsetY
    :closeOnContentClick='false'
    v-model="show"
  >
    <v-btn
      slot="activator"
      flat
    >
      <v-icon dark size="20" class="mt-1">mdi-filter-outline</v-icon>
      {{activatorText}}
      <v-icon right dark>arrow_drop_down</v-icon>
    </v-btn>
    <v-card>
      <v-toolbar flat>
        <v-toolbar-title>{{title}}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn icon @click="show=false">
          <v-icon>close</v-icon>
        </v-btn>
      </v-toolbar>
      <v-card-text>
        <slot></slot>
      </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn flat @click="clear">{{clearText}}</v-btn>
          <v-btn color="primary" flat @click="confirm">{{confirmText}}</v-btn>
        </v-card-actions>
    </v-card>
  </v-menu>

</template>

<script>
export default {
  name: 'vular-data-table-filter',
  props:{
    activatorText:String,
    title:{
      type:String,
      default:'Results Filter',
    },
    clearText:{
      type:String,
      default:'Clear',
    },
    confirmText:{
      type:String,
      default:'Confirm',
    },

    owner:String,
    vularId:String,
    //viewModel:Object,
    value:Object

  },

  data: function () {
    return {
      show: false,
      model:this.value? this.value : {}
    }
  },

  created () {
    const self = this;
    $bus.$on('input', function (event) {
      var {value, owner, field} = event
      //console.log(owner, self.vularId)
      if(owner == self.vularId){
        self.model[field] = value
        //console.log(field, value)
      }
    })
  },

  methods: {
    confirm () {
      this.show = false;
      this.$emit('input', this.model);
      $bus.$emit('reload',this.owner);
    },
    clear () {
      this.show = false;
      this.model = {};
      this.$emit('input', this.model);
      $bus.$emit('clearInput',this.vularId);
      $bus.$emit('reload',this.owner);
      //$bus.$emit('vularAction',{action:'clearFilter', owner:this.owner, method:'post'});
    }
  },


};
</script>
