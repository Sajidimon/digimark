<template>
    <div>
        <!-- Admin Bar -->
        <div
            class="admin-bar bg-gray-800 text-white flex justify-between items-center px-4 py-2 fixed top-0 left-0 right-0 z-50">
            <div class="flex items-center">
                <button @click="toggleSidebar()" class="text-gray-300 hover:text-white focus:outline-none mr-4">
                    <i class="fas fa-bars"></i>
                </button>
                <span class="text-sm font-semibold">Admin Panel</span>
            </div>
            <div class="flex items-center space-x-4">
                <button class="text-gray-300 hover:text-white focus:outline-none">
                    <i class="fas fa-user"></i>
                </button>
                <button @click="logout()" class="text-gray-300 hover:text-white focus:outline-none">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </div>
        </div>

        <div class="flex mt-12">
            <!-- Sidebar -->
            <div class="sidebar bg-gray-800 text-white min-h-screen fixed inset-y-0 left-0 transition-all duration-300"
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
                            <a href="#"
                                class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                <i class="fas fa-tachometer-alt w-6"></i>
                                <span v-if="!isSidebarCollapsed" class="ml-3">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                <i class="fas fa-pencil-alt w-6"></i>
                                <span v-if="!isSidebarCollapsed" class="ml-3">Posts</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                <i class="fas fa-image w-6"></i>
                                <span v-if="!isSidebarCollapsed" class="ml-3">Media</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                <i class="fas fa-file w-6"></i>
                                <span v-if="!isSidebarCollapsed" class="ml-3">Pages</span>
                            </a>
                        </li>
                        <!-- Multi-level Menu: Settings -->
                        <li>
                            <button
                                class="flex items-center p-3 w-full text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                                @click="toggleDropdown('settings-dropdown')">
                                <i class="fas fa-cog w-6"></i>
                                <span v-if="!isSidebarCollapsed" class="ml-3">Settings</span>
                                <i v-if="!isSidebarCollapsed" class="fas fa-chevron-down ml-auto text-xs"></i>
                            </button>
                            <ul id="settings-dropdown" class="hidden pl-6">
                                <li>
                                    <a href="#"
                                        class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                        <i class="fas fa-user w-6"></i>
                                        <span v-if="!isSidebarCollapsed" class="ml-3">Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                        <i class="fas fa-lock w-6"></i>
                                        <span v-if="!isSidebarCollapsed" class="ml-3">Security</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center p-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                        <i class="fas fa-cogs w-6"></i>
                                        <span v-if="!isSidebarCollapsed" class="ml-3">Advanced</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="main-content flex-1 p-10 transition-all duration-300 ease-in-out"
                :class="{ 'ml-64': !isSidebarCollapsed, 'ml-16': isSidebarCollapsed }" id="main-content">
                <h1 class="text-2xl font-bold">Welcome to Your Dashboard</h1>
                <p class="mt-4">This is the main content area. The sidebar can be toggled on all devices.</p>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { router } from '@inertiajs/vue3'

function logout() {
    router.post('/admin-logout')
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
