export default {
  name: 'vular-test',
  render: function (createElement) {
    return createElement(
      'VCheckbox', 
      {
        props:{value:true,label:'test'},
        domProps:{value:true},
      }
      
    )
  },

}
