<template>
  <v-toolbar :color="color" :dark="dark" :light='light'> 
      <a href="#" v-if="!drawer.mini">
          <img 
            :src='logo'
            height="36"
          />
      </a>
      <v-toolbar-title v-if="!drawer.mini" class="ml-0 pl-3" >
          <span class="hidden-sm-and-down">{{title}}</span>
      </v-toolbar-title> 
      <v-spacer v-if="!drawer.mini"></v-spacer>
      <v-btn v-if="showMiniButton" icon class="hidden-xs-only"  @click.stop="miniClick">
        <v-icon v-html="drawer.mini ? 'chevron_right' : 'chevron_left'"></v-icon>
      </v-btn>
  </v-toolbar>
</template>
<script>
export default {
  name: 'vular-drawer-toolbar',
  props:{
    title:String,
    logo:String,
    showMiniButton:Boolean,
    color:String,
    href:String,
    drawerMini:Boolean,
    //mixins/themable
    dark: {
      type: Boolean,
      default: null
    },
    light: {
      type: Boolean,
      default: null
    },
  },
  data: function () {
    return{
      drawer:{
        mini:this.drawerMini,
      },
    }    
  },
  
  created () {
    const self = this;
    $bus.$on('miniChanged', function (argMini) {
      self.drawer.mini = argMini;
    })
  },

  methods: {
    miniClick(){
      //this.drawer.mini = !this.drawer.mini
      $bus.$emit('changeDrawerMini');
    },
  },
};
</script>
