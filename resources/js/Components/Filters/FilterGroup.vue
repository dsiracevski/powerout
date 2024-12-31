<script setup>

import dayjs from "dayjs";
import ResetButton from "@/Components/Filters/ResetButton.vue";
import DateFilterButton from "@/Components/Filters/DateFilterButton.vue";
import DateInput from "@/Components/Filters/DateInput.vue";
import SearchInput from "@/Components/Filters/SearchInput.vue";
import {inject, ref, watch} from "vue";

const filter = inject('filter');

let toggle = ref(false);
let toggleReset = ref(false);

watch(filter, (value) => {
  if (value.date || value.name) {
    toggleReset.value = true;
  }
})

function toggleFilters() {
  toggle.value = !toggle.value;
}

const gridSize = {
  true: 'grid-cols-4 md:grid-cols-4',
  false: 'grid-cols-3 md:grid-cols-3'
}
</script>

<template>
  <div class="flex flex-col my-2">
    <button @click="toggleFilters" class="border-l-orange-500 border-l-orange-500 border-l-orange-500 mx-auto px-3 py-2 rounded-xl capitalize text-white md:text-md text-sm bg-orange-500">
      {{ $t('filter.filters') }}
    </button>
    <transition name="fade">
      <div v-show="toggle" class="place-content-between mt-5 grid md:grid-cols-2 grid-cols-1 gap-2 mx-auto mb-4">
        <div
            :class="[gridSize[toggleReset], 'grid md:col-span-1 col-span-2 gap-2 md:order-first order-last']">
          <DateFilterButton class="" :title="$t('filter.yesterday')"
                            :date="dayjs().subtract(1, 'day').format('YYYY-MM-DD')"/>
          <DateFilterButton class="" :title="$t('filter.today')" :date="dayjs().format('YYYY-MM-DD')"/>
          <DateFilterButton class="" :title="$t('filter.tomorrow')"
                            :date="dayjs().add(1, 'day').format('YYYY-MM-DD')"/>
          <transition name="slide-fade" mode="out-in">
            <ResetButton v-if="toggleReset" @click="toggleReset = false"/>
          </transition>
        </div>
        <div class="grid md:grid-cols-2 grid-cols-2 gap-2 max-w-full place-content-between">
          <DateInput/>
          <SearchInput class="md:w-full"/>
        </div>
      </div>
    </transition>
  </div>
</template>

<style scoped>
.fade-enter-active {
  transition: opacity 0.8s ease-in;
}

.fade-leave-active {
  transition: opacity 0.8s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.slide-fade-enter-active {
  transition: all 2s ease-in;
}

.slide-fade-leave-active,
.slide-fade-enter-from,
.slide-fade-leave-to {
  opacity: 0;
}
</style>