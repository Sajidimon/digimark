<template>
    <Layout>
        <div>

            <Head title="all categories" />
        </div>
        <section class="container px-4 mx-auto" v-if="categories">
            <div class="flex justify-between">
                <div class="flex gap-x-3 items-center">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white">All Category</h2>

                    <span
                        class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">{{
                        categories.length }}
                        Category</span>
                </div>
                <div>
                    <Link href="/admin/create-category" class="bg-primary-500 text-white rounded py-2 px-3">Add Category
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
                                            description</th>
                                        <th scope="col" class="relative py-3.5 px-4">
                                            <span class="">Action</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                    <tr v-for="category in categories.data" :key="category.id">
                                        <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                            <div class="inline-flex items-center gap-x-3">
                                                <input type="checkbox"
                                                    class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700">

                                                <div class="flex items-center gap-x-2">
                                                    <img class="object-cover w-10 h-10 rounded-full"
                                                        v-if="category.thumbnail"
                                                        :src="`/storage/${category.thumbnail}`" alt="">
                                                    <p v-else>no image</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                            {{ category.name }}</td>
                                        <td
                                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                            {{ category.description ? category.description : 'No description' }}</td>
                                        <td class="px-4 py-4 text-sm whitespace-nowrap">
                                            <div class="flex items-center gap-x-6">
                                                <Link :href="`/category/${category.id}/edit`"
                                                    class="text-gray-500 transition-colors duration-200 dark:hover:text-red-500 dark:text-gray-300 hover:text-red-500 focus:outline-none">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                </Link>

                                                <Link
                                                    :href="`/category/${category.name}`"
                                                    class="text-gray-500 transition-colors duration-200 dark:hover:text-red-500 dark:text-gray-300 hover:text-red-500 focus:outline-none"
                                                >
                                                    <i class="fas fa-eye"></i>
                                                </Link>

                                                <button @click="deleteCategory(category.id)"
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
            <div class="flex justify-center mt-6">
                <nav class="inline-flex space-x-1">
                    <button v-for="(link, index) in categories.links" :key="index" :disabled="!link.url"
                        @click="changePage(link.url)" v-html="link.label"
                        class="px-4 py-2 border rounded-md transition duration-300 ease-in-out" :class="{
                            'bg-blue-500 text-white border-blue-500': link.active,
                            'bg-white text-gray-700 border-gray-300 hover:bg-gray-100': !link.active && link.url,
                            'cursor-not-allowed opacity-50': !link.url
                        }">
                    </button>
                </nav>
            </div>
        </section>
    </Layout>
</template>
<script setup>
import Swal from 'sweetalert2';
import Layout from '../../../Layouts/Layout.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    categories: Object,
    category: Object,
})

function changePage(url) {
    if (url) {
        router.visit(url);
    }
}

function deleteCategory(id) {

    Swal.fire({
        title: "Are you sure?",
        text: "All Products associated with it will be deleted",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(`/delete-category/${id}`, {
                onSuccess: () => {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Category has been deleted.",
                        icon: "success"
                    });
                }
            });
        }
    });

}


</script>
<style scoped></style>
