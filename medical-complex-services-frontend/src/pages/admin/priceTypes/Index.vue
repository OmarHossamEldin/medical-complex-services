<template>
  <index-table
    modelName='نوع تسعير'
    modelNamePlural='أنواع التسعير'
    modelNameEnglish='PriceType'
    modelNameEnglishPlural='PriceTypes'
    :columns="columns"
    :item="editedItem"
    :defaultItem="defaultItem"
    :data="priceTypes"
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
          label: 'نوع التسعير',
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
      priceTypes: 'allPriceTypes'
    })
  },
  methods: {
    ...mapActions({
      index: 'indexPriceTypes',
      store: 'storePriceType',
      update: 'updatePriceType',
      del: 'deletePriceType'
    }),
    getId (item) {
      return item.id
    }
  }
}
</script>
