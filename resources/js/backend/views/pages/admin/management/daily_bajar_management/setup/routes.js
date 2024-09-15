import setup from ".";
import All from "../All.vue";
import Form from "../Form.vue";
import Create from "../Create.vue";
import CreateForm from "../CreateForm.vue";
import Details from "../Details.vue";
import Edit from "../Edit.vue";
import EditForm from "../EditForm.vue";
import BajarDateWise from "../BajarDateWise.vue";
import BajarSingleDay from "../BajarSingleDay.vue";
import Layout from "../Layout.vue";

let route_prefix = setup.route_prefix;

const routes =
{
    path: '/daily-bajars',
    component: Layout,
    children: [
        {
            path: '',
            name: "All" + route_prefix,
            component: All,
        },
        {
            path: "create",
            name: "Create" + route_prefix,
            component: Create,
        },
        {
            path: "create-form",
            name: "CreateForm" + route_prefix,
            component: CreateForm,
        },
        {
            path: ":id",
            name: "Details" + route_prefix,
            component: Details,
        },
        {
            path: "edit/:id",
            name: "Edit" + route_prefix,
            component: Edit,
        },
        {
            path: "edit-form/:id",
            name: "EditForm" + route_prefix,
            component: EditForm,
            props: true,
        },
        {
            path: "bajar-date-wise",
            name: "BajarDateWise" + route_prefix,
            component: BajarDateWise,
        },
        {
            path: "bajar-single-day/:date",
            name: "BajarSingleDay" + route_prefix,
            component: BajarSingleDay,
        },

    ]
};


export default routes;
