import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "../store/auth";

const routes = [
  {
    path: "/",
    name: "TaskList",
    component: () => import("../components/TaskList.vue"),
    meta: { requiresAuth: true }
  },
  {
    path: "/create",
    name: "TaskCreate",
    component: () => import("../components/TaskCreate.vue"),
    meta: { requiresAuth: true }
  },
  {
    path: "/task/:id/edit",
    name: "TaskEdit",
    component: () => import("../components/TaskEdit.vue"),
    meta: { requiresAuth: true }
  },
  {
    path: "/task/:id",
    name: "TaskShow",
    component: () => import("../components/TaskShow.vue"),
    meta: { requiresAuth: true }
  },
  {
    path: "/login",
    name: "Login",
    component: () => import("../components/Login.vue"),
    meta: { requiresGuest: true }
  },
  {
    path: "/register",
    name: "Register",
    component: () => import("../components/Register.vue"),
    meta: { requiresGuest: true }
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach(async (to, from, next) => {
  const authStore = useAuthStore();
  
  if (to.meta.requiresAuth && !authStore.isAuthenticated) {
    next('/login');
  } else if (to.meta.requiresGuest && authStore.isAuthenticated) {
    next('/');
  } else {
    next();
  }
});

export default router;