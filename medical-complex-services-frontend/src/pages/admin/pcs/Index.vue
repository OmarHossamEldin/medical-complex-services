<template>
  <index-table
    modelName='جهاز'
    modelNamePlural='اجهزة'
    modelNameEnglish='Pc'
    modelNameEnglishPlural='Pcs'
    :columns="columns"
    :item="editedItem"
    :defaultItem="defaultItem"
    :data="pcs"
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
        name: '',
        ip: '',
        mac_address: ''
      },

      defaultItem: {
        name: '',
        ip: '',
        mac_address: ''
      },

      columns: [
        {
          name: 'name',
          required: true,
          label: 'اسم الجهاز',
          align: 'left',
          field: (row) => row.name,
          format: (val) => `${val}`,
          sortable: true,
          type: 'input'
        },
        {
          name: 'ip',
          required: true,
          label: 'عنوان IP ',
          align: 'left',
          field: (row) => row.ip,
          format: (val) => `${val}`,
          sortable: true,
          type: 'input'
        },
        {
          name: 'mac_address',
          required: true,
          label: 'عنوان MAC',
          align: 'left',
          field: (row) => row.mac_address,
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
      pcs: 'allPcs'
    })
  },
  methods: {
    ...mapActions({
      index: 'indexPcs',
      store: 'storePc',
      update: 'updatePc',
      del: 'deletePc'
    })
  }
}
</script>
