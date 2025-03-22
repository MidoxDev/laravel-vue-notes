<script setup>
import { computed, reactive, ref } from 'vue';
import {useRouter} from 'vue-router'
import { useStore } from 'vuex';

    const store = useStore();
    const router = useRouter();

    const credential = reactive({
        email:'test@example.com',
        password:'password'
    })
    const error =ref('');




    //methods
    const login = async()=>{
        try {
            await store.dispatch('auth/login',credential)
            await store.dispatch('auth/getUser')
            router.push({name:'home'})

        } catch (err) {
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
                            <div class="d-flex align-items-center"><img :src="'/assets/images/logo.png'"
                                    class="img-fluid rounded-normal light-logo logo" alt="logo">
                                <h4 class="logo-title ml-3">NotePlus</h4>
                            </div>
                        </div>
                        <h3 class="mb-2">Sign In</h3>
                        <p>Login to stay connected.</p>
                        <form @submit.prevent="login">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div v-if="error" class="text-danger">{{ error }}</div>
                                    <div class="floating-label form-group">
                                        <input
                                            name="email"
                                            class="floating-input form-control"
                                            placeholder=" "
                                            id="email"
                                            v-model="credential.email"
                                            type="email"
                                            required
                                            autofocus
                                            autocomplete="username"
                                        >
                                        <label>Email</label>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="floating-label form-group">
                                        <input
                                            name="password" class="floating-input form-control" type="password" placeholder=" "
                                            id="password"
                                            v-model="credential.password"
                                            required
                                            autocomplete="current-password"
                                        >
                                        <label>Password</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="custom-control custom-checkbox mb-3 text-left">
                                        <input name="remember" type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Remember Me</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <a v-if="canResetPassword" href="#" class="text-primary float-right">Forgot Password?</a>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Sign In</button>
                            <p class="mt-3 mb-0">
                                Create an Account <router-link :to="{name:'register'}" class="text-primary"><b>Sign Up</b></router-link>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</template>
