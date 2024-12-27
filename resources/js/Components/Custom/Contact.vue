<script setup>

import Socials from "@/Components/Custom/Socials.vue";
</script>

<template>
  <div class="md:mt-24 mt-6 md:self-end space-y-1">
    <p>{{ $t('contact.intro') }}</p>
    <div class="flex flex-row gap-3">
      <p>{{ $t('contact.outro') }}</p>
      <div class="flex flex-row gap-2">
        <Socials />
      </div>
    </div>
  </div>
</template>