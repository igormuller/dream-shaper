<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
import Navbar from '@/components/Navbar.vue'
</script>

<template>
  <div>
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
