<template>
    <div class="row m-0 mt-3">
        <div class="col-sm-12">
            <div class="card w-100">
                <div class="card-header py-1 d-flex align-items-center justify-content-between gap-2">
                    <!-- <form action="" id="month_form">
                        <div class="d-flex align-items-center gap-2">
                            <label class="session_label" for="month">Month</label>
                            <input type="month" name="month" id="month" class="rounded px-2" @change.prevent="month_submit"/>
                        </div>
                    </form> -->
                    <h2 class="pages_title">{{ setup.create_page_title }}</h2>
                    <router-link :to="{ name: `CreateForm${setup.route_prefix}` }" class="btn btn-outline-warning btn-sm">Create new Bajar </router-link>
                </div>
                <div class="card-body">
                    <div class="table-responsive table_responsive card_body_fixed_height">
                        <table class="table table-hover text-center table-bordered">
                            <thead>
                                <tr class="">
                                    <th>action</th>
                                    <th>#srl</th>
                                    <th class="width_40">Date</th>
                                    <th class="width_40">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in data" :key="index">
                                    <td>
                                        <div class="action_btn d-flex gap-2 p-2">
                                            <router-link :to="{ name: 'Alldaily_bajar', params: { id: index } }" class="btn btn-outline-warning btn-sm">
                                                <i class="fa-solid fa-info"></i>
                                            </router-link>

                                        </div>
                                    </td>
                                    <td>{{ index + 1 }}</td>
                                    <td>
                                        {{ item.date }}
                                    </td>
                                    <td>
                                        {{ item.daily_total }}  /-
                                    </td>

                                </tr>
                                <tr v-if="monthly_total > 0">
                                    <td class="text-end pe-3" colspan="3">total</td>
                                    <td class="text-danger fw-bold">{{ monthly_total }} /-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- <div class="card-footer py-2">
                    <button type="button" @click.prevent="import_data" class="btn btn-sm btn-primary submit_button" :disabled="data.length === 0">Submit</button>
                </div> -->
            </div>
        </div>
    </div>



</template>
<script>
import { mapActions, mapState } from "pinia";
import { store as data_store } from "./custom_store/store";
export default {
    data: () => ({
        data:null,
        monthly_total:0,
    }),
    computed: {
        ...mapState(data_store, {
        data: "data",
        setup: "setup",
        }),
    },
    created:async function(){
        let data = await this.date_wise_bajar();
        if(data.data.status == "success"){
            this.data = data.data.data
            this.monthly_total = data.data.monthly_total
        }else{
            this.data = []
        }
        console.log("final " , this.data);


    },
    methods: {
        ...mapActions(data_store, {
            date_wise_bajar: "date_wise_bajar",
        }),

        month_submit: async function () {
            let month = document.getElementById("month").value;

            let data = await this.date_wise_bajar({
                'month': month
            });

            if(data.data.status == "success"){
                this.data = data.data.data
                this.monthly_total = data.data.monthly_total
            }else{
                this.data = []
            }
        },

        submit_all: function (index) {
            this.delete_store_data({
                index: index,
            });
        },
        import_data: function () {
            const session_form = document.getElementById("session_form");
            let formData = new FormData(session_form);
            // for (let [key, value] of formData.entries()) {
            //     console.log(`${key}: ${value}`);
            // }

        },
    },
};
</script>
<style>

.width_40{
    width: 40%;
}
</style>
