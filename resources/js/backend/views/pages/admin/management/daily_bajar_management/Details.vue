<template>
    <div class="container py-2">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="text-capitalize">Details {{ setup.route_prefix }}</h5>
                    <div>
                        <router-link class="btn btn-outline-warning btn-sm me-2" :to="{ name: `BajarDateWisedaily_bajar` }">
                            Date Wise Bajar
                        </router-link>
                        <a class="btn btn-outline-warning btn-sm" @click="goBack">
                            Go Back
                        </a>
                    </div>
                </div>
                <div class="card-body card_body_fixed_height">
                    <div class="row">
                        <div class="col-lg-8">
                            <table class="table quick_modal_table">
                                <tbody>
                                    <!-- <tr>
                                        <th colspan="3">
                                            <img :src="item.image" alt="">
                                        </th>
                                    </tr> -->
                                    <tr>
                                        <th>Title</th>
                                        <th>:</th>
                                        <th>
                                            Value
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Title</th>
                                        <th>:</th>
                                        <th>
                                            {{ item.title }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>QTY</th>
                                        <th>:</th>
                                        <th>
                                            {{ item.qty }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Unit</th>
                                        <th>:</th>
                                        <th>
                                            {{ item.unit }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Price</th>
                                        <th>:</th>
                                        <th>
                                            {{ item.price }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <th>:</th>
                                        <th>
                                            {{ item.total }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Comment</th>
                                        <th>:</th>
                                        <th>
                                            {{ item.comment }}
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <router-link class="btn btn-outline-warning btn-sm"
                        :to="{
                            name: `Edit${setup.route_prefix}`,
                            params: { id: item.slug}
                        }">
                        Edit {{ setup.route_prefix }}
                    </router-link>

                    <a href="" v-if="item.prev_slug" @click.prevent="get_data(item.prev_slug)" class="btn btn-secondary btn-sm ml-2">
                        <i class="fa fa-angle-left"></i>
                        Previous {{ setup.route_prefix }} ({{ item.prev_count }})
                    </a>

                    <a href="" v-if="item.next_slug" @click.prevent="get_data(item.next_slug)" class="btn btn-secondary btn-sm ml-2">
                        Next {{ setup.route_prefix }} ({{ item.next_count }})
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
    </div>
</template>

<script>
import { mapActions, mapState, mapWritableState } from 'pinia'
import { store } from './setup/store';
import setup from "./setup";

export default {
    // data: () => ({
    //     setup,
    // }),
    // created: async function () {
    //     let id = this.param_id = this.$route.params.id;
    //     console.log(id);
    //     await this.get_data(id);
    // },
    // methods: {
    //     ...mapActions(user_store, {
    //         details: 'show_user_details',
    //     }),
    //     get_data: async function(slug){
    //         this.item = {};
    //         await this.details(slug)
    //     },
    // },
    // computed: {
    //     ...mapWritableState(user_store, {
    //         user:'user_details',
    //     }),
    // },

    data: () => ({
        setup,
    }),
    created: async function () {
        let id = this.param_id = this.$route.params.id;
        await this.get_data(id);
    },
    methods: {
        ...mapActions(store, {
            details: 'details',
        }),
        get_data: async function(slug){
            this.item = {};
            await this.details(slug)
        },
        goBack() {
            this.$router.go(-1)
        },
    },
    computed: {
        ...mapWritableState(store, {
            item: "item",
        }),
    },
}
</script>
