<script setup>

import {Link} from "@inertiajs/vue3";
</script>

<template>
  <p>{{ $t('welcome.first') }}
    <Link
        href="/"
        class="border-t-2 underline border-l-2 border-white border-b-2 bg-transparent my-auto rounded-2xl rounded-r-none hover:text-xl hover:text-cyan-600 transition-all duration-300 after:content-['_↗'] text-balance ">
      <span class="lowercase">{{ $t('site.name') }}</span>
    </Link>
    {{ $t('welcome.last') }}
  </p>
</template>

<style scoped>

</style>