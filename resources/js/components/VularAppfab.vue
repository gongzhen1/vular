<template>
  <v-fab-transition>
    <v-btn :small="small" :medium="medium" dark="dark" :large="large"  bottom="bottom" right="right" :color="color" fab="fab" fixed="fixed"  v-scroll="onScroll" v-show="fab" @click="toTop">
      <v-icon>keyboard_arrow_up</v-icon>
    </v-btn>
  </v-fab-transition>
</template>

<script>
export default {
  name: 'vular-appfab',
  props:['color','small','medium','large','dark'],

  data: function () {
    return {
      fab: false,
    }
  },

  methods: {
    onScroll () {
        if (typeof window === 'undefined') return;

        const top = window.pageYOffset ||
        document.documentElement.offsetTop || 0;

        this.fab = top > 300;
    },
    toTop () {
        //this.$router.push({ hash: '' });
        this.$vuetify.goTo(0);
    }
  }
};
</script>
