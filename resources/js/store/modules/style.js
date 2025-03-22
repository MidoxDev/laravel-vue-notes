export default{
    namespaced:true,
    state:{
        colors:
            {'default' :'info',
            'very low' : 'purple',
            'low' : 'primary',
            'medium' : 'success',
            'high' : 'warning',
            'very high' : 'danger'}
    },
    getters:{
        getColors:(state)=>state.colors
    }

}
