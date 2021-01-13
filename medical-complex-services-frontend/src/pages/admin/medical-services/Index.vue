<template>
  <div id="q-app">
    <div>
      <h5 class="text-weight-bold">الخدمات</h5>
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
            label="اضافة خدمة"
            @click="show_add_dialog = true"
            no-caps
          />

          <div class="q-pa-sm q-gutter-sm">
            <q-dialog v-model="show_add_dialog">
              <q-card style="font-family: 'JF Flat';">
                <q-card-section dir="rtl">
                  <div>
                    <p class="text-weight-bold">اضافة خدمة جديدة</p>
                    <div class="q-pa-sm q-gutter-sm">
                      <label>اسم الخدمة</label>
                      <q-input
                        outlined
                        borderless
                        dense
                        v-model="editedItem.name"
                        placeholder="ادخل اسم الخدمة"
                      ></q-input>
                    </div>

                    <div class="q-pa-sm q-gutter-sm">
                      <label>السعر</label>
                      <q-input
                        style="margin: 10px 0;"
                        outlined
                        borderless
                        dense
                        v-model="editedItem.fixed_price"
                        placeholder="ادخل السعر الثابت"
                      ></q-input>
                    </div>

                    <div class="q-pa-sm q-gutter-sm">
                      <label>غير متاحة في أيام</label>
                      <q-input
                        outlined
                        borderless
                        dense
                        v-model="editedItem.timed"
                        placeholder="ادخل الايام الغير متاحة"
                      ></q-input>
                    </div>

                    <div class="q-pa-sm q-gutter-sm">
                      <label>تتطلب طبيب</label>
                      <q-input
                        outlined
                        borderless
                        dense
                        v-model="editedItem.requires_doctor"
                        placeholder=""
                      ></q-input>
                    </div>

                    <div class="q-pa-sm q-gutter-sm">
                      <label>عدد المستهلكين الأساسيين</label>
                      <q-input
                        outlined
                        borderless
                        dense
                        v-model="editedItem.main_consumer_number"
                        placeholder="ادخل عدد المستهلكين الأساسيين"
                      ></q-input>
                    </div>

                    <div class="q-pa-sm q-gutter-sm">
                      <label>عدد المستهلكين الغير أساسيين</label>
                      <q-input
                        outlined
                        borderless
                        dense
                        v-model="editedItem.associate_consumer_number"
                        placeholder="ادخل عدد المستهلكين الغير أساسيين"
                      ></q-input>
                    </div>

                    <div class="q-pa-sm q-gutter-sm">
                      <label>معادلة السعر المتغير</label>
                      <q-input
                        outlined
                        borderless
                        dense
                        v-model="editedItem.variable_price_equation"
                        placeholder="ادخل معادلة السعر المتغير"
                      ></q-input>
                    </div>

                    <div class="q-pa-sm q-gutter-sm">
                      <label>نوع التسعيرة</label>
                      <q-input
                        outlined
                        borderless
                        dense
                        v-model="editedItem.price_type_id"
                        placeholder="ادخل نوع التسعيرة"
                      ></q-input>
                    </div>

                    <div class="q-pa-sm q-gutter-sm">
                      <label>نوع الخدمة</label>
                      <q-input
                        outlined
                        borderless
                        dense
                        v-model="editedItem.service_type_id"
                        placeholder="ادخل نوع الخدمة"
                      ></q-input>
                    </div>

                    <div class="q-pa-sm q-gutter-sm">
                      <label>القسم</label>
                      <q-input
                        outlined
                        borderless
                        dense
                        v-model="editedItem.department_id"
                        placeholder="ادخل اسم القسم"
                      ></q-input>
                    </div>

                    <div class="q-pa-sm q-gutter-sm">
                      <label>الخدمة</label>
                      <q-input
                        outlined
                        borderless
                        dense
                        v-model="editedItem.service_id"
                        placeholder="ادخل اسم الخدمة"
                      ></q-input>
                    </div>

                    <div class="q-pa-sm q-gutter-sm">
                      <label>الأجهزة المعتمدة</label>
                      <q-input
                        outlined
                        borderless
                        dense
                        v-model="editedItem.pc_dependent"
                        placeholder="ادخل اسم الجهاز"
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
            <q-td key="name" :props="props">
              {{ props.row.name }}
            </q-td>

            <q-td key="name" :props="props">
              {{ props.row.fixed_price }}
            </q-td>

            <q-td key="name" :props="props">
              {{ props.row.timed }}
            </q-td>

            <q-td key="name" :props="props">
              {{ props.row.requires_doctor }}
            </q-td>

            <q-td key="name" :props="props">
              {{ props.row.main_consumer_number }}
            </q-td>

            <q-td key="name" :props="props">
              {{ props.row.associate_consumer_number }}
            </q-td>

            <q-td key="name" :props="props">
              {{ props.row.variable_price_equation }}
            </q-td>

            <q-td v-if="props.row.price_type != null" key="name" :props="props">
              {{ props.row.price_type.name }}
            </q-td>

            <q-td key="name" :props="props">
              {{ props.row.service_type.name }}
            </q-td>

            <q-td v-if="props.row.department != null" key="name" :props="props">
              {{ props.row.department.name }}
            </q-td>

            <q-td v-if="props.row.service != null" key="name" :props="props">
              {{ props.row.service.name }}
            </q-td>

            <q-td key="name" :props="props">
              {{ props.row.pc_dependent }}
            </q-td>

            <q-td key="actions" :props="props">
              <q-icon
                size="sm"
                name="edit"
                color="blue-grey-7"
                @click="
                  editedItem.name = props.row.name;
                  editedItem.fixed_price = props.row.fixed_price;
                  editedItem.timed = props.row.timed;
                  editedItem.requires_doctor = props.row.requires_doctor;
                  editedItem.main_consumer_number = props.row.main_consumer_number;
                  editedItem.associate_consumer_number = props.row.associate_consumer_number;
                  editedItem.variable_price_equation = props.row.variable_price_equation;
                  editedItem.price_type_id = props.row.price_type_id;
                  editedItem.service_type_id = props.row.service_type_id;
                  editedItem.department_id = props.row.department_id;
                  editedItem.service_id = props.row.service_id;
                  editedItem.pc_dependent = props.row.pc_dependent;
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
                      <p class="text-weight-bold">تعديل الخدمة</p>
                      <div class="q-pa-sm q-gutter-sm">
                        <label>اسم الخدمة</label>
                        <q-input
                          v-model="editedItem.name"
                          outlined
                          borderless
                          dense
                          placeholder="ادخل اسم الخدمة"
                        ></q-input>
                      </div>

                      <div class="q-pa-sm q-gutter-sm">
                        <label>السعر</label>
                        <q-input
                          v-model="editedItem.fixed_price"
                          outlined
                          borderless
                          dense
                          placeholder="ادخل السعر الثابت"
                        ></q-input>
                      </div>

                      <div class="q-pa-sm q-gutter-sm">
                        <label>غير متاحة في أيام</label>
                        <q-input
                          v-model="editedItem.timed"
                          outlined
                          borderless
                          dense
                          placeholder="ادخل الايام الغير متاحة"
                        ></q-input>
                      </div>

                      <div class="q-pa-sm q-gutter-sm">
                        <label>تتطلب طبيب</label>
                        <q-input
                          v-model="editedItem.requires_doctor"
                          outlined
                          borderless
                          dense
                          placeholder=""
                        ></q-input>
                      </div>

                      <div class="q-pa-sm q-gutter-sm">
                        <label>عدد المستهلكين الأساسيين</label>
                        <q-input
                          v-model="editedItem.main_consumer_number"
                          outlined
                          borderless
                          dense
                          placeholder="ادخل عدد المستهلكين الأساسيين"
                        ></q-input>
                      </div>

                      <div class="q-pa-sm q-gutter-sm">
                        <label>عدد المستهلكين الغير الأساسيين</label>
                        <q-input
                          v-model="editedItem.associate_consumer_number"
                          outlined
                          borderless
                          dense
                          placeholder="ادخل عدد المستهلكين الغير الأساسيين"
                        ></q-input>
                      </div>

                      <div class="q-pa-sm q-gutter-sm">
                        <label>معادلة السعر المتغير</label>
                        <q-input
                          v-model="editedItem.variable_price_equation"
                          outlined
                          borderless
                          dense
                          placeholder="ادخل معادلة السعر المتغير"
                        ></q-input>
                      </div>

                      <div class="q-pa-sm q-gutter-sm">
                        <label>نوع التسعيرة</label>
                        <q-input
                          v-model="editedItem.price_type_id"
                          outlined
                          borderless
                          dense
                          placeholder="ادخل نوع التسعيرة"
                        ></q-input>
                      </div>

                      <div class="q-pa-sm q-gutter-sm">
                        <label>نوع الخدمة</label>
                        <q-input
                          v-model="editedItem.service_type_id"
                          outlined
                          borderless
                          dense
                          placeholder="ادخل نوع الخدمة"
                        ></q-input>
                      </div>

                      <div class="q-pa-sm q-gutter-sm">
                        <label>القسم</label>
                        <q-input
                          v-model="editedItem.department_id"
                          outlined
                          borderless
                          dense
                          placeholder="ادخل اسم القسم"
                        ></q-input>
                      </div>

                      <div class="q-pa-sm q-gutter-sm">
                        <label>الخدمة</label>
                        <q-input
                          v-model="editedItem.service_id"
                          outlined
                          borderless
                          dense
                          placeholder="ادخل اسم الخدمة"
                        ></q-input>
                      </div>

                      <div class="q-pa-sm q-gutter-sm">
                        <label>تعتمد علي جهاز؟</label>
                        <q-input
                          v-model="editedItem.pc_dependent"
                          outlined
                          borderless
                          dense
                          placeholder="ادخل اسم الجهاز"
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
        name: "",
        ip: "",
        mac_address: "",
      },

      defaultItem: {
        name: "",
        ip: "",
        mac_address: "",
      },

      columns: [
        {
          name: "name",
          required: true,
          label: "اسم الخدمة",
          align: "left",
          field: (row) => row.name,
          format: (val) => `${val}`,
          sortable: true,
        },
        {
          name: "fixed_price",
          required: true,
          label: " السعر الثابت ",
          align: "left",
          field: (row) => row.fixed_price,
          format: (val) => `${val}`,
          sortable: true,
        },
        {
          name: "timed",
          required: true,
          label: "غير متاحة في أيام",
          align: "left",
          field: (row) => row.timed,
          format: (val) => `${val}`,
          sortable: true,
        },
        {
          name: "requires_doctor",
          required: true,
          label: "الايام متاحة",
          align: "left",
          field: (row) => row.requires_doctor,
          format: (val) => `${val}`,
          sortable: true,
        },
        {
          name: "main_consumer_number",
          required: true,
          label: " المستهلكين الأساسيين",
          align: "left",
          field: (row) => row.main_consumer_number,
          format: (val) => `${val}`,
          sortable: true,
        },
        {
          name: "associate_consumer_number",
          required: true,
          label: " المستهلكين الغير أساسيين",
          align: "left",
          field: (row) => row.associate_consumer_number,
          format: (val) => `${val}`,
          sortable: true,
        },
        {
          name: "variable_price_equation",
          required: true,
          label: "السعر المتغير ",
          align: "left",
          field: (row) => row.variable_price_equation,
          format: (val) => `${val}`,
          sortable: true,
        },
        {
          name: "price_type_id",
          required: true,
          label: "نوع التسعيرة ",
          align: "left",
          field: (row) => row.price_type_id,
          format: (val) => `${val}`,
          sortable: true,
        },
        {
          name: "service_type_id",
          required: true,
          label: "نوع الخدمة ",
          align: "left",
          field: (row) => row.service_type_id,
          format: (val) => `${val}`,
          sortable: true,
        },
        {
          name: "department_id",
          required: true,
          label: "القسم ",
          align: "left",
          field: (row) => row.department_id,
          format: (val) => `${val}`,
          sortable: true,
        },
        {
          name: "service_id",
          required: true,
          label: " الأجهزة",
          align: "left",
          field: (row) => row.service_id,
          format: (val) => `${val}`,
          sortable: true,
        },
        {
          name: "pc_dependent",
          required: true,
          label: "تعتمد على جهاز؟",
          align: "left",
          field: (row) => row.pc_dependent,
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
      data: "allServices",
      errorMessage: "getErrorMessage",
      requestFailed: "getRequestFailed",
    }),
  },
  methods: {
    ...mapMutations(["setFailingRequest"]),
    ...mapActions({
      index: "indexServices",
      store: "storeService",
      update: "updateService",
      delete: "deleteService",
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
      confirm("هل تريد حذف هذه الخدمة بالتأكيد؟") &&
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
