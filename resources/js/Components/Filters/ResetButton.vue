<script setup>
import {useEventStore} from "@/stores/eventStore.js";
let eventStore = useEventStore();
</script>

<template>
  <button
      @click="eventStore.reset()"
      class="md:capitalize text-white bg-orange-400 lowercase md:text-sm text-xs py-2 rounded-xl border border-orange-500 shadow-md shadow-gray-400">
    {{ $t('filter.reset') }}
  </button>
</template>