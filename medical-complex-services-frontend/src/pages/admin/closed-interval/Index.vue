<template>
  <index-table
    modelName='فترة'
    modelNamePlural='فترات'
    modelNameEnglish='ClosedInterval'
    modelNameEnglishPlural='ClosedIntervals'
    :columns="columns"
    :item="editedItem"
    :defaultItem="defaultItem"
    :data="closedIntervals"
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
        day: '',
        from: '',
        to: ''
      },

      defaultItem: {
        day: '',
        from: '',
        to: ''
      },

      columns: [
        {
          name: 'day',
          required: true,
          label: 'اليوم',
          align: 'left',
          field: (row) => row.day,
          format: (val) => `${val}`,
          sortable: true
        },
        {
          name: 'from',
          required: true,
          label: 'من',
          align: 'left',
          field: (row) => row.from,
          format: (val) => `${val}`,
          sortable: true
        },
        {
          name: 'to',
          required: true,
          label: 'الي',
          align: 'left',
          field: (row) => row.to,
          format: (val) => `${val}`,
          sortable: true
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
      closedIntervals: 'allClosedIntervals'
    })
  },
  methods: {
    ...mapActions({
      index: 'indexClosedIntervals',
      store: 'storeClosedInterval',
      update: 'updateClosedInterval',
      del: 'deleteClosedInterval'
    })
  }
}
</script>
