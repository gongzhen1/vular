const dialog = {
  name:'vular-dialog',
  
  model:{
    vularId:'fm897',
    product_id:'100',
    name:'og name',
    age:'18-29',
  },
  
  props:{
    persistent:false,
    'max-width':"900px",
    vularId:'d054353254554',//dialog唯一标识
  },

  children:[
    {
      name:'v-list-tile',
      slot:"activator",
      children:[
        {
          name:'v-list-tile-action',
          children:[
            {
              name:'v-icon',
              props:{
                color:'red',
              },
              children:[
                {
                  text:'share',
                }
              ]
            },
          ],
        },
        {
          name:'v-list-tile-content',
          children:[
            {
              text:'OG Meta',
            }
          ]
        }
      ],
    },
    {
      name:"v-card",
      children:[
        {
          name:'v-card-title',
          children:[
            {
              name:'span',
              props:{
                'class':'headline',
              },
              children:[
                {
                  text:'User Profile',
                }
              ]
              
            },
          ],
        },
        {
          name:'v-card-text',
          children:[
            {
              name:'v-container',
              props:{
                'class':'grid-list-md',
              },
              children:[
                {
                  name:'v-layout',
                  props:{
                    wrap:true,
                  },
                  children:[
                    {
                      name:'v-flex',
                      props:{
                        class:'xs12 sm6 md4',
                      },
                      children:[
                        {
                          name:'v-text-field',
                          field:'name',
                          props:{
                            label:'Legal first name*',
                            required:true,
                          },
                        },
                      ],
                    },
                    {
                      name:'v-flex',
                      props:{
                        class:'xs12 sm6 md4',
                      },
                      children:[
                        {
                          name:'vular-select',
                          field:'age',
                          props:{
                            label:'Age*',
                            required:true,
                            items:['0-17', '18-29', '30-54', '54+'],
                          },
                        },
                      ],
                    },
                    {
                      name:'v-flex',
                      props:{
                        class:'xs12 sm6 md4',
                      },
                      children:[
                        {
                          name:'v-text-field',
                          props:{
                            label:'中文名',
                            required:true,
                          },
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
          name:'v-card-actions',
          children:[
            {
              name:'v-spacer',
            },
            {
              name:'v-btn',
              props:{
                color:"blue darken-1 flat",
                'flat':true,
              },
              
              children:[
                {
                  text:'Close',
                }
              ],
              click:{
                event:'closeDialog',
                args:{
                  vularId:'d054353254554',
                },
              },
            },
            {
              name:'v-btn',
              props:{
                color:"blue darken-1 flat",
                'flat':true,
              },
              children:[
                {
                  text:'Save',
                }
              ],
              
              click:{
                vularId:'d054353254554',
                acton:'save',
                //success:[
                //  {close_dialog:'d054353254554'},
                //  {message:'保存OG成功！'},
                //],
              },
            },
          ],
        },
      ],
    },
  ],

};

export default dialog;
