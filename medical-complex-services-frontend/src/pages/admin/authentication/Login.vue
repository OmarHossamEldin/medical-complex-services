<template>
  <div>
    <div align="center" class="title">
      <h4> المنظومة الشاملة للمجمع الطبي ق.م بكوبري القبة </h4>
      <h5>لوحة التحكم</h5>
    </div>

    <div class="row login-dialog q-pa-md items-start q-gutter-md" dir="rtl">
      <div class="col-4"></div>
        <q-card class="col-4 login-card">
          <q-card-section>
            <q-icon name="person" class="text-teal" style="font-size: 7em;" />
            <q-input v-model="userName" item-aligned rounded outlined placeholder="اسم المستخدم">
              <template v-slot:prepend>
                <q-icon name="person" />
              </template>
            </q-input>
            <q-input v-model="password" item-aligned rounded outlined :type="isPwd ? 'password' : 'text'" placeholder="كلمة المرور">
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
            <q-btn to='/admin/reports' style="margin: 10px;" align="center" class="btn-fixed-width login-btn" rounded label="تسجيل الدخول" width="100px" />
            <p style="margin: 10px;">لإنشاء حساب يرجى التواصل بفرع نظم المعلومات</p>
          </q-card-section>
        </q-card>
        <div class="col-4"></div>
    </div>
        <h6 class="bottom" align="center" fixed-bottom>جميع الحقوق محفوظة - فرع نظم المعلومات - المجمع الطبي للقوات المسلحة بك القبة</h6>
  </div>
</template>

<script>
export default {
  name: 'Login',
  data () {
    return {
      userName: '',
      password: '',
      isPwd: true
    }
  }
}
</script>

<style scoped>
  .title{
    color: #002B6D;
  }

  .q-gutter-md , q-input {
    text-align:center;
  }

  .login-btn{
    background-color: #002B6D;
    color: #fff;
    min-width: 150px;
  }

  .login-card{
    padding: 30px 0 30px 0;
  }

  .login-card q-input{
    min-width: 200px;
  }
</style>
