<template lang="">
    <a v-if="item.status== 1" href="/deactive" @click.prevent="deactive_data" class="border-warning">
        <i class="fa fa-ban text-warning"></i>
        Deactive
    </a>
    <a v-if="item.status== 0" href="/active" @click.prevent="restore_data" class="border-warning">
        <i class="fa fa-refresh text-warning"></i>
        Restore
    </a>
</template>
<script>
import { mapActions } from 'pinia';
import { store } from '../../../setup/store';

export default {
    props: {
        item: {
            slug: "",
        }
    },
    methods: {
        ...mapActions(store, [
            `restore`,
            `deactive`,
            `get_all`,
            `set_only_latest_data`,
            `set_item`,
        ]),
        deactive_data: async function(){
            let con = await window.s_confirm('deactive');
            if(con){
                this.set_item(this.item);
                this.set_only_latest_data(true);

                let res = await this.deactive();
                await this.get_all();
                if(res.data.status == "success"){
                    window.s_alert('Deactivated');
                }

                this.set_only_latest_data(false);
            }
        },
        restore_data: async function(){
            let con = await window.s_confirm('Restore');
            if(con){
                this.set_item(this.item);
                this.set_only_latest_data(true);

                await this.restore();
                await this.get_all();
                window.s_alert('Restored');

                this.set_only_latest_data(false);
            }
        },
    }
}
</script>
<style lang="">

</style>
