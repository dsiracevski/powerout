<script setup>
import {useEventStore} from "@/stores/eventStore.js";
import {ref, watch} from "vue";
import {storeToRefs} from "pinia";

let eventStore = useEventStore();
const {searchChanged} = storeToRefs(eventStore);

function updateSearch(event) {
  let newValue = event.target.value;
  eventStore.updateSearch(newValue);
}
let text = ref('');

watch(text, (newValue) => {
  eventStore.updateSearch(newValue);
})

watch(searchChanged, function (value) {
  text.value = value
});
</script>

<template>
  <input
      name="search"
      v-model="text"
      type="text"
      placeholder="Search..."
      class="lg:max-w-[206px] max-h-[42px] md:px-6 py-2 rounded-xl border border-gray-300 text-gray-700 shadow-md shadow-gray-400">
</template>

<style scoped>

</style>