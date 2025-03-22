<script setup>
import {useStore} from 'vuex'
import {computed, onMounted} from 'vue'
import SimpleNote from './SimpleNote.vue'
import {successAlert} from '@/alerts'


    const store = useStore()
    defineProps({
        notes:Array
    })





    const deleteNote = async (id)=> {
        await store.dispatch('note/delete',id)
        await store.dispatch('note/fetch_notes')
        successAlert("Note deleted successfuly.")
    }


</script>

<template>

    <div class="icon active animate__animated animate__fadeIn i-grid">
        <div class="row" v-if="notes?.length">
            <div v-for="note in notes" v-bind:key="note.id" class="col-lg-4 col-md-6">

                <simple-note :note="note" @delete="deleteNote"/>
            </div>
        </div>
        <div class="alert alert-danger text-center mt-3" v-else>
            <p class="text-danger">Empty List</p>
        </div>
    </div>
</template>
