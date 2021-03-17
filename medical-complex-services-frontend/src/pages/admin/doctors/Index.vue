<template>
  <index-table
    modelName='طبيب'
    modelNamePlural='اطباء'
    modelNameEnglish='Doctor'
    modelNameEnglishPlural='Doctors'
    :columns="columns"
    :item="editedItem"
    :defaultItem="defaultItem"
    :data="doctors"
    :index="index"
    :store="store"
    :update="update"
    :delete="del"
    :options="options"
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
        sytem_worker_id: null,
        degree_id: null,
        department_id: null
      },

      defaultItem: {
        sytem_worker_id: null,
        degree_id: null,
        department_id: null
      },

      columns: [
        {
          name: 'system_worker_id',
          required: true,
          label: 'اسم المستخدم',
          align: 'left',
          field: (row) => row.system_worker.username,
          format: (val) => `${val}`,
          sortable: true,
          type: 'select'
        },
        {
          name: 'degree_id',
          required: true,
          label: 'الدرجة العلمية  ',
          align: 'left',
          field: (row) => row.degree.name,
          format: (val) => `${val}`,
          sortable: true,
          type: 'select'
        },
        {
          name: 'department_id',
          required: true,
          label: 'القسم   ',
          align: 'left',
          field: (row) => row.department.name,
          format: (val) => `${val}`,
          sortable: true,
          type: 'select'
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
      doctors: 'allDoctors',
      degreesOptions: 'degreesOptions',
      departmentsOptions: 'departmentsOptions',
      systemWorkersOptions: 'systemWorkersOptions'
    }),
    options () {
      var optionsDict = {}
      optionsDict.department_id = this.departmentsOptions
      optionsDict.degree_id = this.degreesOptions
      optionsDict.system_worker_id = this.systemWorkersOptions
      return optionsDict
    }
  },
  methods: {
    ...mapActions({
      index: 'indexDoctors',
      store: 'storeDoctor',
      update: 'updateDoctor',
      del: 'deleteDoctor',
      indexDegrees: 'indexDegrees',
      indexDepartments: 'indexDepartments',
      indexSystemWorkers: 'indexSystemWorkers'
    }),
    getId (item) {
      return item.system_worker_id
    }
  },
  created () {
    this.indexDegrees()
    this.indexDepartments()
    this.indexSystemWorkers()
  }
}
</script>
