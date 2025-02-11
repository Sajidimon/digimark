<template>
    <Layout>
        <div>
            <Head title="all pages" />
        </div>
        <section class="container px-4 mx-auto" v-if="pages">
            <div class="flex justify-between">
                <div class="flex gap-x-3 items-center">
                    <h2
                        class="text-lg font-medium text-gray-800 dark:text-white"
                    >
                        All pages
                    </h2>
                    <span
                        class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400"
                        >{{ pages.length }} pages</span
                    >
                </div>
                <div>
                    <Link
                        href="/admin/create-page"
                        class="bg-primary-500 text-white rounded py-2 px-3"
                        >Add new page
                    </Link>
                </div>
            </div>

            <div class="flex flex-col mt-6">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div
                        class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                    >
                        <div
                            class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg"
                        >
                            <table
                                class="min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                            >
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th
                                            scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                                        >
                                            Name
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                                        >
                                            Publish Date
                                        </th>
                                        <th
                                            scope="col"
                                            class="relative px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                                        >
                                            <span class="">Action</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900"
                                >
                                    <tr v-for="page in pages" :key="page.id">
                                        <td
                                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap"
                                        >
                                            {{ page.name }}
                                        </td>
                                        <td
                                            class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap"
                                        >
                                            {{ createdDate(page.created_at) }}
                                        </td>
                                        <td
                                            class="px-4 py-4 text-sm whitespace-nowrap"
                                        >
                                            <div
                                                class="flex items-center gap-x-6"
                                            >
                                                <Link
                                                    :href="`/page/${page.id}/edit`"
                                                    class="text-gray-500 transition-colors duration-200 dark:hover:text-red-500 dark:text-gray-300 hover:text-red-500 focus:outline-none"
                                                >
                                                    <i
                                                        class="fa-solid fa-pen-to-square"
                                                    ></i>
                                                </Link>
                                                <Link
                                                    :href="`/${page.name}`"
                                                    class="text-gray-500 transition-colors duration-200 dark:hover:text-red-500 dark:text-gray-300 hover:text-red-500 focus:outline-none"
                                                >
                                                    <i class="fas fa-eye"></i>
                                                </Link>

                                                <button
                                                    @click="deletePage(page.id)"
                                                    class="text-gray-500 transition-colors duration-200 dark:hover:text-yellow-500 dark:text-gray-300 hover:text-yellow-500 focus:outline-none"
                                                >
                                                    <i
                                                        class="fa-solid fa-trash"
                                                    ></i>
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
import Swal from "sweetalert2";
import Layout from "../../../Layouts/Layout.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    pages: Array,
});

function createdDate(createdTime) {
    return new Date(createdTime).toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
}

function deletePage(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You can't retrive it again",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(`/delete-page/${id}`, {
                onSuccess: () => {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Page has been deleted.",
                        icon: "success",
                    });
                },
            });
        }
    });
}
</script>
<style scoped></style>
