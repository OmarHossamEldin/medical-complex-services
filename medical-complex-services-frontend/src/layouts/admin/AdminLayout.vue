<template>
  <div>
    <q-layout class="shadow-2 rounded-borders">
      <q-header elevated class="bg-blue-grey-6" dir="rtl" v-if="isLoggedIn">
        <q-toolbar>
          <q-btn flat @click="drawer = !drawer" round dense icon="menu" />
          <q-toolbar-title>المنظومة الشاملة</q-toolbar-title>
          <div class="q-pa-md">
            <q-btn-dropdown
              push
              outline
              no-caps
              icon="person"
              :label= "user.username"
            >
              <q-list style="font-family: JF Flat; font-size: 13px">
                <q-item clickable v-close-popup>
                  <q-item-section avatar>
                    <q-avatar icon="assignment" color="primary" text-color="white" />
                  </q-item-section>
                  <q-item-section>
                    <q-item-label>الصفحة الشخصية</q-item-label>
                  </q-item-section>
                </q-item>

                <q-item clickable v-close-popup @click="logout()">
                  <q-item-section avatar>
                    <q-avatar icon="logout" color="secondary" text-color="white" />
                  </q-item-section>
                  <q-item-section>
                    <q-item-label>تسجيل الخروج</q-item-label>
                  </q-item-section>
                </q-item>
              </q-list>
            </q-btn-dropdown>
          </div>
        </q-toolbar>
      </q-header>

      <q-drawer
        v-if="isLoggedIn"
        v-model="drawer"
        show-if-above
        :width="300"
        :breakpoint="500"
        bordered
        content-class="bg-blue-grey-2 text-subtitle1 text-weight-bold"
        side="right"
      >
        <q-list>
          <template v-for="(menuItem, index) in menuList">
            <q-item
              :to="menuItem.route"
              :key="index"
              clickable
              :active="menuItem.label === 'Outbox'"
              v-ripple
              active-class="active-item"
            >
            <q-item-section dir="rtl">
                {{ menuItem.label }}
              </q-item-section>
              <q-item-section avatar>
                <q-icon :name="menuItem.icon" />
              </q-item-section>

            </q-item>
            <q-separator :key="'sep' + index" v-if="menuItem.separator" />
          </template>
        </q-list>
      </q-drawer>

      <q-page-container dir="rtl">
        <q-page padding>
          <router-view />
        </q-page>
      </q-page-container>
    </q-layout>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

const menuList = [
  {
    icon: 'text_snippet',
    label: 'التقارير',
    route: 'reports',
    separator: false
  },
  {
    icon: 'print',
    iconColor: 'primary',
    label: 'تنفيذ التقارير ',
    route: 'execute-reports',
    separator: false
  },
  {
    icon: 'list_alt',
    label: 'سجل العمليات',
    route: 'transactions',
    separator: true
  },
  {
    icon: 'dns',
    label: 'الخدمات الرئيسية',
    route: 'main-services',
    separator: false
  },
  {
    icon: 'miscellaneous_services',
    iconColor: 'primary',
    label: 'أنواع الخدمات ',
    route: 'service-types',
    separator: false
  },
  {
    icon: 'medical_services',
    label: 'الخدمات',
    route: 'medical-services',
    separator: true
  },
  {
    icon: 'group',
    label: 'الاشخاص',
    route: 'stakeholders',
    separator: false
  },
  {
    icon: 'military_tech',
    iconColor: 'primary',
    label: 'الرتب ',
    route: 'ranks',
    separator: false
  },
  {
    icon: 'rule',
    iconColor: 'primary',
    label: 'المهام الوظيفية ',
    route: 'roles',
    separator: false
  },
  {
    icon: 'group',
    label: 'المستخدمين',
    route: 'systemworkers',
    separator: true
  },
  {
    icon: 'money',
    label: 'الفئات المحاسبية',
    route: 'financial-categories',
    separator: false
  },
  {
    icon: 'attach_money',
    iconColor: 'primary',
    label: 'أنواع التسعير ',
    route: 'price-types',
    separator: false
  },
  {
    icon: 'payment',
    iconColor: 'primary',
    label: 'طرق الدفع',
    route: 'billing-option',
    separator: true
  },
  {
    icon: 'category',
    iconColor: 'primary',
    label: 'الأقسام',
    route: 'departments',
    separator: false
  },
  {
    icon: 'masks',
    iconColor: 'primary',
    label: 'الأطباء',
    route: 'doctors',
    separator: false
  },
  {
    icon: 'gavel',
    iconColor: 'primary',
    label: 'الدرجات ',
    route: 'degrees',
    separator: true
  },
  {
    icon: 'computer',
    iconColor: 'primary',
    label: 'الأجهزة',
    route: 'pcs',
    separator: false
  },
  {
    icon: 'timer_off',
    iconColor: 'primary',
    label: 'فترات العمل الغير متاحة ',
    route: 'closed-interval',
    separator: true
  }
]

export default {
  data () {
    return {
      drawer: false,
      menuList
    }
  },
  computed: {
    ...mapGetters({
      isLoggedIn: 'isLoggedIn',
      authStatus: 'authStatus',
      user: 'user'
    })
  },
  methods: {
    ...mapActions({
      logoutAction: 'logout'
    }),
    logout: function () {
      this.logoutAction()
        .then(() => this.$router.push('/admin/login'))
        .catch(err => console.log(err))
    }
  }
}
</script>

<style>

@font-face {
  font-family: 'JF Flat';
  src: url(../../css/fonts/JF-Flat-Regular.ttf);
}

#q-app{
    font-family: 'JF Flat';
}
.active-item{
  color: #607d8b;
}

.q-table{
  max-width: 99%;
}
</style>
