<script setup>
import { ref } from "vue";
import { authClient } from "@/store/AuthStore";
import { useRouter } from "vue-router";

const title = ref("");
const content = ref("");
const alertMessage = ref("");
const router = useRouter();

const handleCreate = async () => {
    try {
        const res = await authClient.post("/api/posts", {
            title: title.value,
            content: content.value,
        });

        if (res.status == 201) router.push({ name: "home" });
    } catch (e) {
        alert("Etwas ist schief gelaufen");
        console.log(e);
    }
};
</script>

<template>
    <div class="content">
        <div class="createElement">
            <div v-if="alertMessage">{{ alertMessage }}</div>
            <div class="fullTitle">
                <h1>Post erstellen</h1>
                <p class="title2">Was möchtest Du mitteilen?</p>
            </div>
            <form method="POST" @submit.prevent="handleCreate">
                <div class="form-group">
                    <label for="title">Titel</label><br />
                    <input
                        type="text"
                        id="title"
                        name="title"
                        v-model="title"
                        placeholder="Dein Titel..."
                    />
                </div>
                <div class="form-group">
                    <label for="content">Text</label><br />
                    <textarea
                        id="content"
                        name="content"
                        v-model="content"
                        placeholder="Was gibts neuse?"
                    ></textarea
                    ><br />
                    <button>Post speichern</button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped src="../../css/postCreate.css"></style>
