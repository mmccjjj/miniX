<script setup>
import { ref, onMounted } from "vue";
import { storeToRefs } from "pinia";
import { useAuthStore, authClient } from "@/store/AuthStore";
import router from "@/router";
const { authUser } = storeToRefs(useAuthStore());
const { logout } = useAuthStore();

const handleLogout = () => {
    logout();
    router.push("/login");
};

const posts = ref([]);

const getPost = async () => {
    const res = await authClient.get("/api/posts");
    posts.value = res.data;
};

onMounted(async () => {
    getPost();
});
</script>
<template>
    <div>
        <h1>Dashboard View</h1>
        <p>Welcome, {{ authUser.name }}</p>
        <button @click="handleLogout">Logout</button>
    </div>
    <div>
        <h1>Alle Beiträge</h1>

        <ul>
            <li v-for="post in posts" :key="post.id">
                <h2>{{ post.title }}</h2>
                <p>{{ post.content }}</p>
                <router-link
                    :to="{ name: 'post-edit', params: { id: post.id } }"
                    >Edit</router-link
                >
            </li>
        </ul>
    </div>
</template>
