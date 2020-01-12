<template>
  <v-form ref="form" 
    v-model="valid"
    lazy-validation>
    <v-toolbar flat light>
      <v-toolbar-title>{{title}}</v-toolbar-title>

      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" :max-width="editDialogWidth">
        <v-btn slot="activator" color="primary" round dark class="mb-2"><v-icon>add</v-icon> {{$t('table.add-new')}}</v-btn>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>

          <v-card-text v-if="dialog">
            
              <v-layout row wrap>
                <v-flex v-for="(flex,i) in flexs" :class="flex.class" :key="i">
                  <component v-bind:is="flex.field.name" v-bind="flex.field.props" :rules="transRules(flex.field.rules)" v-model="editedItem[flex.field.field]">
                  </component>
                </v-flex>
              </v-layout>
            
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="close">{{$t('table.cancel')}}</v-btn>
            <v-btn color="blue darken-1" flat @click="save">{{$t('table.save')}}</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-toolbar>
    <v-data-table
      :headers="fields"
      :items="items"
      class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td v-for="(column,i) in fields" v-if="i < fields.length -1 ">{{ props.item[column.field] }}</td>
        <td v-else class="justify-center layout pt-3">
          <v-icon
            small
            class="mr-2"
            @click="editItem(props.item)"
          >
            edit
          </v-icon>
          <v-icon
            small
            @click="deleteItem(props.item)"
          >
            delete
          </v-icon>
        </td>
      </template>
      <template slot="no-data">
        no data
      </template>
    </v-data-table>

  </v-form>
</template>

<script>
export default {
  name: 'vular-has-many-table',
  props:{
    flexs:Array,
    title:String,
    editDialogWidth:String,
    value:Array,
    owner:String,
    newTitle:String,
    editTitle:String,
  },

  data: function () {
    return {
      valid: false,
      fields:[],
      items:this.value,
      dialog: false,
      desserts: [],
      editedIndex: -1,
      editedItem: {
      },
      defaultItem: {
      }
    }
  },

  computed: {
      formTitle () {
        return this.editedIndex === -1 ? this.newTitle : this.editTitle
      }
  },

  watch: {
    dialog (val) {
      val || this.close()
    }
  },

  created () {
    this.initialize()
  },

  methods: {
    transRules(rules){
      if(rules){
        for (var i = 0; i < rules.length; i++) {
          rules[i] = eval(rules[i])
        }
      }

      return rules
    },

    initialize () {
      for(var i = 0; i < this.flexs.length; i++){
        var field =  this.flexs[i].field
        field.sortable = false;
        field.text = field.props.label;
        field.value = field.field;
        this.editedItem[field] = null;
        this.defaultItem[field] = null;
        this.fields.push(field)
      }
      this.fields.push({text:this.$t('table.operate'), value:'operate', sortable:false})
    },

    editItem (item) {
      //this.$refs.form.resetValidation()
      this.editedIndex = this.items.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    deleteItem (item) {
      const index = this.items.indexOf(item)
      confirm(this.$t('table.confirm-delete')) && this.items.splice(index, 1)
    },

    close () {
      this.dialog = false
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      }, 300)
    },

    save () {
      if(!this.$refs.form.validate()){
        return
      }

      if (this.editedIndex > -1) {
        Object.assign(this.items[this.editedIndex], this.editedItem)
      } else {
        this.items.push(this.editedItem)
      }
      this.close()
    }
  },
  
  watch: {
    items: {
      handler(newItems, oldItems) {
         this.$emit('input', newItems);
      },
      //immediate: true,
      deep: true
    }
  }

};
</script>
