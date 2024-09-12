import MainLayout from "./partials/MainLayout.vue"
import Dashboard from "./Dashboard.vue"


import user_management from "../admin/management/user_management/setup/routes"
import batch_management from "../admin/management/batch_management/setup/routes"


const routes = {
    path: '',
    component: MainLayout,
    children: [
        {
            path: 'dashboard',
            component: Dashboard,
            name: 'adminDashboard',
        },
        user_management,
        batch_management,

    ]
};


export default routes;
