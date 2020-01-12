<template>
  <vular-dialog v-if="schema.name=='vular-dialog'" :schema="schema" v-model="inputValue[schema.field]">
  </vular-dialog>
  <v-toolbar-side-icon v-else-if="schema.name=='v-toolbar-side-icon'" @click="commitEvent(schema.click)"></v-toolbar-side-icon>
  <component v-else-if="schema.name=='vular-form' || schema.name=='vular-interactive-component' || schema.name=='vular-drawer' || schema.name=='vular-drawer-toolbar'"  :is="schema.name" :schema="schema" v-model="schema.model">
    <template v-for="(com,i) in schema.children">
      <dynamic-component :schema="com" :key="i"  v-model="schema.model"></dynamic-component>
    </template>
  </component>
  <vular-data-table v-else-if="schema.name=='vular-data-table'" :schema="schema" v-model="inputValue" >
  </vular-data-table>
  <component v-else-if="schema.name=='v-text-field' || schema.name=='v-textarea'" :is="schema.name" v-bind="schema.props" v-model="inputValue[schema.field]" @keyup.enter="commitEvent(schema.keyup_enter)" >
  </component>
  <component v-else-if="schema.name=='v-breadcrumbs'"  :items="schema.items" :is="schema.name"  v-bind="schema.props">
    </component>
  <component v-else-if="schema.name=='v-combobox' || schema.name=='v-select'"  
    :items="schema.items" :is="schema.name"  v-model="inputValue[schema.field]" v-bind="schema.props">
  </component>
  <component v-else-if="schema.children" :is="schema.name" v-bind="schema.props" @click="commitEvent(schema.click)">
    <template v-for="(com,i) in schema.children">
      <dynamic-component v-if="com.slot == 'activator'" slot="activator"  :schema="com" :key="i"  v-model="inputValue"></dynamic-component>
      <dynamic-component v-else-if="com.slot == 'badge'" slot="badge"  :schema="com"  :key="i" v-model="inputValue"></dynamic-component>
      <dynamic-component v-else :schema="com" :key="i" v-model="inputValue"></dynamic-component>
    </template>
  </component>
  <component v-else-if="schema.v_html" v-bind:is="schema.name"  v-bind="schema.props" @click="commitEvent(schema.click)" v-html="schema.v_html">
    {{schema.content}}
  </component>
  <component v-else-if="schema.rules" :rules="schema.rules" v-bind:is="schema.name"  v-bind="schema.props" @click="commitEvent(schema.click)" @keyup.enter="commitEvent(schema.keyup_enter)">
    {{schema.content}}
  </component>
  <component v-else v-bind:is="schema.name" :key="schema.name" :schema="schema" v-bind="schema.props" @click="commitEvent(schema.click)" @keyup.enter="commitEvent(schema.keyup_enter)">
    {{schema.content}}
  </component>
</template>

<script>

export default {
  name: 'dynamic-component',
  props:['schema','value'],
  data: function () {
    return {
    }
  },

  computed:{
    inputValue: {
        get:function() {
          if(this.value){
            return this.value;
          }
          return {};//防止空值异常
        },
        set:function(val) {
          this.$emit('input', val);
        },
    },
  },

  methods: {
    commitEvent (pageAction) {
      //if(pageAction){
      //   this.$store.dispatch('doPageAction', pageAction);
      //}
      if(pageAction){
        this.$bus.$emit(pageAction.event, pageAction.args);
      }
    },
  },
}
</script>
