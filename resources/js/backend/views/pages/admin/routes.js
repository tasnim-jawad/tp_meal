import MainLayout from "./partials/MainLayout.vue"
import Dashboard from "./Dashboard.vue"

const routes = {
    path: '',
    component: MainLayout,
    children: [
        {
            path: 'dashboard',
            component: Dashboard,
            name: 'adminDashboard',
        },

        //blog management routes

    ]
};


export default routes;
