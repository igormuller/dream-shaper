import { defineStore } from 'pinia';
import { ref } from 'vue';

import { useToast } from 'vue-toastification';

export const useUiStore = defineStore('ui', () => {
  const loading = ref(false);
  const toast = useToast();

  function showLoading() {
    loading.value = true;
  }

  function hideLoading() {
    loading.value = false;
  }

  // --- TOASTS ---
  function notifySuccess(message: string) {
    toast.success(message);
  }

  function notifyError(message: string) {
    toast.error(message);
  }

  function notifyInfo(message: string) {
    toast.info(message);
  }

  return {
    // states
    loading,

    // actions
    showLoading,
    hideLoading,
    notifySuccess,
    notifyError,
    notifyInfo
  };
});
