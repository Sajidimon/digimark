<template>
    <Content>
        <HeroSection 
        :heading="settingsData[0]?.heading"
        :SubHeading="settingsData[0]?.SubHeading"
        :ButtonLink="settingsData[0]?.ButtonLink"
        :BGImage="settingsData[0]?.herobgimage ? `/storage/${settingsData[0].herobgimage}` : ''"

        />
        <div>
            <Head title="Digimark" />
        </div>
        <section
            v-if="services?.length > 0"
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
                            Our Pro Services
                        </h2>
                    </div>
                </div>
                <div
                    class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4"
                >
                    <Card
                        v-for="service in services.slice(0, 4)"
                        :key="service.id"
                        :src="`/storage/${service.image}`"
                        :title="service.name"
                        :Producthref="`/service/${service.name}`"
                        :price="service.price"
                        :delivery_time="service.delivery_time"
                    />
                </div>
            </div>
        </section>
        <div v-else class="text-center my-20">
            <p class="text-2xl">No Services Found.</p>
        </div>
        <section
            v-if="products?.length > 0"
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
                            WordPress Themes
                        </h2>
                    </div>
                </div>
                <div
                    class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4"
                >
                    <Card
                        v-for="product in products.slice(0,12)"
                        :key="product.id"
                        :src="`/storage/${product.image}`"
                        :title="product.name"
                        :Producthref="`/product/${product.name}`"
                        :price="product.regular"
                        :href="product.demo_link"
                    />
                </div>
            </div>
        </section>
        <div v-else class="text-center my-20">
            <p class="text-2xl">No Products Found.</p>
        </div>
    </Content>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import Card from "../../../Components/Card.vue";
import HeroSection from "../../../Components/HeroSection.vue";
import Content from "../../../Layouts/Content.vue";

const page = usePage();

const settingsData = page.props.settingsData;

const props = defineProps({
    products: {
        type: Array,
        default: () => [],
    },
    services: {
        type: Array,
        default: () => [],
    },
});



</script>
