<script setup>
import { RouterView } from "vue-router";
import CstmHeader from "./components/Header.vue";
import CstmFooter from "./components/Footer.vue";
</script>

<template>
    <CstmHeader />
    <RouterView />
    <CstmFooter />
</template>
