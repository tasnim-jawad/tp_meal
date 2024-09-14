<template>
    <div class="vue_main_container pb-5 mt-3">
        <div class="table_topbar">
            <h2 class="pages_title">{{ setup.create_page_title }}</h2>
            <router-link :to="{ name: `Create${setup.route_prefix}` }"  class="btn btn-outline-warning btn-sm">Go Back</router-link>
        </div>
        <form class="form_border">
            <div class="mb-3 form-group">
                <label for="date">
                    Date
                </label>
                <input type="date" name="date" class="form-control input_padding" id="date" >
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    Product and Price
                </div>
                <div class="card-body">
                    <table class="table table-responsive karjokori_porikolpona_input_table">
                        <thead>
                            <tr >
                                <th>Action</th>
                                <th>srl#</th>
                                <th>Title</th>
                                <th>QTY</th>
                                <th>Unit</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row,index) in row_data" :key="index">
                                <td>
                                    <a class="btn btn-sm btn-outline-danger" @click.prevent="deleteRow(index)">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                                <td scope="row">{{ index + 1 }}</td>
                                <td>
                                    <input type="text" class="form-control" name="title" v-model="row.title" :class="{ error: errors[index] && errors[index].title }">
                                    <!-- <span v-if="errors[index] && errors[index].title" class="text-danger">{{ errors[index].title }}</span> -->
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="qty" v-model="row.qty" :class="{ error: errors[index] && errors[index].qty }">
                                </td>
                                <td>
                                    <select name="unit" class="form-control input_padding" v-model="row.unit" :class="{ error: errors[index] && errors[index].unit }">
                                        <option value="">-- select --</option>
                                        <option v-for="unit in units" :value="unit.value" :key="unit">
                                            {{ unit.title }}
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="price" v-model="row.price" :class="{ error: errors[index] && errors[index].price }">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="total" :value="row.qty * row.price" >
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="comment" >
                                </td>
                            </tr>
                            <tr v-if="row_data.length > 1">
                                <td colspan="6">
                                    ALL Total
                                </td>
                                <td>{{ all_total }} /-</td>
                                <td>taka</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-end">
                    <a class="btn btn-sm btn-outline-primary" @click.prevent="add_row"> Add New Row</a>
                </div>
            </div>

            <button type="submit" class="btn btn-primary submit_button" @click.prevent="validate_data">Submit</button>
        </form>
    </div>
</template>
<script>
// import setup from '../config/setup';
import { mapActions, mapState, storeToRefs } from "pinia";
import { store as data_store } from "./custom_store/store";
import MultiSelect from "../../../../components/MultiSelect.vue";
export default {
    components: {
        MultiSelect,
    },
    data:() => ({
        units: [
            { value: 'kg', title: 'kg' },
            { value: 'gm', title: 'gm' },
            { value: 'liter', title: 'liter' },
            { value: 'piece', title: 'piece' },
        ],

        submitted: false,
        row_data_object:{
            'title': '',
            'qty': '',
            'unit': '',
            'price': '',
            'total': '',
            'comment': '',
        },
        row_data:[],
        all_total: 0 ,
        errors: [],
    }),
    computed:{
        ...mapState(data_store,{
            setup: 'setup',
        }),
    },
    methods:{
        ...mapActions(data_store, {
            submit_form_store: 'submit_create_form',
            import: 'submit_create_form',
        }),
        submit_form:async function(event){
            // console.log("submitted");
            let formData = new FormData(event.target);
            for (let [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);
            }

            console.log(this.row_data);

            await this.submit_form_store({
                form_data:formData,
                department:this.selectedDepartments,
            })
            event.target.reset();
            // this.$router.push(`/bivagio-barshik-porikolpona/create`);
        },

        add_row:function(){
            this.row_data.push({...this.row_data_object})
        },
        deleteRow(index) {
            this.row_data.splice(index, 1);
        },

        validate_data: function() {
            this.errors = []; // Clear previous errors
            let valid = true;

            this.row_data.forEach((row, index) => {
                let rowErrors = {};

                if (!row.title ) {
                    console.log(row.title, "row  =---". row,index);

                    rowErrors.title = 'Title is required';
                    valid = false;
                }

                if (row.qty <= 0 ) {
                    rowErrors.qty = 'Quantity must be greater than zero';
                    valid = false;
                }

                if (!row.unit) {
                    rowErrors.unit = 'unit is required';
                    valid = false;
                }

                if (row.price <= 0) {
                    rowErrors.price = 'Price must be greater than zero';
                    valid = false;
                }

                this.errors[index] = rowErrors;

            });
            console.log(this.errors);

            if (valid) {
                this.submitData();
            }
        },
        submitData() {
            // Code to send data to backend if validation passes
            console.log('Data is valid and ready to be submitted');
        }

    },
    watch: {
        row_data: {
            handler() {
                this.all_total = this.row_data.reduce((sum, row) => sum + (row.qty * row.price || 0), 0);
            },
            deep: true  // This enables deep watching
        }
    }

}
</script>
<style>
.karjokori_porikolpona_input_table th,td{
    border: 1px solid rgba(0,0,0,0.17);
    vertical-align: middle;
    text-align: center;
}
.karjokori_porikolpona_input_table th{
    text-align: center;
    font-weight: 600;
}

/* for error */
.error {
    border: 2px solid #ff00006b !important;
    background-color: #fd000012 !important;
    box-shadow: 0 0 5px 2px rgb(255 0 0 / 29%) !important;
    color: #ff0000a8 !important;
}


</style>
