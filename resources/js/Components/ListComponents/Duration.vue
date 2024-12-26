<script setup>
import dayjs from "dayjs";

defineProps({
  start: String,
  end: String,
})

function formatToDate(dateTimeString) {
  return dayjs(dateTimeString).format('DD-MM-YYYY')
}

function formatToHour(dateTimeString) {
  return dayjs(dateTimeString).format('HH-mm')
}
</script>

<template>
  <li
      class="flex flex-col sm:flex-row items-start mb-1 group-last:before:hidden
                  before:absolute before:left-2 sm:before:left-0 before:h-screen before:w-2px before:bg-blue-400 sm:before:ml-[6.5rem] before:self-start before:-translate-x-1/2 before:translate-y-3
                  after:absolute after:left-2 sm:after:left-0 after:w-2 after:h-2 after:bg-indigo-600 after:border-4 after:box-content after:border-slate-50 after:rounded-full sm:after:ml-[6.5rem] after:-translate-x-1/2 after:translate-y-1.5">
    <div
        class="sm:absolute left-0 translate-y-0.5 inline-flex items-center justify-center text-xs font-semibold uppercase w-20 h-6 mb-3 sm:mb-0 text-emerald-600 bg-emerald-100 rounded-full">
      {{ formatToDate(start) }}
    </div>
    <div class="md:text-lg text-md font-bold text-slate-900">
      {{ formatToHour(start) }} - {{ formatToHour(end) }}
    </div>
  </li>
</template>

<style scoped>

</style>