<template>
  <index-table
    modelName="قسم"
    modelNamePlural="اقسام"
    modelNameEnglish="Department"
    modelNameEnglishPlural="Departments"
    :columns="columns"
    :item="editedItem"
    :defaultItem="defaultItem"
    :data="departments"
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
          label: 'اسم القسم',
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
      departments: 'allDepartments'
    })
  },
  methods: {
    ...mapActions({
      index: 'indexDepartments',
      store: 'storeDepartment',
      update: 'updateDepartment',
      del: 'deleteDepartment'
    })
  }
}
</script>
