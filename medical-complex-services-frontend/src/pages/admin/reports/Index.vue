<template>
  <div>
    <table-title title="التقارير"/>
    <p>{{value}}</p>
  </div>
</template>

<script>
import TableTitle from 'src/components/TableTitle.vue'

export default {
  components: { TableTitle },
  data () {
    return {
      value: ''
    }
  }
}
</script>

<style>

</style>
