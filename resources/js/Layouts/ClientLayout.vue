<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';
import ClientSidebar from '../Components/ClientSidebar.vue'
import FlashMessage from "../Components/FlashMessage.vue";

const showingNavigationDropdown = ref(false);
const showingSidebar = ref(false);

const currentYear = ref(new Date().getFullYear());
</script>

<template>
    <div>
        <div class="relative min-h-screen bg-white">

            <div class="grid md:grid-cols-5">
                <!-- Sidebar here -->
                <aside :class="{ block: showingSidebar, hidden: !showingSidebar }" class="md:block relative col-span-4 md:col-span-1 text-slate-900 bg-purple-50 min-h-screen p-4 lg:pl-5 scroll-auto overflow-y-auto pb-6 text-xs md:text-sm lg:text-base">
                    <ClientSidebar />
                </aside>

                <!-- Hamburger: to show or hide sidebar -->
                <div class="-mr-2 z-20 flex items-center fixed top-8 left-0 md:hidden">
                    <button
                        @click="showingSidebar = !showingSidebar"
                        class="inline-flex items-center justify-center p-2 rounded-sm text-gray-700 hover:text-gray-800 hover:bg-gray-300 bg-gray-200 focus:outline-none rounded-md focus:bg-gray-200 focus:text-gray-900 transition duration-150 ease-in-out"
                    >
                        <svg class="h-4 w-4" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path
                                :class="{
                                            hidden: showingSidebar,
                                            block: !showingSidebar,
                                            'inline-flex': !showingSidebar,
                                        }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{
                                            hidden: !showingSidebar,
                                            'inline-flex': showingSidebar,
                                        }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>

                <div class="col-span-4 h-screen overflow-y-auto overflow-y-scroll">
                    <nav class="sticky top-0 right-0 z-10 text-white bg-white border-b border-gray-100">
                        <!-- Primary Navigation Menu -->
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="flex justify-between h-16">
                                <div class="flex">

                                    <!-- Navigation Links -->
                                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                        <NavLink :href="$page.props.homeUrl" :active="$page.props.homeUrl">
                                            Home
                                        </NavLink>
                                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                            Dashboard
                                        </NavLink>
                                        <NavLink v-if="$page.props.auth.user.role === 'A'" :href="route('admin')" :active="route().current('admin')">
                                            Admin
                                        </NavLink>
                                        <NavLink :href="$page.props.homeUrl+`services`" :active="$page.props.homeUrl+`services`">
                                            Services
                                        </NavLink>
                                    </div>
                                </div>

                                <div class="hidden sm:flex sm:items-center sm:ml-6">
                                    <!-- Settings Dropdown -->
                                    <div class="ml-3 relative">
                                        <Dropdown align="right" width="48">
                                            <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                            </template>

                                            <template #content>
                                                <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                                <DropdownLink :href="route('logout')" method="post" as="button">
                                                    Log Out
                                                </DropdownLink>
                                            </template>
                                        </Dropdown>
                                    </div>
                                </div>

                                <!-- Hamburger -->
                                <div class="-mr-2 flex items-center sm:hidden">
                                    <button
                                        @click="showingNavigationDropdown = !showingNavigationDropdown"
                                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 bg-gray-100 focus:outline-none focus:bg-gray-200 focus:text-gray-500 transition duration-150 ease-in-out"
                                    >
                                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                            <path
                                                :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4 6h16M4 12h16M4 18h16"
                                            />
                                            <path
                                                :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Responsive Navigation Menu -->
                        <div
                            :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                            class="sm:hidden"
                        >
                            <div class="pt-2 pb-3 px-2 sm:px-0 space-y-1">
                                <ResponsiveNavLink :href="$page.props.homeUrl" :active="$page.props.homeUrl">
                                    Home
                                </ResponsiveNavLink>
                                <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </ResponsiveNavLink>
                                <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    All Orders
                                </ResponsiveNavLink>
                                <ResponsiveNavLink :href="route('orders.new')" :active="route().current('orders.new')">
                                    New Order
                                </ResponsiveNavLink>
                            </div>

                            <!-- Responsive Settings Options -->
                            <div class="pt-4 pb-1 border-t border-gray-200">
                                <div class="px-4">
                                    <div class="font-medium text-base text-gray-800">
                                        {{ $page.props.auth.user.name }}
                                    </div>
                                    <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                                </div>

                                <div class="mt-3 space-y-1">
                                    <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                                    <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                        Log Out
                                    </ResponsiveNavLink>
                                </div>
                            </div>
                        </div>
                    </nav>

                    <div class="lg:border-l">
                        <!-- Page Heading -->
                        <header v-if="$slots.header" class="mb-4">
                            <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
                                <slot name="header" />
                            </div>
                        </header>

                        <!-- Page Content -->
                        <main class="py-6 px-2">
                            <FlashMessage class="max-w-screen-md"></FlashMessage>

                            <slot />

                        </main>


                    </div>
                </div>
                <!--footer-->
                <footer class="col-span-5 mt-6 shadow-sm shadow-fuchsia-700 rounded-md">
                    <div class="bg-fuchsia-100 md:col-span-6 text-black text-sm py-4">
                        <div class="grid lg:grid-cols-3 p-6 place-content-center">
                            <div class="p-2 px-3 col-span-1">
                                <h2 class="font-bold underline underline-2 pb-1">
                                    About Us
                                </h2>
                                <ul class="p-2">
                                    <li>
                                        <Link :class="`hover:text-blue-500 hover:underline underline-offset-4`" :href="$page.props.homeUrl+`about-us`">
                                            About
                                        </Link>
                                    </li>

                                    <li>
                                        <Link :class="`hover:text-blue-500 hover:underline underline-offset-4`" :href="route(`dashboard`)">
                                            My Orders
                                        </Link>
                                    </li>

                                    <li>
                                        <Link :class="`hover:text-blue-500 hover:underline underline-offset-4`" :href="route('orders.new')">
                                            New Order
                                        </Link>
                                    </li>
                                </ul>
                            </div>

                            <div class="p-2 px-3 col-span-1">
                                <h3 class="font-bold underline underline-2 pb-1">
                                    Our Services
                                </h3>
                                <ul class="p-2">
                                    <li>
                                        <Link :class="`hover:text-blue-500 hover:underline underline-offset-4`" :href="$page.props.homeUrl+`services`">
                                            Coursework Help
                                        </Link>
                                    </li>

                                    <li>
                                        <Link :class="`hover:text-blue-500 hover:underline underline-offset-4`" :href="$page.props.homeUrl+`services`">
                                            Report Writing
                                        </Link>
                                    </li>

                                    <li>
                                        <Link :class="`hover:text-blue-500 hover:underline underline-offset-4`" :href="$page.props.homeUrl">
                                            Case Study Writing
                                        </Link>
                                    </li>
                                </ul>
                            </div>

                            <div class="p-2 px-3 col-span-1">
                                <h3 class="font-bold underline underline-2 pb-1">
                                    Contact Us
                                </h3>
                                <ul class="p-2 flex flex-col gap-y-2">
                                    <li class="">
                                        <Link :class="`hover:text-blue-500 hover:underline underline-offset-4`" :href="`mailto:essaysresearch70@gmail.com`">
                                            essaysresearch70@gmail.com
                                        </Link>
                                    </li>

                                    <li class="mt-2">
                                        <Link :href="`https://tawk.to/chat/63c8802dc2f1ac1e202e6df2/1gn3j9djh`" class="p-2 px-3 w-fit hover:text-slate-50 text-slate-200 font-semibold bg-purple-500 hover:bg-purple-600 border rounded shadow-md hover:underline underline-offset-4">
                                            Chat with an expert
                                        </Link>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div class="mt-6 mx-auto max-w-3xl">
                            <div class="flex justify-between px-3 text-xs">
                                <p class="">Copyright Protected. Property of {{ $page.props.websiteName }} - {{ currentYear }}.</p>
                                <Link
                                    :href="`https://mwangikanothe.com/#contact`"
                                    :target="`_blank`"
                                    class="text-green-300 rounded drop-shadow-sm hover:underline underline-offset-4">
                                    Developer
                                </Link>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>

        </div>
    </div>
</template>
