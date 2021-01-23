<template>
<<<<<<< HEAD
  <index-table
    modelName='عملية'
    modelNamePlural='عمليات'
    modelNameEnglish='Transaction'
    modelNameEnglishPlural='Transactions'
    :columns="columns"
    :item="editedItem"
    :defaultItem="defaultItem"
    :data="transactions"
    :index="index"
    :store="store"
    :update="update"
    :delete="del"
    :options="options"
  >
  </index-table>
=======
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
              class="table-he er"
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
>>>>>>> b9a136eb883e1675cf1c79a83c416b3567b1d49b
</template>

<script>
import IndexTable from 'src/components/IndexTable.vue'
import { mapGetters, mapActions } from 'vuex'

export default {
  components: { IndexTable },
  data () {
    return {
      editedItem: {
        printing_count: '',
        system_worker_id: '',
        pc_id: '',
        financial_category_id: '',
        service_id: ''
      },

      defaultItem: {
        printing_count: '',
        system_worker_id: '',
        pc_id: '',
        financial_category_id: '',
        service_id: ''
      },

      columns: [
        {
          name: 'printing_count',
          required: true,
          label: 'عدد مرات الطباعة',
          align: 'left',
          field: (row) => row.printing_count,
          format: (val) => `${val}`,
          sortable: true,
          type: 'input'
        },
        {
          name: 'system_worker_id',
          required: true,
          label: 'اسم الموظف',
          align: 'left',
          field: (row) => row.system_worker.username,
          format: (val) => `${val}`,
          sortable: true,
          type: 'select'
        },
        {
          name: 'pc_id',
          required: true,
          label: 'اسم الجهاز',
          align: 'left',
          field: (row) => row.pc.name,
          format: (val) => `${val}`,
          sortable: true,
          type: 'select'
        },
        {
          name: 'financial_category_id',
          required: true,
          label: 'الفئة المحاسبية',
          align: 'left',
          field: (row) => row.financial_category.name,
          format: (val) => `${val}`,
          sortable: true,
          type: 'select'
        },
        {
          name: 'service_id',
          required: true,
          label: 'الخدمة',
          align: 'left',
          field: (row) => row.service.name,
          format: (val) => `${val}`,
          sortable: true,
          type: 'select'
        },
        {
          name: 'actions',
          label: '',
          field: 'actions'
        }
      ]
    }
  },
  computed: {
    ...mapGetters({
      transactions: 'allTransactions',
      systemWorkersOptions: 'systemWorkersOptions',
      pcsOptions: 'pcsOptions',
      financialCategoriesOptions: 'financialCategoriesOptions'
    }),
    options () {
      var optionsDict = {}
      optionsDict.system_worker_id = this.systemWorkersOptions
      optionsDict.pc_id = this.pcsOptions
      optionsDict.financial_category_id = this.financialCategoriesOptions
      return optionsDict
    }
  },
  methods: {
    ...mapActions({
      index: 'indexTransactions',
      store: 'storeTransaction',
      update: 'updateTransaction',
      del: 'deleteTransaction',
      indexPcs: 'indexPcs',
      indexFinancialCategories: 'indexFinancialCategories'
    })
  },
  created () {
    this.indexPcs()
    this.indexFinancialCategories()
  }
}
</script>
