<script setup>
defineProps({
  name: String,
})
</script>

<template>
  <li class="text-[#78B3CE] dark:text-orange-500 mb-1 sm:mb-0 md:text-base text-sm font-bold">
    {{ name }}
  </li>
</template>

<style scoped>

</style>