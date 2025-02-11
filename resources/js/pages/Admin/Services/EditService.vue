<template>
    <Layout>
        <div>

            <Head title="Edit Service" />
        </div>
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Service</h2>
                <form @submit.prevent="submit">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <ProductInput label="Service name" id="name" placeholder="Enter Service name" type="text"
                                v-model="form.name" />
                            <div v-if="form.errors.name">{{ form.errors.name }}</div>
                        </div>
                        <div class="sm:col-span-2">
                            <ProductInput label="price" id="price" placeholder="price" type="number"
                                v-model="form.price" />
                            <div v-if="form.errors.price">{{ form.errors.price }}</div>
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
                                @trix-change="updateDescription" @trix-initialize="loadExistingData"></trix-editor>

                        </div>
                        <div class="sm:col-span-2">
                            <ProductInput label="Project Duration" id="delivery_time" placeholder="Enter delivery time"
                                type="text" v-model="form.delivery_time" />
                        </div>
                        <div class="sm:col-span-2">
                            <img class="w-32 h-24 rounded mb-5" id="image" v-if="imgPreview || props.service.image"
                                :src="imgPreview || `/storage/${props.service.image}`" alt="">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="file_input">Featured Image (Optional)</label>
                            <input ref="fileInput" @change="handleFileUpload"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                aria-describedby="file_input_help" id="file_input" type="file">
                        </div>
                    </div>
                    <button type="submit" :disabled="form.processing"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Update Service
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
    categories: Object,
    service: Object,
});

const form = useForm({
    id: props.service.id,
    name: props.service.name,
    price: props.service.price,
    category_id: props.service.category_id,
    description: props.service.description,
    delivery_time: props.service.delivery_time,
    image: null,
    _method: 'patch'
})

function handleFileUpload(event) {
    const file = event.target.files[0];
    if (file) {
        form.image = file;
        imgPreview.value = URL.createObjectURL(file);
    }
}

const loadExistingData = () => {
    document.querySelector("trix-editor").editor.loadHTML(form.description);
};

function updateDescription(event) {
    form.description = event.target.innerHTML;
}


function submit() {
    form.post(`/update-service/${props.service.id}`, {
        preserveScroll: true,
        onSuccess: () => {
            toast('Service updated successfull', { type: 'success' });
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
