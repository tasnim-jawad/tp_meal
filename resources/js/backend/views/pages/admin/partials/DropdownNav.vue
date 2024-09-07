<template>
    <li class="side_nave_list_item">
        <div class="list_container">
            <div class="list_identity_icon">
                <a href=""><i :class="icon"></i></a>
            </div>
            <div class="list_name">
                <span>
                    {{ label }}
                </span>
                <div class="list_right_icons">
                    <a v-if="isShow == false" href="" @click.prevent="isShow = !isShow"><i
                            class="fa-solid fa-angle-down"></i></a>
                    <a v-if="isShow == true" href="" @click.prevent="isShow = !isShow"><i
                            class="fa-solid fa-angle-up"></i></a>
                </div>
            </div>
        </div>
        <div class="dropdown" v-show="isShow">
            <ul>
                <slot />
            </ul>
        </div>
    </li>
</template>

<script>
export default {
    props: ['icon', 'label'],
    data: () => ({
        isShow: false,
    })
}
</script>

<style lang="scss" scoped></style>
