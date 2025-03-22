import api from "@/api.js"

export default{
    namespaced:true,
    state:{
        user: {},
        token: null
    },
    getters:{
        getUser(state){
            return state.user
        },
        getToken:(state) =>state.token,
        isAuthenticated:(state)=> !!state.user
    },
    mutations:{
        setUser(state,payload){
            state.user = payload
        },
        setToken(state,token){
            state.token = token
            localStorage.setItem('token',token)
        }
    },
    actions:{
        async login({commit},credentials){
            try {
                const response = await api.post('/login',credentials)
                commit('setToken',response.data.token)
            } catch (error) {
                throw new Error( error.response.data.message)
            }
        },
        async getUser({commit,getters}){
            try {
                if (!getters['getToken']) {
                    commit('setToken',localStorage.getItem('token'))
                }
                const response = await api.get('/user')
                commit('setUser',response.data.user)


            } catch (error) {
                commit('setUser',null)
                commit('setToken',null)
                localStorage.removeItem('token');

            }
        },
        async register({commit},new_user){
            try {
                const response =await api.post('/register',new_user)
                commit('setUser',response.data.user)
                commit('setToken',response.data.token)
            } catch (error) {
                throw new Error( error.response.data.message)
            }
        },
        async update({commit},new_info){
            try {
                const response = await api.put('/profile',new_info)
                commit['getUser']
                return response
            } catch (error) {
                throw new Error( error)
            }
        },
        async logout({commit,getters}){
            try {
                await api.post('/logout')
                commit('setUser',null)
                commit('setToken',null)
            } catch (error) {
                console.log(error.message);
            }
        }

    }
}
