<template>
    <Layout>
        <div>

            <Head title="dashboard summary" />
        </div>
        <!-- component -->
        <div v-if="user.role==='admin'">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Dashboard Summary</h3>

            <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <div v-if="products"
                    class="relative overflow-hidden rounded-lg bg-gray-600 px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6">
                    <dt>
                        <div class="absolute rounded-md bg-red-600 p-3">
                            <i class="fas fa-box"></i>
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-300">Total Products</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                        <p class="text-2xl font-semibold text-gray-100">{{ products?.length || 0 }}</p>
                        <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                            <div class="text-sm">
                                <Link href="/admin/products" class="font-medium text-orange-400 hover:text-red-500">View
                                all</Link>
                            </div>
                        </div>
                    </dd>
                </div>
                <div v-if="services"
                    class="relative overflow-hidden rounded-lg bg-gray-600 px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6">
                    <dt>
                        <div class="absolute rounded-md bg-orange-500 p-3">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-300">Total Services</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                        <p class="text-2xl font-semibold text-gray-100">{{ services?.length || 0 }}</p>
                        <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                            <div class="text-sm">
                                <Link href="/admin/services" class="font-medium text-yellow-600 hover:text-orange-500">
                                View all</Link>
                            </div>
                        </div>
                    </dd>
                </div>
                <div v-if="orders"
                    class="relative overflow-hidden rounded-lg bg-gray-600 px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6">
                    <dt>
                        <div class="absolute rounded-md bg-blue-500 p-3">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-300">Total Order</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                        <p class="text-2xl font-semibold text-gray-100">{{ orders?.length || 0 }}</p>
                        <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                            <div class="text-sm">
                                <Link href="/admin/orders" class="font-medium text-cyan-600 hover:text-green-500">View
                                all</Link>
                            </div>
                        </div>
                    </dd>
                </div>
            </dl>
        </div>
        <div v-else>
            <p>Welcome {{ user.name }}</p>
        </div>
    </Layout>
</template>
<script setup>
import { usePage } from '@inertiajs/vue3';
import Layout from '../../Layouts/Layout.vue'
const page = usePage();

const user = page.props.auth;

const props = defineProps({
    products:Array,
    services:Array,
    orders:Array,
})



</script>
<style scoped></style>
