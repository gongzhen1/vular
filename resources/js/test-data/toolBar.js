const toolBar =  {
  show_side_icon:true,
  compontents:[
    /*{
      name:'v-btn',
      props:{
        flat:true,
        icon:true,
      },
      children:[
        {
          name:'v-icon',
          content:'menu',
        }
      ],

      click:{
        event:'hideOrShowDrawer',
        args:{},
      },
    },*/
    {
      name:'v-toolbar-side-icon',
      click:{
        event:'hideOrShowDrawer',
        args:{

        },
      },
    },
    //{
    //  name: 'vular-searchbox',
    //},
    {
      name: 'v-spacer',
    },
    {
      name: 'vular-fullscreen-button',
    },
    {
      name:'v-btn',
      props:{
        icon:true,
        href:'#',
      },
      children:[
        {
          name:'v-icon',
          props:{
            medium:true,
          },
          children:[
            {
              text:'help_outline',
            }
          ]
        }
      ],
    },
    {
      name: 'v-menu',
      props: {
        'offset-y':true, 
        'origin':'center center',
        'nudge-bottom':'14',
        'class':'elelvation-1',
        'transition':'scale-transition'
      },
      children: [
        {
          name:'v-btn',
          slot:"activator",
          props: {
            'icon':true, 
            'large':true,
            'flat':true,
          },
          on:{
            click:{
              event:"loadAsyncContent",
              args:{
                vularId:'xxxxxx',
              }
            },
          },
          children: [
            {
              name:'v-badge',
              props: {
                'color':'red', 
                'overlap':true,
              },
              children: [
                {
                  name:'span',
                  slot:'badge',
                  children:[
                    {
                      text:'3',
                    }
                  ],
                },
                {
                  name:'v-icon',
                  props:{
                    medium:'medium',
                  },
                  children:[
                    {
                      text:'notifications',
                    }
                  ],
                },
              ],

            },
          ],
        },
        {
          name:'v-card',
          
          'class':'elevation-0', 
          
          children: [
            {
              name:'v-toolbar',
              props:{
                'card':true,
                'dense':true,
                'color':'transparent',
              },
              children:[
                {
                  name:'v-toolbar-title',
                  children:[
                    {
                      text:'Notification',
                    }
                  ],
                },
              ],
            },
            {
              name:'v-divider',
            },
            {
              name:'vular-async-panel',
            }
          ],

        },
      ],
    },
    {
      name: 'v-menu',
      props: {
        'offset-y':true, 
        'origin':'center center',
        'nudge-bottom':'10',
        'transition':'scale-transition'
      },
      children: [
        {
          name:'v-btn',
          slot:"activator",
          props: {
            'icon':true, 
            'large':true,
            'flat':true,
          },
          children: [
            {
              name:'v-avatar',
              props: {
                'size':'30px', 
              },
              children: [
                {
                  name:'img',
                  attrs: {
                    'src':'/touxiang.jpg', 
                    'alt':'Martin Li Avatar',
                  },
                },
              ],

            },
          ],
        },
        {
          name:'v-list',
          props: {
            'class':'pa-0', 
          },
          children: [
            {
              name:'v-list-tile',
              props:{
                ripple:true,
                rel:'noopener',
              },
              click:'#',
              children:[
                {
                  name:'v-list-tile-action',
                  children:[
                    {
                      name:'v-icon',
                      children:[
                        {
                          text:'account_circle',
                        }
                      ]
                    }
                  ],
                },
                {
                  name:'v-list-tile-content',
                  children:[
                    {
                      name:'v-list-tile-title',
                      children:[
                        {
                          text:'Profile',
                        }
                      ]
                    },
                  ],
                }
              ],
            },
            {
              name:'v-list-tile',
              props:{
                ripple:true,
                rel:'noopener',
              },
              click:'#',
              children:[
                {
                  name:'v-list-tile-action',
                  children:[
                    {
                      name:'v-icon',
                      children:[
                        {
                          text:'settings',
                        }
                      ]
                    }
                  ],
                },
                {
                  name:'v-list-tile-content',
                  children:[
                    {
                      name:'v-list-tile-title',
                      children:[
                        {
                          text:'Settings',
                        }
                      ]
                    },
                  ],
                }
              ],
            },
            {
              name:'v-list-tile',
              props:{
                ripple:true,
                rel:'noopener',
              },
              click:'#',
              children:[
                {
                  name:'v-list-tile-action',
                  children:[
                    {
                      name:'v-icon',
                      children:[
                        {
                          text:'lock',
                        }
                      ]
                    }
                  ],
                },
                {
                  name:'v-list-tile-content',
                  children:[
                    {
                      name:'v-list-tile-title',
                      children:[
                        {
                          text:'Lock Screen',
                        }
                      ]
                    },
                  ],
                }
              ],
            },
            {
              name:'v-divider',
            },
            {
              name:'div',
              props:{
                'class':'text-xs-center',
              },
              children:[
                {
                  name:'v-btn',
                  props:{
                    'round':true,
                    'outline':true,
                    'light':true,
                    'color':'teal',
                  },
                  children:[
                    {
                      text:'Logout',
                    }
                  ],
                },
              ]
            }

          ],

        },
      ],
    },
    /*
    {
      name: 'v-menu',
      props: {
        'offset-y':true, 
        'origin':'center center',
        'nudge-bottom':'10',
        'transition':'scale-transition'
      },
      children: [
        {
          name:'v-btn',
          slot:"activator",
          props: {
            'icon':true, 
            'large':true,
            'flat':true,
          },
          children: [
            {
              name:'v-avatar',
              props: {
                'size':'26px', 
                'tile':true,
              },
              children: [
                {
                  name:'img',
                  props: {
                    'src':'/flags/cn.png', 
                    'alt':'中文',
                  },
                },
              ],

            },
          ],
        },
        {
          name:'v-list',
          props: {
            'class':'pa-0', 
          },
          children: [
            {
              name:'v-list-tile',
              props:{
                ripple:true,
              },
              click:'#',
              children:[
                {
                  name:'v-list-tile-action',
                  children:[
                    {
                      name:'v-avatar',
                      props: {
                        'size':'26px', 
                        'tile':true,
                      },
                      children: [
                        {
                          name:'img',
                          props: {
                            'src':'/flags/us.png', 
                            'alt':'English',
                          },
                        },
                      ],
                    }
                  ],
                },
                {
                  name:'v-list-tile-content',
                  children:[
                    {
                      name:'v-list-tile-title',
                      content:'English',
                    },
                  ],
                }
              ],
            },
            {
              name:'v-list-tile',
              props:{
                ripple:true,
              },
              click:'#',
              children:[
                {
                  name:'v-list-tile-action',
                  children:[
                    {
                      name:'v-avatar',
                      props: {
                        'size':'26px', 
                        'tile':true,
                      },
                      children: [
                        {
                          name:'img',
                          props: {
                            'src':'/flags/cn.png', 
                            'alt':'中文',
                          },
                        },
                      ],
                    }
                  ],
                },
                {
                  name:'v-list-tile-content',
                  children:[
                    {
                      name:'v-list-tile-title',
                      content:'中文',
                    },
                  ],
                }
              ],
            },

          ],

        },
      ],
    },
    */
  ]
 
};

export default toolBar;
