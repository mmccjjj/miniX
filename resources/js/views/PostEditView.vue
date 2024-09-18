<script setup>
import { ref, onMounted } from "vue";
import { authClient } from "@/store/AuthStore";
import { useRoute } from "vue-router";
import router from "@/router";
import postDeleteButton from "../components/Buttons/PostButtonDelete.vue";

const route = useRoute();
const post = ref([]);
const title = ref("");
const content = ref("");

const post_id = route.params.id;

const getPost = async (id) => {
    const res = await authClient.get(`/api/posts/${id}`);
    post.value = res.data;
    title.value = post.value.title;
    content.value = post.value.content;
};

onMounted(() => {
    getPost(post_id);
});

//TODO Variable ID einfügen dass der richtige post aktuallisiert wird
const handleUpdate = async (id) => {
    try {
        const res = await authClient.put(`/api/posts/${id}`, {
            title: title.value,
            content: content.value,
        });
        if (res.status == 200) {
            router.push({ name: "home" });
        }
    } catch (e) {
        alert("Etwas ist schief gelaufen");
        console.log();
    }
};
</script>

<template>
    <div class="content">
        <div class="postEditElement">
            <h1>Post bearbeiten</h1>
            <form method="POST" @submit.prevent="handleUpdate(post_id)">
                <div class="form-group">
                    <label for="title">Titel:</label><br />
                    <input
                        type="text"
                        id="title"
                        name="title"
                        v-model="title"
                    />
                </div>
                <div class="form-group">
                    <label for="content">Content:</label><br />
                    <textarea
                        id="content"
                        name="content"
                        v-model="content"
                        placeholder="Was gibts neuse?"
                    ></textarea
                    ><br />
                    <button>Post updaten</button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped src="../../css/postEdit.css"></style>
