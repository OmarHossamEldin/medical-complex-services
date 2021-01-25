<template>
  <index-table
    modelName='رتبة'
    modelNamePlural='الرتب'
    modelNameEnglish='Rank'
    modelNameEnglishPlural='Ranks'
    :columns="columns"
    :item="editedItem"
    :defaultItem="defaultItem"
    :data="ranks"
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
          label: 'اسم الرتبة',
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
      ranks: 'allRanks'
    })
  },
  methods: {
    ...mapActions({
      index: 'indexRanks',
      store: 'storeRank',
      update: 'updateRank',
      del: 'deleteRank'
    }),
    getId (item) {
      return item.id
    }
  }
}
</script>
