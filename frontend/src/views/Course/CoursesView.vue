<template>
  <div class="p-6">

    <h1 class="text-2xl font-bold mb-4">Lista de Cursos</h1>

    <LoadingModal :show="loading" text="Carregando..." />

    <div class="mb-4">
      <RouterLink
        :to="{ name: 'new-course' }"
        type="button"
        class="focus:outline-none text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2"
      >
        Novo Curso
      </RouterLink>
    </div>

    <div v-if="!loading && !error" class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3">
              Nome
            </th>
            <th scope="col" class="px-6 py-3">
              Descrição
            </th>
            <th scope="col" class="px-6 py-3">
              Duração (Horas)
            </th>
            <th scope="col" class="px-6 py-3">
              Action
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="course in courses" :key="course.id"
            class="bg-white border-b border-gray-200">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
              {{ course.name }}
            </th>
            <td class="px-6 py-4">
              {{ course.description }}
            </td>
            <td class="px-6 py-4">
              {{ course.duration_hours }}
            </td>
            <td>
              <RouterLink :to="{ name: 'course-edit', params: { id: course.id } }" class="font-medium text-blue-600 hover:underline">Editar</RouterLink>
              <RouterLink :to="{ name: 'course-detail', params: { id: course.id } }" class="ml-4 font-medium text-blue-600 hover:underline">Detalhes</RouterLink>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="my-4">
        <Pagination :pagination="pagination" @nextPagination="nextPagination" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { getCourses } from "@/services/courseService";
import LoadingModal from "@/components/LoadingModal.vue";
import Pagination from "../../components/Pagination.vue";

const courses = ref([]);
const pagination = ref({});
const loading = ref(true);
const error = ref(null);

onMounted(async () => {
  try {
    const data = await getCourses();
    courses.value = data.data;
    pagination.value = data.pagination;
  } catch (error) {
    error.value = "Erro ao carregar cursos";
  } finally {
    loading.value = false;
  }
});

function nextPagination(page) {
  loading.value = true;
  getCourses(page).then((data) => {
    courses.value = data.data;
    pagination.value = data.pagination;
  }).catch(() => {
    error.value = "Erro ao carregar cursos";
  }).finally(() => {
    loading.value = false;
  });
}
</script>

<style></style>
