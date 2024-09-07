<template>
    <div>
        <div class="planing_app">
            <div class="planing_app_topbar">
                <div class="logo_container">
                    <img class="logo_image" src="https://asset.brandfetch.io/idU6lzwMYA/idRvA5TWSD.png" alt="">
                </div>
                <div class="topbar_right">
                    <a href="" class="me-3 text-light"><i class="fa-brands fa-figma"></i></a>
                    <div class="profile_button_container">
                        <button class="topbar_right_profile" @click.prevent="toggle_profile">
                            <div class="letter_circle">
                                <span>TH</span>
                            </div>
                            <a href="" class="dropdown_icon"><i class="fa-solid fa-angle-down"></i></a>
                        </button>
                        <div id="profile_dropdown" class="profile_dropdown d-none">
                            <ul>
                                <li><span><i class="fa-solid fa-user"></i></span> <span>Tasnim</span></li>
                                <li @click.prevent="logout"><span><i class="fa-solid fa-right-from-bracket"></i></span> <span>logout</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layout_content">
                <div class="layout_content_left">
                    <sidebar></sidebar>
                </div>
                <div class="layout_content_right">
                    <div class="topbar">
                        <div class="topbar_left">
                            <a href=""><i class="fa-solid fa-chart-column"></i></a>
                            <span>Dashboard</span>
                        </div>
                        <div class="topbar_right">
                            <div class="topbar_right_search">
                                <a href="" class="search_icon"><i class="fa-solid fa-magnifying-glass"></i></a>
                                <span>Search Dashboards</span>
                            </div>
                            <div class="deshboard_button">
                                <span>New Deshboard</span>
                            </div>
                        </div>
                    </div>
                    <div class="main_content">
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import axios from 'axios';
import Create from '../pages/user/Create.vue';
import DropdownNav from './DropdownNav.vue';
import Sidebar from './Sidebar.vue';
export default {
    components: { DropdownNav, Create, Sidebar },

    methods:{
        logout:async function(){
            let con = await window.s_confirm('logout');
            if(con){
                let res = await axios.post('/api-logout')
                if(res.data.status == "success"){
                    localStorage.removeItem('token');
                    location.href = "/login"
                } else {
                    console.log('Logout failed:', res.data.result);
                }
            }
        },

        toggle_profile:function(){
            const report_app = document.getElementById("profile_dropdown");
            report_app.classList.toggle("d-none");
        },

        // toggle_sidebar:function(){
        //     const width = window.innerWidth;
        //     console.log('width');
        //     if(width >= 768){
        //         const report_app = document.getElementById("report_app");
        //         report_app.classList.toggle("sidebar_hide");

        //         const side_nav = document.getElementById("side_nav");
        //         side_nav.classList.toggle("side_nav_toggle");
        //     }else if(width < 768){
        //         const report_app_left = document.getElementById("report_app_left");
        //         report_app_left.classList.toggle("report_app_left_toggle");
        //     }
        // }
    }
}
</script>

<style lang="scss" scoped></style>
