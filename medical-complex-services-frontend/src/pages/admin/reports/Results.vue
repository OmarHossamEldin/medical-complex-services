<template>
<div>
  <div id="printSection">
    <div class="row">
      <div class="col-6 text-bold">
        <p>ادارة الخــــدمــــــــات الطبيــــــة</p>
        <p>المجمع الطبي ق.م بك القبة</p>
        <p>فرع نظـــــم المعلومــــــــــــات</p>
      </div>
      <div class="col-6" style="text-align: left">
        <img src="../../../assets/kobba.png" width="100" height="100"/>
      </div>
    </div>
    <div class="row">
      <div class="col-12 text-bold">
          <p class="text-bold text-center" style="text-decoration: underline;">{{reportObj.description}}</p>
      </div>
    </div>
    <div class="q-pa-md">
      <q-option-group
        v-model="separator"
        inline
        class="q-mb-md"
        :options="[]"
      />
      <div class="q-pa-md q-gutter-sm">
        <q-btn @click="printEntirePage()" :style="{visibility:visibility}" color="secondary" label="طباعة" />
      </div>
      <table>
        <tr>
          <th v-for="(value, key) in data[0]" :key="key">{{key}}</th>
        </tr>
        <tr v-for="(row, index) in data" :key="index">
          <td v-for="(value, key) in row" :key="key">{{value}}</td>
        </tr>
      </table>
    </div>
  </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  data () {
    return {
      visibility: 'visible',
      separator: 'vertical'
    }
  },

  computed: {
    ...mapGetters({
      data: 'reportResults'
    })
  },

  methods: {
    printEntirePage () {
      this.visibility = 'hidden'
      setTimeout(function () {
        window.print()
      }, 150)
    }
  },

  props: ['reportObj']
}
</script>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid rgba(0, 0, 0, 0.644);
  text-align: left;
  padding: 8px;
}
</style>
