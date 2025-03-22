import api from "@/api.js"

export default{
    namespaced:true,
    state:{
        note:null,
        originalNote:null,
        notes:null,
        /* colors:['info','purple','warning','danger','primary','success'] */
    },
    getters:{
        getNote:(state)=> state.note,
        getOriginalNote:(state)=> state.originalNote,
        getNotes:(state)=> state.notes
    },
    mutations:{
        setNote(state,newNote){
            newNote.reminder_date = newNote.reminder_date.split(" ")[0]
            state.note= newNote
        },
        setOriginalNote(state,newNote){
            let currentNote = newNote
            currentNote.reminder_date = currentNote.reminder_date.split(" ")[0]
            state.originalNote= JSON.parse(JSON.stringify(currentNote))
        },
        resetNote(state){
            state.note = JSON.parse(JSON.stringify(state.originalNote))
        },
        setNotes(state,data){
            state.notes= data
        }
    },
    actions:{
        async store({},note){
            try {
                await api.post('/notes',note)
            } catch (error) {
                throw new Error(error)
            }
        },
        async fetch_notes({commit,rootGetters}){
            try {
                //console.log(store.getters['auth/getUser']);
                if (rootGetters['auth/getUser']!=null) {
                    const response= await api.get('/notes')
                    commit('setNotes', response.data.notes)
                }
            } catch (error) {
                throw new Error(error)
            }
        },
        async show({commit},payload){

            try {
                const response= await api.get('/notes/'+payload)
                commit('setNote', response.data.note)
                commit('setOriginalNote', response.data.note)
            } catch (error) {
                throw new Error(error)
            }
        },
        async update({},note){
            try {
                await api.put('/notes/'+note.id,note)
            } catch (error) {
                throw new Error(error)
            }
        },
        async delete({},id){
            try {
                await api.delete('/notes/'+id)
            } catch (error) {
                throw new Error(error)
            }
        },
        async makeAsFavorite({},id){
            try {
                await api.patch('/notes/'+id)
            } catch (error) {
                throw new Error(error)
            }
        },
        async pin({},id){
            try {
                await api.patch('/notes-pin/'+id)
            } catch (error) {
                throw new Error(error)
            }
        },

    }
}
