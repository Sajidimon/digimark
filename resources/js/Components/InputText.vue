<template>
    <div class="w-full mt-4">
        <input
            class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300"
            :type="type" :placeholder="placeholder" v-model="model"/>
        <div class="text-red-700" v-if="message">{{ message }}</div>
    </div>
</template>

<script setup>

const model = defineModel();

defineProps({
    type: {
        type: String,
        default: 'text'
    },
    placeholder: {
        type: String,
    },
    message: String,
})
</script>

<style></style>