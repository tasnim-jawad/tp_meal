<template>
    <div class="mb-3 form-group">
        <label :for="labelFor">
            {{ label }}
        </label>
        <div class="custom_select">
            <div class="select_selected form-control input_padding" @click="toggleDropdown">
                {{ selectedItems.length ? "" : placeholder }}
                <template v-if="selectedItems.length > 0">
                    <span class="selected_text" v-for="(item, index) in selectedItemsData" :key="index">{{ item.title }}</span>
                </template>
            </div>
            <div class="select_items" v-show="isDropdownOpen">
                <label class="px-2" v-for="item in items" :key="item.id">
                    <input type="checkbox" :value="item.title" v-model="selectedItems" />
                    {{ item.title }}
                </label>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MultiSelect",
        props: {
            items: {
                type: Array,
                required: true,
            },
            label: {
                type: String,
                default: "Select Items",
            },
            labelFor: {
                type: String,
                default: "multi_select",
            },
            placeholder: {
                type: String,
                default: "--- select items ---",
            },
        },
        data() {
            return {
                selectedItems: [],
                selectedItemsData: [],
                isDropdownOpen: false,
            };
        },
        watch: {
            selectedItems(newValue) {
                if (newValue.length === 0) {
                    this.isDropdownOpen = false;
                }
                this.updateSelectedItemsData();
            },
        },
        methods: {
            toggleDropdown() {
                this.isDropdownOpen = !this.isDropdownOpen;
            },
            updateSelectedItemsData() {
                this.selectedItemsData = this.selectedItems
                    .map((selectedTitle) => {
                        const option = this.items.find((item) => item.title === selectedTitle);
                        return option ? { id: option.id, title: option.title } : null;
                    })
                    .filter((item) => item !== null);
            },
        },
    };
</script>

<style scoped>
    .custom_select {
        position: relative;
    }
    .select_items {
        display: flex;
        flex-direction: column;
        position: absolute;
        max-height: 90px;
        overflow-y: scroll;
        scrollbar-width: none;
        box-shadow: 0px 2px 5px 0px rgb(49 49 71 / 65%);
        padding: 5px;
        z-index: 999;
        background-color: white;
    }
    .selected_text {
        font-size: 12px;
        line-height: 12px;
        padding: 2px 5px;
        box-shadow: 0px 0px 5px 1px rgba(0, 0, 255, 0.2);
        margin-right: 5px;
        top: calc(100% + 5px);
    }
</style>
