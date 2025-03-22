import api from "@/api.js"

export default{
    namespaced:true,
    state:{
        folder:null,
        folders:null,
    },
    getters:{
        getFolder:(state)=> state.folder,
        getFolders:(state)=> state.folders
    },
    mutations:{
        setFolder(state,newFolder){
            state.folder= newFolder
        },
        setFolders(state,data){
            state.folders= data
        }
    },
    actions:{
        async store({},folder){
            try {
                await api.post('/folders',folder)
            } catch (error) {
                throw new Error(error)
            }
        },
        async fetch_folders({commit,rootGetters}){
            try {

                if (rootGetters['auth/getUser']!=null) {

                    const response= await api.get('/folders')
                    commit('setFolders', response.data.folders)
                }
            } catch (error) {
                throw new Error(error)
            }
        },

        async update({commit},note){
            try {
                await api.put('/folders/'+note.id,note)
                commit('setFolder',null)
            } catch (error) {
                throw new Error(error)
            }
        },
        async delete({},id){
            try {
                await api.delete('/folders/'+id)
            } catch (error) {
                throw new Error(error)
            }
        },

    }
}
