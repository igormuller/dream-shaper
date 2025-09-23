<template>
  <div class="p-6">

    <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
      <h2 class="text-3xl text-gray-900 mb-2">Novo Aluno</h2>
      <div class="max-w-sm">
        <div class="mb-5">
          <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nome:</label>
          <input type="text" id="name" v-model="form.name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
          />
          <p class="text-sm text-red-600" v-if="errors.name">{{ errors.name[0] }}</p>
        </div>
        <div class="mb-5">
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email:</label>
          <input type="email" id="email" v-model="form.email"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
          />
          <p class="text-sm text-red-600" v-if="errors.email">{{ errors.email[0] }}</p>
        </div>
        <div class="mb-5">
          <label for="cpf" class="block mb-2 text-sm font-medium text-gray-900">CPF:</label>
          <input type="text" id="cpf" v-model="form.cpf" v-maska="'###.###.###-##'"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
          />
          <p class="text-sm text-red-600" v-if="errors.cpf">{{ errors.cpf[0] }}</p>
        </div>
        <button-default @click="save()">
          Salvar
        </button-default>
      </div>
    </div>

  </div>
</template>

<script setup>
import { ref } from "vue";
import {  useRouter } from "vue-router";
import { createStudent } from "@/services/studentService";
import { useUiStore } from "@/stores/ui";
import ButtonDefault from "@/components/ButtonDefault.vue";
import { vMaska } from "maska/vue"

const ui = useUiStore();

const router = useRouter();
const errors = ref([]);
const form = ref({
    name: '',
    email: '',
    cpf: '',
});

async function save() {
  errors.value = [];
  ui.showLoading();
  try {
    await createStudent(form.value)
    ui.hideLoading();
    router.push({ name: "students-list" });
  } catch (error) {
    errors.value = error?.response?.data?.errors
    ui.notifyError("Erro ao criar estudante");
  } finally {
    ui.hideLoading();
  }
}
</script>

<style></style>
