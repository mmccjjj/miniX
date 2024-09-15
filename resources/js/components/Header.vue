<script setup>
import { ref, onMounted } from "vue";
import { RouterLink } from "vue-router";
import { authClient, useAuthStore } from "@/store/AuthStore";
import { storeToRefs } from "pinia";
const { authUser } = storeToRefs(useAuthStore());
const { logout } = useAuthStore();

const handleLogout = () => {
    logout();
    //router.push("/login");
};
</script>

<template>
    <header>
        <p class="title">MINI-X</p>
        <div class="nav">
            <nav>
                <RouterLink to="/">Home</RouterLink>
                <RouterLink to="/dashboard" v-if="authUser"
                    >Dashboard</RouterLink
                >
                <RouterLink :to="{ name: 'post-create' }" v-if="authUser"
                    >New Post</RouterLink
                >
                <RouterLink to="/register" v-if="authUser == null"
                    >Register</RouterLink
                >
                <a href="#" v-if="authUser" @click.prevent="handleLogout"
                    >Logout</a
                >
            </nav>
        </div>
    </header>
</template>

<style scoped src="../../css/header.css"></style>
