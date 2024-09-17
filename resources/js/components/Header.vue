<script setup>
import { ref, onMounted, computed } from "vue";
import { RouterLink, useRouter, useRoute } from "vue-router";
import { authClient, useAuthStore } from "@/store/AuthStore";
import { storeToRefs } from "pinia";
const { authUser } = storeToRefs(useAuthStore());
const { logout } = useAuthStore();
const router = useRouter();
const route = useRoute();

const handleLogout = () => {
    logout();
    router.push("/");
};

const underlineClass = computed(() => {
    if (route.name === "home") return "underline";
    return "";
});
</script>

<template>
    <header>
        <RouterLink to="/" class="title link"><p>MINI-X</p> </RouterLink>
        <div class="nav">
            <nav>
                <RouterLink
                    to="/"
                    v-if="authUser"
                    class="link home"
                    :class="underlineClass"
                    >Meine Tweets</RouterLink
                >
                <RouterLink :to="{ name: 'post-create' }" v-if="authUser"
                    ><button>Post Erstellen</button></RouterLink
                >
            </nav>
        </div>
    </header>
</template>

<style scoped src="../../css/header.css"></style>
