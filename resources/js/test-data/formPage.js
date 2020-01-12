import dialog from './dialog';

const formPage =  {
  entry:{
    pageid:'form',
    params:{
    },
    method:'get',
  },
  schema:{
    name:'v-container',
    children:[
      {
        name:'v-layout',
        class:"align-center grid-list-md row",
        props:{
          //row:true,
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
        name:'vular-interactive-component',
        model:{
          vularId:'fm123',
          name:'name test',
          'seometas.title':'Seo Title',
          'seometas.keywords':' Seo Key words',
          'seometas.description':' SEO Description',
          
        },
        children:[
          {
            name:'v-form',
            children:[

              {
                name:"v-layout",
                class:"row wrap pa-2 mt-2",
                style:'height:36px;',
                props:{
                },
                children:[
                  {
                    name:"v-text-field",
                    field:'name',
                    style:"font-size: 30px;",
                    props:{
                      label:"Name" ,
                      required:true,
                    },
                  },
                  {
                    name:'v-spacer',
                  },
                  {
                    name:'v-btn',
                    class:"hidden-sm-and-down",
                    props:{
                      round:true,
                      large:true,
                      light:true,
                    },
                    
                    children:[
                      {
                        text:'Cancel',
                      }
                    ],
                    click:{
                      event:'closePage',
                    }
                  },
                  {
                    name:'v-btn',
                    class:"hidden-sm-and-down",
                    props:{
                      round:true,
                      large:true,
                      light:true,
                      color:'primary',
                    },
                    
                    children:[
                      {
                        text:'Save',
                      }
                    ],
                  },
                  {
                    name:'v-btn',
                    class:"hidden-sm-and-down",
                    props:{
                      fab:true,
                      small:true,
                      light:true,
                    },
                    children:[
                      {
                        name:"v-icon",
                        
                        children:[
                          {
                            text:'more_horiz',
                          }
                        ]
                      }
                    ],
                  },
                ],
              },
              {
                name:'v-layout',
                'class':'row wrap',
                props:{
                  //row:true,
                },
                children:[
                  {
                    name:'v-flex',
                    class:"pa-2 lg8",
                    props:{
                    },
                    children:[
                      {
                        name:'vular-media-select',
                        'class':"mt-5",
                        style:"border-radius:0px;"
                      },
                      {
                        name:"v-card",
                        style:"border-radius:0px;",
                        'class':"mt-5",
                        props:{
                        },
                        children:[
                          {
                            name:'v-toolbar',
                            props:{
                              color:"transparent",
                              flat:true,
                              card:true,
                            },
                            children:[
                              {
                                name:"v-toolbar-title",
                                style:"font-weight: 300;",
                                props:{
                                },
                                
                                children:[
                                  {
                                    text:'基本信息',
                                  }
                                ]
                              },
                            ]
                          },
                          {
                            name:'v-divider',
                          },
                          {
                            name:'v-card-text',
                            children:[
                              {
                                name:'v-layout',
                                'class':"row wrap",
                                props:{
                                },
                                children:[
                                  {
                                    name:'v-flex',
                                    'class':'lg12 pl-3 pr-3 ',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-text-field',
                                        field:'name',
                                        props:{
                                          label:'产品名称 *',
                                          required:true,
                                          //value:'',
                                          rules:[
                                            v => !!v || 'Name is required',
                                            v => v.length <= 50 || '名称必须少于50个字符'
                                          ],
                                        },
                                      },
                                    ],
                                  },
                                  {
                                    name:'v-flex',
                                    'class':'lg12 pl-3 pr-3 ',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-text-field',
                                        props:{
                                          label:'Slug',
                                        },
                                      },
                                    ],
                                  },
                                  {
                                    name:'v-flex',
                                    class:'lg12 pl-3 pr-3 ',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-combobox',
                                        props:{
                                          label:'产品分类',
                                          'multiple':true,
                                          chips:true,
                                          items: [
                                            '甜味剂',
                                            '增稠剂',
                                            'Vue',
                                            'Vuetify'
                                          ],
                                        },
                                      },
                                    ],
                                  },
                                  {
                                    name:'v-flex',
                                    class:'lg12 pl-3 pr-3 ',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-text-field',
                                        props:{
                                          label:'认证信息',
                                        },
                                      },
                                    ],
                                  },
                                  {
                                    name:'v-flex',
                                    class:'sm6  lg6 pl-3 pr-3 ',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-text-field',
                                        props:{
                                          label:'纯度',
                                        },
                                      },
                                    ],
                                  },
                                  {
                                    name:'v-flex',
                                    class:' sm6  lg6  pl-3 pr-3 ',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-text-field',
                                        props:{
                                          label:'级别',
                                        },
                                      },
                                    ],
                                  },
                                  {
                                    name:'v-flex',
                                    class:' sm6  lg6  pl-3 pr-3 ',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-text-field',
                                        props:{
                                          label:'规格',
                                        },
                                      },
                                    ],
                                  },
                                  {
                                    name:'v-flex',
                                    class:' sm6  lg6  pl-3 pr-3 ',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-text-field',
                                        props:{
                                          label:'包装',
                                        },
                                      },
                                    ],
                                  },
                                  {
                                    name:'v-flex',
                                    class:' sm6  lg6  pl-3 pr-3 ',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-text-field',
                                        props:{
                                          label:'产能',
                                        },
                                      },
                                    ],
                                  },
                                  {
                                    name:'v-flex',
                                    class:' sm6  lg6  pl-3 pr-3 ',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-text-field',
                                        props:{
                                          label:'交货期',
                                        },
                                      },
                                    ],
                                  },
                                  {
                                    name:'v-flex',
                                    class:' sm6  lg6  pl-3 pr-3 ',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-text-field',
                                        props:{
                                          label:'最小订单',
                                        },
                                      },
                                    ],
                                  },
                                  {
                                    name:'v-flex',
                                    class:' sm6  lg6  pl-3 pr-3 ',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-text-field',
                                        props:{
                                          label:'HS编码',
                                        },
                                      },
                                    ],
                                  },
                                  {
                                    name:'v-flex',
                                    class:' sm6  lg6  pl-3 pr-3 ',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-combobox',
                                        props:{
                                          label:'价格类型',
                                        },
                                      },
                                    ],
                                  },
                                  {
                                    name:'v-flex',
                                    class:' sm6  lg6  pl-3 pr-3 ',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-text-field',
                                        props:{
                                          label:'价格',
                                          value:"10.00",
                                          prefix:"$",
                                        },
                                      },
                                    ],
                                  },
                                  {
                                    name:'v-flex',
                                    class:' sm6  lg6  pl-3 pr-3 ',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-text-field',
                                        props:{
                                          label:'库存',
                                          hint:"Hint text",
                                        },
                                      },
                                    ],
                                  },
                                  {
                                    name:'v-flex',
                                    class:' sm6  lg6  pl-3 pr-3 ',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-text-field',
                                        props:{
                                          label:'产品百科',
                                        },
                                      },
                                    ],
                                  },
                                  {
                                    name:'v-flex',
                                    class:'lg12 pl-3 pr-3 ',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-textarea',
                                        props:{
                                          label:'简介',
                                          rows:'4',
                                          value:"The Woodman set to work at once, and so sharp was his axe that the tree was soon chopped nearly through.",
                                          hint:"Hint text",
                                        },
                                      },
                                    ],
                                  },


                                ],
                              }
                            ],
                          },
                        ],
                      },

                      {
                        name:"v-card",
                        style:"border-radius:0px;",
                        'class':"mt-5",
                        props:{
                        },
                        children:[
                          {
                            name:'v-toolbar',
                            props:{
                              color:"transparent",
                              flat:true,
                              card:true,
                            },
                            children:[
                              {
                                name:"v-toolbar-title",
                                style:"font-weight: 300;",
                                field:'seometas',
                                props:{
                                },
                                
                                children:[
                                  {
                                    text:'SEO Meta',
                                  }
                                ]
                              },
                            ]
                          },
                          {
                            name:'v-divider',
                          },
                          {
                            name:'v-card-text',
                            children:[
                              {
                                name:'v-layout',
                                class:"pl-3 pr-3 row wrap",
                                children:[
                                  {
                                    name:'v-flex',
                                    class:'lg12',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-text-field',
                                        field:'seometas.title',
                                        props:{
                                          label:'title',
                                        },
                                      },
                                    ],
                                  },
                                  {
                                    name:'v-flex',
                                    class:'lg12',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-textarea',
                                        field:'seometas.keywords',
                                        props:{
                                          label:'Key Words',
                                          rows:'2',
                                          value:"",
                                        },
                                      },
                                    ],
                                  },
                                  {
                                    name:'v-flex',
                                    class:'lg12',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-textarea',
                                        field:'seometas.description',
                                        props:{
                                          label:'Description',
                                          rows:'3',
                                          value:"",
                                        },
                                      },
                                    ],
                                  },


                                ],
                              }
                            ],
                          },
                        ],
                      },

                      {
                        name:"v-card",
                        style:"border-radius:0px;height: 590px;",
                        'class':"mt-5",
                        props:{
                        },
                        children:[
                          {
                            name:'v-toolbar',
                            props:{
                              color:"transparent",
                              flat:true,
                              card:true,
                            },
                            children:[
                              {
                                name:"v-toolbar-title",
                                props:{
                                  style:"font-weight: 300;",
                                },
                                
                                children:[
                                  {
                                    text:'产品描述',
                                  }
                                ]
                              },
                            ]
                          },
                          {
                            name:'v-divider',
                          },
                          {
                            name:'v-card-text',
                            children:[
                              {
                                name:'v-layout',
                                class:"pl-0 pr-0 row warp",
                                props:{
                                },
                                children:[
                                  {
                                    name:'v-flex',
                                    props:{
                                      class:'lg12',
                                    },
                                    children:[
                                      {
                                        name:'vular-quill-editor',
                                        style:"height : 420px",
                                        props:{
                                          value:'Compose Epic Story...',
                                        },
                                      },
                                    ],
                                  },


                                ],
                              }
                            ],
                          },
                        ],
                      },

                    ],
                  },
                  {
                    name:'v-flex',
                    class:"lg4 pa-2 mt-5",
                    props:{
                    },

                    children:[
                     {
                        name:"v-card",
                        style:"border-radius:0px",
                        props:{
                        },
                        children:[
                          {
                            name:'v-toolbar',
                            props:{
                              color:"transparent",
                              flat:true,
                              card:true,
                            },
                            children:[
                              {
                                name:"v-toolbar-title",
                                style:"font-weight: 300;",
                                props:{
                                },
                                
                                children:[
                                  {
                                    text:'外观',
                                  }
                                ]
                              },
                            ]
                          },
                          {
                            name:'v-divider',
                          },
                          {
                            name:'v-card-text',
                            children:[
                              {
                                name:'v-layout',
                                class:'pl-3 pr-3 row wrap',
                                props:{
                                  //row:true,
                                  //wrap:true,
                                },
                                children:[
                                  {
                                    name:'v-flex',
                                    class:'lg8 sm12',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-switch',
                                        props:{
                                          label:'首页展示',
                                        },
                                      },
                                    ],
                                  },

                                  {
                                    name:'v-flex',
                                    class:'lg8 sm12',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-combobox',
                                        props:{
                                          label:'模板',
                                        },
                                      },
                                    ],
                                  },
                                  {
                                    name:'v-flex',
                                    class:'lg8 sm12',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-text-field',
                                        props:{
                                          label:'顺序',
                                        },
                                      },
                                    ],
                                  },
                                  {
                                    name:'v-flex',
                                    class:'lg8 sm12',
                                    props:{
                                    },
                                    children:[
                                      {
                                        name:'v-switch',
                                        props:{
                                          label:'发布',
                                        },
                                      },
                                    ],
                                  },

                                ],
                              }
                            ],
                          },
                        ],
                     },
                     {
                        name:"v-card",
                        style:"border-radius:0px",
                        class:"mt-5",
                        props:{
                        },
                        children:[
                          {
                            name:'v-toolbar',
                            props:{
                              color:"transparent",
                              flat:true,
                              card:true,
                            },
                            children:[
                              {
                                name:"v-toolbar-title",
                                style:"font-weight: 300;",
                                props:{
                                },
                                
                                children:[
                                  {
                                    text:'标签',
                                  }
                                ]
                              },
                            ]
                          },
                          {
                            name:'v-divider',
                          },
                          {
                            name:'v-card-text',
                            children:[
                              {
                                name:'v-item-group',
                                props:{
                                  multiple:true,
                                },
                                children:[
                                  {
                                    name:'v-item',
                                    children:[
                                      {
                                        name:'v-chip',
                                        'slot-scope':"{active, toggle}",//需要进一步研究该功能
                                        children:[
                                          {
                                            text:'Tag'
                                          }
                                        ]
                                      }
                                    ],
                                  },
                                ],
                              }
                            ],
                          },
                        ],
                     },

                     {
                        name:"v-card",
                        style:"border-radius:0px",
                        class:"mt-5",
                        props:{
                        },
                        children:[
                          {
                            name:'v-toolbar',
                            props:{
                              color:"transparent",
                              flat:true,
                              card:true,
                            },
                            children:[
                              {
                                name:"v-toolbar-title",
                                style:"font-weight: 300;",
                                props:{
                                },
                                
                                children:[
                                  {
                                    text:'附加信息',
                                  }
                                ]
                              },
                            ]
                          },
                          {
                            name:'v-divider',
                          },
                          {
                            name:'v-card-text',
                            children:[
                              {
                                name:'v-list',
                                props:{
                                  dense:true,
                                  class:'pt-0'
                                },
                                children:[
                                  dialog,
                                ],
                              }
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
                'class':'mt-5',
                props:{
                },
              },
              {
                name:'v-layout',
                class:"pb-4 pt-4 row wrap",
                props:{
                },
                children:[
                  {
                    name:'v-spacer',
                  },
                  {
                    name:"v-btn",
                    props:{
                      round:true,
                      large:true,
                      light:true,
                    },
                    
                    children:[
                      {
                        text:'Cancel',
                      }
                    ]
                  },
                  {
                    name:"v-btn",
                    props:{
                      round:true,
                      large:true,
                      light:true,
                      color:'primary',
                    },
                    children:[
                      {
                        text:'Save',
                      }
                    ]
                    
                  },
                ],
              },
            ], 
          }
        ],

      },
    ],
  },

  data:{
    vularId:'fm123',
    name:'name test',
    ogmetas:{
      form:{
        vularId:'fm897',
        product_id:'100',
        name:'og name',
        age:'18-29',
      },
      output_value:'',
    },
    'seometas.title':'Seo Title',
    'seometas.keywords':' Seo Key words',
    'seometas.description':' SEO Description',
    
  },
};

export default formPage;
