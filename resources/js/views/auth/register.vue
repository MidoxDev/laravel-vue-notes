<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import {errorAlert} from '@/alerts'


    // variables
    const user = ref({})
    const store = useStore()
    const router = useRouter()
    const error = ref(null)

    //methods
    const register = async() =>{
        try {
            await store.dispatch('auth/register',user.value)

            router.push({name:'login'})
        } catch (err) {
            errorAlert(err.message)
            error.value = err.message
        }
    }
</script>
<template>
    <div class="wrapper">
      <section class="login-content">
         <div class="container h-100">
            <div class="row justify-content-center align-items-center height-self-center">
               <div class="col-md-5 col-sm-12 col-12 align-self-center">
                  <div class="sign-user_card">
                     <div class="logo-detail">
                           <div class="d-flex align-items-center"><img :src="'/assets/images/logo.png'" class="img-fluid rounded-normal light-logo logo" alt="logo"> <h4 class="logo-title ml-3">NotePlus</h4></div>
                     </div>
                     <h3 class="mb-2">Sign Up</h3>
                     <p>Create your  account.</p>
                     <form @submit.prevent="register">
                        <div class="row">
                           <div class="col-lg-12">
                            <div v-if="error" class="text-danger">{{ error }}</div>
                              <div class="floating-label form-group">
                                 <input v-model="user.name" class="floating-input form-control" type="text" placeholder=" ">
                                 <label>Username</label>
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="floating-label form-group">
                                 <input v-model="user.email" class="floating-input form-control" type="email" placeholder=" ">
                                 <label>Email</label>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="floating-label form-group">
                                 <input v-model="user.password" class="floating-input form-control" type="password" placeholder=" ">
                                 <label>Password</label>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="floating-label form-group">
                                 <input v-model="user.password_confirmation" class="floating-input form-control" type="password" placeholder=" ">
                                 <label>Confirm Password</label>
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="custom-control custom-checkbox mb-3 text-left">
                                 <input type="checkbox" class="custom-control-input" id="customCheck1">
                                 <label class="custom-control-label" for="customCheck1">I agree with the terms of use</label>
                              </div>
                           </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Sign Up</button>
                        <p class="mt-3 mb-0">
                           Already have an Account <router-link :to="{name:'login'}" class="text-primary"><b>Sign In</b></router-link>
                        </p>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
    </div>
</template>
