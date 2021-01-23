<template>
  <div>
    <div class="row">
      <div class="col-3">
        <div class="row no-wrap q-pa-md">
          <div class="column items-center">
            <q-avatar size="200px">
              <img src="../../../assets/1.jpg">
            </q-avatar>
            <h5>علي عزت علي</h5>
            <p>مستخدم عادي</p>
          </div>
          <q-separator vertical inset class="q-mx-lg-lg window-height" style="margin: 0 100px" />
        </div>
      </div>
      <div class="col-9">
        <h5>تعديل الملف الشخصي</h5>
        <div class="row">
          <div class="col-6">
            <div class="q-pa-md">
              <div class="q-gutter-md" style="max-width: 400px">
                <label>الإسم الأول</label>
                <q-input rounded outlined v-model="text" placeholder="الإسم الأول" />
              </div>
            </div>
            <div class="q-pa-md">
              <div class="q-gutter-md" style="max-width: 400px">
                <label>العنوان</label>
                <q-input rounded outlined v-model="text" placeholder="العنوان" />
              </div>
            </div>
            <div class="q-pa-md">
              <div class="q-gutter-md" style="max-width: 400px">
                <label>الرقم القومي</label>
                <q-input rounded outlined v-model="text" placeholder="الرقم القومي" />
              </div>
            </div>
            <div class="q-pa-md">
              <div class="q-gutter-md" style="max-width: 400px">
                <label>كلمة المرور</label>
                <q-input v-model="password" rounded outlined :type="isPwd ? 'password' : 'text'" placeholder="كلمة المرور" >
                  <template v-slot:prepend>
                    <q-icon name="lock" />
                  </template>
                  <template v-slot:append>
                    <q-icon
                      :name="isPwd ? 'visibility_off' : 'visibility'"
                      class="cursor-pointer"
                      @click="isPwd = !isPwd"
                    />
                  </template>
                </q-input>
              </div>
            </div>
            <q-btn to='/home' style="margin: 10px;" class="bg-teal-5 text-white" rounded label="تعديل الملف الشخصي" size="lg"/>
          </div>
          <div class="col-6">
            <div class="q-pa-md">
              <div class="q-gutter-md" style="max-width: 400px">
                <label>الإسم الأخير</label>
                <q-input rounded outlined v-model="text" placeholder="الإسم الأخير" />
              </div>
            </div>
            <div class="q-pa-md">
              <div class="q-gutter-md" style="max-width: 400px">
                <label>رقم الموبايل</label>
                <q-input rounded outlined v-model="text" placeholder="رقم الموبايل" />
              </div>
            </div>
            <div class="q-pa-md">
              <div class="q-gutter-md" style="max-width: 400px">
                <label>تأكيد كلمة المرور</label>
                <q-input v-model="confirmPassword" rounded outlined :type="isPwd ? 'password' : 'text'" placeholder="تأكيد كلمة المرور">
                  <template v-slot:prepend>
                    <q-icon name="lock" />
                  </template>
                  <template v-slot:append>
                    <q-icon
                      :name="isPwd ? 'visibility_off' : 'visibility'"
                      class="cursor-pointer"
                      @click="isPwd = !isPwd"
                    />
                  </template>
                </q-input>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      password: '',
      confirmPassword: '',
      isPwd: true
    }
  }
}
</script>

<style>
</style>
