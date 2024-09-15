import { defineStore } from "pinia";

import setup from "../setup";
export const store = defineStore(`custom_${setup.store_prefix}`, {
    state: () => ({
        setup: setup,
        data: [],
        loading: true,
    }),
    actions: {
        // async submit_create_form(payload) {
        //     const formDataObj = {};
        //     for (let [key, value] of payload.form_data.entries()) {
        //         formDataObj[key] = value;
        //     }
        //     formDataObj['department'] = payload.department;
        //     this.createdData.push(formDataObj);
        // },
        // async edit_created_data(payload){
        //     return this.createdData[payload.index];
        // },

        // async update_created_data(payload){
        //     const formDataObj = {};
        //     for (let [key, value] of payload.data.entries()) {
        //         formDataObj[key] = value;
        //     }
        //     console.log(payload.department);

        //     formDataObj['department'] = payload.department;
        //     this.createdData[payload.index] = formDataObj;
        // },
        // async delete_created_data(payload){
        //     this.createdData.splice(payload.index,1);
        // },

        async import(payload){
            console.log(payload);

            let res = await axios.post('/daily-bajars/import',{
                data:payload,
            })

            if(res.data.status == "success"){
                window.s_alert(res.data.result);
            }

            return res;

        },
        async date_wise_bajar(payload){

            let res = await axios.get('/daily-bajars/date-wise-bajar',{
                params: {
                    month: payload?.month ?? null
                }
            })
            console.log(res);

            return res
        },

    }
})
