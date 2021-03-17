<template>
  <div id="q-app">
    <div>
      <h5 class="text-weight-bold">طباعة التقارير</h5>
      <q-table
        :data="data"
        :columns="columns"
        row-key="name"
        :filter="filter"
        binary-state-sort
        bordered
        :rows-per-page-options="[20, 30, 50, 0]"
        rows-per-page-label="عدد الصفوف في الصفحة"
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
              {{ column.field(props.row) }}
            </q-td>
            <q-td key="actions" :props="props">
              <q-icon
                size="sm"
                name="print"
                color="blue-7"
                @click="getParams(props.row)"
              >
              <q-tooltip anchor="top middle" self="bottom middle" content-class="bg-blue-7" :offset="[3, 3]">
                  <strong>طباعة التقرير</strong>
                </q-tooltip>
              </q-icon>
            </q-td>
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

    <q-dialog v-model="parametersDialog">
      <q-card  style="font-family: 'JF Flat';" dir="rtl">
        <q-card-section>
          <div class="text-h6">ادخل المتغيرات</div>
          <div v-for="(normalParam, index) in normalParams" :key="index" class="col-12 q-pa-lg q-gutter-sm">
              <label dir="auto"> {{normalParam}} </label>
              <q-input
                v-model="paramObject[normalParam]"
                outlined
                borderless
                dense
                :placeholder="'ادخل ' + normalParam"
              ></q-input>
          </div>
          <div v-for="(likeParam, index) in likeParams" :key="index" class="col-12 q-pa-lg q-gutter-sm">
              <label dir="auto"> {{likeParam}} </label>
              <q-input
                :value="paramObject[likeParam]"
                @input="paramObject[likeParam]='%'+$event+'%'"
                outlined
                borderless
                dense
                :placeholder="'ادخل ' + likeParam"
              ></q-input>
          </div>
          <div v-for="(dateParam, index) in dateParams" :key="index" class="col-12 q-pa-lg q-gutter-sm">
              <label dir="auto"> {{dateParam}} </label>
              <q-date
                v-model="paramObject[dateParam]"
                minimal
              />
          </div>
        </q-card-section>
        <q-card-actions align="right">
          <q-btn
            @click="printReport()"
            flat
            label="تنفيذ"
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
import { mapGetters, mapActions, mapMutations } from 'vuex'

export default {
  data () {
    return {
      filter: '',
      parametersDialog: false,
      params: [],
      likeParams: [],
      normalParams: [],
      dateParams: [],
      paramObject: {},
      reportToBePrinted: {},
      editedItem: {
        name: '',
        description: ''
      },

      defaultItem: {
        name: '',
        description: ''
      },

      columns: [
        {
          name: 'name',
          required: true,
          label: 'اسم التقرير',
          align: 'left',
          field: (row) => row.name,
          format: (val) => `${val}`,
          sortable: true
        },
        {
          name: 'description',
          required: true,
          label: 'الوصف',
          align: 'left',
          field: (row) => row.description,
          format: (val) => `${val}`,
          sortable: true
        },
        {
          name: 'actions',
          label: 'تنفيذ الخدمة',
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
      data: 'allReports',
      errorMessage: 'getErrorMessage',
      requestFailed: 'getRequestFailed'
    })
  },
  methods: {
    ...mapMutations(['setFailingRequest']),
    ...mapActions({
      index: 'indexReports',
      executeReport: 'executeReport'
    }),
    resetFailingRequest () {
      this.setFailingRequest(false)
    },
    getParams (report) {
      this.params = []
      this.normalParams = []
      this.likeParams = []
      this.dateParams = []
      this.reportToBePrinted = report
      // Retrieving parameters from the SQL query through RegExp
      const re = /:[a-zA-Z_]+/g
      this.params = report.sql_query.match(re)
      // Removing colon
      if (this.params !== null) {
        this.params = this.params.map((param) => param.slice(1, param.length))
      }
      // Separating parameters according to their types
      if (this.params !== null) {
        this.params.forEach(param => {
          if (param.split('_')[1] === 'like') {
            this.likeParams.push(param)
          } else if (param.split('_')[1] === 'date') {
            this.dateParams.push(param)
          } else {
            this.normalParams.push(param)
          }
        })
      }
      this.parametersDialog = true
    },
    printReport () {
      this.executeReport([this.reportToBePrinted.id, this.paramObject])
      this.$router.push({ name: 'report-results', params: { reportObj: this.reportToBePrinted } })
      this.reportToBePrinted = {}
      this.paramObject = {}
      this.params = []
      this.normalParams = []
      this.likeParams = []
      this.dateParams = []
    }
  }
}
</script>
