<template>
    
        <v-container>
            <v-layout row class="align-center">
                
                <v-icon small>home</v-icon>
                <v-breadcrumbs :items="items" divider="-">
                </v-breadcrumbs>
                <v-spacer></v-spacer>


            </v-layout>

            <v-layout row wrap class="pb-2 align-center">
                <h3 style="font-weight: 300; font-size: 20px;">产品列表</h3>
                <v-spacer></v-spacer>
 
                  <v-dialog v-model="dialog" max-width="500px">
                    <v-btn round large slot="activator" color="primary" dark class="mb-2"><v-icon left dark>add</v-icon>添加</v-btn>
                    <v-card>
                      <v-card-title>
                        <span class="headline">{{ formTitle }}</span>
                      </v-card-title>

                      <v-card-text>
                        <v-container grid-list-md>
                          <v-layout wrap>
                            <v-flex xs12 sm6 md4>
                              <v-text-field v-model="editedItem.name" label="Dessert name"></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md4>
                              <v-text-field v-model="editedItem.calories" label="Calories"></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md4>
                              <v-text-field v-model="editedItem.fat" label="Fat (g)"></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md4>
                              <v-text-field v-model="editedItem.carbs" label="Carbs (g)"></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md4>
                              <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                            </v-flex>
                          </v-layout>
                        </v-container>
                      </v-card-text>

                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" flat @click="save">Save</v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
            </v-layout>

           

                <v-card elevation-1 >
                    <v-card-title class="pa-1">
                        <v-menu offset-y>

                          <v-btn flat slot="activator">
                                批量操作 <v-icon right dark>arrow_drop_down</v-icon>
                            </v-btn>
                          <v-list>
                            <v-list-tile @click="dialog = false">
                              <v-list-tile-action>
                                <v-icon>delete_outline</v-icon>
                              </v-list-tile-action>
                              <v-list-tile-title>删除</v-list-tile-title>
                            </v-list-tile>
                          </v-list>
                        </v-menu>
                        <div style="width: 300px;">                   
                            <v-text-field 
                                append-icon="search"
                              placeholder="Search..."
                              
                            ></v-text-field>
                        </div> 
                        <v-spacer></v-spacer>                   
                        <div> 
                            筛选： 
                            <v-menu offset-y >

                              <v-btn flat slot="activator">
                                    All <v-icon right dark>arrow_drop_down</v-icon>
                                </v-btn>
                              <v-list>
                                <v-list-tile @click="dialog = false">
                                 
                                  <v-list-tile-title>哈哈</v-list-tile-title>
                                </v-list-tile>
                              </v-list>
                            </v-menu>                   
                        </div>
                    </v-card-title>
                    <v-divider></v-divider>
                        <v-data-table
                            v-model="selected"
                            :headers="headers"
                            :items="desserts"
                            item-key="id"
                            select-all
                            class="elevation-1"
                            :pagination.sync="pagination"
                            :total-items="totalDesserts"
                            :loading="loading"

                        >
                        <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                        <template slot="items" slot-scope="props">
                          <td>
                            <v-checkbox
                              v-model="props.selected"
                              primary
                              hide-details
                            ></v-checkbox>
                          </td>
                          <td>{{ props.item.name }}</td>
                          <td class="text-xs-right">{{ props.item.calories }}</td>
                          <td class="text-xs-right">{{ props.item.fat }}</td>
                          <td class="text-xs-right">{{ props.item.carbs }}</td>
                          <td class="text-xs-right">{{ props.item.protein }}</td>

                            <td class="justify-center layout px-0">
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
                      </v-data-table>


                </v-card>

        </v-container>
   

</template>

<script>

