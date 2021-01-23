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
        day: [],
        from: '00:00',
        to: '00:00'
      },

      defaultItem: {
        day: [],
        from: '00:00',
        to: '00:00'
      },

      columns: [
        {
          name: 'day',
          required: true,
          label: 'اليوم',
          align: 'left',
          field: (row) => row.day,
          format: (val) => `${val}`,
          sortable: true,
          type: 'checkbox_selection',
          selection_array: ['السبت', 'الاحد', 'الاثنين', 'الثلاثاء', 'الاربعاء', 'الخميس', 'الجمعة']
        },
        {
          name: 'from',
          required: true,
          label: 'من',
          align: 'left',
          field: (row) => row.from,
          format: (val) => `${val}`,
          sortable: true,
          type: 'time'
        },
        {
          name: 'to',
          required: true,
          label: 'الي',
          align: 'left',
          field: (row) => row.to,
          format: (val) => `${val}`,
          sortable: true,
          type: 'time'
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
