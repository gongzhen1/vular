import leftDrawer from './leftDrawer';
import toolBar from './toolBar';


const adminapp = {
  name:'v-app',
  class:'app',
  style:'background-color:#f0f4f7;',
  props:{
    id:'layout',
    dark:false,
  },

  children:[
    {
      name:'vular-drawer',
      'class':"app--drawer",
      style:'overflow: hidden',
      props:{
        clipped:false,
        floating:false,
        'mini-variant':false,
        app:true,
        dark:true,
      },
      children:[
        {
          name:'vular-drawer-toolbar',
          props:{
            title:'Vular',
            logo:'/logo2.png',
            'show-mini-button':true,
            dark:true,
            color:'',
            href:'#',
            'drawer-mini':false,
          },
        },
        {
          name:'div',
          props:{
            'style':'height: calc(100vh - 48px);overflow: auto',
            settings:{
              maxScrollbarLength: 160
            },
          },
          children:leftDrawer.body,
        }
      ],
    },
    {
      name:'v-toolbar',
      props:{
        'clipped-left':false,
        light:true,
        app:true,
      },
      children:toolBar.compontents
      ,
    },
    {
      name:'v-content',
      children:[
        {
          name:'vular-page-loading-progress-linear',
          props:{
            'class':"pa-0 ma-0",
            'height':"2",
            'color':"blue",
            'indeterminate':true,
          },
        },
        {
          name:'transition',
          children:[
            {
              name:'keep-alive',
              children:[
                {
                  name:'router-view',
                },
              ],
            },
          ],
        }
      ],
    },  
    {
      name:'v-footer',
      'class':"app--footer",
      props:{
        inset:true,
        app:true,
        absolute:true,
      },
      children:[
        {
          name:'span',
          'class':"px-3",
          children:[
            {
              text:'©2019  — Vular',
            }
          ]
        },
      ],
    },
    {
      name:'vular-top-message',
    },
    {
      name:'vular-appfab',
      props:{
        medium: true,
        dark: true, 
        color: "red",
      },
    }
  ],
  
}

export default adminapp;
