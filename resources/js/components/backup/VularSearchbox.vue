<template>
  <v-text-field label="Search" v-if="searching" 
    append-icon="close" 
    @click:append="searching = false">
  </v-text-field>

  <v-btn v-else icon @click.stop="searching = true">
    <v-icon>search</v-icon>
  </v-btn>
</template>

<script>
export default {
  name: 'vular-searchbox',
  data: () => ({
      searching:false,
  }),
}
</script>