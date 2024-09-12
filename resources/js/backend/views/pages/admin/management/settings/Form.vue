<template>
    <div>
        <form @submit.prevent="submitHandler" class="p-2">
            <div class="card w-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="text-capitalize">
                        {{ param_id ? "Update" : "Create" }} new {{ route_prefix }}
                    </h5>
                    <div>
                        <router-link v-if="item.slug" class="btn btn-outline-info me-2 btn-sm"
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
                        <!-- <template v-for="(form_field, index) in form_fields" :key="index">
                            <div
                                :class="form_field.row_col_class ? form_field.row_col_class : `col-md-12 mb-2`">
                                <div class="form-group">
                                    <label :for="form_field.name">{{ form_field.label }}</label>
                                    <input  :type="form_field.type" class="form-control"
                                            v-model="form_field.value"
                                            :name="form_field.name"
                                            :id="form_field.name"
                                            :placeholder="`Enter ` + form_field.label"/>
                                </div>
                            </div>
                        </template> -->
                        <template v-for="(form_field, index) in form_fields" :key="index">
                            <div :class="form_field.row_col_class ? form_field.row_col_class : `col-md-12`">
                                <common-input   :label="form_field.label"
                                                :type="form_field.type"
                                                :name="form_field.name"
                                                :multiple="form_field.multiple" :value="form_field.value"
                                                :data_list="form_field.data_list"
                                                :placeholder="`Enter ` + form_field.label"/>
                            </div>
                        </template>
                    </div>
                    <div class="row">

                        <div class="form-group mb-2">
                            <label for="meal_booking_alert_text_for_all"> Meal Booking Alert Text For All </label>
                            <textarea name="meal_booking_alert_text_for_all" id="meal_booking_alert_text_for_all" rows="2" class="form-control mt-1 mb-2" v-model="meal_booking_alert_text_for_all"></textarea>
                        </div>

                        <div class="form-group mb-2">
                            <label for="notice"> Notice </label>
                            <textarea name="notice" id="notice" rows="2" class="form-control mt-1 mb-2" v-model="notice"></textarea>
                        </div>

                        <div class="form-group mb-2">
                            <label for="shut_down_app"> Shutdown App </label>
                            <select name="shut_down_app" id="shut_down_app" class="form-control mt-1 mb-2" v-model="shut_down_app" >
                                <option value="">--- Select ---</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <template v-if="shut_down_app == 'inactive'">
                            <div class="form-group mb-2">
                                <label for="shut_down_reason"> Shutdown reason </label>
                                <input type="text" name="shut_down_reason" id="shut_down_reason" class="form-control mt-1 mb-2" placeholder="Enter Shutdown Reason" v-model="shut_down_reason">
                            </div>
                        </template>

                        <div class="form-group mb-2">
                                <label for="status"> Status </label>
                                <select name="status" id="status" class="form-control" v-model="status">
                                    <option value="">--- Select status ---</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>

                                </select>
                            </div>
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
            meal_booking_alert_text_for_all: "",
            notice: "",
            shut_down_app: "",
            shut_down_reason: "",
            status: "",

            // isDepartment: false,
            // isBatch: false,

            // previous_image:'',
            departments: [
                { id: "3", title: "IELTS" },
                { id: "4", title: "Spoken" },
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

                    this.meal_booking_alert_text_for_all = this.item.meal_booking_alert_text_for_all ?? "";
                    this.notice = this.item.notice ?? "";
                    this.shut_down_app = this.item.shut_down_app ?? "";
                    this.shut_down_reason = this.item.shut_down_reason ?? "";
                    this.status = this.item.status ?? "";


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

            // on_role_change($event) {
            //     $event.preventDefault();
            //     this.user_role_serial = $event.target.value;
            //     if ($event.target.value == 3) {
            //         this.isDepartment = true;
            //         this.isBatch = true;
            //     } else if($event.target.value == 4){
            //         this.isDepartment = true;
            //         this.isBatch = false;
            //     }else{
            //         this.isDepartment = false;
            //         this.isBatch = false;
            //     }
            // },

            // on_department_change($event) {
            //     this.department_id = $event.target.value;
            // },
            // on_batch_change($event) {
            //     this.batch_id = $event.target.value;
            // },
        },

        computed: {
            ...mapState(user_store, {
                item: "item",
            }),
        },
    };
</script>
