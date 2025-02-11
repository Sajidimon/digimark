<template>
    <Layout>
        <div>

            <Head title="edit category" />
        </div>
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new Category</h2>
                <form @submit.prevent="update">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                                Name</label>
                            <input type="text" id="name" v-model="form.name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type category name">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" rows="8" v-model="form.description"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Your description here"></textarea>
                        </div>
                        <div class="sm:col-span-2">
                            <img v-if="imgPreview || props.category.thumbnail" class="w-32 h-24 rounded mb-5"
                                id="thumbnail" :src="imgPreview || `/storage/${props.category.thumbnail}`" alt="">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="file_input">Upload file</label>
                            <input @change="handleimg"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="file_input" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">WEBP, PNG, JPG
                                or JPEG (MAX. 2MB).</p>
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                        </div>
                    </div>
                    <button type="submit" :disabled="form.processing"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        update Category
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

const imgPreview = ref(null);

const props = defineProps({
    category: Object
})

const form = useForm({
    id:props.category.id,
    name: props.category.name,
    description: props.category.description,
    thumbnail: null,
    _method:'patch'
})


function handleimg(event) {
    const file = event.target.files[0];
    if (file) {
        form.thumbnail = file;
        imgPreview.value = URL.createObjectURL(file);
    }
}

function update() {
    form.post(`/update-category/${props.category.id}`, {
        preserveScroll:true,
        onSuccess: () => {
            toast('category updated successfull', { type: 'success' });
        }
    })
}

</script>
<style scoped></style>
