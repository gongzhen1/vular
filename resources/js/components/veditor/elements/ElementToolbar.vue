<template>
  <div class="element-toolbar">
    <v-icon 
      small color="white" class="pa-1" style="cursor: move;"
      draggable="true"
      >
      open_with
    </v-icon>
    <v-icon small color="white" class="pa-1" style="cursor: pointer;">file_copy</v-icon>
    <v-icon small color="white" class="pa-1" style="cursor: pointer;">delete_outline</v-icon>
  </div>
</template>

<script>
export default {
  name: 'element-toolbar',
};
</script>
<style scoped  lang="stylus">
  .element-toolbar
    background-color: #1E88E5; 
    height:28px;
    position: absolute;
    top:-2px;
    padding-top:2px;
    right:-2px;
    width:86px;
</style>