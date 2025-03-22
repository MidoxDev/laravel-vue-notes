import { createStore } from 'vuex'
import auth from './modules/auth'
import folder from './modules/folder'
import note from './modules/note'
import style from './modules/style'

export default createStore({
  modules: {
    auth,
    folder,
    note,
    style
  },

})
