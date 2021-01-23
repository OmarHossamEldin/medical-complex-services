<template>
  <index-table
    modelName='نوع خدمة'
    modelNamePlural='أنواع الخدمات'
    modelNameEnglish='ServiceType'
    modelNameEnglishPlural='ServiceTypes'
    :columns="columns"
    :item="editedItem"
    :defaultItem="defaultItem"
    :data="serviceTypes"
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
          label: 'نوع الخدمة',
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
      serviceTypes: 'allServiceTypes'
    })
  },
  methods: {
    ...mapActions({
      index: 'indexServiceTypes',
      store: 'storeServiceType',
      update: 'updateServiceType',
      del: 'deleteServiceType'
    })
  }
}
</script>
