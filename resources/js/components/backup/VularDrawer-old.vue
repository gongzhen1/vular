<template>
  <v-navigation-drawer
    :id="schema.id"
    :mini-variant="mini"
    v-model="model"
    v-bind="schema.props"
    >
    <slot></slot>

  </v-navigation-drawer>
</template>
<script>
export default {
  name: 'vular-drawer',
  props: {schema:Object},
  data: function () {
    return{
      mini: this.schema['mini-variant'],
      model: true,
    }    
  },
  

  methods: {
  },

  created () {
    const self = this;
    self.$bus.$on('changeDrawerMini', function () {
      self.mini = !self.mini;
      self.$bus.$emit('miniChanged', self.mini);
    })

    self.$bus.$on('hideOrShowDrawer', function () {
      self.model = !self.model;
      self.$bus.$emit('showDrawerChanged', self.model);
    })
  },
  
};
</script>
