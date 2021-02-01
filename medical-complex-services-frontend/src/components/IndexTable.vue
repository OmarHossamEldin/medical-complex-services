<template>
  <div id="q-app">

    <div>
      <table-title :title="modelNamePlural"/>
      <q-table
        :data="data"
        :columns="columns"
        row-key="name"
        :filter="filter"
        binary-state-sort
        bordered
        :rows-per-page-options="[20, 30, 50, 0]"
        rows-per-page-label="عدد الصفوف في الصفحة"
      >

        <template v-slot:top-right>
          <table-search v-model="filter"></table-search>
        </template>

        <template v-slot:top-left>
          <q-btn
            outline
            class="text-weight-bold"
            color="blue-grey-6"
            :label="'اضافة ' + modelName"
            @click="filling_data_status = 'add'; filling_data_dialog = true"
            no-caps
          />
        </template>

        <template v-slot:header="props">
          <q-tr :props="props">
            <q-th
              v-for="col in props.cols"
              :key="col.name"
              :props="props"
              class="table-header"
            >
              {{ col.label }}
            </q-th>
          </q-tr>
        </template>

        <template v-slot:body="props">
          <q-tr :props="props" class="table-body">
            <q-td dir="ltr" v-for="column in columns.slice(0, -1)" :key="column.name" :props="props">
              <p v-if="column.field(props.row) === null"> لا يوجد </p>
              <p v-else-if="column.field(props.row) === true"> نعم </p>
              <p v-else-if="column.field(props.row) === false"> لا </p>
              <p v-else> {{ column.field(props.row) }} </p>
            </q-td>
            <q-td key="actions" :props="props">
              <q-icon
                size="sm"
                name="edit"
                color="blue-grey-7"
                @click="preEditItem(props.row)"
              >
              <q-tooltip anchor="top middle" self="bottom middle" content-class="bg-blue-grey-7" :offset="[3, 3]">
                  <strong>تعديل</strong>
                </q-tooltip>
              </q-icon>

              <q-icon
                size="sm"
                name="delete"
                color="red-10"
                @click="deleteItem(props.row)"
              >
              <q-tooltip anchor="top middle" self="bottom middle" content-class="bg-red-10" :offset="[3, 3]">
                  <strong>حذف</strong>
                </q-tooltip>
              </q-icon>

            </q-td>

          </q-tr>
        </template>

      </q-table>
              <q-dialog v-model="filling_data_dialog" @escape-key="close()" @hide="close()">
                <q-card style="font-family: 'JF Flat';">
                  <q-card-section dir="rtl">
                    <p v-if="filling_data_status == 'add' " class="text-weight-bold"> اضافة {{modelName}}</p>
                    <p v-if="filling_data_status == 'edit' " class="text-weight-bold">تعديل {{modelName}}</p>
                    <div class="row">
                      <div v-for="column in columns.slice(0, -1)" :key="column.name" class="col-12 q-pa-lg q-gutter-sm">
                        <label v-if="column.type != 'checkbox'">{{column.label}}</label>
                        <q-input
                          dir="auto"
                          v-if="column.type=='input' || column.type=='textarea'"
                          :type="column.type"
                          v-model="editedItem[column.name]"
                          outlined
                          borderless
                          dense
                          :placeholder="'ادخل ' + column.label"
                          :hint = "column.hint"
                        ></q-input>
                        <q-select
                          v-if="column.type=='select'"
                          v-model="editedItem[column.name]"
                          :options="options[column.name]"
                          outlined
                          borderless
                          dense
                          emit-value
                          map-options
                        ></q-select>
                        <q-checkbox v-if="column.type=='checkbox'" v-model="editedItem[column.name]" :label="column.label"/>
                        <q-input v-if="column.type=='time'" filled v-model="editedItem[column.name]" mask="time" :rules="['time']">
                          <template v-slot:append>
                            <q-icon name="access_time" class="cursor-pointer">
                              <q-popup-proxy transition-show="scale" transition-hide="scale">
                                <q-time v-model="editedItem[column.name]">
                                  <div class="row items-center justify-end">
                                    <q-btn v-close-popup label="Close" color="primary" flat />
                                  </div>
                                </q-time>
                              </q-popup-proxy>
                            </q-icon>
                          </template>
                        </q-input>
                        <div v-if="column.type=='checkbox_selection'" class="q-gutter-sm">
                          <q-checkbox v-model="editedItem[column.name]" :val="column.selection_array[0]" :label="column.selection_array[0]"/>
                          <q-checkbox v-model="editedItem[column.name]" :val="column.selection_array[1]" :label="column.selection_array[1]"/>
                          <q-checkbox v-model="editedItem[column.name]" :val="column.selection_array[2]" :label="column.selection_array[2]"/>
                          <q-checkbox v-model="editedItem[column.name]" :val="column.selection_array[3]" :label="column.selection_array[3]"/>
                          <q-checkbox v-model="editedItem[column.name]" :val="column.selection_array[4]" :label="column.selection_array[4]"/>
                          <q-checkbox v-model="editedItem[column.name]" :val="column.selection_array[5]" :label="column.selection_array[5]"/>
                          <q-checkbox v-model="editedItem[column.name]" :val="column.selection_array[6]" :label="column.selection_array[6]"/>
                        </div>
                      </div>
                    </div>
                  </q-card-section>

                  <q-card-actions align="left">
                    <q-btn
                      flat
                      label="موافق"
                      color="primary"
                      v-close-popup
                      @click="addOrEditItem()"
                    ></q-btn>
                    <q-btn
                      flat
                      label="إلغاء"
                      color="error"
                      v-close-popup
                      @click="close()"
                    ></q-btn>
                  </q-card-actions>
                </q-card>
              </q-dialog>
    </div>

    <q-dialog v-model="requestFailed">
      <q-card  style="font-family: 'JF Flat';" dir="rtl">
        <q-card-section>
          <div class="text-h6">تنبيه</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          {{ errorMessage }}
        </q-card-section>

        <q-card-actions align="right">
          <q-btn
            @click="resetFailingRequest()"
            flat
            label="موافق"
            color="primary"
            v-close-popup
          />
        </q-card-actions>
      </q-card>
    </q-dialog>

  </div>
