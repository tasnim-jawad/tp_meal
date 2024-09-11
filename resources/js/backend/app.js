import './bootstrap';
import './plugins/axios_setup.js';
import './plugins/sweet_alert.js';

import { createApp } from 'vue';
import { createPinia } from 'pinia'
import { createRouter, createWebHashHistory } from 'vue-router';
import App from './views/App.vue';

// common components
import CommonInput from "./views/components/CommonInput.vue";
import ImageComponent from "../backend/views/components/ImageComponent.vue";
import Pagination from "../backend/views/components/Pagination.vue";
import DynamicSelect from '../backend/views/components/DynamicSelect.vue';
// import NestedCategory from '../backend/views/components/NestedCategory.vue';
// import TextEditor from '../backend/views/components/TextEditor.vue';
// project rotes
import admin_routes from "./views/pages/admin/routes";
import app_config from './views/pages/admin/app_config';

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

app.config.globalProperties.load_image = function(url){
    try {
        new URL(url);
        return url;
    } catch (error) {
        let full_url = app_config.image_host+'/'+url;
        full_url.replaceAll('//','/');
        return full_url;
    }
}

app.component('app', App);
app.component("common-input", CommonInput);
app.component("image-component", ImageComponent);
app.component("pagination", Pagination);
app.component("dynamicSelect", DynamicSelect);
// app.component("nestedCategory", NestedCategory);
// app.component("textEditor", TextEditor);

app.use(pinia)
app.use(router);
app.mount('#app')
