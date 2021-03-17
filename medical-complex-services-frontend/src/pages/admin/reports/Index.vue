<template>
  <index-table
    modelName='التقرير'
    modelNamePlural='التقارير'
    modelNameEnglish='Report'
    modelNameEnglishPlural='Reports'
    :columns="columns"
    :item="editedItem"
    :defaultItem="defaultItem"
    :data="reports"
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
        sql_query: '',
        status: true,
        show_user: true
      },

      defaultItem: {
        name: '',
        sql_query: '',
        status: true,
        show_user: true
      },

      columns: [
        {
          name: 'name',
          required: true,
          label: 'اسم التقرير',
          align: 'left',
          field: (row) => row.name,
          format: (val) => `${val}`,
          sortable: true,
          type: 'input'
        },
        {
          name: 'description',
          required: true,
          label: 'الوصف',
          align: 'left',
          field: (row) => row.description,
          format: (val) => `${val}`,
          sortable: true,
          type: 'input'
        },
        {
          name: 'sql_query',
          required: true,
          label: 'SQL Query',
          align: 'left',
          field: (row) => row.sql_query,
          format: (val) => `${val}`,
          sortable: true,
          type: 'textarea',
          hint: `Please specify the type of each parameter. e.g. _like_param, _date_param, or _normal_param.
          Also, you can add aliasing for arabic names and put them in double quotes`
        },
        {
          name: 'show_user',
          required: true,
          label: 'اظهار اسم المستخدم؟',
          align: 'left',
          field: (row) => row.show_user,
          format: (val) => `${val}`,
          sortable: true,
          type: 'checkbox'
        },
        {
          name: 'status',
          required: true,
          label: 'الحالة',
          align: 'left',
          field: (row) => row.status,
          format: (val) => `${val}`,
          sortable: true,
          type: 'checkbox'
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
      reports: 'allReports'
    })
  },
  methods: {
    ...mapActions({
      index: 'indexReports',
      store: 'storeReport',
      update: 'updateReport',
      del: 'deleteReport'
    }),
    getId (item) {
      return item.id
    }
  }
}
</script>
