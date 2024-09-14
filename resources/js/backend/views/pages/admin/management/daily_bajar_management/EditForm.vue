<template>
    <div class="vue_main_container">
        <div class="table_topbar ">
            <h2 class="pages_title">{{ setup.edit_page_title }}</h2>
            <router-link :to="{ name: 'CreateBarshikPorikolpona' }"  class="btn btn-outline-warning btn-sm">Go Back</router-link>
        </div>
        <form @submit.prevent="update_data" v-if="all_data !== null" class="form_border">
            <div class="mb-3 form-group">
                <label for="clause">দফা</label>
                <select name="clause" id="clause" class="form-control input_padding" v-model="all_data.clause">
                    <option value="">--- select clause ---</option>
                    <option value="দফা ১ঃ দাওয়াত">দফা ১ঃ দাওয়াত</option>
                    <option value="দফা ২ঃ সংগঠন">দফা ২ঃ সংগঠন</option>
                    <option value="দফা ৩ঃ প্রশিক্ষণ">দফা ৩ঃ প্রশিক্ষণ</option>
                    <option value="দফা ৪ঃ ইসলামী শিক্ষা আন্দোলন ও ছাত্র সমস্যার সমাধান">দফা ৪ঃ ইসলামী শিক্ষা আন্দোলন ও ছাত্র সমস্যার সমাধান</option>
                    <option value="দফা ৫ঃ ইসলামী সমাজ বিনির্মাণ">দফা ৫ঃ ইসলামী সমাজ বিনির্মাণ</option>
                </select>
            </div>
            <div class="mb-3 form-group">
                <label for="target_expectation">
                    অর্জিতব্য টার্গেট
                </label>
                <input type="text" name="target_expectation" class="form-control input_padding" id="target_expectation" v-model="all_data.target_expectation">
            </div>
            <div class="mb-3 form-group">
                <label for="action_plan" class="form-label  text-dark">
                    কর্ম পরিকল্পনা
                </label>
                <input type="text" name="action_plan" class="form-control input_padding" id="action_plan" v-model="all_data.action_plan">
            </div>
            <div class="mb-3 form-group">
                <label for="scheme">
                    ছক
                </label>
                <select name="scheme" id="scheme" class="form-control input_padding" v-model="all_data.scheme">
                    <option value="">--- ছক বাছাই করুন ---</option>
                    <option v-for="scheme in schemes" :value="scheme.id" :key="scheme">
                        {{ scheme.title }}
                    </option>
                </select>
            </div>
            <div class="mb-3 form-group">
                <label for="implementing_departments">
                    বাস্তবায়নকারী বিভাগ
                </label>
                <div class="custom_select">
                    <div class="select_selected form-control input_padding" @click="toggleDropdown">{{ selectedDepartments.length ? "" : '--- select departments ---' }}
                        <template v-if="selectedDepartments.length > 0">
                            <span class="selected_text" v-for="(item,index) in selectedDepartmentsData" :key="index">{{ item.title }}</span>
                        </template>
                    </div>
                    <div class="select_items" v-show="isDropdownOpen">
                        <label class="px-2" v-for="department in departments" :key="department.id">
                            <input type="checkbox" :value="department.title" v-model="selectedDepartments" /> {{ department.title }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="mb-3 form-group">
                <label for="unimplemented_plan" class="form-label  text-dark">
                    পরিকল্পনার অবাস্তবায়িত অংশ
                </label>
                <div class="input-group">
                    <input type="number" name="unimplemented_plan" class="form-control input_padding" id="unimplemented_plan" min="0" max="100" step="0.01" aria-describedby="percentage-addon" v-model="all_data.unimplemented_plan">
                    <span class="input-group-text" id="percentage-addon">%</span>
                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
        </form>
    </div>
</template>
<script>
import { mapActions, mapState, storeToRefs } from 'pinia';
import { store as data_store } from "./custom_store/store";
import { onMounted, ref } from 'vue';

export default {
    props: {
        id: {
            type: String,
            required: true,
        },
    },
    // setup: function(props) {
    //     const createStore = barshik_porikolpona_store();
    //     const { setup } = storeToRefs(createStore);
    //     const formData = ref({ title: '' });

    //     onMounted(async () => {
    //         const previous_data = await createStore.edit_created_data(props.id)
    //         console.log(previous_data);
    //         if (previous_data) {
    //             formData.value = { ...previous_data };
    //         }
    //     });

    //     const editable_data = async () => {
    //         let formData = new FormData(event.target);
    //         await createStore.submit_create_form(formData);
    //         event.target.reset();

    //     };
    //     const updateDdata = async (event) => {
    //         const formDataObj = new FormData(event.target);
    //         const formDataEntries = Object.fromEntries(formDataObj.entries());
    //         console.log("edit",formDataEntries);
    //         await createStore.update_created_data(props.id ,formDataEntries);
    //         event.target.reset();
    //     };

    //     console.log("formdata",formData);

    //     return { setup, formData,updateDdata }
    // },
    data: ()=>({
        form_data: {
            title: ''
        },
        all_data:null,
        departments: [
            { id: '1', title: 'বিজ্ঞান' },
            { id: '2', title: 'আইটি' },
            { id: '3', title: 'ছাত্র কল্যাণ' },
            { id: '4', title: 'দপ্তর' },
            { id: '5', title: 'প্রকাশনা' },
        ],
        ratings: [1,2,3,4,5,6,7,8,9,10],
        schemes: [
            {id: 1, title: 'ছক ১'},
            {id: 1, title: 'ছক ২'},
            {id: 1, title: 'ছক ৩'},
            {id: 1, title: 'ছক ৪'},
        ],
        selectedDepartments: [],
        selectedDepartmentsData: [],
        isDropdownOpen: false,
    }),
    computed:{
        ...mapState(data_store,{
            setup: 'setup',
        }),
    },
    created:async function(){
        const data = await this.edit_store_data({
            index: this.id
        });

        this.all_data = data
        this.selectedDepartments = data.department;
        // this.form_data.title = data.title
        console.log("editable_data");
        console.log(this.all_data);
    },
    methods:{
        ...mapActions(data_store, {
            update_store_data: 'update_created_data',
            edit_store_data: 'edit_created_data',
        }),

        update_data: function(event){
            console.log("updated");

            let formData = new FormData(event.target);
            // console.log(formData);
            for (let [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);
            }

            this.update_store_data({
                index: this.id,
                data: formData,
                department:this.selectedDepartments,
            });
            this.$router.push(`/barshik-porikolponas/create`);
        },
        toggleDropdown() {
            this.isDropdownOpen = !this.isDropdownOpen;
        },

        updateSelectedDepartmentsData() {
            this.selectedDepartmentsData = this.selectedDepartments.map((selectedId) => {
                const option = this.departments.find((dep) => dep.title === selectedId);
                return option ? { id: option.id, title: option.title } : null;
            }).filter(item => item !== null);
        }
    },
    watch: {
        // Close dropdown if the user clicks outside
        selectedDepartments(newValue) {
            if (newValue.length === 0) {
                this.isDropdownOpen = false;
            }
            this.updateSelectedDepartmentsData();

        },


    }

}
</script>
<style lang="">

</style>
