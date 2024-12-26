<script setup>
let props = defineProps({
  data: {
    type: Object,
    required: true
  },
  currentDate: {
    type: String
  }
})
console.log(props.currentDate);
</script>

<template>
  <div class="min-h-screen bg-gradient-to-r from-blue-200 to-blue-400 pt-5">

    <div class="max-w-5xl mx-auto flex flex-col  px-5 space-y-5">
      <div class="flex mx-auto">
        <h1>
          {{ props.currentDate }}
        </h1>
      </div>

      <div v-for="outage in props.data" :key="outage.id"
           class="flex flex-col bg-white   rounded-2xl shadow-lg shadow-black/20 md:shadow-none space-y-5 md:space-x-2">
        <div class="bg-white shadow-lg rounded-md text-center content-center px-2">
          <h1>
            {{ outage.location.name }}
          </h1>
        </div>
        <div class="bg-white shadow-lg rounded-md text-center">
          {{ outage.start }} - {{ outage.end }}
        </div>
        <div class="bg-white shadow-lg rounded-md p-4">
          <p>
            {{ outage.address }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>