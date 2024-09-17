<template>
    <div>
        <form @submit.prevent="submitHandler" class="p-2">
            <div class="card w-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="text-capitalize">{{ param_id ? 'Update' : 'Create' }} new {{ route_prefix }}</h5>
                    <div>
                        <!-- <router-link v-if="item.slug" class="btn btn-outline-info mr-2 btn-sm"
                            :to="{ name: `Details${route_prefix}`, params: {id: item.slug} }">
                            Details {{ route_prefix }}
                        </router-link> -->
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
                        <input type="hidden" name="id" :value="item.id">
                        <div class="form-group mb-2">
                            <label for="title">Title</label>
                            <input  type="text" class="form-control"
                                    name="title" id="title"
                                    :value="item.title"
                                    required="">
                        </div>
                        <div class="form-group mb-2">
                            <label for="qty">qty</label>
                            <input  type="number" class="form-control"
                                    name="qty" id="qty"
                                    v-model="qty"
                                    required="">
                        </div>

                        <div class="form-group mb-2">
                            <label for="role">Unit</label>
                            <select name="unit" class="form-control input_padding" v-model="item.unit" >
                                <option value="">-- select --</option>
                                <option v-for="unit in units" :value="unit.value" :key="unit">
                                    {{ unit.title }}
                                </option>
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label for="price">Price</label>
                            <input  type="number" class="form-control"
                                    name="price" id="price"
                                    v-model="price"
                                    required="">
                        </div>
                        <div class="form-group mb-2">
                            <label for="total">Total</label>
                            <input  type="number" class="form-control"
                                    name="total" id="total"
                                    v-model="total"
                                    required="" readonly>
                        </div>

                        <div class="form-group mb-2">
                            <label for="date">Date</label>
                            <input  type="date" class="form-control"
                                    name="date" id="date"
                                    :value="item.date"
                                    >
                        </div>

                        <div class="form-group mb-2">
                            <label for="comment">Comment</label>
                            <input  type="text" class="form-control"
                                    name="comment" id="comment"
                                    :value="item.comment"
                                    >
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
import { mapActions, mapState } from 'pinia'
import { store as data_store } from './setup/store';
import setup from "./setup";
import form_fields from "./setup/form_fields";

export default {
    data: () => ({
        route_prefix: '',
        prefix: '',
        param_id: null,
        qty: 0,
        price: 0,
        total: 0,
        units: [
            { value: 'kg', title: 'kg' },
            { value: 'gm', title: 'gm' },
            { value: 'liter', title: 'liter' },
            { value: 'piece', title: 'piece' },
        ],
    }),
    created: async function () {
        let id = this.param_id = this.$route.params.id;
        this.route_prefix = setup.route_prefix;
        this.prefix = setup.prefix;
        // this.selected_role = this.user.role;

        // console.log(this.form_fields);
        // this.reset_fields();

        // if (id) {
        //     this.set_fields(id);
        // }

        if (id) {
            this.details(id);
        }
        // this.qty = this.item.qty;
        // this.price = this.item.price;
        // this.total = this.item.total;
        this.set_value();
    },
    methods: {
        ...mapActions(data_store, {
            details: 'details',
            update: 'update',
        }),
        submitHandler: async function ($event) {
            let res = await this.update($event)
            console.log(res);
            if(res.data.status){
                window.s_alert("data updated");

            }else{

            }
        },

        goBack() {
            this.$router.go(-1)
        },

        set_value() {
            if (this.item) {
                this.qty = this.item.qty || 0;
                this.price = this.item.price || 0;
                this.total = this.item.total || this.qty * this.price;
            }
        }
    },

    computed: {
        ...mapState(data_store, {
            item:'item',
        }),
    },
    watch:{
        item: {
            handler: function () {
                this.set_value();
            },
            immediate: true,
        },

        qty:function(){
            this.total = this.qty * this.price
        },
        price:function(){
            this.total = this.qty * this.price
        }
    }
}
</script>
