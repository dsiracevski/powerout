<script setup>

</script>

<template>
  <p class="mt-4 self-center text-2xl font-semibold">
    {{ $t('roadmap.title') }}
  </p>
  <ul class="flex md:flex-row flex-col gap-2">
    <li class="">
      <span class="font-semibold text-lg">{{ $t('roadmap.first') }}</span>: {{ $t('roadmap.first.body') }}
    </li>
    <li class="">
      <span class="font-semibold text-lg">{{ $t('roadmap.second') }}</span>: {{ $t('roadmap.second.body') }}
    </li>
    <li class="">
      <span class="font-semibold text-lg">{{ $t('roadmap.third') }}</span>: {{ $t('roadmap.third.body') }}
    </li>
  </ul>
</template>

<style scoped>

</style>