<script setup>
import { ref } from "vue";
import { useStore } from "vuex";
import {successAlert} from '@/alerts/'


    const store = useStore()
    const folder= ref({title:''})



    const  add_Folder=async ()=>{
        await store.dispatch('folder/store',folder.value)
        await store.dispatch('folder/fetch_folders')

        folder.value.title=''
        $("#new-folder").modal("hide");
        successAlert("Folder create successful .")
    }


</script>
<template>
    <!-- Modal -->
    <div class="modal fade" id="new-folder" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form @submit.prevent="add_Folder" class="form-inline d-flex w-100">
                        <label for="inlineFormInput" class="mr-2">Folder Name</label>
                        <input v-model="folder.title" type="text" class="form-control flex-grow-1 mr-2" id="inlineFormInput" placeholder="Folder Name">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>
