<script setup>
import { ref } from "vue";
import { useAuthStore } from "@/store/AuthStore";
import router from "@/router";

const { register, getAuthUser } = useAuthStore();

const name = ref("");
const email = ref("");
const password = ref("");
const password_confirmation = ref("");

const handleRegister = async () => {
    const respReg = await register({
        name: name.value,
        email: email.value,
        password: password.value,
        password_confirmation: password_confirmation.value,
    });

    if (respReg.status !== 201) {
        return alert("Something went wrong");
    }

    const respUser = await getAuthUser();
    if (respUser.status == 200) router.push("/");
};
</script>

<template>
    <div class="content">
        <div class="registerElement">
            <div class="fullTitle">
                <h1>Live and Trending</h1>
                <p class="title2">Join now!</p>
            </div>
            <form method="POST" @submit.prevent="handleRegister">
                <h1 class="subTitle">Register</h1>
                <div class="form-group">
                    <label for="name">Name:</label><br />
                    <input type="text" id="name" name="name" v-model="name" />
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label><br />
                    <input
                        type="text"
                        id="email"
                        name="email"
                        v-model="email"
                    />
                </div>
                <div class="form-group">
                    <label for="password">Password:</label><br />
                    <input
                        type="password"
                        id="password"
                        name="password"
                        v-model="password"
                    />
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Password:</label><br />
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        v-model="password_confirmation"
                    />
                </div>
                <div class="submitArea">
                    <p class="loginLink">
                        Have already an account?
                        <router-link to="/">Log in</router-link>
                    </p>
                    <button>Register</button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped src="../../css/register.css"></style>
