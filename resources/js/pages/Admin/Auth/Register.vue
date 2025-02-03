<template>
    <div class="mt-14 mx-5">
        <div class="w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="px-6 py-4">
                <div class="flex justify-center mx-auto">
                    <img class="w-auto h-7 sm:h-8" src="https://merakiui.com/images/logo.svg" alt="">
                </div>

                <h3 class="mt-3 text-xl font-medium text-center text-gray-600 dark:text-gray-200">Welcome to digimark
                </h3>

                <p class="mt-1 text-center text-gray-500 dark:text-gray-400">Create account</p>

                <form @submit.prevent="submit">

                    <InputText type="text" placeholder="Full name" v-model="form.name" :message="form.errors.name" />

                    <InputText type="email" placeholder="Email address" v-model="form.email"
                        :message="form.errors.email" />

                    <InputText type="password" placeholder="password" v-model="form.password"
                        :message="form.errors.password" />

                    <InputText type="password" placeholder="Confirm password" v-model="form.password_confirmation" />

                    <div class="mt-4">
                        <button type="submit"
                            class="px-6 py-2 w-full text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                            Sign Up
                        </button>
                    </div>
                </form>
            </div>

            <div class="flex items-center justify-center py-4 text-center bg-gray-50 dark:bg-gray-700">
                <span class="text-sm text-gray-600 dark:text-gray-200">Already have an account? </span>

                <Link href="/admin/login"
                    class="mx-2 text-sm font-bold text-blue-500 dark:text-blue-400 hover:underline">
                Login
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link, router, useForm } from '@inertiajs/vue3';
import InputText from '../../../Components/InputText.vue';
import { toast } from 'vue3-toastify';


const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});


function submit() {
    form.post('/admin-register', {
        onSuccess: () => {
            toast('Registration successfull', { type: 'success' })
            form.reset();
            router.visit('/admin/login');
        },
        onError: () => {
            toast('Registration Failed', { type: 'error' })
        },
    })
}

</script>

<style></style>