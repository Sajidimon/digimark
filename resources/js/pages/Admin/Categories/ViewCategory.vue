<template>
    <Content>
        <div>
            <Head title="Digimark" />
        </div>
        <section
            v-if="category"
            class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-12"
        >
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <!-- Heading & Filters -->
                <div
                    class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8"
                >
                    <div class="mx-auto">
                        <h2
                            class="mt-3 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl"
                        >
                            {{ category.name }}
                        </h2>
                    </div>
                </div>
                <div
                    v-if="category.products?.length > 0 || category.services?.length > 0"
                    class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4"
                >
                    <Card
                        v-for="product in category.products"
                        :key="product.id"
                        :src="`/storage/${product.image}`"
                        :title="product.name"
                        :Producthref="`/product/${product.name}`"
                        :price="product.regular"
                        :href="product.demo_link"
                    />
                </div>
                <div v-else class="text-center my-20">
                    <p class="text-2xl">No Products Found in this category.</p>
                </div>
            </div>
        </section>
    </Content>
</template>

<script setup>
import Card from "../../../Components/Card.vue";
import Content from "../../../Layouts/Content.vue";

const props = defineProps({
    category: Object,
});
</script>
