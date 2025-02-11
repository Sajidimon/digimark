<template>
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="h-56 w-full">
            <Link :href="Producthref">
                <img v-if="src" class="mx-auto h-full dark:hidden" :src="src" />
            </Link>
        </div>
        <div class="pt-6">
            <Link :href="Producthref"
                class="text-md font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{
                    title }}</Link>

            <div class="mt-4 flex items-center justify-between gap-4">
                <p class="text-lg font-extrabold leading-tight text-gray-900 dark:text-white">Price: ${{ price }}</p>

                <a target="_blank" v-if="href" :href="href"
                    class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white">
                    <span
                        class="relative px-3 py-2 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">
                        View Demo
                    </span>
                </a>
                <div v-else>
                    <span class="font-bold">{{ delivery_time }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    src: {
        type: String,
    },
    title: {
        type: String,
    },
    price: {
        type: Number,
    },
    href: {
        type: String,
    },
    Producthref: {
        type: String,
    },
    delivery_time: {
        type: String,
    },
})
</script>

<style></style>