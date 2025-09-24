<template>
  <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Gráfico de Barras -->
    <div class="bg-white p-4 rounded-2xl shadow">
      <h2 class="text-lg font-semibold mb-2">Matriculas Mensais</h2>
      <BarChart :chart-data="barData" :chart-options="chartOptions" />
    </div>

    <!-- Gráfico de Linha -->
    <div class="bg-white p-4 rounded-2xl shadow">
      <h2 class="text-lg font-semibold mb-2">Matriculas Mensais</h2>
      <LineChart :chart-data="lineData" :chart-options="chartOptions" />
    </div>

    <!-- Gráfico de Pizza -->
    <div class="bg-white p-4 rounded-2xl shadow">
      <h2 class="text-lg font-semibold mb-2">Matrículas por curso</h2>
      <PieChart :chart-data="pieData" :chart-options="chartOptions" />
    </div>
  </div>
</template>

<script setup lang="ts">
import { getEnrollmentsByCourse, getEnrollmentsByMonth } from "@/services/dashboardService";
import { onMounted, ref } from "vue";
import { BarChart, LineChart, PieChart } from "vue-chart-3";
import { useUiStore } from "@/stores/ui";

const ui = useUiStore();
const months = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"]

const barData = ref({
  labels: months,
  datasets: [
    {
      label: "Nº de Matrículas",
      data: [],
      backgroundColor: "#3b82f6"
    }
  ]
});

const lineData = ref({
  labels: months,
  datasets: [
    {
      label: "Nº de Matrĩculas",
      data: [],
      borderColor: "#10b981",
      backgroundColor: "rgba(16, 185, 129, 0.2)",
      tension: 0.4
    }
  ]
});

const pieData = ref({
  labels: [],
  datasets: [
    {
      label: "Distribuição",
      data: [],
      backgroundColor: "#f87171"
    }
  ]
});

const chartOptions = {
  responsive: true,
  plugins: {
    legend: { position: "bottom" }
  }
};

onMounted(async () => {
  try {
    barData.value.datasets[0].data = await getEnrollmentsByMonth();
    lineData.value.datasets[0].data = await getEnrollmentsByMonth();
    
    const response = await getEnrollmentsByCourse();
    pieData.value.labels = response.labels;
    pieData.value.datasets[0].data = response.data;
  } catch (error) {
    ui.notifyError("Erro ao carregar estudantes");
  } finally {
    ui.hideLoading();
  }
});
</script>

<style>
</style>