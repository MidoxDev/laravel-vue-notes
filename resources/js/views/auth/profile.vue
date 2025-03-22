<script setup>
import { computed, ref } from 'vue';
import { useStore } from 'vuex';
import {successAlert} from '@/alerts/'


    //variables
    const store = useStore()
    const user = ref(computed(()=>store.getters['auth/getUser']))

    //methods
    const changePersonalInfo= async()=>{
        try {
            const response = await store.dispatch('auth/update',user.value)

            successAlert(response.data.message)
        } catch (error) {
            console.error(error);
        }
    }

</script>

<template>
    <div class="content-page">
        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-12">
                <div class="iq-edit-list-data">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Personal Information</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form @submit.prevent="changePersonalInfo">
                                        <div class="form-group row align-items-center">
                                        <div class="col-md-12">
                                            <div class="profile-img-edit">
                                                <div class="crm-profile-img-edit">
                                                    <img class="crm-profile-pic avatar-100" :src="'/assets/images/user/1.jpg'" alt="profile-pic">
                                                    <div class="crm-p-image bg-primary">
                                                    <i class="las la-pen upload-button"></i>
                                                    <input class="file-upload" type="file" accept="image/*">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class=" row align-items-center">

                                            <div class="form-group col-sm-6">
                                                <label for="uname">User Name</label>
                                                <input type="text" class="form-control" id="uname" v-model="user.name">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control"  id="email" v-model="user.email" disabled>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="password">Current Password</label>
                                                <input type="password" class="form-control" id="password" v-model="user.password">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="new_password">New Password</label>
                                                <input type="password" class="form-control"  id="new_password" v-model="user.new_password">
                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>
