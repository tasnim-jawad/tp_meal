<template>
    <div>
        <form @submit.prevent="submitHandler" class="p-2">
            <div class="card w-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="text-capitalize">
                        {{ param_id ? "Update" : "Create" }} new {{ route_prefix }}
                    </h5>
                    <div>
                        <router-link v-if="item.slug" class="btn btn-outline-info mr-2 btn-sm"
                            :to="{ name: `Details${route_prefix}`, params: { id: item.slug },}">
                            Details {{ route_prefix }}
                        </router-link>
                        <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `All${route_prefix}` }">
                            All {{ route_prefix }}
                        </router-link>
                    </div>
                </div>
                <div class="card-body card_body_fixed_height">
                    <div class="row">
                        <template v-for="(form_field, index) in form_fields" :key="index">
                            <div
                                :class="form_field.row_col_class ? form_field.row_col_class : `col-md-12 mb-2`">
                                <div class="form-group">
                                    <label :for="form_field.name">{{ form_field.label }}</label>
                                    <input :type="form_field.type" class="form-control" v-model="form_field.value" :name="form_field.name" :id="form_field.name" :placeholder="`Enter ` + form_field.label" required />
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="row">
                        <div class="form-group mb-2">
                            <label for="batch_id"> Profile Image </label>
                            <image-component name="image"> </image-component>
                        </div>
                        <div class="form-group mb-2">
                            <label for="user_role_serial">Role</label>
                            <select name="user_role_serial" id="user_role_serial" class="form-control" @change="on_role_change($event)">
                                <option value="">--- select role ---</option>
                                <option v-for="role in roles" :value="role.serial" :key="role">
                                    {{ role.title }}
                                </option>
                            </select>
                        </div>
                        <template v-if="isDepartment">
                            <div class="form-group mb-2">
                                <label for="department_id"> Department </label>
                                <select name="department_id" id="department_id" class="form-control" @change.prevent="on_department_change">
                                    <option value="">--- Select Department ---</option>
                                    <option v-for="department in departments" :value="department.id" :key="department">
                                        {{ department.title }}
                                    </option>
                                </select>
                            </div>
                        </template>

                        <template v-if="isBatch">
                            <div class="form-group mb-2">
                                <label for="batch_id"> Batch </label>
                                <select name="batch_id" id="batch_id" class="form-control" @change.prevent="on_batch_change">
                                    <option value="">--- Select Department ---</option>
                                    <option v-for="batch in batchs" :value="batch.id" :key="batch">
                                        {{ batch.title }}
                                    </option>
                                </select>
                            </div>
                        </template>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-square px-5">
                        <i class="icon-lock"></i>
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import { mapActions, mapState } from "pinia";
    import { store as user_store } from "./setup/store";
    import setup from "./setup";
    import form_fields from "./setup/form_fields";
    import CustomDropdown from "./components/dropdown/DropDownEl.vue";
    import ImageComponent from "../../../../components/ImageComponent.vue";
    import DynamicSelect from "../../../../components/DynamicSelect.vue";

    export default {
        components: { CustomDropdown, ImageComponent, DynamicSelect },
        data: () => ({
            route_prefix: "",
            form_fields,
            param_id: null,
            user_role_serial: "",
            department_id: "",
            batch_id: "",

            isDepartment: false,
            isBatch: false,

            roles: [
                { serial: "2", title: "Admin" },
                { serial: "3", title: "Student" },
                { serial: "4", title: "Employee" },
            ],

            departments: [
                { id: "1", title: "English" },
                { id: "2", title: "IT" },
                { id: "3", title: "IELTS" },
                { id: "4", title: "Spoken" },
            ],

            batchs: [
                { id: "1", title: "IELTS_1" },
                { id: "2", title: "IELTS_2" },
                { id: "3", title: "Spoken_1" },
                { id: "4", title: "Spoken_2" },
            ],
        }),
        created: async function () {
            let id = (this.param_id = this.$route.params.id);
            this.route_prefix = setup.route_prefix;

            this.reset_fields();

            if (id) {
                this.set_fields(id);
            }
        },
        methods: {
            ...mapActions(user_store, {
                create: "create",
                update: "update",
                details: "details",
            }),
            reset_fields: function () {
                this.form_fields.forEach((item) => {
                    item.value = "";
                });
            },
            set_fields: async function (id) {
                this.param_id = id;
                await this.details(id);
                if (this.item) {
                    this.form_fields.forEach((field, index) => {
                        Object.entries(this.item).forEach((value) => {
                            if (field.name == value[0]) {
                                this.form_fields[index].value = value[1];
                            }
                        });
                    });
                }
            },

            submitHandler: async function ($event) {
                if (this.param_id) {
                    let response = await this.update($event);
                    if ([200, 201].includes(response.status)) {
                        window.s_alert("data updated");
                        this.$router.push({ name: `Details${this.route_prefix}` });
                    }
                } else {
                    let response = await this.create($event);
                    if ([200, 201].includes(response.status)) {
                        window.s_alert("data created");
                        this.$router.push({ name: `All${this.route_prefix}` });
                    }
                }
            },

            on_role_change($event) {
                $event.preventDefault();
                this.user_role_serial = $event.target.value;
                if ($event.target.value == 3) {
                    this.isDepartment = true;
                    this.isBatch = true;
                } else {
                    this.isDepartment = false;
                    this.isBatch = false;
                }
            },

            on_department_change($event) {
                this.department_id = $event.target.value;
            },
            on_batch_change($event) {
                this.batch_id = $event.target.value;
            },
        },

        computed: {
            ...mapState(user_store, {
                item: "item",
            }),
        },
        watch: {
            department_id: function () {
                console.log("department_id", this.department_id);
            },
            batch_id: function () {
                console.log("batch_id", this.batch_id);
            },
            user_role_serial: function () {
                console.log("user_role_serial", this.user_role_serial);
            },
        },
    };
</script>
