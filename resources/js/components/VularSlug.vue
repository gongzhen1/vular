<template>
  <v-text-field 
    v-model="inputValue"
    :appendOuterIcon = 'appendOuterIcon'
    :appendOuterIconCb = 'appendOuterIconCb'
    :autofocus = 'autofocus'
    :box = 'box'
    :browserAutocomplete = 'browserAutocomplete'
    :clearable = 'clearable'
    :clearIcon = 'clearIcon'
    :clearIconCb = 'clearIconCb'
    :color = 'color'
    :counter ='counter'
    :flat ='flat'
    :fullWidth = 'fullWidth'
    :label = 'label'
    :outline = 'outline'
    :placeholder = 'placeholder'
    :prefix = 'prefix'
    :prependInnerIcon = 'prependInnerIcon'
    :prependInnerIconCb = 'prependInnerIconCb'
    :reverse = 'reverse'
    :singleLine = 'singleLine'
    :solo = 'solo'
    :soloInverted = 'soloInverted'
    :suffix = 'suffix'
    :type = 'type'
    @blur = 'blur'
  ></v-text-field>
</template>

<script>
export default {
  name: 'vular-slug',
  props:{
    value:String,    
    appendOuterIcon: String,
    /** @deprecated */
    appendOuterIconCb: Function,
    autofocus: Boolean,
    box: Boolean,
    browserAutocomplete: String,
    clearable: Boolean,
    clearIcon: {
      type: String,
      default: '$vuetify.icons.clear'
    },
    clearIconCb: Function,
    color: {
      type: String,
      default: 'primary'
    },
    counter: [Boolean, Number, String],
    flat: Boolean,
    fullWidth: Boolean,
    label: String,
    outline: Boolean,
    placeholder: String,
    prefix: String,
    prependInnerIcon: String,
    /** @deprecated */
    prependInnerIconCb: Function,
    reverse: Boolean,
    singleLine: Boolean,
    solo: Boolean,
    soloInverted: Boolean,
    suffix: String,
    type: {
      type: String,
      default: 'text'
    }
  },
  computed:{
    inputValue: {
        get:function() {
            return this.value;
        },
        set:function(val) {
          this.$emit('input', val);
        },
    },
  },
  methods: {
    blur:function(event){
      this.inputValue = this.trimToSlug(this.inputValue)
    },

    trimToSlug:function(str){
      str = str.replace(/[^a-z0-9]+/gi,'-').toLowerCase()
      return str;
    },
  }  
};
</script>
