<template>
  <table class="w-full text-sm text-left rtl:text-right text-gray-500">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
      <tr>
        <th v-for="col in columns" :key="col.field" scope="col" class="px-6 py-3">
          {{ col.title }}
        </th>
        <th v-if="withAction" scope="col" class="px-6 py-3 text-center">
          Action
        </th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="row in list" :key="row.id" class="bg-white border-b border-gray-200">
        <td v-for="(col, key) in columns" :key="key" class="px-6 py-4">
          {{ row[col.field] }}
        </td>
        <td class="px-6 py-4 text-center">
          <slot name="actions" :row="row"></slot>
        </td>
      </tr>
    </tbody>
    <div v-if="pagination" class="my-4">
        <pagination :pagination="pagination" @nextPage="(page) => $emit('nextPage', page)" />
      </div>
  </table>
</template> 

<script setup>
import Pagination from "@/components/Pagination.vue";

const props = defineProps({
  columns: {
    type: Array,
    required: true
  },
  list: {
    type: Array,
    required: true
  },
  withAction: {
    type: Boolean,
    required: false,
    default: true
  },
  pagination: {
    type: Object,
    required: false
  }
});
</script>

<style></style>