//TODO In Componente auslagern, komponente und view unterschied!! in Dashboard!!

<script setup>
import { ref, onMounted } from "vue";
import { authClient, useAuthStore } from "@/store/AuthStore";
import { storeToRefs } from "pinia";
import Posts from "../components/Posts.vue";
import Login from "../components/Login.vue";
const { authUser } = storeToRefs(useAuthStore());
const { getAuthUser } = useAuthStore();

const posts = ref([]);

const getPost = async () => {
    const res = await authClient.get("/api/posts");
    posts.value = res.data;
};

onMounted(async () => {
    await getPost();
});
</script>

<template>
    <div class="content">
        <Login v-if="authUser == null" />
        <Posts v-if="authUser" />
    </div>
</template>
