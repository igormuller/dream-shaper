<template>
  <nav aria-label="Page navigation example">
    <ul class="inline-flex -space-x-px text-sm">
      <li v-if="pagination.current_page > 1">
        <a href="#" @click="nextPagination(1)"
          class="flex items-center justify-center px-3 h-8 border border-gray-300 leading-tight text-gray-500 bg-white rounded-s-lg hover:bg-gray-100 hover:text-gray-700">Previous</a>
      </li>
      <li v-for="page in pagination.total_pages" :key="page">
        <a href="#" @click="nextPagination(page)"
          :class="['flex items-center justify-center px-3 h-8 border border-gray-300 leading-tight', (page === pagination.current_page) ? 'text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700' : 'text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700']">{{
          page }}</a>
      </li>
      <li v-if="pagination.current_page !== pagination.total_pages">
        <a href="#" @click="nextPagination(pagination.total_pages)"
          class="flex items-center justify-center px-3 h-8 border border-gray-300 leading-tight text-gray-500 bg-white rounded-e-lg hover:bg-gray-100 hover:text-gray-700">Next</a>
      </li>
    </ul>
  </nav>
</template>

<script setup>
const props = defineProps(['pagination'])

const emit = defineEmits(['nextPagination']);

function nextPagination(option) {
  emit('nextPagination', option);
}
</script>

<style></style>
