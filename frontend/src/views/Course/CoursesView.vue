<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Lista de Cursos</h1>

    <div class="mb-4">
      <RouterLink :to="{ name: 'new-course' }">
        <button-default>Novo Curso</button-default>
      </RouterLink>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table-detail
        :list="courses"
        :columns="[
          { field: 'name', title: 'Nome' },
          { field: 'description', title: 'Descrição' },
          { field: 'duration_hours', title: 'Duração (Horas)' },
        ]"
        :pagination="pagination"
        @nextPage="nextPage"
      >
        <template #actions="{ row: course }">
          <RouterLink :to="{ name: 'course-edit', params: { id: course.id } }" class="font-medium text-blue-600 hover:underline">Editar</RouterLink>
          <RouterLink :to="{ name: 'course-detail', params: { id: course.id } }" class="ml-4 font-medium text-blue-600 hover:underline">Detalhes</RouterLink>
        </template>
      </table-detail>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { getCourses } from "@/services/courseService";
import TableDetail from "@/components/TableDetail.vue";
import ButtonDefault from "@/components/ButtonDefault.vue";
import { useUiStore } from "@/stores/ui";

const ui = useUiStore();

const courses = ref([]);
const pagination = ref({});

onMounted(async () => {
  try {
    nextPage();
  } catch (error) {
    ui.notifyError("Erro ao carregar cursos");
  } finally {
    ui.hideLoading();
  }
});

function nextPage(page) {
  ui.showLoading();
  getCourses(page).then((data) => {
    courses.value = data.data;
    pagination.value = data.pagination;
  }).catch(() => {
    ui.notifyError("Erro ao carregar cursos");
  }).finally(() => {
    ui.hideLoading();
  });
}
</script>

<style></style>