export default {
    name: 'table-page',
    props:['schema'],

    data: () => ({
        items: [
            {
              text: 'Dashboard',
              disabled: false,
              href: 'breadcrumbs_dashboard'
            },
            {
              text: 'Link 1',
              disabled: false,
              href: 'breadcrumbs_link_1'
            },
            {
              text: 'Link 2',
              disabled: true,
              href: 'breadcrumbs_link_2'
            }
        ],

      dialog: false,
      headers: [
        {
          text: 'Dessert (100g serving)',
          align: 'left',
          sortable: false,
          value: 'name'
        },
        { text: 'Calories', value: 'calories' },
        { text: 'Fat (g)', value: 'fat' },
        { text: 'Carbs (g)', value: 'carbs' },
        { text: 'Protein (g)', value: 'protein' },
        { text: 'Actions', value: 'name', sortable: false }
      ],
        totalDesserts: 0,
        desserts: [],
        loading: true,
        pagination: {
            rowsPerPage:10,
        },
        selected: [],
      editedIndex: -1,
      editedItem: {
        name: '',
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0
      },
      defaultItem: {
        name: '',
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0
      },

        opitems: [
          'Programming',
          'Design',
          'Vue',
          'Vuetify'
        ]

    }),


    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      }
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      pagination: {
        vularIdr () {
          this.getDataFromApi()
            .then(data => {
              this.desserts = data.items
              this.totalDesserts = data.total
            })
        },
        deep: true
      }

    },

    created () {
      //this.initialize()
    },

    mounted () {
      this.getDataFromApi()
        .then(data => {
          this.desserts = data.items
          this.totalDesserts = data.total
        })
    },

    methods: {
      getDataFromApi () {
        this.loading = true
        return new Promise((resolve, reject) => {
          const { sortBy, descending, page, rowsPerPage } = this.pagination

          let items = this.getDesserts()
          const total = items.length

          if (this.pagination.sortBy) {
            items = items.sort((a, b) => {
              const sortA = a[sortBy]
              const sortB = b[sortBy]

              if (descending) {
                if (sortA < sortB) return 1
                if (sortA > sortB) return -1
                return 0
              } else {
                if (sortA < sortB) return -1
                if (sortA > sortB) return 1
                return 0
              }
            })
          }

          if (rowsPerPage > 0) {
            items = items.slice((page - 1) * rowsPerPage, page * rowsPerPage)
          }

          setTimeout(() => {
            this.loading = false
            resolve({
              items,
              total
            })
          }, 1000)
        })
      },

      getDesserts () {
        return [
          {
            id:1,
            value: false,
            name: 'Frozen Yogurt',
            calories: 159,
            fat: 6.0,
            carbs: 24,
            protein: 4.0,
            iron: '1%'
          },
          {
            id:2,
            value: false,
            name: 'Ice cream sandwich',
            calories: 237,
            fat: 9.0,
            carbs: 37,
            protein: 4.3,
            iron: '1%'
          },
          {
            id:3,
            value: false,
            name: 'Eclair',
            calories: 262,
            fat: 16.0,
            carbs: 23,
            protein: 6.0,
            iron: '7%'
          },
          {
            id:4,
            value: false,
            name: 'Cupcake',
            calories: 305,
            fat: 3.7,
            carbs: 67,
            protein: 4.3,
            iron: '8%'
          },
          {
            id:5,
            value: false,
            name: 'Gingerbread',
            calories: 356,
            fat: 16.0,
            carbs: 49,
            protein: 3.9,
            iron: '16%'
          },
          {
            id:6,
            value: false,
            name: 'Jelly bean',
            calories: 375,
            fat: 0.0,
            carbs: 94,
            protein: 0.0,
            iron: '0%'
          },
          {
            id:7,
            value: false,
            name: 'Ice cream sandwich',
            calories: 237,
            fat: 9.0,
            carbs: 37,
            protein: 4.3,
            iron: '1%'
          },
          {
            id:8,
            value: false,
            name: 'Eclair',
            calories: 262,
            fat: 16.0,
            carbs: 23,
            protein: 6.0,
            iron: '7%'
          },
          {
            id:9,
            value: false,
            name: 'Cupcake',
            calories: 305,
            fat: 3.7,
            carbs: 67,
            protein: 4.3,
            iron: '8%'
          },
          {
            id:10,
            value: false,
            name: 'Gingerbread',
            calories: 356,
            fat: 16.0,
            carbs: 49,
            protein: 3.9,
            iron: '16%'
          },
          {
            id:11,
            value: false,
            name: 'Jelly bean',
            calories: 375,
            fat: 0.0,
            carbs: 94,
            protein: 0.0,
            iron: '0%'
          },
          {
            id:12,
            value: false,
            name: 'Ice cream sandwich',
            calories: 237,
            fat: 9.0,
            carbs: 37,
            protein: 4.3,
            iron: '1%'
          },
          {
            id:13,
            value: false,
            name: 'Eclair',
            calories: 262,
            fat: 16.0,
            carbs: 23,
            protein: 6.0,
            iron: '7%'
          },
          {
            id:14,
            value: false,
            name: 'Cupcake',
            calories: 305,
            fat: 3.7,
            carbs: 67,
            protein: 4.3,
            iron: '8%'
          },
          {
            id:15,
            value: false,
            name: 'Gingerbread',
            calories: 356,
            fat: 16.0,
            carbs: 49,
            protein: 3.9,
            iron: '16%'
          },
          {
            id:16,
            value: false,
            name: 'Jelly bean',
            calories: 375,
            fat: 0.0,
            carbs: 94,
            protein: 0.0,
            iron: '0%'
          },
          {
            id:17,
            value: false,
            name: 'Ice cream sandwich',
            calories: 237,
            fat: 9.0,
            carbs: 37,
            protein: 4.3,
            iron: '1%'
          },
          {
            id:18,
            value: false,
            name: 'Eclair',
            calories: 262,
            fat: 16.0,
            carbs: 23,
            protein: 6.0,
            iron: '7%'
          },
          {
            id:19,
            value: false,
            name: 'Cupcake',
            calories: 305,
            fat: 3.7,
            carbs: 67,
            protein: 4.3,
            iron: '8%'
          },
          {
            id:20,
            value: false,
            name: 'Gingerbread',
            calories: 356,
            fat: 16.0,
            carbs: 49,
            protein: 3.9,
            iron: '16%'
          },
          {
            id:21,
            value: false,
            name: 'Jelly bean',
            calories: 375,
            fat: 0.0,
            carbs: 94,
            protein: 0.0,
            iron: '0%'
          },
          {
            id:22,
            value: false,
            name: 'Ice cream sandwich',
            calories: 237,
            fat: 9.0,
            carbs: 37,
            protein: 4.3,
            iron: '1%'
          },
          {
            id:23,
            value: false,
            name: 'Eclair',
            calories: 262,
            fat: 16.0,
            carbs: 23,
            protein: 6.0,
            iron: '7%'
          },
          {
            id:24,
            value: false,
            name: 'Cupcake',
            calories: 305,
            fat: 3.7,
            carbs: 67,
            protein: 4.3,
            iron: '8%'
          },
          {
            id:25,
            value: false,
            name: 'Gingerbread',
            calories: 356,
            fat: 16.0,
            carbs: 49,
            protein: 3.9,
            iron: '16%'
          },
          {
            id:26,
            value: false,
            name: 'Jelly bean',
            calories: 375,
            fat: 0.0,
            carbs: 94,
            protein: 0.0,
            iron: '0%'
          },
          {
            id:27,
            value: false,
            name: 'Ice cream sandwich',
            calories: 237,
            fat: 9.0,
            carbs: 37,
            protein: 4.3,
            iron: '1%'
          },
          {
            id:28,
            value: false,
            name: 'Eclair',
            calories: 262,
            fat: 16.0,
            carbs: 23,
            protein: 6.0,
            iron: '7%'
          },
          {
            id:29,
            value: false,
            name: 'Cupcake',
            calories: 305,
            fat: 3.7,
            carbs: 67,
            protein: 4.3,
            iron: '8%'
          },
          {
            id:30,
            value: false,
            name: 'Gingerbread',
            calories: 356,
            fat: 16.0,
            carbs: 49,
            protein: 3.9,
            iron: '16%'
          },
          {
            id:31,
            value: false,
            name: 'Jelly bean',
            calories: 375,
            fat: 0.0,
            carbs: 94,
            protein: 0.0,
            iron: '0%'
          },
          {
            id:32,
            value: false,
            name: 'Lollipop',
            calories: 392,
            fat: 0.2,
            carbs: 98,
            protein: 0,
            iron: '2%'
          },
          {
            id:33,
            value: false,
            name: 'Honeycomb',
            calories: 408,
            fat: 3.2,
            carbs: 87,
            protein: 6.5,
            iron: '45%'
          },
          {
            id:34,
            value: false,
            name: 'Donut',
            calories: 452,
            fat: 25.0,
            carbs: 51,
            protein: 4.9,
            iron: '22%'
          },
          {
            id:35,
            value: false,
            name: 'KitKat',
            calories: 518,
            fat: 26.0,
            carbs: 65,
            protein: 7,
            iron: '6%'
          }
        ]
      },      
      editItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.desserts.indexOf(item)
        confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
      },

      close () {
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.desserts[this.editedIndex], this.editedItem)
        } else {
          this.desserts.push(this.editedItem)
        }
        this.close()
      }
    }


};
</script>
