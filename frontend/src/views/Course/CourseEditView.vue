<template>
  <div class="p-6">

    <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
      <h2 class="text-3xl text-gray-900 mb-2">Edição do Curso {{ form.name }}</h2>
      <div class="max-w-sm">
        <div class="mb-5">
          <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nome:</label>
          <input type="text" id="name" v-model="form.name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
          />
          <p class="text-sm text-red-600" v-if="errors.name">{{ errors.name[0] }}</p>
        </div>
        <div class="mb-5">
          <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Descrição:</label>
          <input type="text" id="description" v-model="form.description"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
          />
          <p class="text-sm text-red-600" v-if="errors.description">{{ errors.description[0] }}</p>
        </div>
        <div class="mb-5">
          <label for="duration_hours" class="block mb-2 text-sm font-medium text-gray-900">Duração:</label>
          <input type="number" id="duration_hours" v-model="form.duration_hours"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
          />
          <p class="text-sm text-red-600" v-if="errors.duration_hours">{{ errors.duration_hours[0] }}</p>
        </div>
        <button-default @click="save()">Salvar</button-default>
      </div>
    </div>

  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { getCourseById, updateCourse } from "@/services/courseService";
import {  useRouter } from "vue-router";
import { useUiStore } from "@/stores/ui";
import ButtonDefault from "@/components/ButtonDefault.vue";

const ui = useUiStore();
const props = defineProps(['id']);

const router = useRouter();
const errors = ref([]);
const form = ref({
    name: '',
    description: '',
    duration_hours: '',
});

onMounted(async () => {
  try {
    const data = await getCourseById(props.id);
    form.value = data;
  } catch (error) {
    ui.notifyError("Erro ao carregar cursos");
  } finally {
    ui.hideLoading();
  }
});

async function save() {
  errors.value = [];
  ui.showLoading();
  try {
    await updateCourse(props.id, form.value)
    ui.notifySuccess("Curso atualizado com sucesso");
    router.push({ name: "courses-list" });
  } catch (error) {
    errors.value = error?.response?.data?.errors
    ui.notifyError("Erro ao atualizar curso");
  } finally {
    ui.hideLoading();
  }
}
</script>

<style></style>
