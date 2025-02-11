<template>
    <!-- Overlay -->
    <div v-if="isOpen"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 overflow-y-auto">
        <!-- Modal Container -->
        <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6 max-h-[80vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-semibold mx-auto">{{ title }}</h3>
                <button @click="closeModal" class="text-gray-500 hover:text-gray-700">
                    &times;
                </button>
            </div>
            <!-- Modal Body -->
            <div class="mb-4">
                <slot></slot>
            </div>
            <!-- Modal Footer -->
            <div class="flex justify-end">
                <button @click="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Close
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

// Props
const props = defineProps({
    title: {
        type: String,
        default: 'Modal Title',
    },
});

// Modal State
const isOpen = ref(false);

// Open Modal
const openModal = () => {
    isOpen.value = true;
};

// Close Modal
const closeModal = () => {
    isOpen.value = false;
};

// Expose methods to parent component
defineExpose({ openModal, closeModal });
</script>