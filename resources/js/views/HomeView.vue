//TODO In Componente auslagern, komponente und view unterschied!! in Dashboard!!

<script setup>
import { ref, onMounted } from "vue";
import { authClient, useAuthStore } from "@/store/AuthStore";
import CstmHeader from "../components/Header.vue";
import CstmFooter from "../components/Footer.vue";
import { storeToRefs } from "pinia";
import Login from "../components/Login.vue";
const { authUser } = storeToRefs(useAuthStore());

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
    <div class="content">
        <!-- <CstmHeader /> -->
        <Login v-if="authUser == null" />
        <CstmFooter />
        <!--         <div v-for="post in posts" :key="post.id">
            <h3>{{ post.title }}</h3>
            <p>{{ post.content }}</p>
        </div> -->
    </div>
</template>

<style scoped>
html {
    min-height: auto;
    display: flex;
    flex-direction: column;
}

.content {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}
</style>
