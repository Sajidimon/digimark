<template>
    <Layout>
        <div>

            <Head title="edit page" />
        </div>
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit your page</h2>
                <form @submit.prevent="update">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">page
                                title</label>
                            <input type="text" id="name" v-model="form.name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="page title">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" rows="8" v-model="form.description"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Your description here"></textarea>
                        </div>
                    </div>
                    <button type="submit" :disabled="form.processing"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Update
                    </button>
                </form>
            </div>
        </section>
    </Layout>
</template>
<script setup>
import { useForm } from '@inertiajs/vue3';
import Layout from '../../../Layouts/Layout.vue';
import { toast } from 'vue3-toastify';

const props = defineProps({
    page: Object
})

const form = useForm({
    id: props.page.id,
    name: props.page.name,
    description: props.page.description,
    _method: 'patch'
})

function update() {
    form.post(`/update-page/${props.page.id}`, {
        preserveScroll: true,
        onSuccess: () => {
            toast('Page updated successfull', { type: 'success' });
        }
    })
}

</script>
