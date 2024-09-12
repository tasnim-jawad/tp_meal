<template lang="">
    <aside>
        <nav>
            <div class="side_nave">
                <div class="side_nave_topbar">
                    <div class="profile_heading">
                        <div class="profile_image_container">
                            <img src="https://media.istockphoto.com/id/1327592506/vector/default-avatar-photo-placeholder-icon-grey-profile-picture-business-man.jpg?s=612x612&w=0&k=20&c=BpR0FVaEa5F24GIw7K8nMWiiGmbb8qmhfkpXcp1dhQg="
                                alt="">
                        </div>
                        <div class="profile_name_container">
                            <div class="name">
                                Tasnimul Hasan
                            </div>
                            <div class="setting_icon">
                                <a href=""><i class="fa-solid fa-angle-down"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar_toggle">
                        <a href=""><i class="fa-solid fa-indent"></i></a>
                    </div>
                </div>

                <ul class="side_nave_lists">

                    <dropdown-nav :label="`User Management`" :icon="`fa-solid fa-users`">
                        <dropdown-single-item
                            :to="{name:`Alluser`}"
                            :label="`all`"/>
                        <dropdown-single-item
                            :to="{name:`Createuser`}"
                            :label="`create`"/>
                    </dropdown-nav>

                    <dropdown-nav :label="`Batch Management`" :icon="`fa-solid fa-users`">
                        <dropdown-single-item
                            :to="{name:`Allbatch`}"
                            :label="`all`"/>
                        <dropdown-single-item
                            :to="{name:`Createbatch`}"
                            :label="`create`"/>
                    </dropdown-nav>

                </ul>

                <div class="line_divider"></div>
            </div>
        </nav>
    </aside>
</template>
<script>
import DropdownNav from './DropdownNav.vue';
import DropdownSingleItem from './DropdownSingleItem.vue';
export default {
    components: { DropdownNav, DropdownSingleItem },
}
</script>
<style lang="">

</style>
