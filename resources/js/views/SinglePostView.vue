<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router"; // Für Zugriff auf route params
import { authClient } from "@/store/AuthStore";
import postDeleteButton from "../components/Buttons/PostButtonDelete.vue";

const route = useRoute(); // Route verwenden, um die ID zu erhalten
const post = ref(null);
const alertMessage = ref("");

const fetchPost = async () => {
    try {
        const res = await authClient.get(`/api/posts/${route.params.id}`);
        if (res.status === 200) {
            post.value = res.data;
        }
    } catch (e) {
        alertMessage.value = "Fehler beim Laden des Posts";
        console.error(e);
    }
};

const formatDate = (rawDate) => {
    const date = new Date(rawDate);
    const day = String(date.getDate()).padStart(2, "0");
    const month = String(date.getMonth() + 1).padStart(2, "0");
    const year = date.getFullYear();
    return `${day}.${month}.${year}`;
};

// Post beim Mounten der Komponente abrufen
onMounted(fetchPost);
</script>

<template>
    <div v-if="post" class="content">
        <p>Post vom {{ formatDate(post.created_at) }}</p>
        <h2>{{ post.title }}</h2>
        <p>{{ post.content }}</p>
        <!-- Zurück zum Post-Feed -->
        <router-link :to="{ name: 'post-edit', params: { id: post.id } }"
            ><button>Bearbeiten</button></router-link
        >
        <postDeleteButton type="button" :post_id="route.params.id" />
    </div>
    <div v-else>
        <p>{{ alertMessage }}</p>
    </div>
</template>
