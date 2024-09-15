<script setup>
import { RouterLink } from "vue-router";
import { useAuthStore } from "@/store/AuthStore";
import { storeToRefs } from "pinia";
const { authUser } = storeToRefs(useAuthStore());
</script>

<template>
    <header>
        <div>
            <nav>
                <RouterLink to="/">Home</RouterLink>
                <RouterLink to="/dashboard" v-if="authUser"
                    >Dashboard</RouterLink
                >
                <RouterLink :to="{ name: 'post-create' }" v-if="authUser"
                    >New Post</RouterLink
                >
                <RouterLink to="/login" v-if="authUser == null"
                    >Login</RouterLink
                >
                <RouterLink to="/register" v-if="authUser == null"
                    >Register</RouterLink
                >
            </nav>
        </div>
    </header>
</template>
