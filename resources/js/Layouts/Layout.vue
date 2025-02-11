<template>
    <div>
        <!-- Admin Bar -->
        <div
            class="admin-bar bg-gray-800 text-white flex justify-between items-center px-4 py-2 fixed top-0 left-0 right-0 z-50">
            <div class="flex items-center">
                <button @click="toggleSidebar()" class="text-gray-300 hover:text-white focus:outline-none mr-4">
                    <i class="fas fa-bars"></i>
                </button>
                <Link href="/"><span class="text-sm font-semibold">View Site</span></Link>
            </div>
            <div class="flex items-center space-x-4">
                <button v-if="user && user.role === 'admin'" @click="adminLogout()"
                    class="text-gray-300 hover:text-white focus:outline-none">
                    Logout
                </button>
                <button v-if="user && user.role === 'user'" @click="userLogout()"
                    class="text-gray-300 hover:text-white focus:outline-none">
                    Logout
                </button>
            </div>
        </div>

        <div class="flex mt-12">
            <!-- Sidebar -->
            <div class="sidebar bg-gray-800 text-white min-h-screen fixed inset-y-0 left-0 transition-all duration-300 z-50"
                :class="{
                    'w-60': !isSidebarCollapsed && !isMobile,
                    'w-16': isSidebarCollapsed && !isMobile,
                    'translate-x-0': !isSidebarCollapsed && isMobile,
                    '-translate-x-full': isSidebarCollapsed && isMobile
                }" id="sidebar">
                <div class="p-6 border-b border-gray-700 flex items-center justify-between">
                    <span v-if="!isSidebarCollapsed" class="text-md font-semibold">Dashboard</span>
                    <button @click="toggleSidebar()" class="text-gray-300 hover:text-white focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <nav class="mt-6">
                    <ul class="space-y-1">
                        <li>
                            <Link href="/admin/home"
                                class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-tachometer-alt w-6"></i>
                            <span v-if="!isSidebarCollapsed" class="ml-3">Dashboard</span>
                            </Link>
                        </li>
                        <!-- category menu -->
                        <li v-if="user.role === 'admin'">
                            <button
                                class="flex items-center p-3 w-full text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                                @click="toggleDropdown('categories-dropdown')">
                                <i class="fas fa-folder"></i>
                                <span v-if="!isSidebarCollapsed" class="ml-3">Categories</span>
                                <i v-if="!isSidebarCollapsed" class="fas fa-chevron-down ml-auto text-xs"></i>
                            </button>
                            <ul id="categories-dropdown" class="hidden pl-6">
                                <li>
                                    <Link href="/admin/categories"
                                        class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                    <span v-if="!isSidebarCollapsed" class="ml-3">All Category</span>
                                    </Link>
                                </li>
                                <li>
                                    <Link href="/admin/create-category"
                                        class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                    <span v-if="!isSidebarCollapsed" class="ml-3">Add Category</span>
                                    </Link>
                                </li>
                            </ul>
                        </li>
                        <li v-if="user.role === 'admin'">
                            <button
                                class="flex items-center p-3 w-full text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                                @click="toggleDropdown('products-dropdown')">
                                <i class="fas fa-box"></i>
                                <span v-if="!isSidebarCollapsed" class="ml-3">Products</span>
                                <i v-if="!isSidebarCollapsed" class="fas fa-chevron-down ml-auto text-xs"></i>
                            </button>
                            <ul id="products-dropdown" class="hidden pl-6">
                                <li>
                                    <Link href="/admin/products"
                                        class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                    <span v-if="!isSidebarCollapsed" class="ml-3">All Products</span>
                                    </Link>
                                </li>
                                <li>
                                    <Link href="/admin/create-product"
                                        class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                    <span v-if="!isSidebarCollapsed" class="ml-3">Add Product</span>
                                    </Link>
                                </li>
                            </ul>
                        </li>
                        <li v-if="user.role === 'admin'">
                            <button
                                class="flex items-center p-3 w-full text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                                @click="toggleDropdown('services-dropdown')">
                                <i class="fas fa-laptop-code"></i>
                                <span v-if="!isSidebarCollapsed" class="ml-3">Services</span>
                                <i v-if="!isSidebarCollapsed" class="fas fa-chevron-down ml-auto text-xs"></i>
                            </button>
                            <ul id="services-dropdown" class="hidden pl-6">
                                <li>
                                    <Link href="/admin/services"
                                        class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                    <span v-if="!isSidebarCollapsed" class="ml-3">All Services</span>
                                    </Link>
                                </li>
                                <li>
                                    <Link href="/admin/create-service"
                                        class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                    <span v-if="!isSidebarCollapsed" class="ml-3">Add Service</span>
                                    </Link>
                                </li>
                            </ul>
                        </li>
                        <li v-if="user.role === 'admin'">
                            <button
                                class="flex items-center p-3 w-full text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                                @click="toggleDropdown('orders-dropdown')">
                                <i class="fas fa-shopping-cart"></i>
                                <span v-if="!isSidebarCollapsed" class="ml-3">Orders</span>
                                <i v-if="!isSidebarCollapsed" class="fas fa-chevron-down ml-auto text-xs"></i>
                            </button>
                            <ul id="orders-dropdown" class="hidden pl-6">
                                <li>
                                    <Link href="/admin/orders"
                                        class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                    <span v-if="!isSidebarCollapsed" class="ml-3">All Orders</span>
                                    </Link>
                                </li>
                            </ul>
                        </li>
                        <li v-if="user.role === 'admin'">
                            <button
                                class="flex items-center p-3 w-full text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                                @click="toggleDropdown('pages-dropdown')">
                                <i class="fas fa-file w-6"></i>
                                <span v-if="!isSidebarCollapsed" class="ml-3">Pages</span>
                                <i v-if="!isSidebarCollapsed" class="fas fa-chevron-down ml-auto text-xs"></i>
                            </button>
                            <ul id="pages-dropdown" class="hidden pl-6">
                                <li>
                                    <Link href="/admin/pages"
                                        class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                    <span v-if="!isSidebarCollapsed" class="ml-3">All Pages</span>
                                    </Link>
                                </li>
                                <li>
                                    <Link href="/admin/create-page"
                                        class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                    <span v-if="!isSidebarCollapsed" class="ml-3">Create Page</span>
                                    </Link>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <Link href="/admin/settings"
                                class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                <i class="fas fa-cogs"></i>
                                <span v-if="!isSidebarCollapsed" class="ml-3">Settings</span>
                            </Link>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="main-content flex-1 p-10 transition-all duration-300 ease-in-out"
                :class="{ 'ml-64': !isSidebarCollapsed, 'ml-16': isSidebarCollapsed }" id="main-content">
                <slot></slot>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { router, usePage } from '@inertiajs/vue3'

