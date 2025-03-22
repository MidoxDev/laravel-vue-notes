import { createApp } from "vue";

import App from "@/App.vue";
import router from '@/router/router.js'
import store from '@/store'




try {

    await store.dispatch('auth/getUser').then(rep=>{

        createApp(App).use(router).use(store).mount("#app");
    })

} catch (error) {
    console.log(error);
}

