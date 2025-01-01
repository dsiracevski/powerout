<script setup>
import Alert from "@/Pages/Alert.vue";
import Location from "@/Components/ListComponents/Location.vue";
import Duration from "@/Components/ListComponents/Duration.vue";
import Address from "@/Components/ListComponents/Address.vue";
import {ref, watch} from "vue";
import FilterGroup from "@/Components/Filters/FilterGroup.vue";
import Cat from "@/Components/Custom/Cat.vue";

let props = defineProps({
  data: {
    type: Object,
    required: true
  },
  currentDate: {
    type: String
  },
  activeMessage: Object
});

let outages = ref(props.data)

watch(() => props.data, (newVal, oldVal) => {
  outages = newVal;
})

let activeMessage = props.activeMessage;
let messageType = ref('');
let message = ref('');

if (activeMessage.length) {
  messageType = activeMessage[0][0];
  message = activeMessage[0][1];
}

const statuses = {
  Active: 'text-rose-400 bg-rose-400/10',
  Finished: 'text-green-400 bg-green-400/10',
  Upcoming: 'text-yellow-400 bg-yellow-400/10'
}

</script>

<template>
  <Alert v-show="activeMessage.length" :type="messageType" :message="message"/>

  <div
      class="md:max-w-4xl lg:max-w-7xl lg:min-w-7xl min-w-[332px] mx-auto px-4 md:px-6 bg-stone-100 dark:bg-gray-300 shadow-lg rounded-2xl shadow-cyan-400 divide-y-2 divide-solid divide-[#C9E6F0] overflow-auto lg:min-w-[896px]">
    <FilterGroup/>
    <div class=" flex flex-col justify-center divide-y divide-slate-200 [&>*]:py-6">
      <div class="w-full max-w-3xl mx-auto">
        <div
            v-if="outages.length"
            v-for="outage in outages"
            :key="outage.id"
            class="-my-6 divide-y "
        >
          <transition name="slide-fade" mode="out-in" appear>
            <ul class="relative pl-8 sm:pl-32 py-6 group space-y-2">
              <Location :data="outage.location.name"/>
              <Duration :start="outage.start" :end="outage.end"/>
              <Address :data="outage.address"/>
            </ul>
          </transition>
        </div>
        <div v-else class="h-80 flex items-center justify-center">
          <transition name="fade" appear>
            <div class="rounded-lg px-14 py-12 md:shadow-xl md:shadow-gray-300">
              <div class="flex flex-col content-center text-center gap-5">
                <p class="dark:text-white">
                  {{ $t('No Results') }} {{selectedDate}}
                </p>
              </div>
            </div>
          </transition>
        </div>
      </div>
    </div>
  </div>
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
  opacity: 0;
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}


.fade-enter-active {
  transition: opacity 0.9s ease;
}

.fade-leave-active {
  transition: opacity 0.9s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>