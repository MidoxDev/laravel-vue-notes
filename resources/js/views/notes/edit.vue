<script setup>
import { onMounted,computed } from "vue";
import { useRoute,useRouter } from "vue-router";
import { useStore } from "vuex";
import {successAlert} from '@/alerts'



    // variables
    const store = useStore()
    const route = useRoute()
    const router = useRouter()


    //computed methods
    const colors =computed(()=> store.getters['style/getColors'])
    const note = computed(()=> store.getters['note/getNote'] || '')
    const folders = computed(()=>store.getters['folder/getFolders']|| '')


    //methods
    const show = async()=>{

        try {
            await store.dispatch('note/show',route.params.slug)
        } catch (error) {
            router.push({name:'home'})
            console.log(error.message);
        }
    }

    const resetToDefault = ()=>{
        store.commit('note/resetNote')
    }

    const update= async()=> {
        try {
            await store.dispatch('note/update',note.value)
            successAlert("Note updated successfuly.")
            router.push({name:'home'})
        } catch (error) {
            console.error(error.message);
        }
    }

    onMounted(show)

</script>

<template>

    <div class="content-page">
        <div class="container-fluid">
            <div class="desktop-header">
                <div class="card card-block topnav-left">
                    <div class="card-body write-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4>Edit Note</h4>
                            <router-link :to="{name: 'home'}" class="btn btn-outline-primary svg-icon">
                                <svg width="20" class="svg-icon" id="new-note-back"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                                </svg>
                                <span>Back</span>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-block card-stretch pb-2">
                        <div class="card-body write-card pb-4">
                            <div class="row">
                                <div class="col-md-8">
                                    <form @submit.prevent="update">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="label-control">Title</label>
                                                    <input v-model="note.title" type="text" class="form-control"
                                                        placeholder="Example Note" value="" data-change="input"
                                                        data-custom-target="#note-title">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="label-control">Reminder Date</label>
                                                    <input type="date" class="form-control" v-model="note.reminder_date"
                                                        value="" data-change="input"
                                                        data-custom-target="#note-reminder-date">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="label-control">Folders</label>
                                                    <div>
                                                        <select
                                                            v-model="note.folder_id"
                                                            class="form-control"
                                                            data-change="select"
                                                            data-custom-target="color">
                                                            <option
                                                                v-for="folder in folders"
                                                                v-bind:key="folder.id"
                                                                :value="folder.id">{{folder.title}} </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="label-control">Description</label>
                                            <textarea type="text" class="form-control" v-model="note.description" rows="3" data-change="input"
                                                data-custom-target="#note-description"
                                                placeholder="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."></textarea>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-control">Priority</label>
                                                    <div>
                                                        <select v-model="note.priority" id="" class="form-control"
                                                            data-change="select" data-custom-target="color">
                                                            <option value="default">Default</option>
                                                            <option value="very low">Very Low</option>
                                                            <option value="low">Low</option>
                                                            <option value="medium">Medium</option>
                                                            <option value="high">High</option>
                                                            <option value="very high">Very High</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-control">Permission</label>
                                                    <div>
                                                        <select v-model="note.permission" id="" class="form-control"
                                                            data-change="select" data-custom-target="color">
                                                            <option value="public">Public </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-outline-primary"
                                                @click="resetToDefault"
                                            >
                                            <svg width="20" class="svg-icon" id="new-note-reset"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0019 16V8a1 1 0 00-1.6-.8l-5.333 4zM4.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0011 16V8a1 1 0 00-1.6-.8l-5.334 4z" />
                                            </svg>
                                            Reset
                                        </button>
                                        <button type="submit" class="btn btn-primary ml-1">
                                            <svg width="20" class="svg-icon" id="new-note-save"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                            </svg>
                                            Update
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-4" id="default">
                                    <div class="card card-block card-stretch card-height note-detail"
                                        :class="'card-bottom-border-'+colors[note.priority]"
                                        id="update-note">
                                        <div class="card-header d-flex justify-content-between pb-1">
                                            <div class="icon iq-icon-box-2 icon-border-info rounded" id="note-icon">
                                                <svg width="23" class="svg-icon" id="iq-main-01"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>

                                        </div>
                                        <div class="card-body rounded">
                                            <h4 class="card-title text-ellipsis short-1" id="note-title">{{ note.title }}</h4>
                                            <p class="mb-3 text-ellipsis short-6" id="note-description">{{ note.description }}</p>
                                        </div>
                                        <div class="card-footer">
                                            <div
                                                class="d-flex align-items-center justify-content-between note-text note-text-info">
                                                <a href="#" class=""><i
                                                        class="las la-user-friends mr-2 font-size-20"></i>{{note.permission}}</a>
                                                <a href="#" class=""><i
                                                        class="las la-calendar mr-2 font-size-20"></i><span
                                                        id="note-reminder-date">{{new Date(note.reminder_date).toLocaleDateString('fr-FR',{day:"numeric",month:"long",year:"numeric"})}}</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="default-note d-none">
                <div class="card card-block card-stretch card-height card-bottom-border-info note-detail"
                    id="update-note">
                    <div class="card-header d-flex justify-content-between pb-1">
                        <div class="icon iq-icon-box-2 icon-border-info rounded" id="note-icon">
                            <svg width="23" class="svg-icon" id="iq-main-01"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="card-body rounded">
                        <h4 class="card-title text-ellipsis short-1" id="note-title">{{ note.title}}</h4>
                        <p class="mb-3 text-ellipsis short-6" id="note-description">{{note.description}}</p>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex align-items-center justify-content-between note-text note-text-info">
                            <a href="#" class=""><i
                                    class="las la-user-friends mr-2 font-size-20"></i>{{note.permission}}</a>
                            <a href="#" class=""><i
                                    class="las la-calendar mr-2 font-size-20"></i><span id="note-reminder-date">{{ new Date(note.reminder_date).toLocaleDateString('fr-FR',{day:"numeric",month:"long",year:"numeric"}) }}</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page end  -->
        </div>
    </div>
</template>
