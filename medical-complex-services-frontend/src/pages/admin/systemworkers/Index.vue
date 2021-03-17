<template>
  <index-table
    modelName='مستخدم'
    modelNamePlural='مستخدمين'
    modelNameEnglish='SystemWorker'
    modelNameEnglishPlural='SystemWorkers'
    :columns="columns"
    :item="editedItem"
    :defaultItem="defaultItem"
    :data="systemWorkers"
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
        username: '',
        role_id: null,
        stakeholder_id: null
      },

      defaultItem: {
        username: '',
        role_id: null,
        stakeholder_id: null
      },

      columns: [
        {
          name: 'username',
          required: true,
          label: 'اسم المستخدم',
          align: 'left',
          field: (row) => row.username,
          format: (val) => `${val}`,
          sortable: true,
          type: 'input'
        },
        {
          name: 'role_id',
          required: true,
          label: 'المهمة الوظيفية',
          align: 'left',
          field: (row) => row.role.name,
          format: (val) => `${val}`,
          sortable: true,
          type: 'select'
        },
        {
          name: 'stakeholder_id',
          required: true,
          label: 'الشخص',
          align: 'left',
          field: (row) => row.stakeholder.name,
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
      systemWorkers: 'allSystemWorkers',
      rolesOptions: 'rolesOptions',
      stakeholdersOptions: 'stakeholdersOptions'
    }),
    options () {
      var optionsDict = {}
      optionsDict.role_id = this.rolesOptions
      optionsDict.stakeholder_id = this.stakeholdersOptions
      return optionsDict
    }
  },
  methods: {
    ...mapActions({
      index: 'indexSystemWorkers',
      store: 'storeSystemWorker',
      update: 'updateSystemWorker',
      del: 'deleteSystemWorker',
      indexRoles: 'indexRoles',
      indexStakeholders: 'indexStakeholders'
    }),
    getId (item) {
      return item.stakeholder_id
    }
  },
  created () {
    this.indexRoles()
    this.indexStakeholders()
  }
}
</script>
