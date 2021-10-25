import {CreateElement} from "vue";
import {Component, Vue} from "vue-property-decorator";
import {createInertiaApp, CreateInertiaAppProps,} from "@inertiajs/inertia-vue";
// @ts-ignore
import {Ziggy} from "@/scripts/routes/web";
// @ts-ignore
import {ZiggyVue} from "ziggy-js/dist/vue";
import VueMeta from "vue-meta";
import "lodash";
import "bootstrap";
import "bootstrap/scss/bootstrap.scss";

Vue.use(ZiggyVue, Ziggy);
Vue.use(VueMeta);

Component.registerHooks([
    "beforeRouteEnter",
    "beforeRouteUpdate",
    "beforeRouteLeave",
    "metaInfo",
]);

const inertiaApp: any = createInertiaApp(<CreateInertiaAppProps>{
    resolve: (name: string) => {
        const pages: any = import.meta.glob("../views/pages/**/*.vue");

        const importPage: any = pages[`../views/pages/${name}.vue`];

        if (!importPage) {
            throw new Error(
                `Unknown page ${name}. Is it located under Pages with a .vue extension?`
            );
        }

        return importPage().then((module: any) => module.default);
    },
    setup({el, App, props}: any) {
        new Vue({
            render: (h: CreateElement) => h(App, props),
        }).$mount(el);
    },
});
