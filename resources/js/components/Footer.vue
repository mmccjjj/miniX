<script setup>
import { useAuthStore, authClient } from "@/store/AuthStore";
import { useRouter } from "vue-router";
import { storeToRefs } from "pinia";
const { authUser } = storeToRefs(useAuthStore());
const { logout } = useAuthStore();
const router = useRouter();

const handleLogout = () => {
    logout();
    router.push("/");
};
</script>

<template>
    <footer>
        <p>Mini-X built with Laravel</p>
        <a href="#" v-if="authUser" @click.prevent="handleLogout">Logout</a>
    </footer>
</template>

<style scoped src="../../css/footer.css"></style>
