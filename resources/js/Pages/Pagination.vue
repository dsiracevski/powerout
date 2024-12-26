<script setup>

import {Link} from "@inertiajs/vue3";
import {inject, ref} from "vue";

defineProps({
  links: {
    type: Object
  }
});

function capitalizeWord(input) {
  return input
      .split(' ')
      .map(word => {
        word === 'prev' ? word = 'previous' : word;
        return word.charAt(0).toUpperCase() + word.slice(1);
      })
      .join(' ');
}
</script>

<template>
  <div class="space-x-2 flex justify-center">
    <Link preserve-scroll
        :is="link ? Link : 'span'"
        v-for="(link, name) in links"
        v-html="capitalizeWord(name)"
        :href="link ? link : ''"
        class="bg-gray-700 text-white px-3 py-1 rounded-lg"/>
  </div>
</template>
