<script setup lang="ts">
import { useUiStore } from '@/stores/ui';
import ButtonDefault from '@/components/ButtonDefault.vue'

const ui = useUiStore();
</script>

<template>
  <main>
    <h1 class="text-2xl font-bold">
      Home View
      <button-default @click="ui.showLoading()">Teste</button-default>
    </h1>
  </main>
</template>
