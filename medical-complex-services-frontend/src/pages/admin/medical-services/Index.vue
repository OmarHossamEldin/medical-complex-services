<template>
  <div id="q-app">
    <div>
      <table-title :title="modelNamePlural"/>
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
          <table-search v-model="filter"></table-search>
        </template>
        <template v-slot:top-left>
          <q-btn
            outline
            class="text-weight-bold"
            color="blue-grey-6"
            :label="'اضافة ' + modelName"
            @click="filling_data_status = 'add'; filling_data_dialog = true"
            no-caps
          />
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
            <q-td v-for="column in columns.slice(0, -1)" :key="column.name" :props="props">
              {{ props.row[column.name] }}
            </q-td>

            <q-td key="actions" :props="props">
              <q-icon
                size="sm"
                name="edit"
                color="blue-grey-7"
                @click="
                  preEditItem(props.row)
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
              <q-dialog v-model="filling_data_dialog" @escape-key="close()" @hide="close()">
                <q-card style="font-family: 'JF Flat';">
                  <q-card-section dir="rtl">
                    <div>
                      <p v-if="filling_data_status == 'add' " class="text-weight-bold"> اضافة {{modelName}}</p>
                      <p v-if="filling_data_status == 'edit' " class="text-weight-bold">تعديل {{modelName}}</p>

                      <div v-for="column in columns.slice(0, -1)" :key="column.name" class="q-pa-sm q-gutter-sm">
                        <label>{{column.label}}</label>
                        <q-input
                          v-model="editedItem[column.name]"
                          outlined
                          borderless
                          dense
                          :placeholder="'ادخل ' + column.label"
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
                      @click="addOrEditItem()"
                    ></q-btn>
                    <q-btn
                      flat
                      label="إلغاء"
                      color="error"
                      v-close-popup
                      @click="close()"
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
import TableTitle from 'src/components/TableTitle.vue'
import { mapGetters, mapActions, mapMutations } from 'vuex'
import TableSearch from 'src/components/TableSearch.vue'

export default {
  components: { TableTitle, TableSearch },
  data () {
    return {
      editId: -1,
      filter: '',
      filling_data_dialog: false,
      filling_data_status: '',

      modelName: 'خدمة',
      modelNamePlural: 'خدمات',
      modelNameEnglish: 'Service',
      modelNameEnglishPlural: 'Services',

      editedItem: {
        name: '',
        fixed_price: '',
        timed: '',
        requires_doctor: '',
        main_consumer_number: '',
        associate_consumer_number: '',
        variable_price_equation: '',
        price_type_id: '',
        service_type_id: '',
        department_id: '',
        service_id: '',
        pc_dependent: '',
        price_type: ''
      },

      defaultItem: {
        name: '',
        fixed_price: '',
        timed: '',
        requires_doctor: '',
        main_consumer_number: '',
        associate_consumer_number: '',
        variable_price_equation: '',
        price_type_id: '',
        service_type_id: '',
        department_id: '',
        service_id: '',
        pc_dependent: '',
        price_type: ''
      },

      columns: [
        {
          name: 'name',
          required: true,
          label: 'اسم الخدمة',
          align: 'left',
          field: (row) => row.name,
          format: (val) => `${val}`,
          sortable: true
        },
        {
          name: 'fixed_price',
          required: true,
          label: ' السعر الثابت ',
          align: 'left',
          field: (row) => row.fixed_price,
          format: (val) => `${val}`,
          sortable: true
        },
        {
          name: 'timed',
          required: true,
          label: 'غير متاحة في أيام',
          align: 'left',
          field: (row) => row.timed,
          format: (val) => `${val}`,
          sortable: true
        },
        {
          name: 'requires_doctor',
          required: true,
          label: 'الايام متاحة',
          align: 'left',
          field: (row) => row.requires_doctor,
          format: (val) => `${val}`,
          sortable: true
        },
        {
          name: 'main_consumer_number',
          required: true,
          label: ' المستهلكين الأساسيين',
          align: 'left',
          field: (row) => row.main_consumer_number,
          format: (val) => `${val}`,
          sortable: true
        },
        {
          name: 'associate_consumer_number',
          required: true,
          label: ' المستهلكين الغير أساسيين',
          align: 'left',
          field: (row) => row.associate_consumer_number,
          format: (val) => `${val}`,
          sortable: true
        },
        {
          name: 'variable_price_equation',
          required: true,
          label: 'معادلة السعر المتغير',
          align: 'left',
          field: (row) => row.variable_price_equation,
          format: (val) => `${val}`,
          sortable: true
        },
        {
          name: 'price_type_id',
          required: true,
          label: 'نوع التسعيرة ',
          align: 'left',
          field: (row) => row.price_type_id,
          format: (val) => `${val}`,
          sortable: true
        },
        {
          name: 'service_type_id',
          required: true,
          label: 'نوع الخدمة ',
          align: 'left',
          field: (row) => row.service_type_id,
          format: (val) => `${val}`,
          sortable: true
        },
        {
          name: 'department_id',
          required: true,
          label: 'القسم ',
          align: 'left',
          field: (row) => row.department_id,
          format: (val) => `${val}`,
          sortable: true
        },
        {
          name: 'pc_dependent',
          required: true,
          label: 'تعتمد على جهاز',
          align: 'left',
          field: (row) => row.pc_dependent,
          format: (val) => `${val}`,
          sortable: true
        },
        {
          name: 'actions',
          label: '',
          field: 'actions'
        }
      ]
    }
  },
  created () {
    this.index()
  },
  computed: {
    ...mapGetters({
      data: 'allServices',
      errorMessage: 'getErrorMessage',
      requestFailed: 'getRequestFailed'
    })
  },
  methods: {
    ...mapMutations(['setFailingRequest']),
    ...mapActions({
      index: 'indexServices',
      store: 'storeService',
      update: 'updateService',
      delete: 'deleteService'
    }),
    resetFailingRequest () {
      this.setFailingRequest(false)
    },
    addItem () {
      this.store(this.editedItem)
      this.close()
    },
    preEditItem (row) {
      var columnName = ''
      for (var i = 0; i < this.columns.length - 1; i++) {
        columnName = this.columns[i].name
        this.editedItem[columnName] = row[columnName]
      }
      this.editId = row.id
      this.filling_data_status = 'edit'
      this.filling_data_dialog = true
    },
    addOrEditItem () {
      if (this.filling_data_status === 'add') {
        this.addItem()
      } else if (this.filling_data_status === 'edit') {
        this.editItem()
      }
    },
    editItem () {
      this.update([this.editId, this.editedItem])
      this.close()
    },
    deleteItem (item) {
      confirm('هل تريد حذف هذه الخدمة بالتأكيد؟') &&
        this.delete(item.id)
    },
    close () {
      this.editedItem = Object.assign({}, this.defaultItem)
      this.filling_data_status = ''
      this.filling_data_dialog = false
    }
  }
}
</script>
