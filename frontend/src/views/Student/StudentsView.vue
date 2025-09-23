<template>
  <div class="p-6">

    <h1 class="text-2xl font-bold mb-4">Lista de Alunos</h1>

    <div class="mb-4">
      <RouterLink :to="{ name: 'new-student' }">
        <button-default>Novo Aluno</button-default>
      </RouterLink>
    </div>

    <div v-if="!loading" class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table-detail
        :list="students"
        :columns="columns"
        :pagination="pagination"
        @nextPage="nextPage"
      >
        <template #actions="{ row }">
            <RouterLink :to="{ name: 'student-edit', params: { id: row.id } }" class="font-medium text-blue-600 hover:underline">Editar</RouterLink>
            <RouterLink :to="{ name: 'student-detail', params: { id: row.id } }" class="ml-4 font-medium text-blue-600 hover:underline">Detalhes</RouterLink>
        </template>
      </table-detail>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { getStudents } from "@/services/studentService";
import TableDetail from "@/components/TableDetail.vue";
import ButtonDefault from "@/components/ButtonDefault.vue";
import { useUiStore } from "@/stores/ui";

const ui = useUiStore();
const students = ref([]);
const pagination = ref({});

const columns = ref([
  { title: 'Nome', field: 'name' },
  { title: 'Email', field: 'email' },
  { title: 'CPF', field: 'cpf' },
]);

onMounted(async () => {
  try {
    nextPage();
  } catch (error) {
    ui.notifyError("Erro ao carregar estudantes");
  } finally {
    ui.hideLoading();
  }
});

function nextPage(page) {
  ui.showLoading();
  getStudents(page).then((data) => {
    students.value = data.data;
    pagination.value = data.pagination;
  }).catch((error) => {
    ui.notifyError(error?.response?.data?.message || "Erro ao listar estudantes");
  }).finally(() => {
    ui.hideLoading();
  });
}
</script>

<style></style>
