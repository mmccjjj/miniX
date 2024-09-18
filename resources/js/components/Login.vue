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
    try {
        await login({ email: email.value, password: password.value });
    } catch (error) {
        alert("Login fehlgeschlagen: Ungültige Email oder Passwort.");
    }
    const res = await getAuthUser();
};
</script>
<template>
    <div class="loginContainer">
        <h1>Live and Trending</h1>
        <p class="sub">Welcome back!</p>
        <div class="login">
            <h1>Login</h1>
            <form @submit.prevent="handleLogin">
                <div class="email">
                    <label for="email">Email:</label> <br />
                    <input type="text" v-model="email" />
                </div>
                <div class="password">
                    <label for="password">Password:</label> <br />
                    <input type="password" v-model="password" /><br />
                    <div class="controll">
                        <p>
                            Dont have an account?
                            <router-link to="/register">Sign up</router-link>
                        </p>
                        <button type="submit">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped src="../../css/login.css"></style>
