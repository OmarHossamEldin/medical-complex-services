<template>
  <index-table
    modelName='المهمة الوظيفية'
    modelNamePlural='المهام الوظيفية'
    modelNameEnglish='Role'
    modelNameEnglishPlural='Roles'
    :columns="columns"
    :item="editedItem"
    :defaultItem="defaultItem"
    :data="roles"
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
          label: 'اسم المهمة الوظيفية',
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
      roles: 'allRoles'
    })
  },
  methods: {
    ...mapActions({
      index: 'indexRoles',
      store: 'storeRole',
      update: 'updateRole',
      del: 'deleteRole'
    })
  }
}
</script>
