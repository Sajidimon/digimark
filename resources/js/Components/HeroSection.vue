<template>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-4xl xl:leading-tight dark:text-white">
                    {{ heading }}</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">{{ SubHeading }}</p>
                <a v-if="ButtonLink" :href="ButtonLink" target="_blank"
                    class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                    View Shop
            </a>
            </div>
            <div v-if="BGImage" class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img :src="BGImage" alt="hero image">
            </div>
        </div>
    </section>
</template>

<script setup>

defineProps({
    heading: {
        type:String
    },
    SubHeading: {
        type:String
    },
    ButtonLink: {
        type:String
    },
    BGImage: {
        type:String
    },
})

</script>

<style>

</style>