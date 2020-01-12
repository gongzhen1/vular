<template>
  <v-card class="elevation-1">
    <slot name="header"></slot>
    <v-divider></v-divider>
    <v-data-table
        v-model="selected"
        :items="items"
        :select-all='selectAll'
        :pagination.sync="pagination"
        :total-items="totalItems"
        :rowsPerPage = "pagination.rowsPerPage"
        :headers="columns"
        :loading="loading"
        :noResultsText = "noResultsText"
        :noDataText = "noDataText"
    >
    
      <template slot="items" slot-scope="slotProps">
        <td>
          <v-checkbox
            v-model="slotProps.selected"
            primary
            hide-details
          ></v-checkbox>
        </td>
        <template v-for="(column,i) in columns" >
          <td v-if="slotProps.item[column.value] && typeof(slotProps.item[column.value])=='object' && slotProps.item[column.value].children" :key='i' :class="slotProps.item[column.value]['class']" :style="slotProps.item[column.value]['style']" v-bind="slotProps.item[column.value].props">
            <template v-for="(com,ii) in slotProps.item[column.value].children">
              {{com.text}}
              <vular-node :schema="com" :key="ii"></vular-node>
            </template>
          </td>
          <td v-else-if="slotProps.item[column.value] && typeof(slotProps.item[column.value])=='object'" :key='i' :class="slotProps.item[column.value]['class']" :style="slotProps.item[column.value]['style']" v-bind="slotProps.item[column.value].props">
            {{slotProps.item[column.value].text}}
          </td>
          <td v-else :key='i'>{{ slotProps.item[column.value]}}</td>
        </template>
      </template>
    </v-data-table>
    </v-card>
</template>
<script>
export default {
  name: 'vular-data-table',
  props:{
    //progressBar:Object,
    columns: {
      type: Array,
      default: () => []
    },
    selectAll:Boolean,
    rowsPerPageText: {
      type: String,
      default: '$vuetify.dataTable.rowsPerPageText'
    },
    //totalItems: {
    //  type: Number,
    //  default: null
    //},
    itemKey: {
      type: String,
      default: 'id'
    },
    //rowsPerPage:Number,
    //viewModel:Object,
    owner:String,
    //page:Number,
    pageId:String,
    fetch:String,
    noResultsText:String,
    noDataText:String,
    viewModel:Object,
    vularId:String,
  },
  data: function () {
    return{
      selected:[],
      pagination: this.viewModel.pagination,
      loaded:false,
      items:[],
      totalItems:0,
      apiUrl:host + 'action/' + this.pageId + "/",
      loading: false,
      model:this.viewModel,
    }
  },
  computed:{
  },
  watch: {
    pagination: {
      handler () {
        if(this.loaded){
          this.model.pagination = this.pagination;
          this.model.page = this.pagination.page;
          //console.log(this.pagination.descending,this.pagination.sortBy);
          this.getDataFromApi()
        }
        else{
          this.loaded = true;
        }
      },
      deep: true
    }
  },
  mounted () {
    this.getDataFromApi()
  },

  destroyed() {
    //console.log(this.vularId);
    $bus.$off('reload',this.reload)
    $bus.$off('input', this.input)
    $bus.$off('vularAction',this.vularAction)
  },

  created () {
    const self = this;
          //console.log(self)
    $bus.$on('reload',this.reload)
    $bus.$on('input', this.input)
    $bus.$on('vularAction',this.vularAction)
  },

  methods: {

    reload(vularId) {
      const self = this;
      if(self.vularId === vularId){
        self.getDataFromApi()
      }
    },

    input (event) {
      const self = this;
      var {value, owner, field} = event
      //console.log(owner, self.vularId)
      if(owner == self.vularId){
        self.model[field] = value
        //console.log(field, value)
      }
    },

    vularAction (event) {
      const self = this;
      if(event.owner === self.vularId){

        if(event.confirm && !confirm(event.confirm)){
          return;
        }

        if(event.action === 'reload'){
          self.getDataFromApi();
        }
        else{
          self.extractSelecteIds()
          self.model.params = event.params
          self.load(self.apiUrl + event.action  + "/" + self.vularId);
        }

      }
    },

    extractSelecteIds(){
      this.model.selected = []

      for(var i = 0; i < this.selected.length; i++){
        this.model.selected.push(this.selected[i].id)
      }

    },

    load(actionUrl){
      const self = this;
      self.loading = true

       //console.log(actionUrl)
      axios.post(actionUrl, self.model).then(
        (response)=> {
          //console.log(response.data)
          //self.emitEvents(response.data.beforeEvents)
          self.items = self.pagination.rowsPerPage == -1 ? response.data : response.data.data
          //console.log(self.items[0].description.children)
          self.totalItems = response&&response.data?response.data.total:{}
          self.loading = false
          self.model.selected = []
        },
        error=>{
          //$bus.$emit('finished');
          self.loading = false;

          $bus.$emit('error', error.message);
        }
      )


    },

    getDataFromApi () {
      this.load(this.apiUrl + this.fetch + "/" + this.vularId)
    },
  }
  
}
</script>