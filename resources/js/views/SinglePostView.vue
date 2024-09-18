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
    <div class="content">
        <div class="singlePostElement">
            <div v-if="post">
                <p class="dateTitle">
                    Post vom {{ formatDate(post.created_at) }}
                </p>
                <h2>{{ post.title }}</h2>
                <p class="postText">{{ post.content }}</p>
                <!-- Zurück zum Post-Feed -->
                <div class="buttons">
                    <router-link
                        :to="{ name: 'post-edit', params: { id: post.id } }"
                        ><button class="editButton">
                            Post bearbeiten
                        </button></router-link
                    >
                    <postDeleteButton
                        type="button"
                        :post_id="route.params.id"
                    />
                </div>
            </div>
            <div v-else>
                <p>{{ alertMessage }}</p>
            </div>
        </div>
    </div>
</template>

<style scoped src="../../css/singlePost.css"></style>
