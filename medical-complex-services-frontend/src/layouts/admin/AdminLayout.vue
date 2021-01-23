<template>
  <div>
    <q-layout class="shadow-2 rounded-borders">
      <q-header elevated class="bg-blue-grey-6" dir="rtl">
        <q-toolbar>
          <q-btn flat @click="drawer = !drawer" round dense icon="menu" />
          <q-toolbar-title>المنظومة الشاملة</q-toolbar-title>
        </q-toolbar>
      </q-header>

      <q-drawer
        v-model="drawer"
        show-if-above
        :width="250"
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
const menuList = [
  {
    icon: 'text_snippet',
    label: 'التقارير',
    route: 'reports',
    separator: true
  },
  {
    icon: 'list_alt',
    label: 'سجل العمليات',
    route: 'transactions',
    separator: false
  },
  {
    icon: 'medical_services',
    label: 'الخدمات',
    route: 'medical-services',
    separator: false
  },
  {
    icon: 'group',
    label: 'الاشخاص',
    route: 'stakeholders',
    separator: true
  },
  {
    icon: 'group',
    label: 'المستخدمين',
    route: 'systemworkers',
    separator: true
  },
  {
    icon: 'dns',
    label: 'الخدمات الرئيسية',
    route: 'main-services',
    separator: false
  },
  {
    icon: 'money',
    label: 'الفئات المحاسبية',
    route: 'financial-categories',
    separator: false
  },
  {
    icon: 'category',
    iconColor: 'primary',
    label: 'الأقسام',
    route: 'departments',
    separator: false
  },
  {
    icon: 'health_and_safety',
    iconColor: 'primary',
    label: 'الأطباء',
    route: 'doctors',
    separator: false
  },
  {
    icon: 'computer',
    iconColor: 'primary',
    label: 'الأجهزة',
    route: 'pcs',
    separator: false
  },
  {
    icon: 'payment',
    iconColor: 'primary',
    label: 'طرق الدفع',
    route: 'billing-option',
    separator: false
  },
  {
    icon: '',
    iconColor: 'primary',
    label: 'فترات العمل الغير متاحة ',
    route: 'closed-interval',
    separator: false
  },
  {
    icon: '',
    iconColor: 'primary',
    label: 'الرتب ',
    route: 'ranks',
    separator: false
  },
  {
    icon: '',
    iconColor: 'primary',
    label: 'أنواع التسعير ',
    route: 'price-types',
    separator: false
  },
  {
    icon: '',
    iconColor: 'primary',
    label: 'أنواع الخدمات ',
    route: 'service-types',
    separator: false
  },
  {
    icon: 'rule',
    iconColor: 'primary',
    label: 'المهمام الوظيفية ',
    route: 'roles',
    separator: false
  },
  {
    icon: '',
    iconColor: 'primary',
    label: 'الدرجات ',
    route: 'degrees',
    separator: false
  }
]

export default {
  data () {
    return {
      drawer: false,
      menuList
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
