<template>
    <div>
        <v-btn small fab dark falt fixed top="top" right="right" class="setting-fab" color="blue" style="top:50%!important; right:0; border-radius:0 " @click="openThemeSettings">
              <v-icon>settings</v-icon>
        </v-btn>
        <v-navigation-drawer
              class="setting-drawer"
              temporary
              right
              v-model="rightDrawer"
              hide-overlay
              fixed
              >
            xxxxxxxx
        </v-navigation-drawer>        
    </div>
</template>

<script>
export default {
    name: 'vular-theme-setting',

    data: () => ({
        rightDrawer: false,
    }),

    methods: {
        openThemeSettings () {
          this.$vuetify.goTo(0);
          this.rightDrawer = (!this.rightDrawer);
        }
    }
};
</script>
