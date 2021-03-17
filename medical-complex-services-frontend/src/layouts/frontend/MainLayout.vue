<template>
  <div>
    <q-layout >
    <q-header elevated dir="rtl" class="bg-teal-5">
      <q-toolbar >
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="leftDrawerOpen = !leftDrawerOpen"
        />

        <q-toolbar-title>
          المنظومة الشاملة
        </q-toolbar-title>

        <div class="navLinks">
          <a href="/home">الرئيسية</a>
          <a>رصيد المحفظة <span>1560.5</span></a>
          <q-avatar size="30px">
            <a href="/edit-profile">
              <img src="../../assets/1.jpg">
            </a>
          </q-avatar>
        </div>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      :width="300"
      :breakpoint="500"
      side="right"
      show-if-above
      bordered
      content-class="bg-grey-1"
    >
      <div class="q-pa-md q-gutter-sm" dir="rtl">
        <q-tree
          :nodes="simple"
          node-key="label"
          no-connectors
          :expanded.sync="expanded"
        />
      </div>
    </q-drawer >

    <q-page-container dir="rtl">
      <q-page>
        <router-view />
      </q-page>
    </q-page-container>
  </q-layout >
  </div>
</template>

<script>

export default {
  name: 'MainLayout',
  components: { },
  data () {
    return {
      leftDrawerOpen: false,
      expanded: ['الخدمات المتاحة', 'اسم الخدمة الأولى', 'اسم الخدمة الثانية', 'اسم الخدمة الثالثة', '', ''],
      simple: [
        {
          label: 'الخدمات المتاحة',
          avatar: '',
          children: [
            {
              label: 'اسم الخدمة الأولى',
              icon: 'restaurant_menu',
              children: [
                { label: 'الخدمة الفرعية الأولى' },
                { label: 'الخدمة الفرعية الثانية' }
              ]
            },
            {
              label: 'اسم الخدمة الثانية',
              icon: 'room_service',
              children: [
                { label: 'الخدمة الفرعية الأولى' },
                { label: 'الخدمة الفرعية الثانية' }
              ]
            },
            {
              label: 'اسم الخدمة الثالثة',
              icon: 'photo',
              children: [
                {
                  label: 'الخدمة الفرعية الأولى',
                  img: ''
                },
                { label: 'الخدمة الفرعية الثانية' },
                { label: 'الخدمة الفرعية الثالثة' }
              ]
            }
          ]
        }
      ]
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

.navLinks a, q-btn-dropdown{
  text-decoration: none;
  color: #fff;
  margin-right: 10px;
}

.navLinks span{
  color: #000;
}
</style>
