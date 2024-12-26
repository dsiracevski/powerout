<script setup>
defineProps({
  addresses: String,
})
</script>

<template>
  <li class="text-slate-500 md:text-base text-sm">
    {{ addresses }}
  </li>
</template>

<style scoped>

</style>