<script setup>
import Accordion from './Accordion.vue';
import ApplicationLogo from './ApplicationLogo.vue';
import {Link} from "@inertiajs/inertia-vue3";

</script>

<template>
    <div class="py-6 flex text-slate-900 items-center">
        <!-- Logo -->
        <div class="shrink-0">
            <Link :href="route('home')">
                <ApplicationLogo
                    class="block h-12 w-auto fill-current"
                />
            </Link>
        </div>

        <div>
            <p class="pl-2 text-xs">Welcome, Admin.</p>
            <h4 class="font-bold my-auto pl-2">{{ $page.props.websiteName }}</h4>
        </div>

    </div>

    <div class="flex flex-col space-y-6 mt-6">
        <div class="flex items-center">
            <Link href="/orders/new" class="bg-purple-600 text-xs hover:bg-purple-700 underline flex items-center justify-center text-gray-100 py-2 rounded lg:space-x-2 transition duration-150 px-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                <span>New Order</span>
            </Link>
        </div>
        <div>
            <h3 class="pb-2 border-b border-slate-300 font-semibold"> Orders</h3>

            <div class="grid gap-y-3 mt-2 font-semibold text-sm">
                <Link :href="route('admin.orders.pending')" class="p-2 flex flex-wrap space-x-4 bg-gray-200 rounded hover:bg-gray-300 hover:text-purple-800 hover:underline items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7e22ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.5 2v6h-6M2.5 22v-6h6M2 11.5a10 10 0 0 1 18.8-4.3M22 12.5a10 10 0 0 1-18.8 4.2"/></svg>
                    <span>Pending</span>
                </Link>
                <Link :href="route('admin.orders.recents')" class="p-2 flex flex-wrap space-x-4 items-center bg-gray-200 rounded hover:bg-gray-300 hover:text-purple-800 hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#7e22ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 17l5-5-5-5"/><path d="M13.8 12H3m9 10a10 10 0 1 0 0-20"/></svg>
                    <span>Recent</span>
                </Link>
                <Link :href="route('admin.orders.submitted')" class="p-2 flex flex-wrap space-x-4 items-center bg-gray-200 rounded hover:bg-gray-300 hover:text-purple-800 hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#7e22ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 15v4c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2v-4M17 9l-5 5-5-5M12 12.8V2.5"/></svg>
                    <span>Submitted</span>
                </Link>

                <Link :href="route('admin.orders.completed')" class="p-2 flex flex-wrap space-x-4 items-center bg-gray-200 rounded hover:bg-gray-300 hover:text-purple-800 hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#7e22ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    <span>Completed</span>
                </Link>

                <Link :href="route('admin.orders.running')" class="p-2 flex flex-wrap space-x-4 items-center bg-gray-200 rounded hover:bg-gray-300 hover:text-purple-800 hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#7e22ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                    <span>In Progress</span>
                </Link>

                <Link :href="route('admin.orders.revision')" class="p-2 flex flex-wrap space-x-4 items-center bg-gray-200 rounded hover:bg-gray-300 hover:text-purple-800 hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#7e22ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 2v6h6M2.66 15.57a10 10 0 1 0 .57-8.38"/></svg>
                    <span>Revisions</span>
                </Link>

                <Link :href="route('admin.orders.disputed')" class="p-2 flex flex-wrap space-x-4 items-center bg-gray-200 rounded hover:bg-gray-300 hover:text-purple-800 hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#7e22ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                    <span>Disputed</span>
                </Link>

                <Link href="admin/orders/cancelled" class="p-2 flex flex-wrap space-x-4 items-center bg-gray-200 rounded hover:bg-gray-300 hover:text-purple-800 hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#7e22ce" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                    <span>Cancelled</span>
                </Link>

            </div>
        </div>

        <ul class="mt-2 pt-4 flex flex-col space-y-3 border-t">
            <li>
                <Link :href="`#`" class="pt-3 flex flex-wrap space-x-4 bg-gray-200 hover:bg-gray-300 rounded p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#d946ef" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    <span>Chatroom</span>
                </Link>
            </li>
            <li>
                <Link :href="`#`" class="pt-3 flex flex-wrap space-x-4 bg-gray-200 hover:bg-gray-300 rounded p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#ca8a04" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                    <span>Messages</span>
                </Link>
            </li>
            <!--<li>
                <Link class="pt-3 flex flex-wrap space-x-4 bg-gray-700 rounded p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#6d28d9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                    <span>Tasks</span>
                </Link>
            </li>-->
            <li>
                <Link href="/admin/writer_categories" class="pt-3 flex flex-wrap space-x-4 bg-gray-200 hover:bg-gray-300 rounded p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#28d9ba" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    <span>Writers</span>
                </Link>
            </li>
        </ul>

        <!--Settings-->
        <Accordion>
            <template v-slot:title>
                <span class="font-semibold">Settings</span>
            </template>
            <template v-slot:content>
                <a class="pt-3 flex flex-wrap space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#a78bfa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                    <span>All settings</span>
                </a>
                <Link href="/admin/levels" class="pt-3 flex flex-wrap space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#a78bfa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="20" x2="12" y2="10"></line><line x1="18" y1="20" x2="18" y2="4"></line><line x1="6" y1="20" x2="6" y2="16"></line></svg>
                    <span>Ed. Levels</span>
                </Link>

                <a class="pt-3 flex flex-wrap space-x-4" href="/admin/subjects">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#a78bfa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/><path d="M14 3v5h5M16 13H8M16 17H8M10 9H8"/></svg>
                    <span>Subjects</span>
                </a>

                <a class="pt-3 flex flex-wrap space-x-4" href="/admin/services">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#a78bfa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                    <span>Services</span>
                </a>

                <a class="pt-3 flex flex-wrap space-x-4" href="/admin/styles">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#a78bfa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                    <span>Style/Spacing</span>
                </a>

                <a class="pt-3 flex flex-wrap space-x-4" href="/admin/extras">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#a78bfa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 11.08V8l-6-6H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h6"/><path d="M14 3v5h5M18 21v-6M15 18h6"/></svg>
                    <span>Extras</span>
                </a>

                <a class="pt-3 flex flex-wrap space-x-4" href="/admin/languages">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#a78bfa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="10" r="3"/><path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 6.9 8 11.7z"/></svg>
                    <span>Languages</span>
                </a>

                <a class="pt-3 flex flex-wrap space-x-4" href="/admin/pricings">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#a78bfa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                    <span>Pricing</span>
                </a>

                <a class="pt-3 flex flex-wrap space-x-4" href="/admin/currencies">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#a78bfa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    <span>Currencies</span>
                </a>

                <a class="pt-3 flex flex-wrap space-x-4" href="/admin/discounts">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#a78bfa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="5" x2="5" y2="19"></line><circle cx="6.5" cy="6.5" r="2.5"></circle><circle cx="17.5" cy="17.5" r="2.5"></circle></svg>
                    <span>Discounts</span>
                </a>

            </template>
        </Accordion>
    </div>
</template>
