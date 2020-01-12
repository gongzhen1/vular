<template>
  <v-app id="layout" :dark="dark" class="app" style="background-color:#f0f4f7;">
    <v-navigation-drawer id="appDrawer"
      v-model="primaryDrawer.model"
      :permanent="primaryDrawer.type === 'permanent'"
      :temporary="primaryDrawer.type === 'temporary'"
      :clipped="primaryDrawer.clipped"
      :floating="primaryDrawer.floating"
      :mini-variant="primaryDrawer.mini"
      class="app--drawer"
      app dark>
        <v-toolbar color="" dark>
            <a href="#" v-if="!primaryDrawer.mini">
                <img 
                  :src=drawerSchema.header.image_url
                  height="36"
                />
            </a>
            <v-toolbar-title v-if="!primaryDrawer.mini" class="ml-0 pl-3" >
                <span class="hidden-sm-and-down">{{drawerSchema.header.title}}</span>
            </v-toolbar-title> 
            <v-spacer v-if="!primaryDrawer.mini"></v-spacer>
            <v-btn v-if="drawerSchema.header.show_mini_button" icon class="hidden-xs-only"  @click.stop="primaryDrawer.mini = !primaryDrawer.mini">
              <v-icon v-html="primaryDrawer.mini ? 'chevron_right' : 'chevron_left'"></v-icon>
            </v-btn>
        </v-toolbar>

        <vue-perfect-scrollbar class="drawer-menu--scroll" :settings="scrollSettings">
            <template v-for="(com,i) in drawerSchema.body">
                <dynamic-component :schema="com" :key="i" ></dynamic-component>
            </template>
        </vue-perfect-scrollbar>        
    </v-navigation-drawer>


    <v-toolbar :clipped-left="primaryDrawer.clipped" light app>
        <v-toolbar-side-icon v-if="toolbarSchema.show_side_icon" @click.stop="primaryDrawer.model = !primaryDrawer.model">
        </v-toolbar-side-icon>
        <template v-for="(com,i) in toolbarSchema.compontents">
            <dynamic-component :schema="com" :key="i" ></dynamic-component>
        </template>
    </v-toolbar>
    <v-content>
      <v-progress-linear v-if="$store.state.pageLoading" class="pa-0 ma-0" height="2" color="blue" indeterminate></v-progress-linear>
      <transition>
          <keep-alive>
            <router-view></router-view>
          </keep-alive>
      </transition>
    </v-content>

    <v-footer :inset="footer.inset" class="app--footer" app absolute>
        <span class="px-3">&copy; {{ new Date().getFullYear() }}  — Vular</span>
    </v-footer>
    <vular-appfab medium='true' dark="dark" color="red"></vular-appfab>
    <vular-theme-setting />
  </v-app>
</template>

<script>
import leftDrawer from '@/test-data/leftDrawer';
import toolBar from '@/test-data/toolBar';
import VuePerfectScrollbar from 'vue-perfect-scrollbar';
export default {
    name: 'vular-app',
    components: {
        VuePerfectScrollbar,
    },
    data: () => ({
        dark: false,
        drawers: ['Default (no property)', 'Permanent', 'Temporary'],
        primaryDrawer: {
            model: null,
            type: 'default (no property)',
            clipped: false,
            floating: false,
            mini: false
        },
        drawerSchema:leftDrawer,
        toolbarSchema:toolBar,
        footer: {
           inset: true
        },
        scrollSettings: {
            maxScrollbarLength: 160
        }, 
    }),

    methods: {
      }

  }
</script>

<style lang="stylus">
#appDrawer
  overflow: hidden
  .drawer-menu--scroll
    height: calc(100vh - 48px)
    overflow: auto

</style>

