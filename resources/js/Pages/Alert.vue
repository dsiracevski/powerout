<script setup>

import {ref} from "vue";

let props = defineProps({
  type: String,
  message: String
});

let type = ref(props.type);

function dismissModal() {
  const modal = document.getElementById('modal');
  if (modal) {
    modal.remove(); // Removes the modal and the background overlay together
  }
}

const statuses = {warning: 'bg-red-400', info: 'bg-blue-400', success: 'bg-green-400'}
</script>

<template>
  <transition name="slide-fade" mode="out-in" appear>
    <div id="modal" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-300 bg-opacity-75">
      <div
          :class="[statuses[type], 'py-2 px-4 rounded-md text-white items-center place-content-center text-center mx-auto right-4 flex gap-4']">
        <p>{{ props.message }}</p>
        <span class="cursor-pointer font-bold text-center" onclick="return this.parentNode.remove()"><sup
            @click="dismissModal">X</sup></span>
      </div>
    </div>
  </transition>
</template>

<style scoped>
.slide-fade-enter-active {
  transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(20px);
  opacity: 0;
}
</style>