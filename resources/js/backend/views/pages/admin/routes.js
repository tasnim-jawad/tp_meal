import MainLayout from "./partials/MainLayout.vue"
import Dashboard from "./Dashboard.vue"


import user_management from "../admin/management/user_management/setup/routes"
import batch_management from "../admin/management/batch_management/setup/routes"
import settings from "../admin/management/settings/setup/routes"
import holiday_management from "../admin/management/holiday_management/setup/routes"
import daily_bajar_management from "../admin/management/daily_bajar_management/setup/routes"
import payment_management from "../admin/management/payment_management/setup/routes"


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
        settings,
        holiday_management,
        daily_bajar_management,
        payment_management,

    ]
};


export default routes;
