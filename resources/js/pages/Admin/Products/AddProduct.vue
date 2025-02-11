<template>
    <Layout>
        <div>

            <Head title="add Product" />
        </div>
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new product</h2>
                <form @submit.prevent="submit">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <ProductInput label="Product name" id="name" placeholder="Enter Product name" type="text"
                                v-model="form.name" />
                            <div v-if="form.errors.name">{{ form.errors.name }}</div>
                        </div>
                        <div class="w-full">
                            <ProductInput label="Regular price" id="regular" placeholder="regular price" type="number"
                                v-model="form.regular" />
                            <div v-if="form.errors.regular">{{ form.errors.regular }}</div>
                        </div>
                        <div class="w-full">
                            <ProductInput label="Discount price (Optional)" id="discount" placeholder="discount price"
                                type="number" v-model="form.discount" />
                        </div>
                        <div class="sm:col-span-2">
                            <label for="category"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                            </label>
                            <select id="category" v-model="form.category_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected disabled>Select category</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.name }}</option>
                            </select>
                            <div class="text-red-500" v-if="form.errors.category_id">Choose Category</div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <input id="description" type="hidden">
                            <trix-editor input="description" class="large-editor" placeholder="Description here..."
                                @trix-change="updateDescription"></trix-editor>

                        </div>
                        <div class="sm:col-span-2">
                            <ProductInput label="Demo URL" id="demo_url" placeholder="Enter Demo link" type="text"
                                v-model="form.demo_link" />
                        </div>
                        <div class="sm:col-span-2">
                            <img class="w-32 h-24 rounded mb-5" id="image" v-if="imgPreview" :src="imgPreview" alt="">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="file_input">Featured Image (Optional)</label>
                            <input ref="fileInput" @change="handleFileUpload"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                aria-describedby="file_input_help" id="file_input" type="file">
                        </div>
                    </div>
                    <button type="submit" :disabled="form.processing"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Add product
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
import ProductInput from '../../../Components/ProductInput.vue';

const fileInput = ref(null);
const imgPreview = ref(null);

const props = defineProps({
    categories: Array,
});

const form = useForm({
    'name': '',
    'regular': '',
    'discount': '',
    'category_id': '',
    'description': '',
    'demo_link': '',
    'image': null,
})

function handleFileUpload(event) {
    const file = event.target.files[0];
    if (file) {
        form.image = file;
        imgPreview.value = URL.createObjectURL(file);
    }
}

function updateDescription(event) {
    form.description = event.target.innerHTML;
}


function submit() {
    form.post('/create-product', {
        preserveScroll: true,
        onSuccess: () => {
            toast('Product created successfull', { type: 'success' });
            form.reset();
            fileInput.value.value = null;
            imgPreview.value = null;
            document.querySelector("trix-editor").editor.loadHTML("");
        }
    })
}

</script>
<style scoped>
.large-editor {
    min-height: 300px;
}
</style>
