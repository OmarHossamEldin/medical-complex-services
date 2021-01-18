<template>
  <q-input
    borderless
    dense
    debounce="300"
    :value="value"
    @input="$emit('input', $event)"
    placeholder="بحث"
    outlined
  >
  <template v-slot:append>
    <q-icon name="search" />
  </template>
  </q-input>
</template>

<script>
export default {
  props: ['value']
}
</script>

<style>

</style>
