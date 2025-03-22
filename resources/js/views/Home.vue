<script setup>
import Notes from './notes/index.vue'
import {useStore} from 'vuex'
import {computed,onMounted} from 'vue'

import HeaderBar from '@/components/Header.vue'

    const store = useStore()
    const notes = computed(()=>store.getters['note/getNotes']|| [])
    const fav_notes = computed(()=>store.getters['note/getNotes']?.filter(note=> note.favourite))
    const pin_notes = computed(()=>store.getters['note/getNotes']?.filter(note=> note.pin))

    onMounted(async()=>{
        try {
            await store.dispatch('note/fetch_notes')
        } catch (error) {
            console.log(error.message);
        }
    })
</script>
<template>
    <!-- Wrapper Start -->
    <div class="content-page">
        <div class="container-fluid note-details">
            <header-bar/>
            <div class="row">

                <div class="col-lg-12">
                    <div class="card card-block card-stretch">
                        <div class="card-body custom-notes-space">
                            <h3 class="">Your Notes</h3>
                            <div class="iq-tab-content">
                                <div class="d-flex flex-wrap align-items-top justify-content-between">
                                    <ul class="d-flex nav nav-pills text-center note-tab mb-3" id="note-pills-tab"
                                        role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link home active show" data-toggle="pill"
                                                data-init="note" href="#note1" role="tab"
                                                aria-selected="false">All</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link home" data-toggle="pill" data-init="pin-note"
                                                href="#note2" role="tab" aria-selected="false">Pin Notes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link home" data-toggle="pill" data-init="fav-note"
                                                href="#note3" role="tab" aria-selected="false">Favourite
                                                Notes</a>
                                        </li>
                                    </ul>
                                    <div class="media align-items-top iq-grid">
                                        <div class="view-btn rounded body-bg btn-dropdown filter-btn mr-3">
                                            <div class="dropdown">
                                                <span class="dropdown-toggle cursor-pointer"
                                                    id="dropdownMenuButton003" data-toggle="dropdown">
                                                    <i class="las la-filter font-size-20"></i>
                                                </span>
                                                <div class="dropdown-menu dropdown-menu-right border-none"
                                                    aria-labelledby="dropdownMenuButton003">
                                                    <div class="dropdown-item mb-3">
                                                        <div
                                                            class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mr-4"><i
                                                                    class="las la-book mr-3"></i>Located In</h6>
                                                            <div class="form-group mb-0">
                                                                <select name="type"
                                                                    class="basic-select form-control dropdown-toggle"
                                                                    data-style="py-0">
                                                                    <option value="1">Project Plans</option>
                                                                    <option value="2">Routine Notes</option>
                                                                    <option value="3">Planning</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-item mb-3">
                                                        <div
                                                            class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mr-4"><i
                                                                    class="las la-paste mr-3"></i>Contains</h6>
                                                            <div class="form-group mb-0">
                                                                <select name="type"
                                                                    class="basic-select form-control dropdown-toggle"
                                                                    data-style="py-0">
                                                                    <option value="1">Address</option>
                                                                    <option value="2">Archive Files</option>
                                                                    <option value="3">Code Blocks</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-item mb-2">
                                                        <div
                                                            class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mr-4"><i
                                                                    class="las la-calendar mr-3"></i>Created</h6>
                                                            <div class="form-group mb-0">
                                                                <select id="date-select" name="type"
                                                                    class="basic-select form-control dropdown-toggle"
                                                                    data-style="py-0">
                                                                    <option value="today">Today</option>
                                                                    <option value="yest">Yesterday</option>
                                                                    <option value="last-week">Last Week</option>
                                                                    <option value="last-month">Last Month</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-grid-toggle cursor-pointer">
                                            <span class="icon active i-grid rounded"><i
                                                    class="ri-layout-grid-line font-size-20"></i></span>
                                            <span class="icon active i-list rounded"><i
                                                    class="ri-list-check font-size-20"></i></span>
                                            <span class="label label-list">List</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="note-content tab-content">
                                    <div id="note1" class="tab-pane fade active show">
                                        <notes :notes="notes"/>
                                    </div>
                                    <div id="note2" class="tab-pane fade show">
                                        <notes :notes="pin_notes"/>
                                    </div>
                                    <div id="note3" class="tab-pane fade show">
                                        <notes :notes="fav_notes"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page end  -->
        </div>

    </div>

</template>

