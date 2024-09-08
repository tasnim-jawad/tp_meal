<template lang="">
    <li :class="{ active: isActive }">
        <span>
            <i class="fa-solid fa-circle-chevron-right"></i>
        </span>
        <router-link :to="to">
            {{label}}
        </router-link>
    </li>
</template>
<script>
export default {
    props: ['label', 'to'],
    methods: {
        navigate() {
            this.$refs.link.click();
        }
    },
    computed: {
        isActive:function() {
            console.log("path",this.$route.path);
            console.log('to',this.to);
            return this.$route.path === this.to;
        }
    }
}
</script>
<style >

</style>
