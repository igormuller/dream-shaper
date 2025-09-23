<template>
    <button
        :type="type"
        :disabled="disabled"
        class="focus:outline-none text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 hover:disabled:bg-gray-400 disabled:cursor-not-allowed disabled:opacity-50"
    >
        <slot></slot>
    </button>
</template>

<script setup>
const props = defineProps({
    type: {
        type: String,
        default: 'button'
    },
    disabled: {
        type: Boolean,
        default: false
    }
});
</script>

<style>

</style>