<template>
  <div>
    <q-layout class="shadow-2 rounded-borders">
      <q-header elevated class="bg-black" dir="rtl">
        <q-toolbar>
          <q-btn flat @click="drawer = !drawer" round dense icon="menu" />
          <q-toolbar-title>المنظومة الشاملة</q-toolbar-title>
        </q-toolbar>
      </q-header>

      <q-drawer
        v-model="drawer"
        show-if-above
        :width="200"
        :breakpoint="500"
        bordered
        content-class="bg-grey-3"
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
            >
              <q-item-section avatar>
                <q-icon :name="menuItem.icon" />
              </q-item-section>
              <q-item-section>
                {{ menuItem.label }}
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
    icon: "report",
    label: "التقارير",
    route: "reports",
    separator: true,
  },
  {
    icon: "transactions",
    label: "سجل العمليات",
    route: "transactions",
    separator: false,
  },
  {
    icon: "services",
    label: "الخدمات",
    route: "medical-services",
    separator: false,
  },
  {
    icon: "person",
    label: "المستخدمين",
    route: "systemworkers",
    separator: true,
  },
  {
    icon: "main",
    label: "الخدمات الرئيسية",
    route: "main-services",
    separator: false,
  },
  {
    icon: "category",
    label: "الفئات المحاسبية",
    route: "financial-categories",
    separator: false,
  },
  {
    icon: "category",
    iconColor: "primary",
    label: "الأقسام",
    route: "departments",
    separator: false,
  },
  {
    icon: "person",
    iconColor: "primary",
    label: "الأطباء",
    route: "doctors",
    separator: false,
  },
  {
    icon: "computer",
    iconColor: "primary",
    label: "الأجهزة",
    route: "pcs",
    separator: false,
  },
];

export default {
  data() {
    return {
      drawer: false,
      menuList,
    };
  },
};
</script>

<style>
</style>
