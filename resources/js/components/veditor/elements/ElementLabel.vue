<template>
  <div class="element-label">
    {{label}}
  </div>
</template>

<script>
export default {
  name: 'element-label',
  props:{
    label:String,
  },
};
</script>
<style scoped  lang="stylus">
  .element-label
    background-color: #E3F2FD;
    border: 1px solid #DDDDDD;
    color: #9DA0A4;
    font-size: 11px;
    font-weight: bold;
    left: -1px;
    line-height: 16px;
    padding: 3px 7px;
    position: absolute;
    height:22px;
    top: -22px;
    overflow: hidden;
    text-overflow:ellipsis;
    white-space: nowrap;
    
  .mouse-over-label
    background-color: #1E88E5;
    border:solid #1E88E5 1px;
    color:#fff;

  .drag-over-label
    background-color: #F06292;
    border:solid #F06292 1px;
    color:#fff;
    
  .focus-it-label
    background-color: #1E88E5;
    border:solid #1E88E5 1px;
    color:#fff;
    left: -2px;

  .dragged-label
    background-color: #E3F2FD;
    border: 1px solid #DDDDDD;
    color: #9DA0A4;
    -moz-opacity:0.6;
    opacity: 0.6;
    
</style>