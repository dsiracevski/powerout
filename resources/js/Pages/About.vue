<script setup>

import Menu from "@/Components/Custom/Menu.vue";
import {Link} from "@inertiajs/vue3";
import Layout from "@/Components/Custom/Layout.vue";
import Contact from "@/Components/Custom/Contact.vue";
import Roadmap from "@/Components/Custom/Roadmap.vue";
import Welcome from "@/Components/Custom/Welcome.vue";
import {event} from "vue-gtag";
import {onMounted} from "vue";

onMounted(() => {
  event('about', {method: 'Google'})
})
function goToTop() {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  });
}
</script>

<template>
  <Layout>
    <Menu/>
    <transition name="slide-fade" mode="out-in" appear>
      <div
          class=" md:max-w-3xl lg:min-w-7xl min-w-[332px] min-h-full mx-auto px-4 md:px-6 bg-white md:shadow-lg rounded-2xl md:shadow-cyan-500/50 divide-y-2 divide-solid divide-cyan-500/50 overflow-auto lg:min-w-[896px]">
        <div class="flex flex-col justify-center items-start gap-2 m-6">
          <p class="self-center mb-4 text-2xl">{{ $t('site.name') }}</p>
          <p>
            {{ $t('intro.first') }} <span
              class="text-lg font-semibold">{{ $t('intro.try') }}</span> {{ $t('intro.last') }}.
          </p>
          <Welcome />
          <Roadmap />
          <p class="mt-6">
            {{ $t('welcome.explore') }}
          </p>
          <Contact />
        </div>
      </div>
    </transition>
  </Layout>
</template>

<style scoped>
.slide-fade-enter-active {
  transition: all 0.8s ease-in;
}

.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(20px);
  opacity: 25%;
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}
</style>