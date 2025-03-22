<script setup>
import { useStore } from "vuex";
import {successAlert} from '@/alerts'


    //variables
    const props = defineProps({
        folders:Array
    })
    const store = useStore()

    //methods
    function editFolder(folder){
        store.commit('folder/setFolder',folder)
    }

    const deleteFolder=(id)=>{
        store.dispatch('folder/delete',id)
        store.dispatch('folder/fetch_folders')
        successAlert("Folder deleted successfuly.")
    }




</script>

<template>
    <li class="">
        <a href="#notebooks" class="collapsed svg-icon" data-toggle="collapse"
            aria-expanded="false">
            <i>
                <svg width="20" class="svg-icon" id="iq-main-2"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                </svg>
            </i>
            <span>Folders</span>
            <i class="las la-angle-right iq-arrow-right arrow-active"></i>
            <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
        </a>
        <ul id="notebooks" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
            <li class="d-flex align-items-center justify-content-between" v-for="folder in folders" v-bind:key="folder.id">
                <a href="" class="svg-icon">
                    <i>
                        <svg width="20" class="svg-icon" id="iq-main-3"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                        </svg>
                    </i>
                    <span>{{ folder.title}}</span>
                </a>
                <!-- Edit & Delete Icons after <a> -->
                <span class="action-icons">
                    <i class="las la-edit text-primary mx-2" data-toggle="modal" data-target="#update-folder" @click="editFolder(folder)"></i>
                    <i class="las la-trash-alt text-danger" @click="deleteFolder(folder.id)"></i>
                </span>
            </li>
            <li class="" v-if="!folders">
                <a href="page-project-plans.html" class="svg-icon">
                    <i class="text-danger">
                        <svg width="20" class="svg-icon" id="iq-main-3"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                        </svg>
                    </i>
                    <span class="text-danger">...</span>
                </a>
            </li>
        </ul>
    </li>
</template>
