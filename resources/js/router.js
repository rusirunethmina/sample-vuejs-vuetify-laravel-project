import Vue from "vue";
import Router from "vue-router";
import APILogin from "./components/admin/APILogin";
import PlanningHome from './components/planning/planningHome';
import User from './components/planning/Users';
import Details from "./components/planning/AddDedails";

Vue.use(Router);

const routes = [
    {
        path: "/logout",
        component: APILogin,
    },
    {
        path: "/Apilogin",
        component: APILogin,
    },

    {
        path: "/planning",
        component: PlanningHome,
    },
    {
        path: "/users",
        component: User,
    },
    {
        path: "/details",
        component: Details,
    },
];

export default new Router({
    state: {
        userIsAuthorized: true,
    },
    mode: "history",
    routes
});
