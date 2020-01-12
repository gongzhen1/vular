const tableData =[
  {
    id:1,
    value: false,
    name: 'Frozen Yogurt',
    calories: 159,
    fat: 6.0,
    carbs: 24,
    protein: 4.0,
    iron:{
      'class':"text-xs-right",
      'style':"color:red;",
      props:{
      },
      content: '1%',
    },
    actions:{
        controls:[
          {
            name:'v-chip',
            props:{
              'color':"primary",
              'text-color':"white",
            },
            children:[
              {
                text:'Primary',
              }
            ]
            
          }
      ],
    },
    
  },
  {
    id:2,
    value: false,
    name: 'Ice cream sandwich',
    calories: 237,
    fat: 9.0,
    carbs: 37,
    protein: 4.3,
    iron: '1%',
    actions:{
      props:{
        'class':'text-xs-right',
      },
      controls:[
        {
          name:"v-btn",
          class:'small ma-0',
          'style':'width:26px;height:26px;',
          props:{
            flat:true,
            icon:true,
            'color':'#757575',
          },
          click:{
            vularId:'tb00001',
            action:'delete',
            params:{
              id:2,
            },
          },
          children:[
            {
              name:'v-icon',
              props:{
                'small':true,
              },
              
              children:[
                {
                  text:'edit',
                }
              ]
            },
          ],
        },
        {
          name:"v-btn",
          'style':'width:26px;height:26px;',
          class:'small ma-0',
          props:{
           'color':'#757575',
            flat:true,
            icon:true,
          },
          click:'####',
          children:[
            {
              name:'v-icon',
              props:{
                'small':true,
              },
              
              children:[
                {
                  text:'delete',
                }
              ]
            },
          ],
        },
      ],
    },
  },
  {
    id:3,
    value: false,
    name: 'Eclair',
    calories: 262,
    fat: 16.0,
    carbs: 23,
    protein: 6.0,
    iron: '7%',
    actions:[
      {
        name:'v-icon',
        props:{
          'small':true,
          'class':"mr-2",
        },
        content:'edit',
        click:'####',
      },
      {
        name:'v-icon',
        props:{
          'small':true,
          'class':"mr-2",
        },
        content:'delete',
        click:'####',
      },
    ],
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
export default tableData;