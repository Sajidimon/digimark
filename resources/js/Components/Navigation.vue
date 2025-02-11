<template>
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <Link href="/" class="text-xl font-bold text-gray-800">
                        <img
                            v-if="settingsData[0]?.HeaderLogo"
                            :src="
                                `/storage/${settingsData[0]?.HeaderLogo}` ||
                                'add logo here'
                            "
                            class="w-48 h-auto"
                            alt="logo"
                        />
                    </Link>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-4">
                    <Link
                        href="/"
                        class="text-gray-800 hover:text-gray-600 px-3 py-2"
                        >Home</Link
                    >

                    <!-- Dropdown Menu -->
                    <div class="relative" v-if="categories?.length">
                        <button
                            @click="desktopDropdown = !desktopDropdown"
                            class="text-gray-800 hover:text-gray-600 px-3 py-2 focus:outline-none"
                        >
                            Categories
                            <svg
                                class="w-4 h-4 inline ml-1"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                ></path>
                            </svg>
                        </button>
                        <div
                            v-if="desktopDropdown"
                            class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg py-2"
                        >
                            <div
                                v-for="category in categories.slice(0, 5)"
                                :key="category.id"
                            >
                                <Link
                                    href="/"
                                    class="block px-4 py-2 text-gray-800 hover:bg-gray-100"
                                    >{{ category.name }}</Link
                                >
                            </div>
                        </div>
                    </div>
                    <div>
                        <Link
                            href="/cart"
                            class="relative inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >
                            <i class="fa-solid fa-cart-shopping mr-2"></i> Cart
                        </Link>
                        <Link
                            href="/signup"
                            class="text-gray-800 hover:text-gray-600 px-3 py-2"
                            >Register</Link
                        >
                        <Link
                            href="/signin"
                            class="text-gray-800 hover:text-gray-600 px-3 py-2"
                            >Login</Link
                        >
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button
                        @click="mobileMenu = !mobileMenu"
                        id="mobile-menu-button"
                        class="text-gray-800 hover:text-gray-600 focus:outline-none"
                    >
                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"
                            ></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div v-if="mobileMenu" id="mobile-menu" class="md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <Link
                    href="/"
                    class="block text-gray-800 hover:text-gray-600 px-3 py-2"
                    >Home</Link
                >

                <!-- Dropdown Menu for Mobile -->
                <div class="relative" v-if="categories?.length">
                    <button
                        @click="mobileDropdown = !mobileDropdown"
                        id="mobile-dropdown-button"
                        class="w-full text-left text-gray-800 hover:text-gray-600 px-3 py-2 focus:outline-none"
                    >
                        Categories
                        <svg
                            class="w-4 h-4 inline ml-1"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            ></path>
                        </svg>
                    </button>
                    <div
                        v-if="mobileDropdown"
                        id="mobile-dropdown"
                        class="pl-4"
                    >
                        <div v-for="category in categories" :key="category.id">
                            <a
                                href="#"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100"
                                >{{ category.name }}</a
                            >
                        </div>
                    </div>
                </div>
                <div>
                    <Link
                        href="/cart"
                        class="relative inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    >
                        <i class="fa-solid fa-cart-shopping"></i>
                        Cart
                    </Link>
                    <Link
                        href="/signup"
                        class="block text-gray-800 hover:text-gray-600 px-3 py-2"
                        >Register</Link
                    >
                    <Link
                        href="/signin"
                        class="text-gray-800 hover:text-gray-600 px-3 py-2"
                        >Login</Link
                    >
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import { ref } from "vue";

// Mobile menu state
const mobileMenu = ref(false);
const mobileDropdown = ref(false);

// Desktop dropdown state
const desktopDropdown = ref(false);

const props = defineProps({
    pages: Array,
    categories: Array,
    settingsData: Array,
});

const page = usePage();

const user = page.props.auth;
</script>
