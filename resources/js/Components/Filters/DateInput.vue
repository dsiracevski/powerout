<script setup>
import {useEventStore} from "@/stores/eventStore.js";
import {ref, watch} from "vue";
import {storeToRefs} from "pinia";
import dayjs from "dayjs";

let eventStore = useEventStore();
const {dateChanged} = storeToRefs(eventStore);
function updateDate(event) {
  let newDate = event.target.value;
  eventStore.updateDate(newDate);
}
let date = ref('')

watch(dateChanged, function (value) {
    date.value = value
});

</script>

<template>
  <input
      name="date"
      v-model="date"
      @change="updateDate"
      type="date"
      class="lg:max-w-[206px] max-h-[42px] py-2 rounded-xl border border-gray-300 text-gray-700 shadow-md shadow-gray-400"/>
</template>

<style scoped>

</style>