<template>
  <div class="p-6">
    <div class="mt-10">
      <h2 class="text-xl font-semibold mb-2">Detalhes do Aluno: <span class="text-3xl text-blue-900">{{ student.name}}</span></h2>
      <p><strong>Email:</strong> {{ student.email }}</p>
      <p><strong>CPF:</strong> {{ student.cpf }}</p>
    </div>

    <div class="mt-10 max-w-sm">
      <div>
        <label for="course" class="block mb-2 text-sm font-medium text-gray-900">Curso</label>
        <select
          id="course"
          v-model="enroll.course_id"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
          <option value="">Selecione</option>
          <option v-for="course in listCourses" :key="course.id" :value="course.id">{{ course.name }}</option>
        </select>
      </div>

      <div class="mb-5">
        <label for="progress" class="block mb-2 text-sm font-medium text-gray-900">Progresso</label>
        <input
          type="number"
          id="progress"
          v-model="enroll.progress_percentage"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
        />
      </div>

      <button-default @click="enrollmentStudent()" :disabled="!enroll.course_id">Matricular</button-default>
    </div>

    <table-detail :list="courses" :columns="columns">
      <template #actions="{ row }">
          <RouterLink :to="{ name: 'enrollments-edit', params: { id: row.enrollment_id } }" class="font-medium text-blue-600 hover:underline">Editar</RouterLink>
          <!-- <RouterLink :to="{ name: 'student-detail', params: { id: row.id } }" class="ml-4 font-medium text-blue-600 hover:underline">Detalhes</RouterLink> -->
      </template>
    </table-detail>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { getStudentById, studentCourses } from '@/services/studentService';
import { createEnrollment } from '@/services/enrollmentService';
import { listCursesByStudent } from "@/services/courseService";
import TableDetail from "@/components/TableDetail.vue";
import { useUiStore } from "@/stores/ui";
import ButtonDefault from "@/components/ButtonDefault.vue";

const props = defineProps(['id']);
const ui = useUiStore();

const columns = ref([
  { title: 'Nome', field: 'name' },
  { title: 'Descrição', field: 'description' },
  { title: 'Progresso (%)', field: 'progress_percentage' },
]);

const student = ref({});
const courses = ref([]);
const listCourses = ref([]);
const enroll = ref({
  student_id: props.id,
  course_id: null,
  progress_percentage: null
});

onMounted(async () => {
  try {
    ui.showLoading();
    const data = await getStudentById(props.id);
    student.value = data;

    const value = await studentCourses(props.id);
    courses.value = value;

    const list = await listCursesByStudent(props.id);
    listCourses.value = list;
  } catch (error) {
    ui.notifyError("Erro ao carregar Aluno");
  } finally {
    ui.hideLoading();
  }
});

async function enrollmentStudent() {
  ui.showLoading();
  const form = {
    student_id: props.id,
    course_id: enroll.value.course_id,
    progress_percentage: enroll.value.progress_percentage || 0
  };
  try {
    await createEnrollment(form)
    enroll.value.progress_percentage = null
    const value = await studentCourses(props.id);
    courses.value = value;

    const list = await listCursesByStudent(props.id);
    listCourses.value = list;

    ui.notifySuccess("Estudante matriculado com sucesso");
  } catch (error) {
    ui.notifyError(error?.response?.data?.message || "Erro ao matricular estudante");
  } finally {
    ui.hideLoading();
  }
  
}
</script>

<style>

</style>
