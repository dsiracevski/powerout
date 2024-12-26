<script setup>

import {router, usePage} from "@inertiajs/vue3";
import {reactive, computed, ref, watch} from "vue";
import Pagination from "@/Pages/Pagination.vue";
import Alert from "@/Pages/Alert.vue";
import debounce from 'lodash/debounce'
import Table from "@/Components/Custom/Table.vue";
import Default from "@/Components/Custom/Default.vue";
import Timeline from "@/Components/Custom/Timeline.vue";
import Swal from "sweetalert2";
import dayjs from "dayjs";
import FilterButton from "@/Components/Filters/DateFilterButton.vue";
import UpdateButton from "@/Components/Filters/UpdateButton.vue";
import {useEventStore} from "@/stores/eventStore.js";
import {storeToRefs} from "pinia";


let props = defineProps({
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

const eventStore = useEventStore();
const {dataChanged} = storeToRefs(eventStore);

watch(dataChanged, function (value) {
  if (value === 'reset') {
    router.reload();
    // filter.date = null;
    // filter.name = null;
  } else {
    filter.date = value
  }
});

let activeMessage = ref('');
let messageType = ref('');
let message = ref('');

activeMessage = Object.entries(props.flash).filter(([key, value]) => value);

if (activeMessage.length) {
  messageType = activeMessage[0][0];
  message = activeMessage[0][1];
}


let filter = reactive({
  name: props.filters.filter.name,
  date: props.filters.filter.date
})

watch(filter, debounce(function (value) {
  loadMoreItems();
  // router.get('/outages', {
  //       filter: {
  //         name: filter.name,
  //         date: filter.date,
  //       }
  //     },
  //     {
  //       preserveState: true,
  //       replace: true
  //     }
  // )
}, 500));

function importOutages() {
  router.get('/import',
      {
        preserveState: true,
        replace: true
      }
  )
}

let items = ref(props.outages.data);

watch(() => props.outages, (newValue, oldValue) => {
    items.value = [...items.value, ...newValue.data];
});
watch( () => props.filters.filter.date)

const filteredItems = computed(() => {
  if (props.filters.filter.date) {
    return items.value.filter(item => dayjs(item.start).format('YYYY-MM-DD') === dayjs(props.filters.filter.date).format('YYYY-MM-DD'));
  }
  return items.value;
});

const initialUrl = usePage().url;
const loadMoreItems = () => {
  if (!props.outages.links.next) {
    return;
  }

  router.get(
      props.outages.links.next,
      {
        filter: {
          name: filter.name,
          date: filter.date,
        }
      },
      {
        preserveState: true,
        preserveScroll: true,
        replace: true,
        onSuccess: () => {
          window.history.replaceState({}, '', initialUrl);
        }
      })
}

const statuses = {
  Active: 'text-rose-400 bg-rose-400/10',
  Finished: 'text-green-400 bg-green-400/10',
  Upcoming: 'text-yellow-400 bg-yellow-400/10'
}
const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      loadMoreItems();
    }
  });
});
</script>

<template>
  <button @click="loadMoreItems">dadas</button>
  <!--  <div class="bg-gray-400 h-screen content-center mz space-y-3">-->

  <!--    <div class="w-4/5 mx-auto flex place-content-between">-->
  <!--      <div class="space-x-2">-->


  <div class="flex md:flex-row sm:flex-col place-content-around space-x-3">
    <div class="flex flex-row divide gap-2">
      <input
          v-model="filter.name"
          type="text"
          placeholder="Search..."
          class="px-2 py-2 rounded-xl bg-gray-700 text-white">
      <input
          v-model="filter.date"
          type="date"
          class="px-2 py-2 rounded-xl border border-gray-400 text-gray-700">


    </div>
  </div>
  <!--      </div>-->
  <!--      <div class="items-center space-x-2 flex place-content-between">-->

  <Alert v-if="activeMessage.length" :type="messageType" :message="message"/>

  <Timeline :data="items" :current-date="filter.date"/>


  <!--  <WhenVisible-->
  <!--      always-->
  <!--      :data="props.outages.data"-->
  <!--      :params="{-->
  <!--        data: {-->
  <!--          page: props.outages.meta.page + 1-->
  <!--        },-->
  <!--        only: ['outages'],-->
  <!--        preserveUrl: true,-->
  <!--      }"-->
  <!--  >-->

  <!--  </WhenVisible>-->
</template>
