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

                    <!-- <dropdown-nav :label="`User`" :icon="`fa-solid fa-users`">
                        <dropdown-single-item
                            :to="{name:`all-user`}"
                            :label="`all`" />
                        <dropdown-single-item
                            :to="{name:`create-user`}"
                            :label="`create`" />
                    </dropdown-nav> -->

                    <dropdown-nav :label="`User_management`" :icon="`fa-solid fa-users`">
                        <dropdown-single-item
                            :to="{name:`Alluser`}"
                            :label="`all`" />
                        <dropdown-single-item
                            :to="{name:`Createuser`}"
                            :label="`create`" />
                    </dropdown-nav>

                    <!-- <dropdown-nav :label="`Barsik Porikolpona`" :icon="`fa fa-list`">
                        <dropdown-single-item
                            :to="{name:`AllBarshikPorikolpona`}"
                            :label="`all`" />
                        <dropdown-single-item
                            :to="{name:`CreateBarshikPorikolpona`}"
                            :label="`create`" />
                    </dropdown-nav> -->

                    <dropdown-nav :label="`Task`" :icon="`fa-solid fa-users`">
                        <dropdown-single-item
                            :to="{name:`AllTask`}"
                            :label="`all`" />
                        <dropdown-single-item
                            :to="{name:`CreateTask`}"
                            :label="`create`" />
                    </dropdown-nav>

                    <dropdown-nav :label="`কেন্দ্রিও বার্ষিক পরিকল্পনা`" :icon="`fa fa-list`">
                        <dropdown-single-item
                            :to="{name:`AllKendrioBarshikPorikolpona`}"
                            :label="`all`" />
                        <dropdown-single-item
                            :to="{name:`CreateKendrioBarshikPorikolpona`}"
                            :label="`create`" />
                    </dropdown-nav>

                    <dropdown-nav :label="`বিভাগীয় বার্ষিক পরিকল্পনা`" :icon="`fa fa-list`">
                        <dropdown-single-item
                            :to="{name:`Allbivagio_barshik_porikolpona`}"
                            :label="`all`" />
                        <dropdown-single-item
                            :to="{name:`Createbivagio_barshik_porikolpona`}"
                            :label="`create`" />
                    </dropdown-nav>

                    <dropdown-nav :label="`বার্ষিক পরিকল্পনা`" :icon="`fa fa-list`">
                        <dropdown-single-item
                            :to="{name:`AllBarshikPorikolpona`}"
                            :label="`all`" />
                        <dropdown-single-item
                            :to="{name:`CreateBarshikPorikolpona`}"
                            :label="`create`" />
                    </dropdown-nav>

                    <dropdown-nav :label="`বার্ষিক কার্যকরী পরিকল্পনা`" :icon="`fa fa-list`">
                        <dropdown-single-item
                            :to="{name:`Allbarshik_karjokori_porikolpona`}"
                            :label="`all`" />
                        <dropdown-single-item
                            :to="{name:`Createbarshik_karjokori_porikolpona`}"
                            :label="`create`" />
                    </dropdown-nav>

                    <dropdown-nav :label="`মাসিক পরিকল্পনা`" :icon="`fa fa-list`">
                        <dropdown-single-item
                            :to="{name:`Allmashik_porikolpona`}"
                            :label="`all`" />
                        <dropdown-single-item
                            :to="{name:`Createmashik_porikolpona`}"
                            :label="`create`" />
                    </dropdown-nav>

                    <dropdown-nav :label="`মাসিক কার্যকরী পরিকল্পনা`" :icon="`fa fa-list`">
                        <dropdown-single-item
                            :to="{name:`Allmashik_karjokori_porikolpona`}"
                            :label="`all`" />
                        <dropdown-single-item
                            :to="{name:`Createmashik_karjokori_porikolpona`}"
                            :label="`create`" />
                    </dropdown-nav>

                    <dropdown-nav :label="`পরিকল্পনা বাস্তবায়নের মাসিক রিপোর্ট`" :icon="`fa fa-list`">
                        <dropdown-single-item
                            :to="{name:`Allporikolpona_bastobayoner_mashik_report`}"
                            :label="`all`" />
                        <dropdown-single-item
                            :to="{name:`Createporikolpona_bastobayoner_mashik_report`}"
                            :label="`create`" />
                    </dropdown-nav>

                    <dropdown-nav :label="`কার্যকরী পরিকল্পনা বাস্তবায়নের মাসিক রিপোর্ট`" :icon="`fa fa-list`">
                        <dropdown-single-item
                            :to="{name:`Allkarjokori_porikolpona_bastobayoner_mashik_report`}"
                            :label="`all`" />
                        <dropdown-single-item
                            :to="{name:`Createkarjokori_porikolpona_bastobayoner_mashik_report`}"
                            :label="`create`" />
                    </dropdown-nav>

                    <dropdown-nav :label="`পরিকল্পনা বাস্তবায়নের ত্রৈমাসিক/ষাণ্মাসিক/বার্ষিক রিপোর্ট`" :icon="`fa fa-list`">
                        <dropdown-single-item
                            :to="{name:`Allporikolpona_bastobayoner_troimashik_shanmashik_barshik_report`}"
                            :label="`all`" />
                        <dropdown-single-item
                            :to="{name:`Createporikolpona_bastobayoner_troimashik_shanmashik_barshik_report`}"
                            :label="`create`" />
                    </dropdown-nav>

                    <dropdown-nav :label="`কেন্দ্রিও পরিকল্পনা বাস্তবায়নের রিপোর্ট`" :icon="`fa fa-list`">
                        <dropdown-single-item
                            :to="{name:`Allkendrer_porikolpona_bastobayoner_report`}"
                            :label="`all`" />
                        <dropdown-single-item
                            :to="{name:`Createkendrer_porikolpona_bastobayoner_report`}"
                            :label="`create`" />
                    </dropdown-nav>

                    <dropdown-nav :label="`বিভাগের পরিকল্পনা বাস্তবায়নের রিপোর্ট`" :icon="`fa fa-list`">
                        <dropdown-single-item
                            :to="{name:`Allbivager_porikolpona_bastobayoner_report`}"
                            :label="`all`" />
                        <dropdown-single-item
                            :to="{name:`Createbivager_porikolpona_bastobayoner_report`}"
                            :label="`create`" />
                    </dropdown-nav>

                    <dropdown-nav :label="`আর্কাইভ (পর্যালোচনা)`" :icon="`fa fa-list`">
                        <dropdown-single-item
                            :to="{name:`Allarchive`}"
                            :label="`all`" />
                        <dropdown-single-item
                            :to="{name:`Createarchive`}"
                            :label="`create`" />
                    </dropdown-nav>

                    <dropdown-nav :label="`বার্ষিক বাজেট`" :icon="`fa fa-list`">
                        <dropdown-single-item
                            :to="{name:`AllTask`}"
                            :label="`all`" />
                        <dropdown-single-item
                            :to="{name:`CreateTask`}"
                            :label="`create`" />
                    </dropdown-nav>

                    <dropdown-nav :label="`শাখা থেকে প্রাপ্ত/সংগৃহীত রিপোর্ট`" :icon="`fa fa-list`">
                        <dropdown-single-item
                            :to="{name:`AllTask`}"
                            :label="`all`" />
                        <dropdown-single-item
                            :to="{name:`CreateTask`}"
                            :label="`create`" />
                    </dropdown-nav>

                    <dropdown-nav :label="`ব্যবহারবিধি`" :icon="`fa fa-list`">
                        <dropdown-single-item
                            :to="{name:`AllTask`}"
                            :label="`all`" />
                        <dropdown-single-item
                            :to="{name:`CreateTask`}"
                            :label="`create`" />
                    </dropdown-nav>

                    <dropdown-nav :label="`বিবিধ`" :icon="`fa fa-list`">
                        <dropdown-single-item
                            :to="{name:`AllTask`}"
                            :label="`all`" />
                        <dropdown-single-item
                            :to="{name:`CreateTask`}"
                            :label="`create`" />
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
    components: { DropdownNav, DropdownSingleItem }
}
</script>
<style lang="">

</style>
