<script setup>
defineProps({
  data: {
    type: Object,
    required: true
  }
})

const statuses = {Active: 'text-rose-400 bg-rose-400/10', Finished: 'text-green-400 bg-green-400/10', Upcoming: 'text-yellow-400 bg-yellow-400/10'}
</script>

<template>
  <table class="mt-6 mx-auto my-auto whitespace-nowrap text-left">
    <colgroup>
      <col class="w-1/12"/>
      <col class="w-2/12"/>
      <col class="w-2/12"/>
      <col class="w-6/12"/>
      <col class="w-1/12"/>
    </colgroup>
    <thead class="border-b border-white/10 text-sm leading-6 text-white">
    <tr class="bg-gray-800 sticky top-0">
      <th scope="col" class="w-1/12 sticky top-0 py-2 pl-4 pr-8 font-semibold sm:pl-6 lg:pl-8">Location</th>
      <th scope="col" class="w-2/12 sticky top-0 py-2 pl-0 pr-8 font-semibold sm:table-cell">Start</th>
      <th scope="col" class="w-2/12 sticky top-0 py-2 pl-0 pr-4 font-semibold sm:pr-8 sm:text-left lg:pr-20">End
      </th>
      <th scope="col" class="w-4/12 sticky top-0 py-2 pl-0 pr-8 font-semibold md:table-cell lg:pr-20">Address</th>
      <th scope="col" class="w-1/12 sticky top-0 py-2 pl-0 pr-4 font-semibold sm:table-cell sm:pr-6 lg:pr-8">
        Status
      </th>
    </tr>
    </thead>
    <tbody class="divide-y divide-white/5">
    <tr v-for="outage in data" :key="outage.id">
      <td class="w-1/12 py-4 pl-4 pr-8 sm:pl-6 lg:pl-8">
        <div class="flex items-center gap-x-4">
          <div class="truncate text-sm font-medium leading-6 text-white">{{ outage.location.name }}</div>
        </div>
      </td>
      <td class="w-2/12 py-4 pl-0 pr-4 sm:table-cell sm:pr-8">
        <div class="flex gap-x-3">
          <div
              class="rounded-md bg-gray-700/40 px-2 py-1 text-xs font-medium text-gray-400 ring-1 ring-inset ring-white/10">
            {{ outage.start }}
          </div>
        </div>
      </td>
      <td class="w-2/12 py-4 pl-0 pr-4 sm:table-cell sm:pr-8">
        <div class="flex gap-x-3">
          <div
              class="rounded-md bg-gray-700/40 px-2 py-1 text-xs font-medium text-gray-400 ring-1 ring-inset ring-white/10">
            {{ outage.end }}
          </div>
        </div>
      </td>
      <td class="w-4/12 text-balance py-4 pl-0 pr-8 text-sm leading-6 text-gray-400 md:table-cell lg:pr-20 ">
        {{ outage.address }}
      </td>
      <td class="w-1/12 py-4 pl-0 pr-4 text-sm leading-6 sm:pr-8 lg:pr-20">
        <div class="flex items-center justify-end gap-x-2 sm:justify-start">
          <!--                    <time class="text-gray-400 sm:hidden" :datetime="outage.duration">{{ outage.duration }}</time>-->
          <div :class="[statuses[outage.status], 'flex-none rounded-full p-1 animate-pulse']">
            <div class="h-2 w-2 rounded-full bg-current"/>
          </div>
          <div class="hidden text-white sm:block">{{ outage.status }}</div>
        </div>
      </td>
    </tr>
    </tbody>
  </table>

</template>

<style scoped>

</style>