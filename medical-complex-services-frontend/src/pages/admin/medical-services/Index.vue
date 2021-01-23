<template>
  <index-table
    modelName='خدمة'
    modelNamePlural='خدمات'
    modelNameEnglish='Service'
    modelNameEnglishPlural='Services'
    :columns="columns"
    :item="editedItem"
    :defaultItem="defaultItem"
    :data="services"
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
        fixed_price: '',
        timed: false,
        requires_doctor: false,
        main_consumer_number: '',
        associate_consumer_number: '',
        variable_price_equation: '',
        price_type_id: '',
        service_type_id: '',
        department_id: '',
        service_id: '',
        pc_dependent: false,
        price_type: ''
      },

      defaultItem: {
        name: '',
        fixed_price: '',
        timed: false,
        requires_doctor: false,
        main_consumer_number: '',
        associate_consumer_number: '',
        variable_price_equation: '',
        price_type_id: '',
        service_type_id: '',
        department_id: '',
        service_id: '',
        pc_dependent: false,
        price_type: ''
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
          name: 'fixed_price',
          required: true,
          label: ' السعر الثابت ',
          align: 'left',
          field: (row) => row.fixed_price,
          format: (val) => `${val}`,
          sortable: true,
          type: 'input'
        },
        {
          name: 'timed',
          required: true,
          label: 'مرتبطة بوقت محدد؟',
          align: 'left',
          field: (row) => row.timed,
          format: (val) => `${val}`,
          sortable: true,
          type: 'checkbox'
        },
        {
          name: 'requires_doctor',
          required: true,
          label: 'تتطلب طبيب؟',
          align: 'left',
          field: (row) => row.requires_doctor,
          format: (val) => `${val}`,
          sortable: true,
          type: 'checkbox'
        },
        {
          name: 'main_consumer_number',
          required: true,
          label: ' المستهلكين الأساسيين',
          align: 'left',
          field: (row) => row.main_consumer_number,
          format: (val) => `${val}`,
          sortable: true,
          type: 'input'
        },
        {
          name: 'associate_consumer_number',
          required: true,
          label: ' المستهلكين الغير أساسيين',
          align: 'left',
          field: (row) => row.associate_consumer_number,
          format: (val) => `${val}`,
          sortable: true,
          type: 'input'
        },
        {
          name: 'variable_price_equation',
          required: true,
          label: 'معادلة السعر المتغير',
          align: 'left',
          field: (row) => row.variable_price_equation,
          format: (val) => `${val}`,
          sortable: true,
          type: 'input'
        },
        {
          name: 'price_type_id',
          required: true,
          label: 'نوع التسعيرة ',
          align: 'left',
          field: (row) => row.price_type.name,
          format: (val) => `${val}`,
          sortable: true,
          type: 'select'
        },
        {
          name: 'service_type_id',
          required: true,
          label: 'نوع الخدمة ',
          align: 'left',
          field: (row) => row.service_type.name,
          format: (val) => `${val}`,
          sortable: true,
          type: 'select'
        },
        {
          name: 'department_id',
          required: true,
          label: 'القسم ',
          align: 'left',
          field: (row) => row.department.name,
          format: (val) => `${val}`,
          sortable: true,
          type: 'select'
        },
        {
          name: 'pc_dependent',
          required: true,
          label: 'تعتمد على جهاز',
          align: 'left',
          field: (row) => row.pc_dependent,
          format: (val) => `${val}`,
          sortable: true,
          type: 'checkbox'
        },
        {
          name: 'service_id',
          required: true,
          label: 'الخدمة الأعلى',
          align: 'left',
          field: (row) => row.service_id,
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
      services: 'allServices',
      priceTypesOptions: 'priceTypesOptions',
      serviceTypesOptions: 'serviceTypesOptions',
      departmentsOptions: 'departmentsOptions',
      servicesOptions: 'servicesOptions'
    }),
    options () {
      var optionsDict = {}
      optionsDict.price_type_id = this.priceTypesOptions
      optionsDict.service_type_id = this.serviceTypesOptions
      optionsDict.department_id = this.departmentsOptions
      optionsDict.service_id = this.servicesOptions
      optionsDict.service_id.push({ label: 'لا يوجد', value: null })
      return optionsDict
    }
  },
  methods: {
    ...mapActions({
      index: 'indexServices',
      store: 'storeService',
      update: 'updateService',
      del: 'deleteService',
      indexPriceTypes: 'indexPriceTypes',
      indexServiceTypes: 'indexServiceTypes',
      indexDepartments: 'indexDepartments'
    })
  },
  created () {
    this.indexPriceTypes()
    this.indexServiceTypes()
    this.indexDepartments()
  }
}
</script>
