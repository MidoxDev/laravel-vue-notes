<script setup>
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';
import { ref,computed,onMounted } from 'vue';
import NewFolder from '@/views/folders/NewFolder.vue'
import UpdateFolder from '@/views/folders/UpdateFolder.vue'
import FolderList from '@/views/folders/FolderList.vue'

    //variables
    const store = useStore()
    const router = useRouter()
    const user=ref(computed(()=> store.getters['auth/getUser']))


    //methods
    const logout=()=>{
        store.dispatch('auth/logout').then(()=>{

            router.push({name :'login'})
        });
    }


    const folders = computed(()=>store.getters['folder/getFolders']|| '')

    const get_folders = async()=>{
        await store.dispatch('folder/fetch_folders')
    }


    onMounted(get_folders)

</script>
<template>


    <new-folder/>
    <update-folder/>

    <div class="iq-top-navbar">
        <div class="iq-navbar-custom">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                    <i class="ri-menu-line wrapper-menu"></i>
                    <router-link to="/" class="header-logo">
                        <img :src="'/assets/images/logo.png'" class="img-fluid rounded-normal light-logo"
                            alt="logo">

                    </router-link>
                </div>

            </nav>
        </div>
    </div>

    <div class="iq-sidebar sidebar-default ">
        <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
            <router-link to="/" class="header-logo">
                <img :src="'/assets/images/logo.png'" class="img-fluid rounded-normal light-logo" alt="logo">
                <h4 class="logo-title ml-3">NotePlus</h4>
            </router-link>
            <div class="iq-menu-bt-sidebar">
                <i class="las la-times wrapper-menu"></i>
            </div>
        </div>
        <div class="dropdown" style="margin: 0 20px 20px;">
            <a href="#" class="iq-user-toggle d-flex align-items-center justify-content-between"
                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img :src="'/assets/images/user/1.jpg'" class="img-fluid rounded avatar-50 mr-3" alt="user">
                <div class="caption">
                    <h6 class="mb-0 line-height">{{(user?.name)}}</h6>
                </div>
                <i class="las la-angle-down"></i>
            </a>
            <div class="dropdown-menu w-100 border-0 my-2" aria-labelledby="dropdownMenuButton">
                <router-link class="dropdown-item mb-2"
                    :to="{name:'profile'}">
                    <i class="lar la-user-circle font-size-20 mr-1"></i>
                    <span class="mt-2">My Profile</span>
                </router-link>
                <button type="button" @click="logout" class="dropdown-item mb-2">
                    <i class="las la-sign-out-alt font-size-20 mr-1"></i>
                    <span class="mt-2">Logout</span>
                </button>

            </div>
        </div>
        <div class="data-scrollbar" data-scroll="1">

            <div class="sidebar-btn mb-3 d-grid gap-2">
                <router-link :to="{name:'notes.create'}"
                    class="btn btn-primary pr-5 position-relative iq-user-toggle d-flex align-items-center justify-content-between"
                    style="height: 40px; width:230px">
                    <span class="btn-title"><i class="ri-add-line mr-3"></i>Add New Note</span>
                    <span class="note-add-btn" style="height: 40px;"><i class="ri-add-line"></i></span>
                </router-link>


                <button data-toggle="modal" data-target="#new-folder"
                    class="btn btn-warning pr-5 position-relative iq-user-toggle d-flex align-items-center justify-content-between my-3"
                    style="height: 40px; width:230px"
                    type="button">
                    <span class="btn-title"><i class="ri-add-line mr-3"></i>Add New Folder</span>
                    <span class="note-add-btn" style="height: 40px; background-color: #ee5600cc;"><i class="ri-add-line"></i></span>
                </button>
            </div>
            <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu">
                    <li class="active">
                        <router-link :to="{name:'home'}" class="svg-icon">
                            <i>
                                <svg class="svg-icon" id="iq-main-1" width="20"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </i>
                            <span>Your Notes</span>
                        </router-link>
                        <ul id="index" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        </ul>
                    </li>

                    <folder-list :folders="folders"/>



                </ul>

            </nav>
            <div class="p-3"></div>
        </div>
    </div>

</template>
<style>
    .iq-sidebar {
        height: 100vh; /* Full viewport height */
        overflow-y: auto; /* Enable vertical scrolling */
        overflow-x: hidden; /* Hide horizontal overflow */
    }
</style>
