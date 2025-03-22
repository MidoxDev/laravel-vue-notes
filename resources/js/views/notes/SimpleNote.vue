<script setup>

import {computed} from 'vue'
import {useStore} from 'vuex'

    const emit = defineEmits(['delete']); // Define the event
    const props= defineProps({
        note:Object
    })

    const store = useStore()

    const colors =computed(()=> store.getters['style/getColors'])

    const deletItem=()=>{
        emit('delete',props.note.id)
    }
    const makeAsFavorite=()=>{
        store.dispatch('note/makeAsFavorite',props.note.id)
        store.dispatch('note/fetch_notes')
    }

    const pin=()=>{
        store.dispatch('note/pin',props.note.id)
        store.dispatch('note/fetch_notes')
    }

</script>

<template>
    <div
        class="card card-block card-stretch card-height note-detail"
        :class="'card-bottom-border-'+colors[note.priority]">
        <div class="card-header d-flex justify-content-between pb-1">
            <div
                class="icon iq-icon-box-2 icon-border-success rounded">
                <svg width="23" height="23"
                    class="svg-icon" id="iq-main-07"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2"
                        d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                </svg>
            </div>
            <div
                class="card-header-toolbar d-flex align-items-center">
                <div
                    class="card-header-toolbar d-flex align-items-center">
                    <div class="dropdown">
                        <span class="dropdown-toggle dropdown-bg"
                            id="note-dropdownMenuButton10"
                            data-toggle="dropdown"
                            aria-expanded="false" role="button">
                            <i class="ri-more-fill"></i>
                        </span>
                        <div class="dropdown-menu dropdown-menu-right"
                            aria-labelledby="note-dropdownMenuButton10"
                            style="">
                            <router-link :to="{name:'notes.edit',params:{slug:note.slug}}"
                                class="dropdown-item edit-note1"
                                data-toggle="modal"
                                data-target="#edit-note1"><i
                                    class="las la-pen mr-3"></i>Edit</router-link>
                            <button type="button" class="dropdown-item"
                                data-extra-toggle="delete"
                                data-closest-elem=".card"
                                @click=deletItem><i
                                    class="las la-trash-alt mr-3"></i>Delete</button>
                            <button type="button" class="dropdown-item"
                                data-extra-toggle="delete"
                                data-closest-elem=".card"
                                @click=makeAsFavorite>
                                <i class="la la-heart mr-3" style="color:red"></i>
                                {{(note.favourite)? 'Unfavorite':'Favorite'}}</button>
                            <button type="button" class="dropdown-item"
                                data-extra-toggle="delete"
                                data-closest-elem=".card"
                                @click=pin><i class="la la-thumbtack mr-3"></i>

{{(note.pin)? 'Unpin':'Pin'}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body rounded">
            <h4 class="card-title">{{note.title}}</h4>
            <p class="mb-3 card-description short">{{note.description}}</p>
        </div>
        <div class="card-footer">
            <div
                class="d-flex align-items-center justify-content-between note-text note-text-success">
                <a href="#" class=""><i
                        class="las la-user mr-2 font-size-20"></i>{{note.permission}}</a>
                <a href="#" class=""><i
                        class="las la-calendar mr-2 font-size-20"></i>{{ new Date(note.reminder_date).toLocaleDateString('fr-FR',{day:"numeric",month:"long",year:"numeric"}) }}</a>
            </div>
        </div>
    </div>
</template>
