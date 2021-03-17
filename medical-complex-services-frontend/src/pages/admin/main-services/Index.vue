<template>
  <index-table
    modelName='خدمة رئيسية'
    modelNamePlural='خدمات رئيسية'
    modelNameEnglish='Module'
    modelNameEnglishPlural='Modules'
    :columns="columns"
    :item="editedItem"
    :defaultItem="defaultItem"
    :data="modules"
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
          label: 'اسم الخدمة',
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
      modules: 'allModules'
    })
  },
  methods: {
    ...mapActions({
      index: 'indexModules',
      store: 'storeModule',
      update: 'updateModule',
      del: 'deleteModule'
    }),
    getId (item) {
      return item.id
    }
  }
}
</script>
