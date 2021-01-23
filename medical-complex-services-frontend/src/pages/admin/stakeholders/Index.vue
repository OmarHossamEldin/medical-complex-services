<template>
  <index-table
    modelName='شخص'
    modelNamePlural='الاشخاص'
    modelNameEnglish='Stakeholder'
    modelNameEnglishPlural='Stakeholders'
    :columns="columns"
    :item="editedItem"
    :defaultItem="defaultItem"
    :data="stakeholders"
    :index="index"
    :store="store"
    :update="update"
    :delete="del"
    :options="options"
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
        wallet: '',
        patient_code: '',
        barcode: '',
        rank_id: '',
        stakeholder_id: null
      },

      defaultItem: {
        name: '',
        wallet: '',
        patient_code: '',
        barcode: '',
        rank_id: '',
        stakeholder_id: null
      },
      columns:
      [{
        name: 'name',
        required: true,
        label: 'الاسم',
        align: 'left',
        field: (row) => row.name,
        format: (val) => `${val}`,
        sortable: true,
        type: 'input'
      },
      {
        name: 'wallet',
        required: true,
        label: 'المحفظة',
        align: 'left',
        field: (row) => row.wallet,
        format: (val) => `${val}`,
        sortable: true,
        type: 'input'
      },
      {
        name: 'patient_code',
        required: true,
        label: 'رقم الحاسب',
        align: 'left',
        field: (row) => row.patient_code,
        format: (val) => `${val}`,
        sortable: true,
        type: 'input'
      },
      {
        name: 'barcode',
        required: true,
        label: 'الباركود',
        align: 'left',
        field: (row) => row.barcode,
        format: (val) => `${val}`,
        sortable: true,
        type: 'input'
      },
      {
        name: 'rank_id',
        required: true,
        label: 'الرتبة',
        align: 'left',
        field: (row) => row.rank.name,
        format: (val) => `${val}`,
        sortable: true,
        type: 'select'
      },
      {
        name: 'stakeholder_id',
        required: true,
        label: 'العائل',
        align: 'left',
        field: (row) => row.stakeholder_id,
        format: (val) => `${val}`,
        sortable: true,
        type: 'select'
      },
      {
        name: 'actions',
        label: '',
        field: 'actions'
      }]

    }
  },
  computed: {
    ...mapGetters({
      stakeholders: 'allStakeholders',
      ranksOptions: 'ranksOptions',
      stakeholdersOptions: 'stakeholdersOptions'
    }),
    options () {
      var optionsDict = {}
      optionsDict.rank_id = this.ranksOptions
      optionsDict.stakeholder_id = this.stakeholdersOptions
      optionsDict.stakeholder_id.push({ label: 'لا يوجد عائل', value: null })
      return optionsDict
    }
  },
  methods: {
    ...mapActions({
      index: 'indexStakeholders',
      store: 'storeStakeholder',
      update: 'updateStakeholder',
      del: 'deleteStakeholder',
      indexRanks: 'indexRanks'
    })
  },
  created () {
    this.indexRanks()
  }
}
</script>
