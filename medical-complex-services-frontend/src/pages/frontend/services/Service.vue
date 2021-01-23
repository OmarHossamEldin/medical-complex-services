<template>
  <div>
    <h5 align="center" class="text-teal-5">اسم الخدمة</h5>
    <q-separator horizontal inset class="q-mx-lg-lg"/>
    <div>
      <h6 class="titleName">اختر طريقة البحث:</h6>
      <div class="q-pa-md" align="center">
        <div class="q-gutter-sm">
          <q-radio v-model="formData" val="patientNumber" label="البحث برقم المريض" color="teal" />
          <q-radio v-model="formData" val="patientID" label="البحث بالرقم القومي او العسكري" color="teal" />
          <q-radio v-model="formData" val="systemCode" label="البحث بكود النظام" color="teal" />
          <q-radio v-model="formData" val="patientName" label="البحث باسم المريض" color="teal" />
        </div>
        <div class="q-px-sm q-mt-sm" v-if="formData === 'patientNumber'">
          <div class="q-pa-md">
            <div class="q-gutter-md" style="max-width: 300px" align="right">
              <label>رقم المريض</label>
              <q-input rounded outlined placeholder="ادخل رقم المريض">

                <template v-slot:after>
                  <q-btn label="بحث" class="bg-teal-5 text-white" rounded/>
                </template>
              </q-input>
            </div>
          </div>
        </div>
        <div class="q-px-sm q-mt-sm" v-if="formData === 'patientID'">
          <div class="q-pa-md">
            <div class="q-gutter-md" style="max-width: 400px" align="right">
              <label>الرقم القومي أو العسكري</label>
              <q-input rounded outlined placeholder="ادخل الرقم القومي أو العسكري">

                <template v-slot:after>
                  <q-btn label="بحث" class="bg-teal-5 text-white" rounded/>
                </template>
              </q-input>
            </div>
          </div>
        </div>
        <div class="q-px-sm q-mt-sm" v-if="formData === 'systemCode'">
          <div class="q-pa-md">
            <div class="q-gutter-md" style="max-width: 300px" align="right">
              <label>كود النظام</label>
              <q-input rounded outlined placeholder="ادخل كود النظام">

                <template v-slot:after>
                  <q-btn label="بحث" class="bg-teal-5 text-white" rounded/>
                </template>
              </q-input>
            </div>
          </div>
        </div>
        <div class="q-px-sm q-mt-sm" v-if="formData === 'patientName'">
          <div class="row q-pa-md patientName1">
            <div class="q-gutter-md patientName col-3" style="max-width: 300px" align="right">
              <label>الاسم الأول</label>
              <q-input rounded outlined placeholder="ادخل الاسم الأول"/>
            </div>
            <div class="q-gutter-md patientName col-3" style="max-width: 300px" align="right">
              <label>الاسم الثاني</label>
              <q-input rounded outlined placeholder="ادخل الاسم الثاني" />
            </div>
            <div class="q-gutter-md patientName col-3" style="max-width: 300px" align="right">
              <label>الاسم الثالث</label>
              <q-input rounded outlined placeholder="ادخل الاسم الثالث" />
            </div>
            <div class="q-gutter-md patientName col-3" style="max-width: 300px" align="right">
              <label>الاسم الرابع</label>
              <q-input rounded outlined placeholder="ادخل الاسم الرابع" />
            </div>
          </div>
          <q-btn align="center" class="bg-teal-5 text-white" rounded label="بحث" size="md"/>
        </div>
        <div>
          <div class="q-pa-md">
            <q-table
              title="نتيجة البحث"
              :data="data"
              :columns="columns"
              row-key="name"
            >
              <template v-slot:header="props">
                <q-tr :props="props">
                  <q-th
                    v-for="col in props.cols"
                    :key="col.name"
                    :props="props"
                    class="text-italic text-teal-5"
                  >
                    {{ col.label }}
                  </q-th>
                </q-tr>
              </template>
            </q-table>
          </div>
        </div>
        <h6 class="titleName">اختر اسم الطبيب:</h6>
        <div align="right">
          <div class="q-pa-md" style="max-width: 400px;">
            <div class="q-gutter-md" align="right">
              <q-select rounded outlined v-model="doctor_name" :options="options"/>
            </div>
          </div>
        </div>
        <h6 class="titleName">ادخل القيم الاتية للمعادلة الحسابية:</h6>
        <div class="row">
          <div class="col-6" >
            <div class="q-gutter-md patientName col-3" style="max-width: 300px" align="right">
              <label>عدد الشهور</label>
              <q-input rounded outlined placeholder="ادخل عدد الشهور"/>
            </div>
          </div>
          <div class="col-6">
            <div class="q-gutter-md patientName col-3" style="max-width: 300px" align="right">
              <label>عدد الأصناف</label>
              <q-input rounded outlined placeholder="ادخل عدد الأصناف"/>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <h6 class="titleName">اختر الفئة المحاسبية:</h6>
            <div class="q-pa-md" align="right">
              <div class="q-gutter-sm">
                <q-radio v-model="financial_category" val="والدين" label="والدين" color="teal" />
              </div>
              <div class="q-gutter-sm">
                <q-radio v-model="financial_category" val="أجانب" label="أجانب" color="teal" />
              </div>
            </div>
          </div>
          <div class="col-6">
            <h6 class="titleName">اختر طريقة الدفع:</h6>
            <div class="q-pa-md" align="right">
              <div class="q-gutter-sm">
                <q-radio v-model="payment_method" val="كاش" label="كاش" color="teal" />
              </div>
              <div class="q-gutter-sm">
                <q-radio v-model="payment_method" val="فيزا" label="فيزا" color="teal" />
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="q-pa-md q-gutter-sm">
          <q-btn class="bg-teal-5 text-white" label="مراجعة البيانات" @click="fixed = true" />
          <q-dialog v-model="fixed" dir="rtl" >
            <q-card style="font-family: 'JF Flat'">
              <q-card-section>
                <div class="text-h6">مراجعة البيانات</div>
              </q-card-section>

              <q-separator />

              <q-card-section class="scroll" style="width:250px">
                <div class="row">
                  <div class="col-6">
                    <p>رقم المريض</p>
                    <p>اسم المريض</p>
                    <p>اسم الطبيب</p>
                    <p>فئة المحاسبية</p>
                    <p>المبلغ الاجمالي</p>
                    <p>طريقة الدفع</p>
                  </div>
                  <div class="col-6">
                    <p>1234567</p>
                    <p>احمد </p>
                    <p>محمد</p>
                    <p>عسكريين</p>
                    <p>1000</p>
                    <p>فيزا</p>
                  </div>
                </div>
              </q-card-section>

              <q-separator />

              <q-card-actions align="right">
                <q-btn flat label="الغاء" color="primary" v-close-popup />
                <q-btn flat label="طباعة" color="primary" v-close-popup />
              </q-card-actions>
            </q-card>
          </q-dialog>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      formData: '',
      financial_category: '',
      payment_method: '',
      basic: false,
      fixed: false,
      color: 'teal-5',
      columns: [
        { name: 'patient_code', required: true, label: 'رقم المريض', align: 'left', field: row => row.patient_code, format: val => `${val}`, sortable: true },
        { name: 'patient_name', align: 'center', label: 'اسم المريض', field: 'patient_name', sortable: true },
        { name: 'code_id', label: 'الرقم القومي', field: 'code_id', sortable: true },
        { name: 'military_id', label: 'الرقم العسكري', field: 'military_id' },
        { name: 'system_code', label: 'كود النظام', field: 'system_code' }
      ],
      data: [
        {
          patient_code: 1234567,
          patient_name: 'الرتبة/ الاسم الأول الاسم الثاني',
          code_id: 12345678912345,
          military_id: 1234567,
          system_code: 1234567
        },
        {
          patient_code: 1234567,
          patient_name: 'الرتبة/ الاسم الأول الاسم الثاني',
          code_id: 12345678912345,
          military_id: 1234567,
          system_code: 1234567
        },
        {
          patient_code: 1234567,
          patient_name: 'الرتبة/ الاسم الأول الاسم الثاني',
          code_id: 12345678912345,
          military_id: 1234567,
          system_code: 1234567
        },
        {
          patient_code: 1234567,
          patient_name: 'الرتبة/ الاسم الأول الاسم الثاني',
          code_id: 12345678912345,
          military_id: 1234567,
          system_code: 1234567
        },
        {
          patient_code: 1234567,
          patient_name: 'الرتبة/ الاسم الأول الاسم الثاني',
          code_id: 12345678912345,
          military_id: 1234567,
          system_code: 1234567
        },
        {
          patient_code: 1234567,
          patient_name: 'الرتبة/ الاسم الأول الاسم الثاني',
          code_id: 12345678912345,
          military_id: 1234567,
          system_code: 1234567
        },
        {
          patient_code: 1234567,
          patient_name: 'الرتبة/ الاسم الأول الاسم الثاني',
          code_id: 12345678912345,
          military_id: 1234567,
          system_code: 1234567
        },
        {
          patient_code: 1234567,
          patient_name: 'الرتبة/ الاسم الأول الاسم الثاني',
          code_id: 12345678912345,
          military_id: 1234567,
          system_code: 1234567
        },
        {
          patient_code: 1234567,
          patient_name: 'الرتبة/ الاسم الأول الاسم الثاني',
          code_id: 12345678912345,
          military_id: 1234567,
          system_code: 1234567
        },
        {
          patient_code: 1234567,
          patient_name: 'الرتبة/ الاسم الأول الاسم الثاني',
          code_id: 12345678912345,
          military_id: 1234567,
          system_code: 1234567
        }
      ],
      doctor_name: 'اختر اسم الطبيب..',
      options: [
        'لواء ط/ محمد احمد حسين', 'عميد ط/ محمود اشرف علي', 'مقدم ط/ علي محمد حسني'
      ]
    }
  }
}
</script>

<style>
.titleName{
  padding-left: 10px;
  text-align: left;
}

.patientName
{
  margin: auto;
}

.q-field__control{
  height: 40px;
}
</style>
