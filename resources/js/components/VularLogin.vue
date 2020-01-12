<template>
  <v-app id="inspire">
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            <v-card class="elevation-12 pb-2">
              <v-toolbar dark color="primary">
                <v-toolbar-title>{{$t('vular.login')}}</v-toolbar-title>
                <v-spacer></v-spacer>
                <img width="40" src="/vular/images/logo.png" />
              </v-toolbar>
              <v-card-text>
                <v-form ref="form"
                  v-model="valid"
                  lazy-validation>
                  <v-text-field 
                    prepend-icon="person" 
                    name="login" 
                    label="Login" 
                    required type="text"
                    :rules="[v => !!v || $t('vular.required')]"
                    autofocus
                    v-model="model.login_name"
                    @keyup.enter="login"
                    ></v-text-field>
                  <v-text-field id="password" prepend-icon="lock" name="password" required label="Password" type="password"
                  :rules="[v => !!v || $t('vular.required')]"
                  v-model="model.password"
                  @keyup.enter="login"></v-text-field>
                </v-form>
                <span style="color:red">{{error}}</span>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-progress-circular
                  indeterminate
                  color="primary"
                  width="1"
                  size="25"
                  class="mr-3"
                  v-show="logging"
                ></v-progress-circular>
                <v-btn color="primary" :disabled="logging" autofocus  @click="login">Login</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
export default {
  name: 'vular-login',
  props: {
    source: String
  },
  data: () => ({
      valid: true,
      logging: false,
      error:'',
      loginUrl:host + 'login',
      model:{login_name:'', password:''}
  }),
  methods: {
    login(){
      if (this.$refs.form.validate()) {
        this.logging = true
        axios.post(this.loginUrl, this.model).then(
          (response)=> {

            this.logging = false;
            var data = response? response.data : {}
            if(data.error){
              this.error = data.error
              return
            }

            $bus.$emit('loggedIn', response.data.access_token);
          },
          error=>{
            this.logging = false;
            this.error = error.message;
          }
        )
        //
      }
    }
  },
}
</script>