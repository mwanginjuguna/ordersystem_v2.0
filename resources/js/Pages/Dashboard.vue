<script setup>
import ClientLayout from '@/Layouts/ClientLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Panel from "../Components/Panel.vue";
import {defineProps} from "vue";

const props = defineProps({
    orders: Object
})

let completed = 0;
let recent = 0;
let pending = 0;
let running = 0;
let submitted = 0;
let disputed = 0;
let revision = 0;
let cancelled = 0;

for (let order of Object.values(props.orders)) {
    if (order.status === 'complete') {
        completed++;
    }
    if (order.status === 'pending') {
        pending++;
    }
    if (order.status === 'new') {
        recent++;
    }
    if (order.status === 'running') {
        running++;
    }
    if (order.status === 'submitted') {
        submitted++;
    }
    if (order.status === 'revision') {
        revision++;
    }
    if (order.status === 'disputed') {
        disputed++;
    }
    if (order.status === 'cancelled') {
        cancelled++;
    }
}

function formatTime(time) {
    // Create a new Date object from the given time string.
    const date = new Date(time);

    // Get the difference between the current time and the given time.
    const diff = date.getTime() - Date.now();

    // Convert the difference to days, hours, and minutes.
    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));

    // Check if the given time is in the past or future.
    const isPast = diff < 0;

    // Return a human readable string of the time difference.
    return `${days ? days + " days " : ""}${hours ? hours + " hrs " : ""}${minutes} min ${isPast ? "ago" : "from now"}`;
}
</script>

