<template>
    <div class="container py-2">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="text-capitalize">Details {{ setup.route_prefix }}</h5>
                    <div>
                        <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `All${setup.route_prefix}` }">
                            All {{ setup.route_prefix }}
                        </router-link>
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
                                    <tr class="border-bottom">
                                        <th>Title</th>
                                        <th>:</th>
                                        <th>
                                            Value
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td>:</td>
                                        <td>
                                            {{ item.name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Role</td>
                                        <td>:</td>
                                        <td>
                                            {{ item.user_role_serial }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Department</td>
                                        <td>:</td>
                                        <td>
                                            {{ item.department_id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Batch</td>
                                        <td>:</td>
                                        <td>
                                            {{ item.batch_id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>
                                            {{ item.email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>image</td>
                                        <td>:</td>
                                        <td>
                                            <img :src="item.image" alt="" widtd="150">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td>:</td>
                                        <td>
                                            {{ item.gender }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mobile</td>
                                        <td>:</td>
                                        <td>
                                            {{ item.mobile }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Whatsapp</td>
                                        <td>:</td>
                                        <td>
                                            {{ item.whatsapp }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Telegram</td>
                                        <td>:</td>
                                        <td>
                                            {{ item.telegram }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>:</td>
                                        <td>
                                            {{ item.address }}
                                        </td>
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
    },
    computed: {
        ...mapWritableState(store, {
            item: "item",
        }),
    },
}
</script>
