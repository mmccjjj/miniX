<script setup>
// refs verwenden wir um die Daten zu binden um sie reaktiv zu machen
import { ref } from "vue";

// wir importieren den AuthStore damit wir die Authentifizierung durchführen können

import { useAuthStore } from "@/store/AuthStore";
import router from "@/router";

// wir holen uns die login und getAuthUser Funktionen aus dem Store
const { login, getAuthUser } = useAuthStore();
// für das v-model binding, siehe unten im template und wir verwenden anschliessen im handleLogin die email.value
const email = ref("");
const password = ref("");

const handleLogin = async () => {
    // wir geben die email und password Werte an die login Funktion in unserem Store weiter
    await login({ email: email.value, password: password.value });

    // nach dem Login holen wir uns den authentifizierten User um ihn im Store zu speichern
    const res = await getAuthUser();

    // wenn der Status 200 ist, leiten wir den Benutzer auf die Dashboard-Seite weiter
    if (res.status === 200) router.push("/dashboard");
};
</script>
<template>
    <div>
        <h1>Login View</h1>
        <form @submit.prevent="handleLogin">
            <label for="email">Email:</label>
            <input type="text" v-model="email" />
            <label for="password">Password:</label>
            <input type="password" v-model="password" />
            <button type="submit">Login</button>
        </form>
    </div>
</template>
