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
                    <div class="date_container">
                        <span>Date: </span> <span>{{ param_date }}</span>
                    </div>
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
                                    <th>Title</th>
                                    <th>QTY</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in data" :key="index">
                                    <td>
                                        <!-- <div class="action_btn d-flex gap-2 p-2">
                                            <router-link :to="{ name: 'Alldaily_bajar', params: { id: index } }" class="btn btn-outline-warning btn-sm">
                                                <i class="fa-solid fa-info"></i>
                                            </router-link>

                                        </div> -->

                                        <table-row-action :item="item"></table-row-action>


                                    </td>
                                    <td>{{ index + 1 }}</td>
                                    <td>
                                        {{ item.title }}
                                    </td>
                                    <td>
                                        {{ item.qty }}
                                    </td>
                                    <td>
                                        {{ item.unit }}
                                    </td>
                                    <td>
                                        {{ item.price }}
                                    </td>
                                    <td>
                                        {{ item.total }} /-
                                    </td>
                                    <td>
                                        {{ item.comment }}
                                    </td>

                                </tr>
                                <tr v-if="daily_total > 0">
                                    <td class="text-end pe-3" colspan="6">total</td>
                                    <td class="text-danger fw-bold">{{ daily_total }} /-</td>
                                    <td></td>
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
import TableRowAction from './components/all_data_page/TableRowAction.vue';
export default {
    components: { TableRowAction },

    data: () => ({
        param_date:null,
        data:null,
        daily_total: 0,
    }),
    computed: {
        ...mapState(data_store, {
        setup: "setup",
        }),
    },
    created:async function(){
        this.param_date = this.$route.params.date;

        let data = await this.single_day_bajar({
            'date': this.param_date,
        });

        if(data.data.status == "success"){
            this.data = data.data.data
            this.daily_total = data.data.daily_total
        }else{
            this.data = []
        }
    },
    methods: {
        ...mapActions(data_store, {
            single_day_bajar: "single_day_bajar",
        }),

    },
};
</script>
<style>

.width_40{
    width: 40%;
}
</style>