const page = usePage();

const user = page.props.auth;

function adminLogout() {
    router.post('/admin-logout');
}
function userLogout() {
    router.post('/user-logout');
}

const isSidebarCollapsed = ref(false);
const isMobile = ref(window.innerWidth < 768);

function toggleDropdown(id) {
    const dropdown = document.getElementById(id);
    dropdown.classList.toggle('hidden');
}

function toggleSidebar() {
    if (isMobile.value) {
        isSidebarCollapsed.value = !isSidebarCollapsed.value;
    } else {
        isSidebarCollapsed.value = !isSidebarCollapsed.value;
    }
}

function handleResize() {
    isMobile.value = window.innerWidth < 768;
}

onMounted(() => {
    window.addEventListener('resize', handleResize);
});

onUnmounted(() => {
    window.removeEventListener('resize', handleResize);
});
onMounted(() => {
    handleResize();
    window.addEventListener('resize', handleResize);
});

</script>
<style scoped>
.admin-bar {
    height: 50px;
}

.sidebar {
    transition: width 0.3s ease-in-out;
    width: 240px;
}

.sidebar.w-16 {
    width: 60px;
}

.sidebar a {
    transition: all 0.3s ease-in-out;
}

.sidebar.collapsed span {
    display: none;
}

.sidebar.collapsed a {
    justify-content: center;
}

.sidebar.collapsed i {
    margin-right: 0;
}

/* Mobile Fix */
@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
        transition: all 0.3s ease-in-out;
    }

    .sidebar.translate-x-0 {
        transform: translateX(0);
    }

    .main-content {
        margin-left: 0 !important;
    }
}
</style>
