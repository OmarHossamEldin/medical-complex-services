<template>
  <div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 self-center" align="center">
          <p>مرحبا بكم في</p>
          <p class="complexName">المجمع الطبي ق.م بكوبري القبة</p>
          <p>المنظومة الشاملة</p>
        <div class="loginForm">
            <q-input v-model="userName" item-aligned rounded outlined placeholder="اسم المستخدم" style="padding: 0;">
              <template v-slot:prepend>
                <q-icon name="person" />
              </template>
            </q-input>
            <q-input v-model="password" item-aligned rounded outlined :type="isPwd ? 'password' : 'text'" placeholder="كلمة المرور"  style="padding: 15px 0 0 0;">
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
            <q-btn to='/home' style="margin: 10px;" align="center" class="bg-teal-5 text-white full-width" rounded label="تسجيل الدخول" size="lg"/>
            <p style="margin: 10px;">لإنشاء حساب يرجى التواصل بفرع نظم المعلومات</p>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 self-center  leftSide window-height" align="center" >
        <p class="systemName">المنظومة الشاملة للمجمع الطبي</p>
        <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.</p>
      </div>
    </div>
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

<style>
.complexName, .systemName{
  font-size: 30px;
}

.loginForm{
  max-width: 50%;
}

.leftSide{
  padding: 20% 5%;
  background-image: url("../../../assets/1.jpg");
  opacity: 50%;
}
</style>
