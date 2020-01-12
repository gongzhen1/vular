<template>
  <v-data-table
      v-model="selected"
      :items="items"
      v-bind="schema.props"
      :pagination.sync="pagination"
      :total-items="totalItems"
      :loading="loading"
      :headers="schema.columns"
  >
  
    <dynamic-component v-if="schema.progress_bar" slot="progress" :schema="schema.progress_bar" />
    <template slot="items" slot-scope="slotProps">
      <td>
        <v-checkbox
          v-model="slotProps.selected"
          primary
          hide-details
        ></v-checkbox>
      </td>
      <template v-for="(column,i) in schema.columns" >
        <td v-if="typeof(slotProps.item[column.value])=='object' && slotProps.item[column.value].controls" :key='i' v-bind="slotProps.item[column.value].props">
          <template v-for="(com,ii) in slotProps.item[column.value].controls">
            <dynamic-component :schema="com" :key="ii"></dynamic-component>
          </template>
        </td>
        <td v-else-if="typeof(slotProps.item[column.value])=='object'" :key='i' v-bind="slotProps.item[column.value].props">
          {{ slotProps.item[column.value].content}}
        </td>
        <td v-else :key='i'>{{ slotProps.item[column.value]}}</td>
      </template>
    </template>
  </v-data-table>
</template>
<script>
import tableData from '@/test-data/tableData';

export default {
  name: 'vular-data-table',
  props:{schema:Object},
  data: function () {
    return{
      pagination: this.schema.pagination,
      totalItems:0,
      loading:false,
      selected:[],
      items:tableData,
      //filter:{},
      //keywords:'',
    }
  },

  watch: {
    pagination: {
      vularIdr () {
        //this.getDataFromApi()
        //  .then(data => {
        //    this.desserts = data.items
        //    this.totalDesserts = data.total
        //  })
        this.totalItems = 100;
      },
      deep: true
    }
  },
}
</script>