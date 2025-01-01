<script setup>
import {useEventStore} from "@/stores/eventStore.js";
import {ref} from "vue";

let eventStore = useEventStore();

let props = defineProps({
  title: String,
  date: String
})

let date = ref(props.date);
</script>

<template>
  <button
      @click="eventStore.updateDate(date)"
      class="min-w-[60px] md:capitalize lowercase md:text-sm text-xs py-2 rounded-xl border border-cyan-300 bg-cyan-300 text-gray-700 shadow-md shadow-gray-400">
    {{ title }}
  </button>
</template>

<style scoped>

</style>