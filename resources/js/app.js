/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
import router from "./router";
window.Vue = require("vue");
//-----------------------Vuetify install---------------------------------------
import Vuetify from "vuetify";
import "material-design-icons-iconfont/dist/material-design-icons.css";
import * as VueGoogleMaps from "vue2-google-maps";
import _ from "lodash";
import * as geolib from "geolib";
import VuetifyNumberInput from "@jzolago/vuetify-number-input";
import ImgInputer from "vue-img-inputer";
import "vue-img-inputer/dist/index.css";
import VueMask from "v-mask";
import VueResource from "vue-resource";
import rcolor from "rcolor";
window.shapefile = require("shapefile");
Object.defineProperty(Vue.prototype, "$_", {
    value: _,
});
import moment from "moment";
import VueLazyLoad from "vue-lazyload";
import * as VueWindow from "@hscmap/vue-window";

Vue.use(geolib);
Vue.use(Vuetify);
Vue.use(VuetifyNumberInput);
Vue.component("ImgInputer", ImgInputer);
Vue.use(VueResource);
Vue.use(VueWindow);

Vue.use(VueGoogleMaps, {
    load: {
        key: "AIzaSyBKwT3-cq00IaM04TcHh1UiePAgjbp9LN4",
        libraries: "drawing,language=si,geometry,places,visualization",
    },
});

Vue.use(VueMask);
Vue.use(rcolor);
Vue.prototype.moment = moment;
Vue.use(VueLazyLoad);
Vue.use(require("@hscmap/vue-window"));

Vue.component(
    "passport-clients",
    require("./components/passport/Clients.vue").default
);

Vue.component(
    "passport-authorized-clients",
    require("./components/passport/AuthorizedClients.vue").default
);

Vue.component(
    "passport-personal-access-tokens",
    require("./components/passport/PersonalAccessTokens.vue").default
);

Vue.component("api-login", require("./components/admin/APILogin.vue").default);

Vue.component(
    "planning-dashboard",
    require("./components/admin/Dashboard.vue").default
);
Vue.component(
    "user-dashboard",
    require("./components/planning/Users.vue").default
);
Vue.component(
    "add-details-dashboard",
    require("./components/planning/AddDedails.vue").default
);

/**
 *
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router,
    vuetify: new Vuetify({
        theme: {
            dark: false,
        },
    }),
});
