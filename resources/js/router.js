import Vue from "vue";
import VueRouter from "vue-router";
import TodoComponent from "./components/TodoComponent";
import LoginPageComponent from "./pages/LoginPageComponent";

Vue.use(VueRouter);

const router = new VueRouter({
  mode: "history",
  routes: [
    {
      path: "/todo",
      name: "todo",
      component: TodoComponent,
    },
    {
      path: "/login",
      name: "login",
      component: LoginPageComponent,
    },
  ],
});

export default router;
