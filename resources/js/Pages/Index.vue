<script setup>

import {router, usePage} from "@inertiajs/vue3";
import {reactive, ref, watch, provide, readonly, toRef, onMounted} from "vue";
import Pagination from "@/Pages/Pagination.vue";
import debounce from 'lodash/debounce'
import Timeline from "@/Components/Custom/Timeline.vue";
import {useEventStore} from "@/stores/eventStore.js";
import {storeToRefs} from "pinia";
import Menu from "@/Components/Custom/Menu.vue";
import Layout from "@/Components/Custom/Layout.vue";
import {getActiveLanguage} from "laravel-vue-i18n";
import {useLanguageStore} from "@/stores/languageStore.js";
import {event} from "vue-gtag";

// onMounted(() => {
//   event('outages', {method: 'Google'})
// })
const props = defineProps({
  outages: {
    type: Object
  },
  filters: {
    type: Object
  },
  flash: {
    type: Object
  }
});
let outages = ref(props.outages);
let links = ref(outages.value.meta.links);

watch(() => props.outages, (newVal, oldVal) => {
  if (newVal) {
    outages = newVal;
    links.value = newVal.meta.links;
  }
})


const filter = reactive({
  name: props.filters.filter.name,
  date: props.filters.filter.date
})
provide('filter', readonly(filter))

const eventStore = useEventStore();
const {dateChanged} = storeToRefs(eventStore);

const {searchChanged} = storeToRefs(eventStore);

watch(dateChanged, function (value) {
  if (value === 'reset') {
    delete filter['date'];
    delete filter['name'];
  } else {
    filter.date = value
  }
});

watch(searchChanged, function (value) {
  filter.name = value
});

const languageStore = useLanguageStore();
const {languageChanged} = storeToRefs(languageStore)

watch([filter, languageChanged], debounce(function (value) {
  router.get('/', {
        filter: {
          name: filter.name,
          date: filter.date,
        },
        locale: getActiveLanguage()
      },
      {
        preserveState: true,
        preserveScroll: true,
        replace: true,
        onSuccess: () => {
          window.history.replaceState({}, '', '/');
        }
      }
  )
}, 300));

let activeMessage = ref('');
let messageType = ref('');
let message = ref('');

activeMessage = Object.entries(props.flash).filter(([key, value]) => value);

if (activeMessage.length) {
  messageType = activeMessage[0][0];
  message = activeMessage[0][1];
}

const statuses = {
  Active: 'text-rose-400 bg-rose-400/10',
  Finished: 'text-green-400 bg-green-400/10',
  Upcoming: 'text-yellow-400 bg-yellow-400/10'
}

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
    <Timeline
        :data="outages.data"
        :active-message="activeMessage"
        :current-date="filter.date"/>
    <div class="bg-transparent w-full mt-2 mb-2 flex place-content-evenly">
      <Pagination :links="links" />
      <button
          @click="goToTop"
          class="animate-bounce md:hidden">
        <svg
            height="34px" width="34px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
          <g id="SVGRepo_iconCarrier"> <path style="fill:#ffffff;"
                                             d="M0,256.006C0,397.402,114.606,512.004,255.996,512C397.394,512.004,512,397.402,512,256.006 C512.009,114.61,397.394,0,255.996,0C114.606,0,0,114.614,0,256.006z"></path>
            <path style="fill:#e4e4e4;"
                  d="M476.807,385.506c2.572-4.619-214.177-214.177-214.179-214.178l-1.63-1.63 c-2.762-2.762-7.235-2.762-9.998,0L88.394,332.305c-2.762,2.762-2.762,7.235,0,9.998c0.289,0.289,0.657,0.422,0.98,0.651 c0.229,0.323,167.783,167.879,168.107,168.108c0.206,0.291,0.352,0.612,0.589,0.886 C351.328,511.207,432.658,460.623,476.807,385.506z"></path>
            <path style="fill:#E8573F;"
                  d="M423.607,332.305L260.998,169.697c-2.762-2.762-7.235-2.762-9.997,0L88.393,332.305 c-2.762,2.762-2.762,7.235,0,9.997c2.762,2.762,7.235,2.762,9.997,0L256,184.693l157.61,157.61c1.381,1.381,3.189,2.071,4.998,2.071 s3.618-0.69,4.998-2.071C426.369,339.541,426.369,335.068,423.607,332.305z"></path> </g></svg>
      </button>
    </div>
  </Layout>
</template>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from, .fade-leave-to {
  opacity: 0;
}

.fade-enter-to, .fade-leave-from {
  opacity: 1;
}

.box {
  padding: 20px;
  background-color: lightblue;
  text-align: center;
  border: 1px solid #ccc;
  margin-top: 20px;
}

</style>