<script setup>
import { defineProps } from "vue";
import { authClient } from "@/store/AuthStore";
import router from "@/router";

const props = defineProps({
    post_id: null,
});

const postDelete = async (id) => {
    try {
        const res = await authClient.delete(`/api/posts/${id}`);

        if (res.status == "204") router.push({ name: "home" });
    } catch (e) {
        console.log(e);
    }
};
</script>

<template>
    <button @click="postDelete(props.post_id)">Löschen</button>
</template>

<style scoped>
button {
    background-color: #df1313;
    width: 126px;
    height: 38px;
    border-radius: 8px;
    border-style: none;
    color: #fff;
    font-size: 14px;
}
</style>
