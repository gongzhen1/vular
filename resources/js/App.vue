<template>
  <!--v-app id="layout" app v-else-if="loading" style="background-color:#f0f4f7;">
    <v-content>
        <vular-editor></vular-editor>
    </v-content>
  </v-app-->
    
  <vular-login v-if="!isLoggedIn" />
  <v-app id="layout" v-else-if="loading" style="background-color:#f0f4f7;">
    <v-container>
      <v-layout align-center justify-center row fill-height>
        <v-progress-circular
          color="primary"
          indeterminate
        ></v-progress-circular>
      </v-layout>
    </v-container>
  </v-app>
  <v-app v-else-if="errorMessage">
    <v-container>
      <v-layout align-center justify-center row fill-height>
        <v-card class="pa-0">
          <v-alert
            :value="true"
            style="min-width:300px;"
            type="error"
            class="ma-0"
          >
            {{errorMessage}}
          </v-alert>
        </v-card>
        
      </v-layout>
    </v-container>
  </v-app>
  <vular-node v-else :schema="schema"></vular-node>
</template>

<script>
//import VularApp from './components/VularApp'
//import adminapp from './test-data/adminapp';
//import servertest from './test-data/servertest';
import {get_fromStorage} from './storage'

export default {
  name: 'App',
  components: {
    //VularApp,
  },
  data () {
    return {
      //loggedIn:true,
      loading:false,
      errorMessage:'',
      schema:{},
      apiUrl:host + 'admin'
    }
  },

  computed:{
      isLoggedIn(){
        if(this.$store.state.token) return true;

        var storageToken = get_fromStorage('access_token')

        if(storageToken){
          this.$store.commit('loggedin', storageToken)

          return true;
        }

        return false;
      }
  },

  methods: {
    load(){
      axios.get(this.apiUrl).then(
        (response)=> {
          this.schema = response? response.data : {}
          this.loading = false;
        },
        error=>{
          this.loading = false;
          this.errorMessage = error.message;
        }
      )
    }
  },

  created () {
    const self = this;

    $bus.$on('loggedIn', function (accessToken) {
      self.$store.commit('loggedin', accessToken)
      //self.loggedIn = true;
      self.load()
    })

    $bus.$on('logout', function () {
      self.$store.commit('logout')
      //self.loggedIn = false;
    })

    this.loading = true;
    //if(self.loggedIn){
    //}
    self.load()
  },

}
</script>
