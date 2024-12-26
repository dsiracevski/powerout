<script setup>

import {Link} from "@inertiajs/vue3";
import UpdateButton from "@/Components/Filters/UpdateButton.vue";
</script>

<template>
  <div class="bg-transparent flex place-content-center gap-0 relative">
    <Link
        href="/"
        class="relative top-0 left-3 border-t-2 border-l-2 border-white border-b-2 py-2 px-6 bg-[#C9E6F0] my-auto rounded-2xl rounded-r-none">
      Home
    </Link>
    <div class="relative z-10 border-2 text-white rounded-full">
      <UpdateButton/>
    </div>
    <Link
        href='/about'
        class="relative top-0 -left-3 border-t-2 border-r-2 border-white border-b-2 py-2 px-6 bg-[#C9E6F0] my-auto rounded-2xl rounded-l-none">
      About
    </Link>
  </div>
</template>

<style scoped>

</style>