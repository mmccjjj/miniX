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
    if (respUser.status == 200) router.push("/dashboard");
};
</script>

<template>
    <div class="content">
        <form method="POST" @submit.prevent="handleRegister">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" v-model="name" />
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" v-model="email" />
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    v-model="password"
                />
            </div>

            <div class="form-group">
                <label for="password_confirmation">Password:</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    v-model="password_confirmation"
                />
            </div>
            <button>Submit</button>
        </form>
    </div>
</template>