</template>

<script>
import TableTitle from 'src/components/TableTitle.vue'
import { mapGetters, mapMutations } from 'vuex'
import TableSearch from 'src/components/TableSearch.vue'

export default {
  components: { TableTitle, TableSearch },

  props: ['modelName', 'modelNamePlural', 'modelNameEnglish', 'modelNameEnglishPlural', 'columns', 'item', 'defaultItem',
    'data', 'index', 'store', 'update', 'delete', 'options', 'getId'],

  data () {
    return {
      editId: -1,
      filter: '',
      filling_data_dialog: false,
      filling_data_status: '',
      editedItem: this.item
    }
  },
  created () {
    this.index()
  },
  computed: {
    ...mapGetters({
      errorMessage: 'getErrorMessage',
      requestFailed: 'getRequestFailed'
    })
  },
  methods: {
    ...mapMutations(['setFailingRequest']),

    resetFailingRequest () {
      this.setFailingRequest(false)
    },
    addOrEditItem () {
      if (this.filling_data_status === 'add') {
        this.addItem()
      } else if (this.filling_data_status === 'edit') {
        this.editItem()
      }
    },
    addItem () {
      this.store(this.editedItem)
      this.close()
    },
    preEditItem (row) {
      var columnName = ''
      for (var i = 0; i < this.columns.length - 1; i++) {
        columnName = this.columns[i].name
        this.editedItem[columnName] = row[columnName]
      }
      this.editId = this.getId(row)
      this.filling_data_status = 'edit'
      this.filling_data_dialog = true
    },
    editItem () {
      this.update([this.editId, this.editedItem])
      this.close()
    },
    deleteItem (item) {
      confirm('هل تريد حذف هذا القسم بالتأكيد؟') &&
        this.delete(this.getId(item))
    },
    close () {
      this.editedItem = Object.assign({}, this.defaultItem)
      this.filling_data_status = ''
      this.filling_data_dialog = false
    }
  }
}
</script>

<style scoped>
.table-header {
  font-size: 20px;
  font-weight: bold;
}

.table-body td {
  font-size: 18px;
}

.addDialog{
  width: 100%;
}
</style>
