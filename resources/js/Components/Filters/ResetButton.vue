<script setup>
import {useEventStore} from "@/stores/eventStore.js";
let eventStore = useEventStore();

</script>

<template>
  <button
      @click="eventStore.reset()"
      class="md:capitalize bg-orange-500 lowercase md:text-sm text-xs py-2 rounded-xl border border-orange-500 text-gray-700 shadow-md shadow-gray-400">Reset</button>
</template>

<style scoped>

</style>