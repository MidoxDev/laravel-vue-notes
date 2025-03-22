<script setup>
import { useStore } from 'vuex';
import LeftSidebar from '@/components/LeftSidebar.vue';
import FooterNote from '@/components/Footer.vue';
import { useRoute } from 'vue-router';


    const route = useRoute()


</script>

<template>

    <!-- <div id="loading">
        <div id="loading-center">
        </div>
    </div> -->
     <div class="auth">
        <div class="wrapper">
            <left-sidebar v-if="!['login', 'register'].includes(route.name)"/>

            <router-view></router-view>
        </div>
        <footer-note v-if="!['login', 'register'].includes(route.name)"/>
    </div>

</template>
