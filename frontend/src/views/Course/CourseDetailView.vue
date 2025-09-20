<template>
  <div class="p-6">   

    <LoadingModal :show="loading" text="Carregando..." />

    <div v-if="!loading">
      <div class="mt-10">
        <h2 class="text-xl font-semibold mb-2">Detalhes do Curso: <span class="text-3xl text-blue-900">{{ course.name}}</span></h2>
        <p><strong>Duração:</strong> {{ course.duration_hours }} horas</p>
        <p><strong>Descrição:</strong> {{ course.description }}</p>
      </div>

      <div class="mt-10 max-w-sm">
        <div>
          <label for="Estudante" class="block mb-2 text-sm font-medium text-gray-900">Estudante</label>
          <select
            id="Estudante"
            v-model="enroll.student_id"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="">Selecione</option>
            <option v-for="student in listStudents" :key="student.id" :value="student.id">{{ student.name }}</option>
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
        <button @click="enrollmentStudent()" class="ml-2 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Matricular</button>
      </div>

      <div class="mt-10">
        <h2 class="text-xl font-semibold mb-2">Estudantes Inscritos</h2>
        <ul class="max-w-md space-y-1 text-gray-900 list-disc list-inside">
          <li v-for="student in students" :key="student.id" class="mb-1">
            {{ student.name }} ({{ student.email }}) - {{ student.progress_percentage }}% concluído
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { getCourseById, courseStudents } from "@/services/courseService";
import LoadingModal from "@/components/LoadingModal.vue";
import { listStudentsByCourse } from '@/services/studentService';
import { createEnrollment } from '@/services/enrollmentService';
import { useToast } from "vue-toastification";

const props = defineProps(['id'])

const course = ref();
const students = ref([]);
const listStudents = ref([]);
const enroll = ref({});
const loading = ref(true);
const toast = useToast();

onMounted(async () => {
  try {
    const data = await getCourseById(props.id);
    course.value = data;

    const value = await courseStudents(props.id);
    students.value = value;

    const list = await listStudentsByCourse(props.id);
    listStudents.value = list;
  } catch (error) {
    console.log(error);
    toast.error("Erro ao carregar curso");
  } finally {
    loading.value = false;
  }
});

async function enrollmentStudent() {
  loading.value = true;
  const form = {
    student_id: enroll.value.student_id,
    course_id: props.id,
    progress_percentage: enroll.value.progress_percentage || 0
  };
  try {
    await createEnrollment(form)
    enroll.value.progress_percentage = null
    const value = await courseStudents(props.id);
    students.value = value;

    const list = await listStudentsByCourse(props.id);
    listStudents.value = list;

    loading.value = false;
  } catch (error) {
    toast.error(error?.response?.data?.message || "Erro ao matricular estudante");
  } finally {
    loading.value = false;
  }
  
}
</script>

<style>

</style>
