<script setup>
import BaseLayout from '../../Layouts/BaseLayout.vue';
import OrdersCard from '../../Components/OrdersCard.vue';
import {Head, Link} from "@inertiajs/inertia-vue3";
import Panel from "../../Components/Panel.vue";
import NavLink from "../../Components/NavLink.vue";
import {useFormatTime} from "@/Composables/useFornatedTime";

let { formatTime } = useFormatTime();

const props = defineProps({
    orders: Object
});

let completed = 0;
let recent = 0;
let pending = 0;
let running = 0;
let submitted = 0;
let disputed = 0;
let revision = 0;
let cancelled = 0;
let totalAmount = 0;
let pendingAmount = 0;
let paidAmount = 0;

for (let order of Object.values(props.orders)) {
    totalAmount += order.amount;
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

    if (order.paid === 1) {
        paidAmount += order.amount
    }
    if (order.paid === 0) {
        pendingAmount += order.amount
    }

}

</script>

<template>
    <Head title="Admin Page" />
    <BaseLayout>
        <template v-slot:header>
            <h1 class="font-bold text-xl lg:text-4xl text-slate-900">Admin Dashboard</h1>
        </template>

        <template v-slot:default>
            <div class="">
                <div class="pb-3 lg:mb-6 grid sm:grid-cols-3 gap-y-3 px-4 md:px-8">
                    <h3 class="sm:col-span-3 md:mt-4 mt-2 md:mb-3 text-xl font-bold font-serif text-slate-800 border-b">
                        Overview of Finances & Earnings
                    </h3>

                    <div class="min-w-fit w-2/3 md:w-fit p-2 px-4 grid grid-cols-3 gap-x-2 bg-orange-600 hover:bg-orange-700 rounded-md transition-all duration-150 ease-in-out">
                        <svg width="44px" height="44px" class="iconify iconify--noto place-self-center" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" preserveAspectRatio="xMidYMid meet" fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g fill="none"> <path d="M93.46 39.45c6.71-1.49 15.45-8.15 16.78-11.43c.78-1.92-3.11-4.92-4.15-6.13c-2.38-2.76-1.42-4.12-.5-7.41c1.05-3.74-1.44-7.87-4.97-9.49s-7.75-1.11-11.3.47c-3.55 1.58-6.58 4.12-9.55 6.62c-2.17-1.37-5.63-7.42-11.23-3.49c-3.87 2.71-4.22 8.61-3.72 13.32c1.17 10.87 3.85 16.51 8.9 18.03c6.38 1.92 13.44.91 19.74-.49z" fill="#FFCA28"> </path> <path d="M104.36 8.18c-.85 14.65-15.14 24.37-21.92 28.65l4.4 3.78s2.79.06 6.61-1.16c6.55-2.08 16.12-7.96 16.78-11.43c.97-5.05-4.21-3.95-5.38-7.94c-.61-2.11 2.97-6.1-.49-11.9zm-24.58 3.91s-2.55-2.61-4.44-3.8c-.94 1.77-1.61 3.69-1.94 5.67c-.59 3.48 0 8.42 1.39 12.1c.22.57 1.04.48 1.13-.12c1.2-7.91 3.86-13.85 3.86-13.85z" fill="#E2A610"> </path> <path d="M61.96 38.16S30.77 41.53 16.7 68.61c-14.07 27.08-2.11 43.5 10.55 49.48c12.66 5.98 44.56 8.09 65.31 3.17s25.94-15.12 24.97-24.97c-1.41-14.38-14.77-23.22-14.77-23.22s.53-17.76-13.25-29.29c-12.23-10.24-27.55-5.62-27.55-5.62z" fill="#FFCA28"> </path> <path d="M74.76 83.73c-6.69-8.44-14.59-9.57-17.12-12.6c-1.38-1.65-2.19-3.32-1.88-5.39c.33-2.2 2.88-3.72 4.86-4.09c2.31-.44 7.82-.21 12.45 4.2c1.1 1.04.7 2.66.67 4.11c-.08 3.11 4.37 6.13 7.97 3.53c3.61-2.61.84-8.42-1.49-11.24c-1.76-2.13-8.14-6.82-16.07-7.56c-2.23-.21-11.2-1.54-16.38 8.31c-1.49 2.83-2.04 9.67 5.76 15.45c1.63 1.21 10.09 5.51 12.44 8.3c4.07 4.83 1.28 9.08-1.9 9.64c-8.67 1.52-13.58-3.17-14.49-5.74c-.65-1.83.03-3.81-.81-5.53c-.86-1.77-2.62-2.47-4.48-1.88c-6.1 1.94-4.16 8.61-1.46 12.28c2.89 3.93 6.44 6.3 10.43 7.6c14.89 4.85 22.05-2.81 23.3-8.42c.92-4.11.82-7.67-1.8-10.97z" fill="#6B4B46"> </path> <path d="M71.16 48.99c-12.67 27.06-14.85 61.23-14.85 61.23" stroke="#6B4B46" stroke-width="5" stroke-miterlimit="10"> </path> <path d="M81.67 31.96c8.44 2.75 10.31 10.38 9.7 12.46c-.73 2.44-10.08-7.06-23.98-6.49c-4.86.2-3.45-2.78-1.2-4.5c2.97-2.27 7.96-3.91 15.48-1.47z" fill="#6D4C41"> </path> <path d="M81.67 31.96c8.44 2.75 10.31 10.38 9.7 12.46c-.73 2.44-10.08-7.06-23.98-6.49c-4.86.2-3.45-2.78-1.2-4.5c2.97-2.27 7.96-3.91 15.48-1.47z" fill="#6B4B46"> </path> <path d="M96.49 58.86c1.06-.73 4.62.53 5.62 7.5c.49 3.41.64 6.71.64 6.71s-4.2-3.77-5.59-6.42c-1.75-3.35-2.43-6.59-.67-7.79z" fill="#E2A610"> </path> </g> </g></svg>

                        <div class="col-span-2 pl-2">
                            <p class="text-xl lg:text-2xl font-bold text-slate-50">$ {{ totalAmount.toFixed(2) }}</p>
                            <h2 class="mt-px text-slate-200 text-sm font-semibold">Total Projected</h2>
                        </div>
                    </div>

                    <div class="min-w-fit w-2/3 md:w-fit p-2 px-4 grid grid-cols-3 gap-x-2 bg-purple-600 hover:bg-purple-700 rounded-md transition-all duration-150 ease-in-out">
                        <svg width="44px" height="44px" class="place-self-center" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 503.467 503.467" xml:space="preserve" fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g transform="translate(1 1)"> <path style="fill:#8AFFD8;" d="M250.733,233.667c9.387,0,17.067,7.68,17.067,17.067s-7.68,17.067-17.067,17.067 c-9.387,0-17.067-7.68-17.067-17.067S241.347,233.667,250.733,233.667"></path> <path style="fill:#AAB1BA;" d="M498.2,250.733c0,29.013-5.12,56.32-14.507,81.92c-0.853-1.707-2.56-4.267-3.413-5.973 c-0.853-1.707-2.56-4.267-4.267-5.973l0,0c-1.707-1.707-2.56-3.413-4.267-5.12c-1.707-1.707-3.413-3.413-5.12-5.12 c-1.707-1.707-3.413-3.413-5.12-5.12l0,0c-0.853-0.853-2.56-2.56-3.413-3.413c4.267-16.213,5.973-33.28,5.973-51.2 c0-117.76-95.573-213.333-213.333-213.333C132.973,37.4,37.4,132.973,37.4,250.733c0,56.32,21.333,106.667,57.173,145.067H50.2 C20.333,354.84,3.267,305.346,3.267,250.733C3.267,114.2,114.2,3.266,250.733,3.266S498.2,114.2,498.2,250.733"></path> <path style="fill:#FFE079;" d="M483.693,333.507c9.387,16.213,14.507,34.133,14.507,53.76c0,61.44-49.493,110.933-110.933,110.933 c-58.027,0-105.813-45.227-110.08-102.4c0-1.707,0-2.56,0-4.267c0-1.707,0-2.56,0-4.267c0-61.44,49.493-110.933,110.933-110.933 c1.707,0,3.413,0,5.973,0c0.853,0,0.853,0,1.707,0h0.853c0.853,0,1.707,0,2.56,0c0.853,0,0.853,0,1.707,0c0.853,0,1.707,0,2.56,0 s0.853,0,1.707,0l0,0h0.853c0.853,0,1.707,0,3.413,0.853l0,0c0.853,0,0.853,0,1.707,0c0.853,0,0.853,0,1.707,0 c1.707,0,2.56,0.853,4.267,0.853h0.853c0.853,0,0.853,0,1.707,0.853c0.853,0,0.853,0,1.707,0.853 c1.707,0.853,3.413,0.853,5.12,1.707c2.56,0.853,5.12,1.707,7.68,2.56c1.707,0.853,2.56,1.707,4.267,1.707 c0.853,0,0.853,0,0.853,0.853c1.707,0.853,3.413,1.707,5.12,2.56c0.853,0,1.707,0.853,2.56,0.853s1.707,0.853,1.707,0.853 c3.413,2.56,7.68,5.12,11.093,8.533c0.853,0.853,2.56,1.707,3.413,3.413l0,0c1.707,1.707,3.413,3.413,5.12,5.12 c1.707,1.707,3.413,3.413,5.12,5.12c1.707,1.707,3.413,3.413,4.267,5.973l0,0c1.707,1.707,2.56,3.413,4.267,5.973 C481.133,329.24,482.84,330.947,483.693,333.507L483.693,333.507z"></path> <path style="fill:#ECF4F7;" d="M464.067,250.733c0,17.067-2.56,34.987-5.973,51.2c-0.853,0-0.853-0.853-0.853-0.853 c-2.56-1.707-4.267-3.413-6.827-5.12c-0.853-0.853-2.56-1.707-3.413-2.56c-0.853-0.853-1.707-0.853-1.707-0.853 c-0.853-0.853-1.707-0.853-2.56-1.707c-1.707-0.853-3.413-1.707-5.12-2.56c0,0-0.853,0-0.853-0.853 c-0.853,0-1.707-0.853-2.56-0.853s-0.853-0.853-1.707-0.853c-2.56-0.853-5.12-1.707-7.68-3.413 c-1.707-0.853-3.413-0.853-5.12-1.707c-0.853,0-0.853,0-1.707-0.853c-0.853,0-0.853,0-1.707-0.853c-0.853,0-0.853,0-0.853,0 c-1.707,0-2.56-0.853-4.267-0.853c-0.853,0-1.707,0-1.707-0.853c-0.853,0-0.853,0-1.707,0l0,0c-0.853,0-1.707,0-3.413-0.853h-0.853 l0,0c-0.853,0-0.853,0-1.707,0c-0.853,0-1.707,0-2.56,0c-0.853,0-0.853,0-1.707,0c-0.853,0-1.707,0-2.56,0h-0.853 c-0.853,0-0.853,0-1.707,0c-1.707,0-3.413,0-5.973,0c-61.44,0-110.933,49.493-110.933,110.933c0,1.707,0,2.56,0,4.267 c0,1.707,0,2.56,0,4.267h-34.987h-51.2H155.16h-34.133h-28.16c-34.987-38.4-57.173-88.747-57.173-145.067 c0-117.76,95.573-213.333,213.333-213.333S464.067,132.973,464.067,250.733 M267.8,250.733c0-9.387-7.68-17.067-17.067-17.067 c-9.387,0-17.067,7.68-17.067,17.067s7.68,17.067,17.067,17.067C260.12,267.8,267.8,260.12,267.8,250.733"></path> <path style="fill:#7EE1E6;" d="M277.187,395.8H3.267v102.4h307.2v-30.72C291.693,448.707,278.893,423.96,277.187,395.8 L277.187,395.8z"></path> </g> <path style="fill:#51565F;" d="M388.267,503.467c-63.147,0-115.2-52.053-115.2-115.2s52.053-115.2,115.2-115.2 s115.2,52.053,115.2,115.2S451.413,503.467,388.267,503.467z M388.267,281.6c-58.88,0-106.667,47.787-106.667,106.667 s47.787,106.667,106.667,106.667s106.667-47.787,106.667-106.667S447.147,281.6,388.267,281.6z M294.4,503.467H192 c-2.56,0-4.267-1.707-4.267-4.267c0-2.56,1.707-4.267,4.267-4.267h102.4c2.56,0,4.267,1.707,4.267,4.267 C298.667,501.76,296.96,503.467,294.4,503.467z M157.867,503.467c-2.56,0-4.267-1.707-4.267-4.267V396.8 c0-2.56,1.707-4.267,4.267-4.267c2.56,0,4.267,1.707,4.267,4.267v102.4C162.133,501.76,160.427,503.467,157.867,503.467z M123.733,503.467H4.267C1.707,503.467,0,501.76,0,499.2c0-2.56,1.707-4.267,4.267-4.267h119.467c2.56,0,4.267,1.707,4.267,4.267 C128,501.76,126.293,503.467,123.733,503.467z M261.973,469.333H192c-2.56,0-4.267-1.707-4.267-4.267S189.44,460.8,192,460.8h69.973 c2.56,0,4.267,1.707,4.267,4.267S264.533,469.333,261.973,469.333z M123.733,469.333H4.267c-2.56,0-4.267-1.707-4.267-4.267 s1.707-4.267,4.267-4.267h119.467c2.56,0,4.267,1.707,4.267,4.267S126.293,469.333,123.733,469.333z M388.267,452.267 c-2.56,0-4.267-1.707-4.267-4.267v-4.267c-14.507-1.707-25.6-14.507-25.6-29.867c0-2.56,1.707-4.267,4.267-4.267 s4.267,1.707,4.267,4.267c0,11.947,9.387,21.333,21.333,21.333c11.947,0,21.333-9.387,21.333-21.333 c0-11.947-9.387-21.333-21.333-21.333c-16.213,0-29.867-13.653-29.867-29.867c0-15.36,11.093-27.307,25.6-29.867v-4.267 c0-2.56,1.707-4.267,4.267-4.267s4.267,1.707,4.267,4.267v4.267c14.507,1.707,25.6,14.507,25.6,29.867 c0,2.56-1.707,4.267-4.267,4.267s-4.267-1.707-4.267-4.267c0-11.947-9.387-21.333-21.333-21.333 c-11.947,0-21.333,9.387-21.333,21.333c0,11.947,9.387,21.333,21.333,21.333c16.213,0,29.867,13.653,29.867,29.867 c0,15.36-11.093,27.307-25.6,29.867V448C392.533,450.56,390.827,452.267,388.267,452.267z M247.467,435.2H192 c-2.56,0-4.267-1.707-4.267-4.267s1.707-4.267,4.267-4.267h55.467c2.56,0,4.267,1.707,4.267,4.267S250.027,435.2,247.467,435.2z M123.733,435.2H4.267c-2.56,0-4.267-1.707-4.267-4.267s1.707-4.267,4.267-4.267h119.467c2.56,0,4.267,1.707,4.267,4.267 S126.293,435.2,123.733,435.2z M243.2,401.067H192c-2.56,0-4.267-1.707-4.267-4.267c0-2.56,1.707-4.267,4.267-4.267h51.2 c2.56,0,4.267,1.707,4.267,4.267C247.467,399.36,245.76,401.067,243.2,401.067z M123.733,401.067H4.267 C1.707,401.067,0,399.36,0,396.8c0-2.56,1.707-4.267,4.267-4.267h119.467c2.56,0,4.267,1.707,4.267,4.267 C128,399.36,126.293,401.067,123.733,401.067z M30.72,367.787c-1.707,0-3.413-0.853-3.413-2.56C9.387,330.24,0,291.84,0,251.733 C0,112.64,112.64,0,251.733,0s251.733,112.64,251.733,251.733c0,11.093,0,26.453-2.56,37.547c-0.853,2.56-2.56,3.413-5.12,3.413 c-2.56-0.853-3.413-2.56-3.413-5.12c2.56-10.24,2.56-25.6,2.56-34.987c0-134.827-109.227-244.053-243.2-244.053 c-133.973,0-243.2,109.227-243.2,243.2c0,38.4,8.533,75.093,26.453,109.227c0.853,1.707,0,4.267-1.707,5.973 C32.427,367.787,31.573,367.787,30.72,367.787z M69.973,366.933c-1.707,0-2.56-0.853-3.413-1.707 c-20.48-34.133-31.573-73.387-31.573-113.493c0-120.32,97.28-217.6,217.6-217.6s217.6,97.28,217.6,217.6c0,0,0,6.827-0.853,11.947 c-0.853,2.56-2.56,3.413-5.12,3.413c-2.56-0.853-4.267-2.56-3.413-5.12c0.853-4.267,0.853-10.24,0.853-10.24 c0-116.053-93.867-209.92-209.067-209.92S43.52,135.68,43.52,250.88c0,38.4,10.24,75.947,30.72,109.227 c0.853,1.707,0.853,4.267-1.707,5.973C70.827,366.933,70.827,366.933,69.973,366.933z M95.573,345.6c-1.707,0-2.56-0.853-3.413-2.56 c0-0.853-0.853-1.707-0.853-2.56c0-1.707,0.853-2.56,1.707-3.413l7.68-4.267c1.707-0.853,4.267-0.853,5.973,1.707 c0,0.853,0.853,1.707,0.853,2.56c0,1.707-0.853,2.56-1.707,3.413l-7.68,4.267C96.427,345.6,96.427,345.6,95.573,345.6z M251.733,273.067c-10.24,0-18.773-7.68-20.48-17.067h-98.987c-2.56,0-4.267-1.707-4.267-4.267s1.707-4.267,4.267-4.267h98.987 c1.707-8.533,8.533-15.36,16.213-16.213V72.533c0-2.56,1.707-4.267,4.267-4.267c2.56,0,4.267,1.707,4.267,4.267v158.72 c8.533,1.707,15.36,8.533,17.067,16.213h12.8c2.56,0,4.267,1.707,4.267,4.267S288.427,256,285.867,256h-12.8 C270.507,265.387,261.973,273.067,251.733,273.067z M251.733,238.933c-6.827,0-12.8,5.973-12.8,12.8s5.973,12.8,12.8,12.8 c6.827,0,12.8-5.973,12.8-12.8S258.56,238.933,251.733,238.933z M98.133,256h-25.6c-2.56,0-4.267-1.707-4.267-4.267 s1.707-4.267,4.267-4.267h25.6c2.56,0,4.267,1.707,4.267,4.267S100.693,256,98.133,256z M401.067,170.667 c-1.707,0-2.56-0.853-3.413-2.56c0-0.853-0.853-1.707-0.853-2.56c0-1.707,0.853-2.56,2.56-3.413l7.68-4.267 c1.707-0.853,4.267-0.853,5.973,1.707c0,0.853,0.853,1.707,0.853,2.56c0,1.707-0.853,2.56-2.56,3.413l-7.68,4.267 C401.92,170.667,401.067,170.667,401.067,170.667z M103.253,168.107c-0.853,0-1.707,0-1.707-0.853l-7.68-4.267 c-1.707-0.853-2.56-2.56-2.56-3.413c0-0.853,0-1.707,0.853-2.56c0.853-1.707,3.413-2.56,5.973-1.707l7.68,4.267 c1.707,0.853,2.56,2.56,2.56,3.413c0,0.853,0,1.707-0.853,2.56C106.667,168.107,104.96,168.107,103.253,168.107z M339.627,107.52 c-0.853,0-1.707,0-2.56-0.853c-1.707-0.853-2.56-2.56-2.56-3.413s0-1.707,0.853-2.56l4.267-7.68c0.853-1.707,3.413-2.56,5.973-1.707 c1.707,0.853,2.56,2.56,2.56,3.413s0,1.707-0.853,2.56l-4.267,7.68C342.187,106.667,340.48,107.52,339.627,107.52z M166.4,106.667 c-1.707,0-2.56-0.853-3.413-1.707l-4.267-7.68c0-0.853-0.853-1.707-0.853-2.56c0-1.707,0.853-2.56,1.707-3.413 c1.707-0.853,4.267-0.853,5.973,1.707l4.267,7.68c0,0.853,0.853,1.707,0.853,2.56c0,1.707-0.853,2.56-1.707,3.413 C168.107,106.667,167.253,106.667,166.4,106.667z"></path> </g></svg>

                        <div class="col-span-2 pl-2">
                            <p class="text-xl lg:text-2xl font-bold text-slate-50">$ {{ (totalAmount - paidAmount).toFixed(2) }}</p>
                            <h2 class="mt-px text-slate-200 text-sm font-semibold">Pending Amount</h2>
                        </div>
                    </div>

                    <div class="min-w-fit w-2/3 md:w-fit p-2 px-4 grid grid-cols-3 gap-x-2 bg-green-600 hover:bg-green-700 rounded-md transition-all duration-150 ease-in-out">
                        <svg width="44px" height="44px" class="place-self-center" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 503.438 503.438" xml:space="preserve" fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g transform="translate(1 3)"> <path style="fill:#ffffff;" d="M3.267,479.119V257.252h51.2c9.387,0,17.067,7.68,17.067,17.067v17.067v119.467v51.2 c0,9.387-7.68,17.067-17.067,17.067H3.267z"></path> <path style="fill:#FFD0A1;" d="M361.667,376.719l98.133-47.787c11.947-6.827,28.16-2.56,34.987,9.387 c6.827,11.947,2.56,28.16-9.387,34.987l-115.2,71.68c0,0-25.6,17.067-85.333,17.067c-51.2,0-128-42.667-128-42.667 s-17.067-8.533-51.2-8.533H71.533V291.385h102.4c25.6,0,68.267,51.2,93.867,51.2H319c17.067,0,25.6,8.533,25.6,8.533 S361.667,359.652,361.667,376.719"></path> <g> <path style="fill:#FFE079;" d="M336.067,18.319c80.213,0,145.067,64.853,145.067,145.067S416.28,308.452,336.067,308.452 S191,243.599,191,163.385S255.853,18.319,336.067,18.319"></path> <path style="fill:#FFE079;" d="M336.067,274.319c-61.44,0-110.933-49.493-110.933-110.933S274.627,52.452,336.067,52.452 S447,101.945,447,163.385S397.507,274.319,336.067,274.319"></path> </g> </g> <path style="fill:#51565F;" d="M55.467,486.385h-51.2c-2.56,0-4.267-1.707-4.267-4.267c0-2.56,1.707-4.267,4.267-4.267h51.2 c6.827,0,12.8-5.973,12.8-12.8V277.319c0-6.827-5.973-12.8-12.8-12.8h-51.2c-2.56,0-4.267-1.707-4.267-4.267 s1.707-4.267,4.267-4.267h51.2c11.947,0,21.333,9.387,21.333,21.333v187.733C76.8,476.999,67.413,486.385,55.467,486.385z M285.867,469.319c-52.053,0-127.147-41.813-129.707-43.52l0,0c0,0-17.067-7.68-49.493-7.68c-2.56,0-4.267-1.707-4.267-4.267 s1.707-4.267,4.267-4.267c34.987,0,52.053,8.533,52.907,9.387c0.853,0.853,76.8,41.813,126.293,41.813 c57.173,0,82.773-16.213,82.773-16.213l115.2-71.68c5.12-2.56,8.533-7.68,10.24-12.8c1.707-5.12,0.853-11.093-2.56-16.213 c-3.413-5.12-7.68-8.533-12.8-10.24s-11.093-0.853-16.213,1.707l-98.133,47.787c-17.92,9.387-34.987,9.387-69.973,9.387 c-34.133,0-83.627-8.533-86.187-8.533s-4.267-2.56-3.413-5.12c0-2.56,2.56-4.267,5.12-3.413c0.853,0,51.2,8.533,84.48,8.533 s50.347,0,66.56-7.68l98.133-47.787c6.827-4.267,14.507-5.12,22.187-2.56c7.68,1.707,14.507,6.827,17.92,13.653 c4.267,6.827,5.12,15.36,3.413,23.04c-1.707,7.68-6.827,14.507-13.653,17.92l-115.2,71.68 C372.053,452.252,346.453,469.319,285.867,469.319z M25.6,443.719c-5.12,0-8.533-3.413-8.533-8.533s3.413-8.533,8.533-8.533 s8.533,3.413,8.533,8.533S30.72,443.719,25.6,443.719z M345.6,358.385c-0.853,0-2.56,0-3.413-0.853l0,0c0,0-7.68-7.68-22.187-7.68 h-51.2c-14.507,0-31.573-12.8-49.493-26.453c-16.213-11.947-33.28-24.747-44.373-24.747h-68.267c-2.56,0-4.267-1.707-4.267-4.267 s1.707-4.267,4.267-4.267h68.267c14.507,0,31.573,12.8,49.493,26.453c16.213,11.947,33.28,24.747,44.373,24.747H320 c18.773,0,28.16,9.387,29.013,9.387c1.707,1.707,1.707,4.267,0,5.973C348.16,358.385,346.453,358.385,345.6,358.385z M337.067,315.719c-81.92,0-149.333-67.413-149.333-149.333S255.147,17.052,337.067,17.052S486.4,84.465,486.4,166.385 S418.987,315.719,337.067,315.719z M337.067,25.585c-77.653,0-140.8,63.147-140.8,140.8s63.147,140.8,140.8,140.8 s140.8-63.147,140.8-140.8S414.72,25.585,337.067,25.585z M337.067,281.585c-63.147,0-115.2-52.053-115.2-115.2 s52.053-115.2,115.2-115.2s115.2,52.053,115.2,115.2S400.213,281.585,337.067,281.585z M230.4,166.385 c0,58.88,47.787,106.667,106.667,106.667s106.667-47.787,106.667-106.667S395.947,59.719,337.067,59.719 S230.4,107.506,230.4,166.385z M337.067,230.385c-2.56,0-4.267-1.707-4.267-4.267v-4.267c-14.507-1.707-25.6-14.507-25.6-29.867 c0-2.56,1.707-4.267,4.267-4.267s4.267,1.707,4.267,4.267c0,11.947,9.387,21.333,21.333,21.333s21.333-9.387,21.333-21.333 c0-11.947-9.387-21.333-21.333-21.333c-16.213,0-29.867-13.653-29.867-29.867c0-15.36,11.093-27.307,25.6-29.867v-4.267 c0-2.56,1.707-4.267,4.267-4.267s4.267,1.707,4.267,4.267v4.267c14.507,1.707,25.6,14.507,25.6,29.867 c0,2.56-1.707,4.267-4.267,4.267s-4.267-1.707-4.267-4.267c0-11.947-9.387-21.333-21.333-21.333s-21.333,9.387-21.333,21.333 s9.387,21.333,21.333,21.333c16.213,0,29.867,13.653,29.867,29.867c0,15.36-11.093,27.307-25.6,29.867v4.267 C341.333,228.679,339.627,230.385,337.067,230.385z"></path> </g></svg>

                        <div class="col-span-2 pl-2">
                            <p class="text-xl lg:text-2xl font-bold text-slate-50">$ {{ paidAmount.toFixed(2) }}</p>
                            <h2 class="mt-px text-slate-200 text-sm font-semibold">Paid Amount</h2>
                        </div>
                    </div>
                </div>

                <h4 class="px-4 md:px-8 pt-4 md:pt-8 font-bold text-xl text-indigo-900 font-serif">
                    Orders
                </h4>

                <div class="grid sm:grid-cols-3 mt-3 gap-y-3 pb-6 px-4 md:px-8">
                    <div class="min-w-fit w-2/3 md:w-fit p-2 px-4 grid grid-cols-3 gap-x-2 bg-slate-100 hover:bg-slate-200 rounded-md transition-all duration-150 ease-in-out border-2 border-orange-500 text-orange-500 hover:text-orange-600">
                        <svg width="44px" height="44px" class="place-self-center" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M8.04582 10.8718C8.52718 10.601 8.6979 9.99127 8.42713 9.50992C8.15637 9.02856 7.54665 8.85784 7.0653 9.1286L3.50974 11.1286C3.18725 11.31 2.99128 11.6546 3.0003 12.0245C3.00931 12.3944 3.22184 12.7291 3.55279 12.8946L5.63258 13.9345L3.50974 15.1286C3.18725 15.31 2.99128 15.6546 3.0003 16.0245C3.00931 16.3944 3.22184 16.7291 3.55279 16.8946L11.5528 20.8946C11.8343 21.0354 12.1657 21.0354 12.4472 20.8946L20.4472 16.8946C20.7782 16.7291 20.9907 16.3944 20.9997 16.0245C21.0087 15.6546 20.8128 15.31 20.4903 15.1286L18.3674 13.9345L20.4472 12.8946C20.7782 12.7291 20.9907 12.3944 20.9997 12.0245C21.0087 11.6546 20.8128 11.31 20.4903 11.1286L16.9347 9.1286C16.4533 8.85784 15.8436 9.02856 15.5729 9.50992C15.3021 9.99127 15.4728 10.601 15.9542 10.8718L17.8679 11.9482L12 14.8821L6.13213 11.9482L8.04582 10.8718ZM16.2077 15.0144L12.4472 16.8946C12.1657 17.0354 11.8343 17.0354 11.5528 16.8946L7.7923 15.0144L6.13213 15.9482L12 18.8821L17.8679 15.9482L16.2077 15.0144Z" fill="#4296FF"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5528 3.10557C11.8343 2.96481 12.1657 2.96481 12.4472 3.10557L20.4472 7.10557C20.786 7.27496 21 7.62123 21 8C21 8.37877 20.786 8.72504 20.4472 8.89443L12.4472 12.8944C12.1657 13.0352 11.8343 13.0352 11.5528 12.8944L3.55279 8.89443C3.214 8.72504 3 8.37877 3 8C3 7.62123 3.214 7.27496 3.55279 7.10557L11.5528 3.10557ZM6.23607 8L12 10.882L17.7639 8L12 5.11803L6.23607 8Z" fill="#152C70"></path> </g></svg>
                        <div class="col-span-2 pl-2">
                            <p class="text-xl lg:text-3xl font-bold">{{ orders.length }}</p>
                            <h2 class="mt-px text-slate-500 text-sm font-semibold">Total Orders</h2>
                        </div>
                    </div>

                    <div class="min-w-fit w-2/3 md:w-fit p-2 px-4 grid grid-cols-3 gap-x-2 bg-slate-100 hover:bg-slate-200 rounded-md transition-all duration-150 ease-in-out border-2 border-purple-500 text-purple-500 hover:text-purple-600">
                        <svg width="44px" height="44px" class="place-self-center" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 496 496" xml:space="preserve" fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#76FFE5;" d="M248,92c-13.6,0-24-10.4-24-24V24c0-13.6,10.4-24,24-24s24,10.4,24,24v44C272,80.8,261.6,92,248,92z"></path> <path style="fill:#0DBFBA;" d="M248,496c-13.6,0-24-10.4-24-24v-44c0-13.6,10.4-24,24-24s24,10.4,24,24v44 C272,485.6,261.6,496,248,496z"></path> <path style="fill:#BBFFF2;" d="M157.6,116c-8,0-16-4-20.8-12l-21.6-37.6c-6.4-11.2-2.4-26.4,8.8-32.8s26.4-2.4,32.8,8.8L178.4,80 c6.4,11.2,2.4,26.4-8.8,32.8C166.4,114.4,161.6,116,157.6,116z"></path> <path style="fill:#1BCEB8;" d="M360,465.6c-8,0-16-4-20.8-12L317.6,416c-6.4-11.2-2.4-26.4,8.8-32.8c11.2-6.4,26.4-2.4,32.8,8.8 l21.6,37.6c6.4,11.2,2.4,26.4-8.8,32.8C368,464.8,364,465.6,360,465.6z"></path> <path style="fill:#E1FFF9;" d="M92,181.6c-4,0-8-0.8-12-3.2l-37.6-21.6c-11.2-6.4-15.2-21.6-8.8-32.8s21.6-15.2,32.8-8.8l37.6,21.6 c11.2,6.4,15.2,21.6,8.8,32.8C108,177.6,100,181.6,92,181.6z"></path> <path style="fill:#26DBC0;" d="M442.4,384c-4,0-8-0.8-12-3.2L392,359.2c-11.2-6.4-15.2-21.6-8.8-32.8c6.4-11.2,21.6-15.2,32.8-8.8 l37.6,21.6c11.2,6.4,15.2,21.6,8.8,32.8C458.4,380,450.4,384,442.4,384z"></path> <path style="fill:#F3FFFD;" d="M68,272H24c-13.6,0-24-10.4-24-24s10.4-24,24-24h44c13.6,0,24,10.4,24,24S80.8,272,68,272z"></path> <path style="fill:#2EE5C6;" d="M472,272h-44c-13.6,0-24-10.4-24-24s10.4-24,24-24h44c13.6,0,24,10.4,24,24S485.6,272,472,272z"></path> <path style="fill:#11AEBA;" d="M53.6,384c-8,0-16-4-20.8-12c-6.4-11.2-2.4-26.4,8.8-32.8l37.6-21.6c11.2-6.4,26.4-2.4,32.8,8.8 c6.4,11.2,2.4,26.4-8.8,32.8l-37.6,21.6C62.4,383.2,58.4,384,53.6,384z"></path> <path style="fill:#3BEDCB;" d="M404,181.6c-8,0-16-4-20.8-12c-6.4-11.2-2.4-26.4,8.8-32.8l37.6-21.6c11.2-6.4,26.4-2.4,32.8,8.8 s2.4,26.4-8.8,32.8L416,178.4C412,180.8,408,181.6,404,181.6z"></path> <path style="fill:#0FB8BC;" d="M136,465.6c-4,0-8-0.8-12-3.2c-11.2-6.4-15.2-21.6-8.8-32.8l21.6-37.6c6.4-11.2,21.6-15.2,32.8-8.8 c11.2,6.4,15.2,21.6,8.8,32.8l-21.6,37.6C152,461.6,144,465.6,136,465.6z"></path> <path style="fill:#57F7D8;" d="M338.4,116c-4,0-8-0.8-12-3.2c-11.2-6.4-15.2-21.6-8.8-32.8l21.6-37.6c6.4-11.2,21.6-15.2,32.8-8.8 c11.2,6.4,15.2,21.6,8.8,32.8L359.2,104C354.4,111.2,346.4,116,338.4,116z"></path> </g></svg>

                        <div class="col-span-2 pl-2">
                            <p class="text-xl lg:text-3xl font-bold">{{ running }}</p>
                            <Link :href="route('admin.orders.running')" class="mt-px text-slate-500 text-sm font-semibold">In-Progress</Link>
                        </div>
                    </div>

                    <div class="min-w-fit w-2/3 md:w-fit p-2 px-4 grid grid-cols-3 gap-x-2 bg-slate-100 hover:bg-slate-200 rounded-md transition-all duration-150 ease-in-out border-2 border-green-500 text-lime-600 hover:text-green-600">
                        <svg width="44px" height="44px" class="place-self-center" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 496 496" xml:space="preserve" fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#82CC00;" d="M496,248c0,136.8-111.2,248-248,248S0,384.8,0,248S111.2,0,248,0S496,111.2,496,248z"></path> <path style="fill:#3EB500;" d="M248,0c136.8,0,248,111.2,248,248S384.8,496,248,496"></path> <path style="fill:#5FBF02;" d="M72.8,72.8c96.8-96.8,253.6-96.8,350.4,0s96.8,253.6,0,350.4"></path> <path style="fill:#EEFFFF;" d="M244,333.6c-3.2,0-5.6-0.8-8-3.2l-72.8-72.8c-4.8-4.8-4.8-12,0-16.8s12-4.8,16.8,0l64.8,64.8 l123.2-124c4.8-4.8,12-4.8,16.8,0s4.8,12,0,16.8L252,330.4C249.6,332.8,246.4,333.6,244,333.6z"></path> </g></svg>

                        <div class="col-span-2 pl-2">
                            <p class="text-xl lg:text-3xl font-bold">{{ completed }}</p>
                            <Link :href="route('admin.orders.completed')" class="mt-px text-slate-500 text-sm font-semibold">Completed</Link>
                        </div>
                    </div>
                </div>

                <div class="max-w-7xl mt-6 mx-auto">
                    <div class="mt-6 bg-white overflow-hidden shadow-sm">
                        <!--stats-->
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:w-[92%] px-4 sm:px-8 md:pt-4 pb-3 md:pb-6 place-content-center text-slate-900 md border-t">
                            <div class="grid gap-y-2">
                                <Link :href="route('admin.orders.submitted')"
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

                                <Link :href="route('admin.orders.revision')"
                                      class="p-1 px-2 w-44 lg:w-60 flex justify-between align-middle rounded bg-orange-400 hover:underline"
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
                                <Link :href="route('admin.orders.recents')"
                                      class="mt-3 p-1 px-2 w-44 lg:w-60 flex justify-between items-center rounded bg-orange-400 hover:underline"
                                >
                                    <div class="">
                                        <p class="text-xs md:text-sm font-semibold">New Orders</p>
                                        <p class="text-lg font-bold">{{ recent }}</p>
                                    </div>

                                    <div class="p-1.5 h-fit place-self-center bg-slate-700 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 17l5-5-5-5"/><path d="M13.8 12H3m9 10a10 10 0 1 0 0-20"/></svg>
                                    </div>
                                </Link>

                                <Link :href="route('admin.orders.pending')"
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

                                <Link :href="route('admin.orders.disputed')"
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

                                <Link :href="route('admin.orders.cancelled')"
                                      class="mt-3 p-1 px-2 w-44 lg:w-60 flex justify-between align-middle rounded bg-orange-400 hover:underline"
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
                        <Panel class="bg-slate-100 mt-3 lg:py-6 p-2 col-span-2">
                            <template v-slot:heading>
                                <h4 class="font-bold px-3 border-b border-purple-200">Recent Activity</h4>
                            </template>
                            <template v-slot:default>
                                <div class="grid divide-y gap-y-5" v-for="(order, index) in orders" :key="order.id">
                                    <div v-if="index < 5" class="px-3 pt-2 grid grid-cols-4 gap-x-2 text-sm place-content-center" >
                                        <Link :href="route('admin.orders.show', order.id)" class="col-span-4 py-2 text-blue-800 hover:underline underline-offset-4 font-semibold">
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
                                              :href="route('admin.orders.show', order.id)"
                                        >
                                            View
                                        </Link>
                                    </div>
                                </div>
                            </template>
                            <template v-slot:footer>
                                <Link :href="route('admin.orders.running')"
                                      :class="`text-purple-500 hover:text-purple-700 underline underline-offset-4 hover:decoration-dotted`"
                                >
                                    Orders in Progress
                                </Link>
                            </template>
                        </Panel>
                    </div>
                </div>
            </div>
        </template>
    </BaseLayout>
</template>
