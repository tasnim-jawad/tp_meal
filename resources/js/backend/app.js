import './bootstrap';
import './plugins/axios_setup.js';
import './plugins/sweet_alert.js';

import { createApp } from 'vue';
import { createPinia } from 'pinia'
import { createRouter, createWebHashHistory } from 'vue-router';
import App from './views/App.vue';
// project rotes
import admin_routes from "./views/pages/admin/routes"

const router = createRouter({
    history: createWebHashHistory(),
    linkActiveClass: 'active',
    linkExactActiveClass: 'active',
    routes: [
        admin_routes,
    ]
})
// previous route store
router.beforeEach((to, from, next) => {
    to.href.length > 2 &&
        window.sessionStorage.setItem('prevurl', to.href);
    next();
});

router.afterEach((to, from) => {
    let el = document.querySelector(`[href="${to.href}"]`);
})

const app = createApp({});
const pinia = createPinia()

app.component('app', App);

app.use(pinia)
app.use(router);
app.mount('#app')
