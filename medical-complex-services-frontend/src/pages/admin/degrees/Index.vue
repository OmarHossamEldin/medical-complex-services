<template>
  <index-table
    modelName="درجة"
    modelNamePlural="الدرجات"
    modelNameEnglish="Degree"
    modelNameEnglishPlural="Degrees"
    :columns="columns"
    :item="editedItem"
    :defaultItem="defaultItem"
    :data="degrees"
    :index="index"
    :store="store"
    :update="update"
    :delete="del"
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
          label: 'اسم الدرجة',
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
      degrees: 'allDegrees'
    })
  },
  methods: {
    ...mapActions({
      index: 'indexDegrees',
      store: 'storeDegree',
      update: 'updateDegree',
      del: 'deleteDegree'
    })
  }
}
</script>
