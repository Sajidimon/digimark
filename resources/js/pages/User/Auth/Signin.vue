<template>
    <Content>
        <div>
            <Head title="user login" />
        </div>

        <div
            class="w-full my-20 max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800"
        >
            <div class="px-6 py-4">
                <div class="flex justify-center mx-auto">
                    <img
                        class="w-auto h-7 sm:h-8"
                        src="https://merakiui.com/images/logo.svg"
                        alt=""
                    />
                </div>

                <h3
                    class="mt-3 text-xl font-medium text-center text-gray-600 dark:text-gray-200"
                >
                    Welcome Back
                </h3>

                <p class="mt-1 text-center text-gray-500 dark:text-gray-400">
                    Login your user panel
                </p>

                <form @submit.prevent="submit">
                    <InputText
                        type="email"
                        placeholder="Email address"
                        v-model="form.email"
                        :message="form.errors.email"
                    />

                    <InputText
                        type="password"
                        placeholder="password"
                        v-model="form.password"
                        :message="form.errors.password"
                    />

                    <div class="flex items-center justify-between mt-4">
                        <Link
                            href="/forgot-password"
                            class="text-sm text-gray-600 dark:text-gray-200 hover:text-gray-500"
                            >Forget Password?</Link
                        >

                        <button
                            class="px-6 py-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50"
                        >
                            Sign In
                        </button>
                    </div>
                </form>
            </div>

            <div
                class="flex items-center justify-center py-4 text-center bg-gray-50 dark:bg-gray-700"
            >
                <span class="text-sm text-gray-600 dark:text-gray-200"
                    >Don't have an account?
                </span>

                <Link
                    href="/signup"
                    class="mx-2 text-sm font-bold text-blue-500 dark:text-blue-400 hover:underline"
                >
                    Sign Up
                </Link>
            </div>
        </div>
    </Content>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import InputText from "../../../Components/InputText.vue";
import { toast } from "vue3-toastify";
import Content from "../../../Layouts/Content.vue";

const form = useForm({
    email: "",
    password: "",
});

function submit() {
    form.post("/signin", {
        onSuccess: () => {
            toast("login successfull", { type: "success" });
            form.reset();
        },
        onError: () => {
            toast("login Failed", { type: "error" });
        },
    });
}
</script>

<style></style>
