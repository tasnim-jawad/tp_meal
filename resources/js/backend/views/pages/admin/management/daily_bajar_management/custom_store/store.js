import { defineStore } from "pinia";

import setup from "../setup";
export const store = defineStore(`custom_${setup.store_prefix}`, {
    state: () => ({
        setup: setup,
        data: [],
        loading: true,
    }),
    actions: {
        async import(payload){
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
            return res
        },


        async single_day_bajar(payload){

            let res = await axios.get('/daily-bajars/bajar-single-day',{
                params: {
                    date: payload?.date
                }
            })
            console.log(res);

            return res
        },

    }
})
