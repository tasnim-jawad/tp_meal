<template>
    <div class="row m-0 mt-3">
        <div class="col-sm-12">
            <div class="card w-100">
                <div class="card-header py-1 d-flex align-items-center justify-content-between gap-2">
                    <form action="" id="session_form">
                        <div class="d-flex align-items-center gap-2">
                            <label class="session_label" for="session">Session</label>
                            <!-- <select name="role" id="role" class="rounded px-2">
                                    <option value="">--- select session ---</option>
                                    <option value="1">2022-2023</option>
                                    <option value="2">2023-2024</option>
                                    <option value="3">2024-2025</option>
                                </select> -->
                            <input type="date" name="session" id="session" class="rounded px-2" />
                        </div>
                    </form>
                    <h2 class="pages_title">{{ setup.create_page_title }}</h2>
                    <router-link :to="{ name: `CreateForm${setup.route_prefix}` }" class="btn btn-outline-warning btn-sm">Create new row </router-link>
                </div>
                <div class="card-body">
                    <div class="table-responsive table_responsive card_body_fixed_height">
                        <table class="table table-hover text-center table-bordered">
                            <thead>
                                <tr class="">
                                    <th>action</th>
                                    <th>si</th>
                                    <th>দফা</th>
                                    <th>অর্জিতব্য টার্গেট</th>
                                    <th>কর্ম পরিকল্পনা</th>
                                    <th>ছক</th>
                                    <th>বাস্তবায়নকারী বিভাগ</th>
                                    <th>পরিকল্পনার অবাস্তবায়িত অংশ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in data" :key="index">
                                    <td>
                                        <div class="action_btn d-flex gap-2 p-2">
                                            <router-link :to="{ name: 'EditFormbarshik_karjokori_porikolpona', params: { id: index } }" class="btn btn-sm btn-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </router-link>
                                            <a @click.prevent="delete_data(index)" class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                            <a class="btn btn-sm btn-info">
                                                <i class="fa-solid fa-file-zipper"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ index + 1 }}</td>
                                    <td>
                                        {{ item.clause }}
                                    </td>
                                    <td>
                                        {{ item.target_expectation }}
                                    </td>
                                    <td>
                                        {{ item.action_plan }}
                                    </td>
                                    <td>
                                        {{ item.scheme }}
                                    </td>
                                    <td>
                                        {{ item.department.join(', ') }}
                                    </td>
                                    <td>
                                        {{ item.unimplemented_plan }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-2">
                    <button type="button" @click.prevent="import_data" class="btn btn-sm btn-primary submit_button" :disabled="data.length === 0">Submit</button>
                </div>
            </div>
        </div>
    </div>



</template>
<script>
import { mapActions, mapState } from "pinia";
import { store as data_store } from "./custom_store/store";
export default {
  data: () => ({}),
  computed: {
    ...mapState(data_store, {
      data: "createdData",
      setup: "setup",
    }),
  },
  methods: {
    ...mapActions(data_store, {
      delete_store_data: "delete_created_data",
      import: "import",
    }),
    delete_data: function (index) {
      this.delete_store_data({
        index: index,
      });
    },
    submit_all: function (index) {
      this.delete_store_data({
        index: index,
      });
    },
    import_data: function () {
      const session_form = document.getElementById("session_form");
      let formData = new FormData(session_form);
      // for (let [key, value] of formData.entries()) {
      //     console.log(`${key}: ${value}`);
      // }

      this.import({
        session: formData,
      });
    },
  },
};
</script>
<style>
</style>
