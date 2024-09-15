//TODO In Componente auslagern, komponente und view unterschied!! in Dashboard!!

<script setup>
import { ref, onMounted } from "vue";
import { authClient } from "@/store/AuthStore";

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
        <h1>Home View</h1>
        <div v-for="post in posts" :key="post.id">
            <h3>{{ post.title }}</h3>
            <p>{{ post.content }}</p>
        </div>
    </div>
</template>
