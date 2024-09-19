import { createRouter, createWebHistory } from "vue-router";
import { storeToRefs } from "pinia";
import { useAuthStore } from "@/store/AuthStore";

import HomeView from "../views/HomeView.vue";

const router = createRouter({
    history: createWebHistory("/"),
    routes: [
        {
            path: "/",
            name: "home",
            component: HomeView,
        },

        {
            // Hier brauchen wir keine Meta-Informationen, da diese Route für nicht authentifizierte User zugänglich sein soll.
            path: "/register",
            name: "register",
            component: () => import("../views/RegisterView.vue"),
        },

        {
            // Hier brauchen wir keine Meta-Informationen, da diese Route für nicht authentifizierte User zugänglich sein soll.
            path: "/posts/create",
            name: "post-create",
            component: () => import("../views/PostCreateView.vue"),
            meta: { requiresAuth: true },
        },

        {
            // Hier brauchen wir keine Meta-Informationen, da diese Route für nicht authentifizierte User zugänglich sein soll.
            path: "/posts/edit/:id",
            name: "post-edit",
            component: () => import("../views/PostEditView.vue"),
            meta: { requiresAuth: true },
        },

        {
            // Hier brauchen wir keine Meta-Informationen, da diese Route für nicht authentifizierte User zugänglich sein soll.
            path: "/posts/:id",
            name: "single-post",
            component: () => import("../views/SinglePostView.vue"),
        },

        
    ],
});

router.beforeEach(async (to, from, next) => {
    const { getAuthUser } = useAuthStore();
    const { authUser } = storeToRefs(useAuthStore());
    const reqAuth = to.matched.some((record) => record.meta.requiresAuth);

    if (reqAuth && !authUser.value) {
        await getAuthUser();
        if (!authUser.value) next("/");
        next();
    } else {
        next(); // make sure to always call next()!
    }
});

export default router;

//TODO Guard Anwenden