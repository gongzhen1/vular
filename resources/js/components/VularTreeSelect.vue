<template>

  <v-card :tile='tile' :flat='flat'>
    <v-toolbar
      card
      dense
      :color="labelColor"
      v-if="label"
    >
      {{label}}
    </v-toolbar>

    <v-card-text>
      <v-treeview
        v-model="inputValue"
        :items="items"
        :activatable = 'activatable'
        :active = 'active'
        :activeClass="activeClass"
        :dark = "dark"
        :expandIcon = 'expandIcon'
        :hoverable = 'hoverable'
        :indeterminateIcon = 'indeterminateIcon'
        :itemChildren="itemChildren"
        :itemKey = 'itemKey'
        :itemText = 'itemText'
        :light = 'light'
        :loadChildren = 'loadChildren'
        :multipleActive = 'multipleActive'
        :offIcon="offIcon"
        :onIcon="onIcon"
        :open = "open"
        :openAll = "openAll"
        :openOnClick ="openOnClick"
        :selectable = 'selectable'
        :selectedColor = 'selectedColor'
        :transition = 'transition'
      >

        <template slot="prepend" slot-scope="{ item, open, leaf }">
          <v-icon :color="nodeIconColor" v-if="item[itemChildren] && item[itemChildren].length >0">
            {{ open ? openIcon : closeIcon }}
          </v-icon>
          <v-icon :color="leafIconColor" v-else>
            {{leafIcon}}
          </v-icon>
        </template>
      </v-treeview>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: 'vular-tree-select',
  props: {
    activatable:{
      type:Boolean,
      default:false
    },
    active: {
      type: Array,
      default: () => ([])
    },
    activeClass: {
      type:String,
      default:'v-treeview-node--active'
    },

    dark: {
      type: Boolean,
      default: null
    },

    expandIcon: {
      type:String,
      default:'$vuetify.icons.subgroup'
    },

    hoverable: Boolean,

    indeterminateIcon:{
      type:String,
      default:'indeterminate_check_box'
    },

    itemChildren:{
      type:String,
      default:'children'
    },

    itemKey:{
      type:String,
      default:'id'
    },

    itemText:{
      type:String,
      default:'name'
    },

    items: {
      type: Array,
      default: () => ([])
    },

    light: {
      type: Boolean,
      default: null
    },
    loadChildren:{
      type:String,
      default:null
    },
    multipleActive: Boolean,
    offIcon:{
      type:String,
      default:'check_box_outline_blank'
    },
    onIcon:{
      type:String,
      default:'check_box'
    },
    open: {
      type: Array,
      default: () => ([])
    },
    openAll: Boolean,
    openOnClick: Boolean,
    selectable: {
      type:Boolean,
      default:false
    },
    selectedColor: {
      type : String,
      default:'indigo'
    },
    transition: Boolean,

    flat:Boolean,
    tile:{
      type:Boolean,
      default:true
    },
    label:String,
    labelColor:{
      type:String,
      default:'grey lighten-3'
    },
    leafIcon:{
      type:String,
      default:'vpn_key'
    },
    leafIconColor:{
      type:String,
      default:'orange'
    },
    nodeIconColor:String,
    openIcon:{
      type:String,
      default:'folder_open'
    },
    closeIcon:{
      type:String,
      default:'folder'
    },
    value: {
      type: Array,
      default: () => ([])
    },
  },
  data: () => ({
    selectedItems:null,
  }),

  created () {
      this.init();
  },

  computed:{
    inputValue: {
        get:function() {
            return this.selectedItems;
        },
        set:function(val) {
          this.$emit('input', val);
        },
    },
  },
  methods: {
    init(){
      this.selectedItems = [];
      for (var i = 0; i < this.value.length; i++) {
        var item = typeof(this.value[i])=='object'  ? this.value[i][this.itemKey] : this.value[i]
        this.selectedItems.push(item) 
        //console.log(typeof(this.value[i]), this.value[i][this.itemKey])
      }
    }    
  },

  watch: {
    value(){
      this.init();
    }
  },  

}
</script>

