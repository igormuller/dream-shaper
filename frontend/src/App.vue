<script setup lang="ts">
import Navbar from '@/components/Navbar.vue'
import LoadingModal from '@/components/LoadingModal.vue';
import { storeToRefs } from 'pinia';
import { useUiStore } from '@/stores/ui';

const ui = useUiStore();
const { loading } = storeToRefs(ui);
</script>

<template>
  <div>
    <loading-modal :show="loading" />
    <header>
      <div class="container mx-auto">
        <Navbar />
      </div>
    </header>

    <div class="container mx-auto px-5 py-2">
      <RouterView />
    </div>
  </div>
</template>

<style scoped>

</style>
