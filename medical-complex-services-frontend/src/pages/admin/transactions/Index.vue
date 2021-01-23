<template>
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
