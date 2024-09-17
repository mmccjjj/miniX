<script setup>
import { ref, onMounted } from "vue";
import { storeToRefs } from "pinia";
import { useAuthStore, authClient } from "@/store/AuthStore";
import router from "@/router";
const { authUser } = storeToRefs(useAuthStore());

const posts = ref([]);
const alertMessage = ref("");

const fetchPosts = async () => {
    try {
        const res = await authClient.get("/api/posts"); // Abrufen aller Posts

        if (res.status === 200) {
            posts.value = res.data; // Speichern der abgerufenen Posts
        }
    } catch (e) {
        alertMessage.value = "Etwas ist schief gelaufen";
        console.error(e); // Fehler in der Konsole anzeigen
    }
};

const formatDate = (rawDate) => {
    const date = new Date(rawDate);
    const day = String(date.getDate()).padStart(2, "0");
    const month = String(date.getMonth() + 1).padStart(2, "0");
    const year = date.getFullYear();
    return `${day}.${month}.${year}`;
};

// Fetch Posts beim Mounten der Komponente
fetchPosts();
</script>

<template>
    <div class="postsContainer">
        <p class="miniTitle titel">FEED VON</p>
        <h1 class="titel">{{ authUser.name }}</h1>
        <p v-if="alertMessage">{{ alertMessage }}</p>
        <ul>
            <li v-for="post in posts" :key="post.id">
                <p>{{ formatDate(post.created_at) }}</p>
                <h2>{{ post.title }}</h2>
                <p>{{ post.content }}</p>
                <RouterLink
                    :to="{ name: 'single-post', params: { id: post.id } }"
                    ><button>Post ansehen</button></RouterLink
                >
            </li>
        </ul>
    </div>
</template>
<style scoped src="../../css/posts.css"></style>
