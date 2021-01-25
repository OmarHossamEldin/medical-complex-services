<template>
  <index-table
    modelName='فئة محاسبية'
    modelNamePlural='فئات محاسبية'
    modelNameEnglish='FinancialCetegory'
    modelNameEnglishPlural='FinancialCetegories'
    :columns="columns"
    :item="editedItem"
    :defaultItem="defaultItem"
    :data="financialCategories"
    :index="index"
    :store="store"
    :update="update"
    :delete="del"
    :getId="getId"
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
        name: '',
        operator: '',
        value: 0,
        max_limit: 0
      },

      defaultItem: {
        name: '',
        operator: '',
        value: 0,
        max_limit: 0
      },

      columns: [
        {
          name: 'name',
          required: true,
          label: 'اسم الفئة المحاسبية',
          align: 'left',
          field: (row) => row.name,
          format: (val) => `${val}`,
          sortable: true,
          type: 'input'
        },
        {
          name: 'operator',
          required: true,
          label: 'العملية',
          align: 'left',
          field: (row) => row.operator,
          format: (val) => `${val}`,
          sortable: true,
          type: 'input'
        },
        {
          name: 'value',
          required: true,
          label: ' القيمة',
          align: 'left',
          field: (row) => row.value,
          format: (val) => `${val}`,
          sortable: true,
          type: 'input'
        },
        {
          name: 'max_limit',
          required: true,
          label: ' الحد الأقصي',
          align: 'left',
          field: (row) => row.max_limit,
          format: (val) => `${val}`,
          sortable: true,
          type: 'input'
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
      financialCategories: 'allFinancialCategories'
    })
  },
  methods: {
    ...mapActions({
      index: 'indexFinancialCategories',
      store: 'storeFinancialCategory',
      update: 'updateFinancialCategory',
      del: 'deleteFinancialCategory'
    }),
    getId (item) {
      return item.id
    }
  }
}
</script>
