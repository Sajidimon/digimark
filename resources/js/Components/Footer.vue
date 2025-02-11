<template>
    <footer class="bg-white dark:bg-gray-900">
        <div class="container p-6 mx-auto">
            <div
                class="lg:flex"
                v-if="
                    pages?.length > 0 ||
                    categories?.length > 0 ||
                    products?.length > 0 ||
                    services?.length > 0
                "
            >
                <div class="w-full -mx-6 lg:w-2/5">
                    <div class="px-6">
                        <Link href="/" class="text-xl font-bold text-gray-800">
                            <img
                                v-if="settingsData[0]?.FooterLogo"
                                :src="
                                    `/storage/${settingsData[0]?.FooterLogo}` ||
                                    'add logo here'
                                "
                                class="w-48 h-auto"
                                alt=""
                            />
                        </Link>

                        <p
                            class="max-w-sm mt-2 text-gray-500 dark:text-gray-400"
                        >
                            {{ settingsData[0]?.FooterDescription }}
                        </p>

                        <div class="flex mt-6 -mx-2">
                            <a
                                :href="settingsData[0]?.Footerfb"
                                target="_blank"
                                class="mx-2 text-gray-600 transition-colors duration-300 dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400"
                                aria-label="Reddit"
                            >
                                <i class="fab fa-facebook"></i>
                            </a>

                            <a
                                :href="settingsData[0]?.Footeryt"
                                target="_blank"
                                class="mx-2 text-gray-600 transition-colors duration-300 dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400"
                                aria-label="Facebook"
                            >
                                <i class="fab fa-youtube"></i>
                            </a>

                            <a
                                :href="settingsData[0]?.Footerinsta"
                                target="_blank"
                                class="mx-2 text-gray-600 transition-colors duration-300 dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400"
                                aria-label="Github"
                            >
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-6 lg:mt-0 lg:flex-1">
                    <div
                        class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
                    >
                        <div v-if="pages?.length > 0">
                            <h3 class="text-gray-700 uppercase dark:text-white">
                                Imporant links
                            </h3>
                            <Link
                                v-for="page in pages.slice(0, 4)"
                                :key="page.id"
                                :href="`/${page.name}`"
                                class="block mt-2 text-sm text-gray-600 dark:text-gray-400 hover:underline"
                                >{{ page.name }}</Link
                            >
                        </div>

                        <div v-if="categories?.length > 0">
                            <h3 class="text-gray-700 uppercase dark:text-white">
                                popular category
                            </h3>
                            <Link
                                v-for="category in categories.slice(0, 4)"
                                :key="category.id"
                                :href="`/category/${category.name}`"
                                class="block mt-2 text-sm text-gray-600 dark:text-gray-400 hover:underline"
                                >{{ category.name }}</Link
                            >
                        </div>

                        <div v-if="products?.length > 0">
                            <h3 class="text-gray-700 uppercase dark:text-white">
                                Popular Product
                            </h3>
                            <Link
                                v-for="product in products.slice(0, 4)"
                                :key="product.id"
                                :href="`/product/${product.name}`"
                                class="block mt-2 text-sm text-gray-600 dark:text-gray-400 hover:underline"
                                >{{ product.name }}</Link
                            >
                        </div>

                        <div v-if="services?.length > 0">
                            <h3 class="text-gray-700 uppercase dark:text-white">
                                pro service
                            </h3>
                            <Link
                                v-for="service in services.slice(0, 4)"
                                :key="service.id"
                                :href="`/service/${service.name}`"
                                class="block mt-2 text-sm text-gray-600 dark:text-gray-400 hover:underline"
                                >{{ service.name }}</Link
                            >
                        </div>
                    </div>
                </div>
            </div>

            <div v-else class="text-center my-20">
                <p class="text-2xl">Add Footer from dashboard.</p>
            </div>

            <hr class="h-px my-6 bg-gray-200 border-none dark:bg-gray-700" />

            <div>
                <p class="text-center text-gray-500 dark:text-gray-400">
                    {{ settingsData[0]?.copyright }}
                </p>
            </div>
        </div>
    </footer>
</template>

<script setup>
const props = defineProps({
    pages: Array,
    categories: Array,
    products: Array,
    services: Array,
    settingsData: Array,
});
</script>

<style></style>
