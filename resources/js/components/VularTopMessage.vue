<template>
  <v-snackbar 
    v-if="type ==='success'"
    v-model="show"
    :top="true"
    :timeout="2000"
    color="success"
  >
    {{ message }}
    <v-btn
      dark
      flat
      @click="show = false"
    >
      Close
    </v-btn>
  </v-snackbar>

  <v-alert
    v-else
    v-model="show"
    :type="type"
    dismissible
    class="message-panel"
  >
    {{message}}
  </v-alert>
</template>

<script>
export default {
  name: 'vular-top-message',
  props:{},

  data: function () {
    return {
      show: false,
      type:'error',// success, info, warning or error 
      message:'',
    }
  },

  created () {
    const self = this;

    $bus.$on('error', function (message) {
      self.type = 'error'
      self.message = message
      self.show = true;
    })

    $bus.$on('warning', function (message) {
      self.type = 'error'
      self.message = message
      self.show = true;
    })

    $bus.$on('info', function (message) {
      self.type = 'info'
      self.message = message
      self.show = true;
    })

    $bus.$on('success', function (message) {
      self.type = 'success'
      self.message = message
      self.show = true;
    })

  },

  methods: {
  }
};
</script>

<style scoped  lang="stylus">
  .message-panel{
    position: fixed; 
    top:50%;
    left:50%; 
    margin-left:-200px;
    margin-top:-60px;
    z-index: 99999;
    width: 400px;
    min-height: 60px;
  }

  .error-msg{
    color: red;
  }

</style>