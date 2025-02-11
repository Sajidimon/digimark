<template>
    <Navigation />

    <div v-if="page">
        <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
            <div class="flex justify-between px-4 mx-auto max-w-screen-xl">
                <article
                    class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                    <header class="mb-4 lg:mb-6 not-format">
                        <h1
                            class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                            {{ props.page.name }}
                        </h1>
                    </header>
                    <p class="lead">{{ props.page.description }}</p>
                </article>
            </div>
        </main>
    </div>

    <Footer />
</template>

<script setup>
import Navigation from "../../../Components/Navigation.vue";
import Footer from "../../../Components/Footer.vue";

const props = defineProps({
    page: Object,
});

</script>

<style></style>
