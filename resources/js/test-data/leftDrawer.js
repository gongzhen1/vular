const leftDrawer =  {
  //{ 
  //name: 'v-toolbar',
  //props: ['dark','extended'],
  //prop_pairs: [
  //  color:'red',
  //  extension_height:'',
  //],
  //sub_items:[
    //{
    //  name:'div',
    //  is_raw_html:true,
    //  slots:[
    //    {name:'img',is_raw_html:true,prop_pairs:{src:'xxx.jpg'}}
    //  ]
    //},
    //{
      //name:'drawer-tool-bar',
      //title:'Vular',
      //prop_pairs:{src:'xxx.jpg'}
    //}
  //]

  //},

  header:{
    title:'Vular','image-url':'/logo2.png','show-mini-button':true
  },

  body:[
    {
      name: 'v-list',
      props: {
        'dense':true, 
        'expand':true,
        'light':false,
        'dark':true,
        'class':'v-test',
      },
      children: [
        {
          name:'v-subheader',
          props: {
            'class':"v-test2",
          },
          children:[
            {
              text:'Main Function',
            }
          ],
        },
        {
          name:'v-list-tile',
          props:{
            ripple:true,
            to:"/formxx",
          },
          //click:'#',
          children:[
            {
              name:'v-list-tile-action',

              children:[
                {
                  name:'v-badge',
                  props: {
                    'right':true,
                    'color':'red',
                   },
                  children:[
                    {
                      name:'span',
                      slot:"badge",
                      children:[
                        {
                          text:'6',
                        }
                      ],
                    },
                    {
                      name:'v-icon',
                      children:[
                        {
                          text:'description',
                        }
                      ],
                     }
                  ],
                },
              ]
            },
            {
              name:'v-list-tile-title',
              children:[
                {
                  text:'Form',
                }
              ],
            }
          ]
        },
        {
          name:'v-list-tile',
          props:{
            ripple:true,
              to:"/table",
          },
          //click:'#',
          children:[
            {
              name:'v-list-tile-action',

              children:[
                {
                  name:'v-icon',
                  children:[
                    {
                      text:'border_all'
                    },
                  ],
                }
                ,
              ]
            },
            {
              name:'v-list-tile-title',
              children:[
                {
                  text:'Table',
                }
              ],
            }
          ]
        },
        {
          name:'v-list-group',
          props:{
            'group':'widgets',
            'prepend-icon':'widgets',
            'no-action':true,
          },
          children: [
            {
              name:'v-list-tile',
              slot:"activator",
              props:{
                'ripple':"ripple",
                'no-action':'no-action',
              },
              children:[
                {
                  name:'v-list-tile-title',
                  children:[
                    {
                      text:'Bobo Mall',
                    }
                  ]
                },
              ]
            },
            {
              name:'v-list-tile',
              props:{
                ripple:true,
                to:{name:'adminpage', params:{pageid:'table'}},
              },
              //click:'param_test',
              children:[
                {

                  name:'v-list-tile-content',
                  children:[
                    {
                      name:'v-list-tile-title',
                      children:[
                        {
                          text:'Mall Table',
                        }
                      ],
                    },
                  ]
                },
              ]
            },
            {
              name:'v-list-tile',
              props:{
                ripple:true,
                to:{name:'adminpage', params:{pageid:'form'}},
              },
              //click:'param_test',
              children:[
                {

                  name:'v-list-tile-content',
                  children:[
                    {
                      name:'v-list-tile-title',
                      children:[
                        {
                          text:'Mall产品',
                        }
                      ],
                    },
                  ]
                },
                {
                  name:'v-list-tile-action',
                  children:[
                    {
                      name:'v-icon',
                      children:[
                        {
                          text:'settings',
                        }
                      ],
                    },
                  ]
                },
              ]
            },
            {
              name:'v-list-group',
              props:{
                'sub-group':true,
                'no-action':true,
              },
              children:[
                {
                  name:'v-list-tile',
                  slot:"activator",
                  children:[
                    {
                      name:'v-list-tile-title',
                      children:[
                        {
                          text:'下面还有子菜单',
                        }
                      ]
                    },
                  ]
                },
                {
                  name:'v-list-tile',
                  props:{
                    ripple:true,
                  },
                  //click:'#',
                  children:[
                    {

                      name:'v-list-tile-content',
                      children:[
                        {
                          name:'v-list-tile-title',
                          children:[
                            {
                              text:'这是个子菜单，够了吧',
                            }
                          ]
                        },
                      ]
                    },
                    {
                      name:'v-chip',
                      props:{
                        'color':'blue',
                        'text-color':'white',
                      },
                      style: {
                        fontSize: '10px',
                        height: '16px'
                      },
                      'class':{

                      },
                      children:[
                        {
                          text:'New',
                        }
                      ],
                    },
                  ]
                },

              ]
            },
           ],

        },
        {
          name:'v-divider',
        },
      ]
    },

  ],
};

export default leftDrawer;
