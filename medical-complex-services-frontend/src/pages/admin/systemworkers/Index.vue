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
            <q-td v-for="column in columns.slice(0, -1)" :key="column.name" :props="props">
              {{ props.row[column.name] }}
            </q-td>
            <q-td key="actions" :props="props">
              <q-icon
                size="sm"
                name="edit"
                color="blue-grey-7"
                @click="
                  preEditItem(props.row)
                "
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
            <div class="q-pa-sm q-gutter-sm">
              <q-dialog v-model="filling_data_dialog" @escape-key="close()" @hide="close()">
                <q-card style="font-family: 'JF Flat';">
                  <q-card-section dir="rtl">
                    <div>
                      <p v-if="filling_data_status == 'add' " class="text-weight-bold"> اضافة {{modelName}}</p>
                      <p v-if="filling_data_status == 'edit' " class="text-weight-bold">تعديل {{modelName}}</p>

                      <div v-for="column in columns.slice(0, -1)" :key="column.name" class="q-pa-sm q-gutter-sm">
                        <label>{{column.label}}</label>
                        <q-input
                          v-model="editedItem[column.name]"
                          outlined
                          borderless
                          dense
                          :placeholder="'ادخل ' + column.label"
                        ></q-input>
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
          </q-tr>
        </template>
      </q-table>
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

<style scoped>
.table-header {
  font-size: 20px;
  font-weight: bold;
}
.table-body td {
  font-size: 18px;
}
</style>

<script>
import TableTitle from 'src/components/TableTitle.vue'
import { mapGetters, mapActions, mapMutations } from 'vuex'
import TableSearch from 'src/components/TableSearch.vue'

export default {
  components: { TableTitle, TableSearch },
  data () {
    return {
      editId: -1,
      filter: '',
      filling_data_dialog: false,
      filling_data_status: '',

      modelName: 'مستخدم',
      modelNamePlural: 'مستخدمين',
      modelNameEnglish: 'SystemWorker',
      modelNameEnglishPlural: 'SystemWorkers',

      editedItem: {
        username: ''
      },

      defaultItem: {
        username: ''
      },

      columns: [
        {
          name: 'username',
          required: true,
          label: 'اسم المستخدم',
          align: 'left',
          field: (row) => row.username,
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
  created () {
    this.index()
  },
  computed: {
    ...mapGetters({
      data: 'allSystemWorkers',
      errorMessage: 'getErrorMessage',
      requestFailed: 'getRequestFailed'
    })
  },
  methods: {
    ...mapMutations(['setFailingRequest']),
    ...mapActions({
      index: 'indexSystemWorkers',
      store: 'storeSystemWorker',
      update: 'updateSystemWorker',
      delete: 'deleteSystemWorker'
    }),
    resetFailingRequest () {
      this.setFailingRequest(false)
    },
    preEditItem (row) {
      var columnName = ''
      for (var i = 0; i < this.columns.length - 1; i++) {
        columnName = this.columns[i].name
        this.editedItem[columnName] = row[columnName]
      }
      this.editId = row.id
      this.filling_data_status = 'edit'
      this.filling_data_dialog = true
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
    editItem () {
      this.update([this.editId, this.editedItem])
      this.close()
    },
    deleteItem (item) {
      confirm('هل تريد حذف هذا المستخدم بالتأكيد؟') &&
        this.delete(item.id)
    },
    close () {
      this.editedItem = Object.assign({}, this.defaultItem)
      this.filling_data_status = ''
      this.filling_data_dialog = false
    }
  }
}
</script>
