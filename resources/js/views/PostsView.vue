<script setup>
import { ref } from "vue";
import { authClient } from "@/store/AuthStore";

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

// Fetch Posts beim Mounten der Komponente
fetchPosts();
</script>

<template>
    <div>
        <h1>Alle Beiträge</h1>
        <p v-if="alertMessage">{{ alertMessage }}</p>
        <ul>
            <li v-for="post in posts" :key="post.id">
                <h2>{{ post.title }}</h2>
                <p>{{ post.content }}</p>
            </li>
        </ul>
    </div>
</template>
