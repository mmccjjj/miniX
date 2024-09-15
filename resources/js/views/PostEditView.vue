<script setup>
import { ref, onMounted } from "vue";
import { authClient } from "@/store/AuthStore";
import { useRoute } from "vue-router";

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
const handleCreate = async () => {
    try {
        const res = await authClient.post("/api/posts", {
            title: title.value,
            content: content.value,
        });
    } catch (e) {
        alert("Etwas ist schief gelaufen");
        console.log();
    }
};
</script>

<template>
    <div>
        <form method="POST" @submit.prevent="handleCreate">
            <div class="form-group">
                <label for="title">Titel:</label>
                <input type="text" id="title" name="title" v-model="title" />
            </div>

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea
                    id="content"
                    name="content"
                    v-model="content"
                    placeholder="Was gibts neuse?"
                ></textarea>
                <button>submit</button>
            </div>
        </form>
    </div>
</template>
