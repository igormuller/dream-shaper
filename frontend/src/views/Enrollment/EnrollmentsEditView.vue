<template>
  <div class="p-6">
    

    <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
      <h2 class="text-3xl text-gray-900 mb-2">Edição da Matrícula</h2>
      <div class="mt-10">
        <h2 class="text-xl font-semibold mb-2">Detalhes do Aluno: <span class="text-3xl text-blue-900">{{ enroll.student.name}}</span></h2>
        <p><strong>Email:</strong> {{ enroll.student.email }}</p>
        <p><strong>CPF:</strong> {{ enroll.student.cpf }}</p>
      </div>

      <div class="max-w-sm">
        <div class="mb-5">
          <label for="progress_percentage" class="block mb-2 text-sm font-medium text-gray-900">Duração:</label>
          <input type="number" id="progress_percentage" v-model="enroll.progress_percentage"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
          />
          <p class="text-sm text-red-600" v-if="errors.progress_percentage">{{ errors.progress_percentage[0] }}</p>
        </div>
        <div class="mb-5">
          <label for="enrollment_date" class="block mb-2 text-sm font-medium text-gray-900">Data da matrícula:</label>
          <input type="text" id="enrollment_date" v-model="enroll.enrollment_date" v-maska="'##/##/####'"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
          />
          <p class="text-sm text-red-600" v-if="errors.enrollment_date">{{ errors.enrollment_date[0] }}</p>
        </div>
        <div class="mb-5">
          <label for="completion_date" class="block mb-2 text-sm font-medium text-gray-900">Data de Conclusão:</label>
          <input type="text" id="completion_date" v-model="enroll.completion_date" v-maska="'##/##/####'"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
          />
          <p class="text-sm text-red-600" v-if="errors.completion_date">{{ errors.completion_date[0] }}</p>
        </div>
        <button-default @click="save()" :disabled="!enroll.progress_percentage">Salvar</button-default>
      </div>
    </div>

  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import {  useRouter } from "vue-router";
import { useUiStore } from "@/stores/ui";
import { getEnrollmentById, updateEnrollment } from "@/services/enrollmentService";
import { vMaska } from "maska/vue"
import ButtonDefault from "@/components/ButtonDefault.vue";

const ui = useUiStore();
const props = defineProps(['id']);

const router = useRouter();
const errors = ref({});
const enroll = ref({ student: { name: '', email: '', cpf: '' }, progress_percentage: 0});

onMounted(async () => {
  try {
    const data = await getEnrollmentById(props.id);
    enroll.value = data;
  } catch (error) {
    console.log(error);
    ui.notifyError("Erro ao carregar Matrícula");
  } finally {
    ui.hideLoading();
  }
});

async function save() {
  errors.value = [];
  ui.showLoading();
  try {
    await updateEnrollment(props.id, enroll.value)
    ui.notifySuccess("Matrícula atualizada com sucesso");
    router.push({ name: "course-detail", params: {id: enroll.value.course.id} });
  } catch (error) {
    errors.value = error?.response?.data?.errors
    ui.notifyError("Erro ao atualizar matrícula");
  } finally {
    ui.hideLoading();
  }
}
</script>

<style></style>
