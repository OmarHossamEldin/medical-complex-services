<template>
  <div id="q-app">
    <div>
      <h5 class="text-weight-bold">فترات العمل الغير متاحة </h5>
      <q-table
        :data="data"
        :columns="columns"
        row-key="name"
        :filter="filter"
        binary-state-sort
        bordered
        :rows-per-page-options="[20, 30, 50, 0]"
      >
        <template v-slot:top-right>
          <q-input
            borderless
            dense
            debounce="300"
            v-model="filter"
            placeholder="بحث"
            outlined
          >
            <template v-slot:append>
              <q-icon name="search" />
            </template>
          </q-input>
        </template>
        <template v-slot:top-left>
          <q-btn
            outline
            class="text-weight-bold"
            color="blue-grey-6"
            label="اضافة فترة "
            @click="show_add_dialog = true"
            no-caps
          />

          <div class="q-pa-sm q-gutter-sm">
            <q-dialog v-model="show_add_dialog">
              <q-card style="font-family: 'JF Flat';">
                <q-card-section dir="rtl">
                  <div>
                    <p class="text-weight-bold">اضافة فترة    </p>

                    <div class="q-pa-sm q-gutter-sm">
                      <label> اليوم </label>
                      <q-input
                        outlined
                        borderless
                        dense
                        v-model="editedItem.day"
                        placeholder="اليوم   "
                      ></q-input>
                    </div>
                     <div class="q-pa-sm q-gutter-sm">
                      <label> من </label>
                      <q-input
                        outlined
                        borderless
                        dense
                        v-model="editedItem.from"
                        placeholder="من   "
                      ></q-input>
                    </div>
                    <div class="q-pa-sm q-gutter-sm">
                      <label> الي </label>
                      <q-input
                        outlined
                        borderless
                        dense
                        v-model="editedItem.to"
                        placeholder="الي   "
                      ></q-input>
                    </div>

                  </div>
                </q-card-section>

                <q-card-actions align="left">
                  <q-btn
                    rounded
                    flat
                    label="موافق"
                    color="primary"
                    v-close-popup
                    @click="addItem"
                  ></q-btn>
                </q-card-actions>
              </q-card>
            </q-dialog>
          </div>
        </template>

        <template v-slot:header="props">
          <q-tr :props="props">
            <q-th
              v-for="col in props.cols"
              :key="col.name"
              :props="props"
              class="table-header"
            >
              {{ col.label }}
            </q-th>
          </q-tr>
        </template>

        <template v-slot:body="props">
          <q-tr :props="props" class="table-body">
            <q-td key="day" :props="props">
              {{ props.row.day }}
            </q-td>
            <q-td key="from" :props="props">
              {{ props.row.from }}
            </q-td>
            <q-td key="to" :props="props">
              {{ props.row.to }}
            </q-td>
            <q-td key="actions" :props="props">
              <q-icon
                size="sm"
                name="edit"
                color="blue-grey-7"
                @click="
                  editedItem.day = props.row.day;
                  editedItem.from = props.row.from;
                  editedItem.to = props.row.to;
                  editId = props.row.id;
                  show_edit_dialog = true;
                "
              >
              <q-tooltip anchor="top middle" self="bottom middle" content-class="bg-blue-grey-7" :offset="[3, 3]">
                  <strong>تعديل</strong>
                </q-tooltip>
              </q-icon>

              <q-icon
                size="sm"
                name="delete"
                color="red-10"
                @click="deleteItem(props.row)"
              >
              <q-tooltip anchor="top middle" self="bottom middle" content-class="bg-red-10" :offset="[3, 3]">
                  <strong>حذف</strong>
                </q-tooltip>
              </q-icon>

            </q-td>
            <div class="q-pa-sm q-gutter-sm">
              <q-dialog v-model="show_edit_dialog">
                <q-card style="font-family: 'JF Flat';">
                  <q-card-section dir="rtl">
                    <div>
                      <p class="text-weight-bold">تعديل طريقة الدفع</p>

                      <div class="q-pa-sm q-gutter-sm">
                        <label>اسم طريقة الدفع</label>
                        <q-input
                          v-model="editedItem.name"
                          outlined
                          borderless
                          dense
                          placeholder="ادخل طريقة الدفع  "
                        ></q-input>
                      </div>

                    </div>
                  </q-card-section>

                  <q-card-actions align="left">
                    <q-btn
                      flat
                      label="موافق"
                      color="primary"
                      v-close-popup
                      @click="editItem()"
                    ></q-btn>
                    <q-btn
                      flat
                      label="إلغاء"
                      color="error"
                      v-close-popup
                      @click="editedItem.name = defaultItem.name"
                    ></q-btn>
                  </q-card-actions>
                </q-card>
              </q-dialog>
            </div>
          </q-tr>
        </template>
      </q-table>
    </div>
    <q-dialog v-model="requestFailed">
      <q-card  style="font-family: 'JF Flat';" dir="rtl">
        <q-card-section>
          <div class="text-h6">تنبيه</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          {{ errorMessage }}
        </q-card-section>

        <q-card-actions align="right">
          <q-btn
            @click="resetFailingRequest()"
            flat
            label="موافق"
            color="primary"
            v-close-popup
          />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </div>
</template>

<style scoped>
.table-header {
  font-size: 20px;
  font-weight: bold;
}
.table-body td {
  font-size: 18px;
}
</style>

<script>
import { mapGetters, mapActions , mapMutations} from "vuex";

export default {
  data() {
    return {
      editId: -1,
      filter: "",
      show_add_dialog: false,
      show_edit_dialog: false,

      editedItem: {
        day: "",
        from:"",
        to:""
      },

      defaultItem: {
        day: "",
        from:"",
        to:""
      },

      columns: [
        {
          name: "day",
          required: true,
          label: "اليوم",
          align: "left",
          field: (row) => row.day,
          format: (val) => `${val}`,
          sortable: true,
        },
         {
          name: "from",
          required: true,
          label: "من",
          align: "left",
          field: (row) => row.from,
          format: (val) => `${val}`,
          sortable: true,
        },
         {
          name: "to",
          required: true,
          label: "الي",
          align: "left",
          field: (row) => row.to,
          format: (val) => `${val}`,
          sortable: true,
        },
        {
          name: "actions",
          label: "",
          field: "actions",
        },
      ],
    };
  },
  created() {
    this.index();
  },
  computed: {
    ...mapGetters({
      data: "allClosedIntervals",
      errorMessage: "getErrorMessage",
      requestFailed: "getRequestFailed",
    }),
  },
  methods: {
    ...mapMutations(["setFailingRequest"]),
    ...mapActions({
      index: "indexClosedIntervals",
      store: "storeClosedInterval",
      update: "updateClosedInterval",
      delete: "deleteBillingOption",
    }),
    resetFailingRequest() {
      this.setFailingRequest(false)
    },
    addItem() {
      this.store(this.editedItem);
      this.close();
    },
    editItem() {
      this.update([this.editId, this.editedItem]);
      this.close();
    },
    deleteItem(item) {
      confirm("هل تريد حذف هذا القسم بالتأكيد؟") &&
        this.delete(item.id);
    },
    close() {
      this.show_add_dialog = false;
      this.show_edit_dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
      }, 300);
    },
  },
};
</script>
