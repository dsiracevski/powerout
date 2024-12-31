<script setup>
import {ref, watch} from "vue";

let props = defineProps({
  data: String,
})
let data = ref(props.data);

watch(() => props.data, (newVal, oldVal) => {
  data = newVal;
})
</script>

<template>
  <li class="text-[#78B3CE] dark:text-orange-500 mb-1 sm:mb-0 md:text-base text-sm font-bold">
    {{ data }}
  </li>
</template>