<script setup>

import {Link} from "@inertiajs/vue3";

let props = defineProps({
  links: {
    type: Object
  }
});

</script>

<template>
  <div class="space-x-2 flex justify-center">
    <Link preserve-scroll
          v-if="props.links.length > 3"
          v-for="link in props.links"
          v-html="link.label"
          :href="link.url ? link.url.replace('http://', 'https://') : 'null'"
          :class="{'opacity-25 cursor-not-allowed pointer-events-none': link.active || link.url === null}"
          class="border border-white bg-gray-700 text-white dark:bg-gray-200 dark:text-orange-500 px-3 py-1 rounded-lg capitalize">
    </Link>
  </div>
</template>
