<template>
    <Layout>
        <div>
            <Head title="add category" />
        </div>
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new Category</h2>
                <form @submit.prevent="submit">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                                Name</label>
                            <input type="text" id="name" v-model="form.name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type category name">
                            <div class="text-red-500" v-if="form.errors.name">{{ form.errors.name }}</div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" rows="8" v-model="form.description"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Your description here"></textarea>
                        </div>
                        <div class="sm:col-span-2">
                            <img class="w-32 h-24 rounded mb-5" id="thumbnail" v-if="imgPreview" :src="imgPreview"
                                alt="">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="file_input">Upload file</label>
                            <input ref="fileInput" @change="handleFileUpload"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="file_input" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">WEBP, PNG, JPG
                                or JPEG (MAX. 2MB).</p>
                        </div>
                    </div>
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Add Category
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
import { ref } from 'vue';

const fileInput = ref(null);
const imgPreview = ref(null);

const form = useForm({
    'name': '',
    'description': '',
    'thumbnail': '',
})

function handleFileUpload(event) {
   const file = event.target.files[0];
    if (file) {
        form.thumbnail = file;
        imgPreview.value = URL.createObjectURL(file);
    }
}


function submit() {
    form.post('/create-category', {
        onSuccess: () => {
            toast('category created successfull', { type: 'success' });
            form.reset();
            form.thumbnail = null;
            fileInput.value.value = null;
            imgPreview.value = null;
        }
    })
}

</script>
<style scoped></style>
