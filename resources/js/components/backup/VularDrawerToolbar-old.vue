<template>
  <v-toolbar :color="schema.props.color" :dark="schema.props.dark" :class="schema.props.class" :style="schema.props.style"> 
      <a href="schema.props.href" v-if="!drawer.mini">
          <img 
            :src='schema.props.logo'
            height="36"
          />
      </a>
      <v-toolbar-title v-if="!drawer.mini" class="ml-0 pl-3" >
          <span class="hidden-sm-and-down">{{schema.props.title}}</span>
      </v-toolbar-title> 
      <v-spacer v-if="!drawer.mini"></v-spacer>
      <v-btn v-if="schema.props['show-mini-button']" icon class="hidden-xs-only"  @click.stop="miniClick">
        <v-icon v-html="drawer.mini ? 'chevron_right' : 'chevron_left'"></v-icon>
      </v-btn>
  </v-toolbar>
</template>
<script>
export default {
  name: 'vular-drawer-toolbar',
  props: {schema:Object},
  data: function () {
    return{
      drawer:{
        mini:this.schema.props['drawer-mini'],
      },
    }    
  },
  
  created () {
    const self = this;
    self.$bus.$on('miniChanged', function (argMini) {
      self.drawer.mini = argMini;
    })
  },

  methods: {
    miniClick(){
      //this.drawer.mini = !this.drawer.mini
      this.$bus.$emit('changeDrawerMini');
    },
  },
};
</script>
