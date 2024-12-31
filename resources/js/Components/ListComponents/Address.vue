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
  <li class="text-slate-500 md:text-base text-sm dark:text-black">
    {{ data }}
  </li>
</template>