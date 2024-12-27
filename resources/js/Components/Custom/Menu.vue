<script setup>

import {Link} from "@inertiajs/vue3";
import UpdateButton from "@/Components/Filters/UpdateButton.vue";
import {loadLanguageAsync} from 'laravel-vue-i18n';
import {ref, watch} from "vue";

let darkMode = ref(false);

watch(darkMode, () => {
  if (darkMode.value) {
    document.querySelector('html').classList.add('dark');
  } else {
    document.querySelector('html').classList.remove('dark');
  }
})

function changeMode() {
  document.querySelector('html').classList.add('dark');
  console.log("changeMode");
}
</script>

<template>
  <div class="bg-transparent grid grid-cols-3 place-items-center gap-5 relative md:max-w-4xl lg:max-w-7xl lg:min-w-7xl min-w-[332px] mx-auto">
    <div class="flex left-8">
      <button aria-label="mk" @click="loadLanguageAsync('mk')" class="rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="32" viewBox="-8 -5 37 35">
          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
          <g id="SVGRepo_iconCarrier">
            <g clip-path="url(#clip0_503_4180)">
              <rect width="28" height="20" rx="2" fill="white"></rect>
              <mask id="mask0_503_4180" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="28"
                    height="20">
                <rect width="28" height="20" rx="2" fill="white"></rect>
              </mask>
              <g mask="url(#mask0_503_4180)">
                <rect width="28" height="20" fill="#E81B26"></rect>
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M13.9998 13.3334C15.8408 13.3334 17.3332 11.841 17.3332 10C17.3332 8.15907 15.8408 6.66669 13.9998 6.66669C12.1589 6.66669 10.6665 8.15907 10.6665 10C10.6665 11.841 12.1589 13.3334 13.9998 13.3334Z"
                      fill="#FFE94F"></path>
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M10.2082 7.27932C10.4095 6.99925 10.641 6.74239 10.8981 6.51353L1.96168 -3.53064L-0.714844 -0.558062L10.2082 7.27932ZM10.8981 13.4864C10.6411 13.2576 10.4095 13.0007 10.2082 12.7207L-0.714844 20.5581L1.96168 23.5306L10.8981 13.4864ZM13.0846 14.5769L12 20H16L14.9154 14.5769C14.6195 14.6358 14.3134 14.6666 14.0002 14.6666C13.6868 14.6666 13.3807 14.6358 13.0846 14.5769ZM17.792 12.7208C17.5907 13.0009 17.3591 13.2577 17.1021 13.4866L26.0384 23.5306L28.7149 20.5581L17.792 12.7208ZM9.37981 10.66C9.34929 10.4444 9.3335 10.224 9.3335 9.99998C9.3335 9.77594 9.34928 9.55558 9.37981 9.33997L2.43187e-05 8V12L9.37981 10.66ZM13.0846 5.42308L12 9.53674e-07H16L14.9154 5.42303C14.6195 5.36418 14.3134 5.33331 14.0002 5.33331C13.6868 5.33331 13.3807 5.3642 13.0846 5.42308ZM18.6205 9.33993C18.651 9.55556 18.6668 9.77592 18.6668 9.99998C18.6668 10.224 18.651 10.4444 18.6205 10.6601L28 12V8L18.6205 9.33993ZM17.792 7.27919C17.5907 6.99911 17.3591 6.74226 17.1021 6.5134L26.0384 -3.53064L28.7149 -0.558062L17.792 7.27919Z"
                      fill="#FFE94F"></path>
              </g>
            </g>
            <defs>
              <clipPath id="clip0_503_4180">
                <rect width="28" height="20" rx="2" fill="white"></rect>
              </clipPath>
            </defs>
          </g>
        </svg>
      </button>
      <button aria-label="en" @click="loadLanguageAsync('en')">
        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="32" viewBox="-8 -5 37 35">
          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
          <g id="SVGRepo_iconCarrier">
            <g clip-path="url(#clip0_503_2952)">
              <rect width="28" height="20" rx="2" fill="white"></rect>
              <mask id="mask0_503_2952" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="28"
                    height="20">
                <rect width="28" height="20" rx="2" fill="white"></rect>
              </mask>
              <g mask="url(#mask0_503_2952)">
                <rect width="28" height="20" fill="#0A17A7"></rect>
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M-1.28244 -1.91644L10.6667 6.14335V-1.33333H17.3334V6.14335L29.2825 -1.91644L30.7737 0.294324L21.3263 6.66667H28V13.3333H21.3263L30.7737 19.7057L29.2825 21.9165L17.3334 13.8567V21.3333H10.6667V13.8567L-1.28244 21.9165L-2.77362 19.7057L6.67377 13.3333H2.95639e-05V6.66667H6.67377L-2.77362 0.294324L-1.28244 -1.91644Z"
                      fill="white"></path>
                <path d="M18.668 6.33219L31.3333 -2" stroke="#DB1F35" stroke-width="0.666667"
                      stroke-linecap="round"></path>
                <path d="M20.0128 13.6975L31.3666 21.3503" stroke="#DB1F35" stroke-width="0.666667"
                      stroke-linecap="round"></path>
                <path d="M8.00555 6.31046L-3.83746 -1.67099" stroke="#DB1F35" stroke-width="0.666667"
                      stroke-linecap="round"></path>
                <path d="M9.29006 13.6049L-3.83746 22.3105" stroke="#DB1F35" stroke-width="0.666667"
                      stroke-linecap="round"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 12H12V20H16V12H28V8H16V0H12V8H0V12Z"
                      fill="#E6273E"></path>
              </g>
            </g>
            <defs>
              <clipPath id="clip0_503_2952">
                <rect width="28" height="20" rx="2" fill="white"></rect>
              </clipPath>
            </defs>
          </g>
        </svg>
      </button>
    </div>
    <div class="bg-transparent flex place-content-center gap-0 relative self-center left-1">
      <Link
          href="/"
          class="relative top-0 left-3 border-t-2 border-l-2 border-white border-b-2 py-2 px-6 bg-[#C9E6F0] my-auto rounded-2xl rounded-r-none capitalize">
        {{ $t('menu.home') }}
      </Link>
      <div class="relative z-10 border-2 text-white rounded-full">
        <UpdateButton/>
      </div>
      <Link
          href='/about'
          class="relative top-0 -left-3 border-t-2 border-r-2 border-white border-b-2 py-2 px-6 bg-[#C9E6F0] my-auto rounded-2xl rounded-l-none capitalize">
        {{ $t('menu.about') }}
      </Link>
    </div>
    <button @click="darkMode = !darkMode" class="h-12 w-12 rounded-lg p-2 hover:bg-gray-100 dark:hover:bg-gray-700">
      <svg class="fill-violet-700 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
      </svg>
      <svg class="fill-yellow-500 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
        <path
            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
            fill-rule="evenodd" clip-rule="evenodd"></path>
      </svg>
    </button>
  </div>
</template>

<style scoped>

</style>