<template>
    <Head title="Dashboard" />

    <ClientLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="">
            <div class="pb-3 lg:mb-6 md:mx-8 flex flex-wrap justify-between">
                <h4 class="font-bold text-xl text-indigo-900 font-serif">
                    Orders
                </h4>
                <Link
                    :href="route('orders.new')"
                    class="p-2 px-4 mr-12 bg-purple-200 text-slate-900 hover:underline border border-slate-700 rounded hover:bg-purple-300 hover:text-slate-800 active:bg-purple-400 active:ring-slate-900 transition ease-in-out hover:duration-500 active:duration-500"
                >
                    New Order
                </Link>
            </div>

            <div class="grid sm:grid-cols-3 mt-3 gap-y-3 px-4 md:px-8">
                <div class="w-fit p-2 px-4 grid grid-cols-3 gap-x-2 bg-amber-400 rounded-md">
                    <svg width="44px" height="44px" class="place-self-center" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M18.5 5.5H11.5V12.5H18.5V5.5ZM10 4V14H20V4H10Z" fill="#a30fcc"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M7 8H8.5V15.5H16V17H7V8Z" fill="#a30fcc"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M4 11H5.5V18.5H13V20H4V11Z" fill="#a30fcc"></path> </g>
                    </svg>
                    <div class="col-span-2 pl-2">
                        <p class="text-xl font-bold text-slate-900">{{ orders.length }}</p>
                        <h2 class="mt-px text-slate-600 text-sm font-semibold">Total Orders</h2>
                    </div>
                </div>

                <div class="w-fit p-2 px-4 grid grid-cols-3 gap-x-2 bg-amber-400 rounded-md">
                    <svg width="44px" height="44px" class="place-self-center" viewBox="0 0 64 64" data-name="Layer 1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#274c77" class="cls-4" d="M46.2,32c0-.9,.3-1.72,.8-2.4-.36-2.14-1.2-4.11-2.4-5.81-.83-.13-1.63-.49-2.26-1.13s-1.01-1.44-1.13-2.26c-1.7-1.2-3.67-2.04-5.81-2.4-.67,.5-1.5,.8-2.4,.8s-1.72-.3-2.4-.8c-2.14,.36-4.11,1.2-5.81,2.4-.13,.83-.49,1.63-1.13,2.26s-1.44,1.01-2.26,1.13c-1.2,1.7-2.04,3.67-2.4,5.81,.5,.67,.8,1.5,.8,2.4s-.3,1.72-.8,2.4c.36,2.14,1.2,4.11,2.4,5.81,.83,.13,1.63,.49,2.26,1.13,.64,.64,1.01,1.44,1.13,2.26,1.7,1.2,3.67,2.04,5.81,2.4,.67-.5,1.5-.8,2.4-.8s1.72,.3,2.4,.8c2.14-.36,4.11-1.2,5.81-2.4,.13-.83,.49-1.63,1.13-2.26,.64-.64,1.44-1.01,2.26-1.13,1.2-1.7,2.04-3.67,2.4-5.81-.5-.67-.8-1.5-.8-2.4Z"></path><circle fill="#fa7900" cx="33" cy="32" r="9"></circle><path fill="#9d5fb9" d="M7,32c0-14.36,11.64-26,26-26v4c-12.15,0-22,9.85-22,22"></path><polygon fill="#fa1500" points="9 38 5 32 13 32 9 38"></polygon><path fill="#9d5fb9" d="M46,54.51c-12.44,7.18-28.34,2.92-35.52-9.52l3.46-2c6.08,10.52,19.53,14.13,30.05,8.05"></path><polygon fill="#fa1500" points="50.19 49.78 47 56.25 43 49.32 50.19 49.78"></polygon><path fill="#9d5fb9" d="M46,9.48c12.44,7.18,16.7,23.08,9.52,35.52l-3.46-2c6.08-10.52,2.47-23.98-8.05-30.05"></path><polygon fill="#fa1500" points="39.8 8.21 47 7.75 43 14.68 39.8 8.21"></polygon></g>
                    </svg>
                    <div class="col-span-2 pl-2">
                        <p class="text-xl font-bold text-slate-900">{{ running }}</p>
                        <h2 class="mt-px text-slate-600 text-sm font-semibold">In-Progress</h2>
                    </div>
                </div>

                <div class="w-fit p-2 px-4 grid grid-cols-3 gap-x-2 bg-amber-400 rounded-md">
                    <svg width="44px" height="44px" class="place-self-center" viewBox="0 0 64 64" data-name="Layer 1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title></title><path class="fill-[#65a30d]" d="M28.46,42.29A2,2,0,0,1,27,41.71l-9.5-9.5a2,2,0,0,1,2.83-2.83l8.09,8.09L43.63,22.29a2,2,0,1,1,2.83,2.83L29.87,41.71A2,2,0,0,1,28.46,42.29Z"></path><path class="fill-[#bb00ff]" d="M32,60A28,28,0,1,1,60,30.47a2,2,0,0,1-1.88,2.11A2,2,0,0,1,56,30.69,24,24,0,1,0,39.64,54.75,23.86,23.86,0,0,0,53.58,42.51a2,2,0,1,1,3.59,1.75A27.78,27.78,0,0,1,40.91,58.55,28.14,28.14,0,0,1,32,60Z"></path></g>
                    </svg>
                    <div class="col-span-2 pl-2">
                        <p class="text-xl font-bold text-slate-900">{{ completed }}</p>
                        <h2 class="mt-px text-slate-600 text-sm font-semibold">Completed</h2>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mt-6 mx-auto">
                <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <!--stats-->
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:w-[92%] px-4 sm:px-8 md:pt-4 pb-3 md:pb-6 place-content-center text-slate-900 md border-t">
                        <div class="grid gap-y-2">
                            <Link :href="route('orders.submitted')"
                                  class="mt-3 p-1 px-2 w-44 lg:w-60 flex justify-between items-center rounded bg-purple-200 hover:underline"
                            >
                                <div class="">
                                    <p class="text-xs md:text-sm font-semibold">Submitted Orders</p>
                                    <p class="text-lg font-bold">{{ submitted }}</p>

                                </div>

                                <div class="p-1.5 h-fit place-self-center bg-slate-700 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 15v4c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2v-4M17 9l-5 5-5-5M12 12.8V2.5"/></svg>
                                </div>

                            </Link>

                            <Link :href="route('orders.revision')"
                                  class="p-1 px-2 w-44 lg:w-60 flex justify-between align-middle rounded bg-amber-200 hover:underline"
                            >
                                <div class="">
                                    <p class="text-xs md:text-sm font-semibold">Orders under revision</p>
                                    <p class="text-lg font-bold">{{ revision }}</p>

                                </div>

                                <div class="p-1.5 h-fit place-self-center bg-slate-700 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 2v6h6M2.66 15.57a10 10 0 1 0 .57-8.38"/></svg>
                                </div>

                            </Link>
                        </div>

                        <div class="grid gap-y-2">
                            <Link :href="route('orders.recents')"
                                  class="mt-3 p-1 px-2 w-44 lg:w-60 flex justify-between items-center rounded bg-amber-200 hover:underline"
                            >
                                <div class="">
                                    <p class="text-xs md:text-sm font-semibold">New Orders</p>
                                    <p class="text-lg font-bold">{{ recent }}</p>
                                </div>

                                <div class="p-1.5 h-fit place-self-center bg-slate-700 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 17l5-5-5-5"/><path d="M13.8 12H3m9 10a10 10 0 1 0 0-20"/></svg>
                                </div>
                            </Link>

                            <Link :href="route('orders.pending')"
                                  class="p-1 px-2 w-44 lg:w-60 flex justify-between align-middle rounded bg-purple-200 hover:underline"
                            >
                                <div class="">
                                    <p class="text-xs md:text-sm font-semibold">Pending Orders</p>
                                    <p class="text-lg font-bold">{{ pending }}</p>
                                </div>

                                <div class="p-1.5 h-fit place-self-center bg-slate-700 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.5 2v6h-6M2.5 22v-6h6M2 11.5a10 10 0 0 1 18.8-4.3M22 12.5a10 10 0 0 1-18.8 4.2"/></svg>
                                </div>
                            </Link>
                        </div>

                        <div class="grid gap-y-2">

                            <Link :href="route('orders.disputed')"
                                  class="mt-3 p-1 px-2 w-44 lg:w-60 flex justify-between align-middle rounded bg-purple-200 hover:underline"
                            >
                                <div class="">
                                    <p class="text-xs md:text-sm font-semibold">Disputed Orders</p>
                                    <p class="text-lg font-bold">{{ disputed }}</p>

                                </div>

                                <div class="p-1.5 h-fit place-self-center bg-slate-700 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                </div>

                            </Link>

                            <Link :href="route('orders.cancelled')"
                                  class="mt-3 p-1 px-2 w-44 lg:w-60 flex justify-between align-middle rounded bg-amber-200 hover:underline"
                            >
                                <div class="">
                                    <p class="text-xs md:text-sm font-semibold">Cancelled Orders</p>
                                    <p class="text-lg font-bold">{{ cancelled }}</p>

                                </div>

                                <div class="p-1.5 h-fit place-self-center bg-slate-700 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                                </div>
                            </Link>
                        </div>
                    </div>

                    <!--recent orders-->
                    <Panel class="bg-fuchsia-50 mt-3 lg:py-6 col-span-2">
                        <template v-slot:heading>
                            <h4 class="font-bold px-3 border-b border-purple-200">Recent Activity</h4>
                        </template>
                        <template v-slot:default>
                            <section class="grid divide-y gap-y-5">
                                <div class="" v-for="(order, index) in orders" :key="order.id">
                                    <div v-if="index < 5" class="px-3 pt-2 grid grid-cols-4 gap-x-2 text-sm place-content-center" >
                                        <Link :href="route('orders.show', order.id)" class="col-span-4 py-2 text-blue-800 hover:underline underline-offset-4 font-semibold">
                                            Order #{{ order.id }} - {{ order.title }}
                                        </Link>
                                        <p class="text-slate-500">
                                            Status:
                                            <span class="text-slate-800 font-semibold">
                                                {{ order.status }}
                                            </span>
                                        </p>
                                        <p class="col-span-2">Deadline:
                                            <span :class="formatTime(order.due_at).endsWith('ago') ? `text-red-500` : `text-green-500` " class="text-xs">
                                            {{ formatTime(order.due_at) }}
                                            </span>
                                        </p>
                                        <Link :class="`pl-3 text-sky-500 hover:text-sky-700 hover:font-semibold underline`"
                                              :href="route('orders.show', order.id)"
                                        >
                                            View
                                        </Link>
                                    </div>
                                </div>
                            </section>
                        </template>
                        <template v-slot:footer>
                            <Link :href="route('orders.running')"
                                  :class="`text-purple-500 hover:text-purple-700 underline underline-offset-4 hover:decoration-dotted`"
                            >
                                Orders in Progress
                            </Link>
                        </template>
                    </Panel>
                </div>
            </div>
        </div>
    </ClientLayout>
</template>
