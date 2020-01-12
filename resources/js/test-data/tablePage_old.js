const tablePage =  {
  vularId:'p05435325350',//Page唯一标识
  entry:{
    pageid:'datatable',
    params:{
    },
    method:'get',
  },
  schema:{
    name:'v-container',
    children:[
      {
        name:'v-layout',
        props:{
          row:true,
          class:"align-center",
        },
        children:[
          {
            name:'v-icon',
            props: {
                'small':true,
            },
            content:'home',
          },
          {
            name:'v-breadcrumbs',
            props:{
              divider:'-'
            },
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
          },
          {
            name:'v-spacer',
          },
        ],
      },
      {
        name:'v-layout',
        props:{
          wrap:true,
          row:true,
          'class':'pb-2 align-center',
        },
        children:[
          {
            name:'h3',
            props:{
              style:'font-weight: 300; font-size: 20px;',
            },
            content:'Mall产品列表',
          },
          {
            name:'v-spacer',
          },
          {
            name:'v-btn',
            props:{
              round:true,
              large:true,
              color:"primary",
              dark:true,
              class:"mb-2",
            },

            click:{
              load_page:{
                pageid:'form',
                params:{},
              },
            },
            
            children:[
              {
                name:'v-icon',
                props:{
                  left:true,
                  dark:true,
                },
                content:'add',
              },
              {
                name:'span',
                content:'Add new',
              },
            ],
          },
        ],
      },
      {
        name:'v-card',
        props:{
          'class':'elevation-1',
        },
        children:[
          {
            name:'v-card-title',
            props:{
              'class':"pa-1",
            },
            children:[
              {
                name:'v-menu',
                props:{
                  'offset-y':true,
                },
                children:[
                  {
                    name:'v-btn',
                    slot:"activator",
                    props:{
                      flat:true,
                    },
                    children:[
                      {
                        name:'span',
                        content:'批量操作',
                      },
                      {
                        name:'v-icon',
                        props:{
                          right:true,
                          dark:true,
                        },
                        content:'arrow_drop_down',
                      },
                    ],
                  },
                  {
                    name:'v-list',
                    children:[
                      {
                        name:'v-list-tile',
                        click:'ddd',
                        children:[
                          {
                            name:'v-list-tile-action',
                            children:[
                              {
                                name:'v-icon',
                                content:'delete_outline',
                              },
                            ],
                          },
                          {
                            name:'v-list-tile-title',
                            content:'删除',
                          },

                        ],
                      },
                    ],
                  },
                ],
              },
              {
                name:'div',
                props:{
                  'style':"width: 300px;",
                },
                children:[
                  {
                    name:'v-text-field',
                    props:{
                      'append-icon':'search',
                      'placeholder':"Search...",
                    },
                  },
                ],
              },
              {
                name:'v-spacer',
              },
              {
                name:'div',
                children:[
                  {
                    name:'span',
                    content:'Filter By:',
                  },
                  {
                    name:"v-menu",
                    props:{
                      'offset-y':true,
                      'close-on-content-click':false,
                    },
                    children:[
                      {
                        name:'v-btn',
                        slot:"activator",
                        props:{
                          flat:true,
                        },
                        children:[
                          {
                            name:'span',
                            content:'All ',
                          },
                          {
                            name:'v-icon',
                            props:{
                              right:true,
                              dark:true,
                            },
                            content:'arrow_drop_down',
                          },
                        ],
                      },
                      {
                        name:'v-list',
                        children:[
                          {
                            name:'v-list-tile',
                            click:'##',
                            children:[
                              {
                                name:'v-list-tile-title',
                                content:'哈哈',
                              },
                            ],
                          },
                        ],
                      },
                    ],
                  },
                ],
              },
            ],
          },
          {
            name:'v-divider',
          },
          {
            name:'vular-data-table',
            props:{
              'item-key':"id",
              'select-all':true,
              'class':"elevation-1",
              'rows-per-page-items':[ 5,10, 15, 25, { "text": "$vuetify.dataIterator.rowsPerPageAll", "value": -1 } ],
            },
            columns:[
              {
                text: 'Dessert (100g serving)',
                align: 'left',
                sortable: false,
                value: 'name'
              },
              { text: 'Calories', value: 'calories',props:{'class':'text-xs-right'}, },
              { text: 'Fat (g)', value: 'fat',props:{'class':'text-xs-right'}, },
              { text: 'Carbs (g)', value: 'carbs',},
              { text: 'Protein (g)', value: 'protein' ,
                props:{'class':'text-xs-right'},
              },
              { text: 'Iron', value: 'iron',},
              { text: 'Actions', value:'actions', sortable: false,},
            ],
            'pagination': {
              rowsPerPage:10,
            },
            /*progress_bar:{
              name:'v-progress-linear',
              slot:"progress",
              props:{
                 color:"blue",
                 indeterminate:true,
              },
            },*/
            children:[
              /*{
                name:'v-progress-linear',
                slot:"progress",
                props:{
                   color:"blue",
                   indeterminate:true,
                },
              },*/

            ],
          },
        ],
      },
    ],
   },

}

export default tablePage;
