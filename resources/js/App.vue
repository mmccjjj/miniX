<script setup>
import { RouterView } from "vue-router";
import CstmHeader from "./components/Header.vue";
</script>

<template>
    <div>
        <CstmHeader />
        <RouterView />
    </div>
</template>
