<template>
    <Layout>
        <div>

            <Head title="all services" />
        </div>
        <section class="container px-4 mx-auto" v-if="services">
            <div class="flex justify-between">
                <div class="flex gap-x-3 items-center">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white">All Service</h2>

                    <span
                        class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">{{
                        services.length }}
                        Product</span>
                </div>
                <div>
                    <Link href="/admin/create-service" class="bg-primary-500 text-white rounded py-2 px-3">Add Service
                    </Link>
                </div>
            </div>

            <div class="flex flex-col mt-6">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            <div class="flex items-center gap-x-3">
                                                <input type="checkbox"
                                                    class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700">
                                                <span>Thumbnail</span>
                                            </div>
                                        </th>
                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            Name</th>
                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            Price</th>
                                        <th scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            description</th>
                                        <th scope="col" class="relative py-3.5 px-4">
                                            <span class="">Action</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                    <tr v-for="service in services" :key="service.id">
                                        <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                            <div class="inline-flex items-center gap-x-3">
                                                <input type="checkbox"
                                                    class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700">

                                                <div class="flex items-center gap-x-2">
                                                    <img class="object-cover w-14 h-14 rounded" v-if="service.image"
                                                        :src="`/storage/${service.image}`" alt="">
                                                    <p v-else>no image</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                            {{ service.name }}</td>
                                        <td
                                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                            {{ service.price }}</td>
                                        <td v-html="getShortDescription(service.description)"
                                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                        </td>
                                        <td class="px-4 py-4 text-sm whitespace-nowrap">
                                            <div class="flex items-center gap-x-6">
                                                <Link :href="`/service/${service.id}/edit`"
                                                    class="text-gray-500 transition-colors duration-200 dark:hover:text-red-500 dark:text-gray-300 hover:text-red-500 focus:outline-none">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                </Link>

                                                <Link
                                                    :href="`/service/${service.name}`"
                                                    class="text-gray-500 transition-colors duration-200 dark:hover:text-red-500 dark:text-gray-300 hover:text-red-500 focus:outline-none"
                                                >
                                                    <i class="fas fa-eye"></i>
                                                </Link>

                                                <button @click="deleteService(service.id)"
                                                    class="text-gray-500 transition-colors duration-200 dark:hover:text-yellow-500 dark:text-gray-300 hover:text-yellow-500 focus:outline-none">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
    </Layout>
</template>
<script setup>
import Swal from 'sweetalert2';
import Layout from '../../../Layouts/Layout.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    services: Array
})


const getShortDescription = (htmlContent) => {
    if (!htmlContent) return "No description";

    const textContent = htmlContent.replace(/<\/?[^>]+(>|$)/g, "");

    return textContent.length > 50 ? textContent.slice(0, 40) + "..." : textContent;
};

function deleteService(id) {

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(`/delete-service/${id}`, {
                onSuccess: () => {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Service has been deleted.",
                        icon: "success"
                    });
                }
            });
        }
    });

}


</script>
<style scoped></style>
