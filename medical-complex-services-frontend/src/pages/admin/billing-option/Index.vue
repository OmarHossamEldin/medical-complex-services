<template>
  <index-table
    modelName='طريقة دفع'
    modelNamePlural='طرق الدفع'
    modelNameEnglish='BillingOption'
    modelNameEnglishPlural='BillingOptions'
    :columns="columns"
    :item="editedItem"
    :defaultItem="defaultItem"
    :data="billingOptions"
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
        name: ''
      },
      defaultItem: {
        name: ''
      },

      columns: [
        {
          name: 'name',
          required: true,
          label: 'اسم طريقة الدفع',
          align: 'left',
          field: (row) => row.name,
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
      billingOptions: 'allBillingOptions'
    })
  },
  methods: {
    ...mapActions({
      index: 'indexBillingOptions',
      store: 'storeBillingOption',
      update: 'updateBillingOption',
      del: 'deleteBillingOption'
    }),
    getId (item) {
      return item.id
    }
  }
}
</script>
