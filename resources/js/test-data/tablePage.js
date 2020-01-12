import tableData from './tableData';

const tablePage =  {
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
        class:"align-center",
        props:{
          row:true,
        },
        children:[
          {
            name:'v-icon',
            props: {
              'small':true,
            },
            children:[
              {
                text:'home',
              }
            ],
            
          },
          {
            name:'v-breadcrumbs',
            props:{
              divider:'-',
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
          },
          {
            name:'v-spacer',
          },
        ],
      },
      {
        phpclass:'water-bobo_mall-products_list',
        name:'vular-interactive-component',
        model:{
          vularId:'tb00001',
          'pagination': {
            rowsPerPage:10,
          },
          keywords:'搜我呀',
          totalItems:0,
          loading:false,
          selected:[],
          output:tableData,
        },
        children:[
          {
            name:'v-layout',
            'class':'pb-2 align-center',
            props:{
              wrap:true,
              row:true,
            },
            children:[
              {
                name:'h3',
                style:'font-weight: 300; font-size: 20px;',
                props:{
                },
                children:[
                  {
                    text:'Mall产品列表',
                  }
                ],
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
                on:{
                  click:{
                    event:'toPage',
                    args:{ pageid:'form',},
                  }
                },
                
                children:[
                  {
                    name:'v-icon',
                    props:{
                      left:true,
                      dark:true,
                    },
                    children:[
                      {
                        text:'add',
                      }
                    ]
                  },
                  {
                    text:'Add new',
                  },
                ],
              },
            ],
          },
          {
            name:'v-card',
            'class':'elevation-1',
            props:{
            },
            children:[
              {
                name:'v-card-title',
                'class':"pa-1",
                props:{
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
                            children:[
                              {
                                text:'批量操作',
                              }
                            ]
                          },
                          {
                            name:'v-icon',
                            props:{
                              right:true,
                              dark:true,
                            },
                            children:[
                              {
                                text:'arrow_drop_down',
                              }
                            ]
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
                                    children:[
                                      {
                                        text:'delete_outline',
                                      }
                                    ]
                                  },
                                ],
                              },
                              {
                                name:'v-list-tile-title',
                                  children:[
                                    {
                                      text:'删除',
                                    }
                                  ]
                              },

                            ],
                          },
                        ],
                      },
                    ],
                  },
                  {
                    name:'div',
                    'style':"width: 300px;",
                    props:{
                    },
                    children:[
                      {
                        name:'v-text-field',
                        field:'keywords',
                        keyup:{
                          keycode:'13',
                          event:'pageAction', 
                          args:{
                            vularId:'tb00001',//页面标识
                          },
                        },
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
                        
                        children:[
                          {
                            text:'Filter By:',
                          }
                        ]
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
                                
                                children:[
                                  {
                                    text:'All ',
                                  }
                                ]
                              },
                              {
                                name:'v-icon',
                                props:{
                                  right:true,
                                  dark:true,
                                },
                                children:[
                                  {
                                    text:'arrow_drop_down',
                                  }
                                ]
                                
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
                                    children:[
                                      {
                                        text:'哈哈',
                                      }
                                    ]
                                    
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
                'class':"elevation-1",
                props:{
                  'item-key':"id",
                  'select-all':true,
                  'rows-per-page-items':[ 5,10, 15, 25, { "text": "$vuetify.dataIterator.rowsPerPageAll", "value": -1 } ],
                  'progress-bar':{
                    name:'v-progress-linear',
                    slot:"progress",
                    props:{
                       color:"blue",
                       indeterminate:true,
                    },
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
                },
                //progress_bar:
                children:[
                  //{
                  //  name:'v-progress-linear',
                  //  slot:"progress",
                  //  props:{
                  //     color:"blue",
                  //     indeterminate:true,
                  //  },
                  //},

                ],
              },
            ],
          },
        ],
      },
    ],
  },

}

export default tablePage;
