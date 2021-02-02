<template>
  <div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 self-center" align="center">
          <p>مرحبا بكم في</p>
          <p class="complexName">المجمع الطبي ق.م بكوبري القبة</p>
          <p>المنظومة الشاملة</p>
        <div class="loginForm">
            <q-input v-model="username" item-aligned rounded outlined placeholder="اسم المستخدم" style="padding: 0;">
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
            <q-btn @click="login()" style="margin: 10px;" align="center" class="bg-teal-5 text-white full-width" rounded label="تسجيل الدخول" size="lg"/>
            <p style="margin: 10px;">لإنشاء حساب يرجى التواصل بفرع نظم المعلومات</p>
        </div>
      </div>
      <q-img src="../../../assets/3.jpg" class="col-lg-6 col-md-6 col-sm-12 col-xs-12 self-center window-height">
        <div class="absolute-bottom bg-teal-5 window-height text-subtit text-center leftSide" >
          <div>
            <p class="systemName">المنظومة الشاملة للمجمع الطبي</p>
            <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.</p>
          </div>
        </div>
      </q-img>
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
import { mapActions, mapGetters, mapMutations } from 'vuex'

export default {
  name: 'Login',
  data () {
    return {
      username: '',
      password: '',
      isPwd: true
    }
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

    ...mapActions({
      loginAction: 'login'
    }),
    login: function () {
      this.loginAction([this.username, this.password])
        .then(() => this.$router.push('/admin/reports'))
        .catch(err => console.log(err))
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
  padding: 40% 5% !important;
  opacity: 0.8;
}
</style>
