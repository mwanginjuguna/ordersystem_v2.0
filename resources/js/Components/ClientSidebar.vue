<script setup>
import Accordion from './Accordion.vue';
import ApplicationLogo from './ApplicationLogo.vue';
import NavLink from "../Components/NavLink.vue";
import {Link} from "@inertiajs/inertia-vue3";

</script>

<template>
    <div class="pb-6 flex text-slate-900">
        <!-- Logo -->
        <div class="shrink-0">
            <Link :href="$page.props.homeUrl">
                <ApplicationLogo
                    class="block h-9 w-auto fill-current"
                />
            </Link>
        </div>

        <div class="flex flex-col gap-y-2 pl-2">
            <h4 class="font-bold my-auto">{{ $page.props.websiteName }}</h4>
            <p class="text-xs">Welcome, {{ $page.props.auth.user.name }}</p>
        </div>

    </div>

    <div class="mt-6 flex flex-col space-y-6 text-purple-900 text-sm font-semibold">
        <div class="flex flex-col space-y-1">
            <Link :href="route(`orders.new`)" class="text-xs lg:text-base hover:bg-purple-200 underline flex items-center text-purple-900 py-2 lg:space-x-2 transition duration-150 px-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" class="stroke-purple-900" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                <span>New Order</span>
            </Link>

            <Link :href="route('dashboard')" class="w-full mt-3 pt-3 flex flex-wrap space-x-4 p-2 items-center hover:text-purple-800 hover:underline">
                <svg height="19px" width="19px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#EDEDED;" d="M406.905,256c0,83.343-67.562,150.905-150.905,150.905S105.095,339.343,105.095,256 S172.657,105.095,256,105.095S406.905,172.657,406.905,256z"></path> <path style="fill:#FFDB57;" d="M241.767,503.916L241.767,503.916c-4.596,0-8.91-2.22-11.582-5.961l-43.372-60.721 c-4.074-5.704-6.265-12.539-6.265-19.55s2.19-13.846,6.265-19.55l43.372-60.721c2.672-3.74,6.986-5.961,11.582-5.961l0,0 c7.861,0,14.234,6.372,14.234,14.234v16.698c58.754,0,106.384-47.63,106.384-106.384h109.194 c0,119.061-96.518,215.579-215.579,215.579v18.103C256,497.543,249.627,503.916,241.767,503.916z"></path> <path style="fill:#FFBC00;" d="M470.976,272.168c-1.987,26.782-8.874,52.197-19.756,75.365l-13.987,9.991 c-5.704,4.074-12.539,6.265-19.55,6.265c-7.011,0-13.846-2.19-19.55-6.265l-55.562-39.687c6.374-8.907,11.403-18.839,14.801-29.5 c0,0,4.593-10.896,3.79-16.168c0.804-5.272,1.221-10.671,1.221-16.168h106.781C469.965,261.328,470.573,266.72,470.976,272.168z"></path> <path style="fill:#73A4BC;" d="M503.916,270.234L503.916,270.234c0,4.596-2.22,8.91-5.961,11.582l-60.721,43.372 c-5.704,4.074-12.539,6.265-19.55,6.265c-7.011,0-13.846-2.19-19.55-6.265l-60.721-43.372c-3.74-2.672-5.961-6.986-5.961-11.582l0,0 c0-7.861,6.372-14.234,14.234-14.234h16.698c0-58.754-47.63-106.384-106.384-106.384V40.421 c119.061,0,215.579,96.518,215.579,215.579h18.103C497.543,256,503.916,262.373,503.916,270.234z"></path> <path style="fill:#56889B;" d="M272.168,41.024c26.782,1.985,52.197,8.874,75.365,19.756l9.991,13.987 c4.074,5.704,6.266,12.539,6.266,19.55c0,7.011-2.19,13.846-6.266,19.55l-39.687,55.562c-8.907-6.374-18.839-11.403-29.5-14.801 c0,0-10.896-4.593-16.168-3.79c-5.272-0.804-10.671-1.221-16.168-1.221V42.836C261.328,42.035,266.72,41.427,272.168,41.024z"></path> <path style="fill:#B6E152;" d="M270.234,8.084L270.234,8.084c4.596,0,8.91,2.22,11.582,5.961l43.372,60.721 c4.074,5.704,6.265,12.539,6.265,19.55c0,7.011-2.19,13.846-6.265,19.55l-43.372,60.721c-2.672,3.74-6.986,5.961-11.582,5.961l0,0 c-7.861,0-14.234-6.373-14.234-14.234v-16.698c-58.754,0-106.384,47.63-106.384,106.384H40.421 c0-119.061,96.518-215.579,215.579-215.579V22.318C256,14.457,262.372,8.084,270.234,8.084z"></path> <path style="fill:#92B703;" d="M42.836,256c-0.801-5.328-1.409-10.72-1.813-16.168c1.987-26.782,8.874-52.197,19.756-75.365 l13.987-9.991c5.704-4.074,12.539-6.265,19.55-6.265c7.011,0,13.846,2.19,19.55,6.265l55.562,39.687 c-6.374,8.907-11.403,18.839-14.801,29.5c0,0-5.011,26.841-5.011,32.337H42.836V256z"></path> <path style="fill:#FF6029;" d="M8.084,241.766L8.084,241.766c0-4.596,2.22-8.91,5.961-11.582l60.721-43.372 c5.704-4.074,12.539-6.265,19.55-6.265c7.011,0,13.846,2.19,19.55,6.265l60.721,43.372c3.74,2.672,5.961,6.986,5.961,11.582l0,0 c0,7.861-6.373,14.234-14.234,14.234h-16.698c0,58.754,47.63,106.384,106.384,106.384v109.195 c-119.061,0-215.579-96.518-215.579-215.579H22.318C14.457,256,8.084,249.627,8.084,241.766z"></path> <path style="fill:#B7441C;" d="M256,362.384v106.764c-5.372,0.808-10.81,1.415-16.305,1.819c-26.733-2-52.1-8.884-75.228-19.747 l-9.991-13.987c-4.074-5.704-6.266-12.539-6.266-19.55s2.19-13.846,6.266-19.55l39.687-55.562 c8.907,6.374,18.839,11.403,29.5,14.801C223.663,357.373,250.484,362.384,256,362.384z"></path> <path style="fill:#FFDB57;" d="M309.895,464.787c-17.226,4.433-35.285,6.792-53.895,6.792v18.103 c0,7.861-6.373,14.234-14.234,14.234l0,0c-4.596,0-8.91-2.22-11.582-5.961l-43.372-60.721c-4.074-5.704-6.266-12.539-6.266-19.55 s2.19-13.846,6.266-19.55l43.372-60.721c2.672-3.74,6.985-5.961,11.582-5.961l0,0c7.861,0,14.234,6.372,14.234,14.234v16.698 c19.669,0,38.088-5.344,53.895-14.652V464.787z"></path> <path d="M169.193,453.555c-1.398,2.878-4.279,4.553-7.277,4.554c-1.186,0-2.389-0.262-3.527-0.815 c-37.214-18.078-68.682-46.099-91.001-81.033c-21.484-33.627-33.478-72.251-34.907-112.178H22.317 C10.011,264.084,0,254.073,0,241.766c0-7.191,3.493-13.98,9.345-18.16l60.721-43.372c7.118-5.083,15.503-7.771,24.249-7.771 c8.747,0,17.132,2.687,24.249,7.771l60.721,43.372c5.852,4.181,9.345,10.97,9.345,18.16c0,12.306-10.011,22.318-22.318,22.318 h-8.277c2.364,28.401,17.086,54.73,40.389,71.599c3.616,2.618,4.426,7.672,1.808,11.289c-2.618,3.615-7.672,4.426-11.289,1.808 c-29.687-21.491-47.412-56.176-47.412-92.781c0-4.465,3.62-8.084,8.084-8.084h16.698c3.391,0,6.149-2.758,6.149-6.149 c0-1.981-0.963-3.852-2.575-5.005l-60.721-43.371c-4.359-3.112-9.494-4.758-14.851-4.758c-5.356,0-10.492,1.646-14.851,4.76 l-60.721,43.372c-1.613,1.151-2.575,3.022-2.575,5.004c0,3.391,2.758,6.149,6.149,6.149h18.103c4.465,0,8.084,3.62,8.084,8.084 c0,80.149,44.812,151.708,116.949,186.751C169.47,444.702,171.144,449.539,169.193,453.555z M58.447,169.19 c4.016,1.951,8.853,0.276,10.804-3.739C104.294,93.317,175.852,48.505,256,48.505c4.465,0,8.084-3.62,8.084-8.084V22.318 c0-3.391,2.758-6.149,6.149-6.149c1.981,0,3.852,0.963,5.004,2.575l43.372,60.721c3.113,4.359,4.759,9.495,4.759,14.851 c0,5.357-1.646,10.492-4.76,14.851l-43.371,60.721c-1.152,1.613-3.022,2.575-5.005,2.575c-3.391,0-6.149-2.758-6.149-6.149v-16.698 c0-4.465-3.62-8.084-8.084-8.084c-36.604,0-71.289,17.724-92.781,47.412c-2.618,3.616-1.809,8.671,1.808,11.289 c1.433,1.037,3.09,1.536,4.734,1.536c2.505,0,4.974-1.161,6.556-3.345c16.869-23.303,43.199-38.025,71.599-40.389v8.277 c0,12.306,10.011,22.318,22.318,22.318c7.191,0,13.979-3.493,18.16-9.345l43.372-60.721c5.084-7.116,7.772-15.501,7.772-24.248 c0-8.746-2.687-17.131-7.771-24.249L288.393,9.345C284.213,3.493,277.424,0,270.234,0c-12.306,0-22.318,10.011-22.318,22.318v10.165 c-39.925,1.428-78.549,13.423-112.175,34.905c-34.933,22.319-62.954,53.785-81.033,90.999 C52.756,162.402,54.43,167.239,58.447,169.19z M489.682,247.916h-10.165c-3.084-85.71-55.007-162.429-134.049-196.964 c-4.091-1.787-8.858,0.08-10.644,4.171c-1.788,4.092,0.08,8.857,4.171,10.644C414.626,98.812,463.495,173.483,463.495,256 c0,4.465,3.62,8.084,8.084,8.084h18.103c3.391,0,6.149,2.758,6.149,6.149c0,1.981-0.963,3.852-2.575,5.004l-60.721,43.372 c-4.359,3.113-9.494,4.759-14.851,4.759c-5.356,0-10.492-1.646-14.851-4.76l-60.721-43.372c-1.613-1.151-2.575-3.022-2.575-5.004 c0-3.391,2.758-6.149,6.149-6.149h16.698c4.465,0,8.084-3.62,8.084-8.084c0-36.604-17.724-71.289-47.412-92.781 c-3.616-2.619-8.671-1.809-11.289,1.808s-1.809,8.671,1.808,11.289c23.303,16.869,38.024,43.199,40.389,71.599h-8.277 c-12.306,0.002-22.318,10.014-22.318,22.32c0,7.191,3.493,13.98,9.345,18.16l60.721,43.372c7.118,5.083,15.502,7.771,24.249,7.771 c8.747,0,17.132-2.687,24.249-7.771l60.722-43.372c5.852-4.18,9.344-10.97,9.344-18.16C512,257.927,501.988,247.916,489.682,247.916 z M453.554,342.809c-4.017-1.951-8.854-0.277-10.804,3.739C407.706,418.683,336.148,463.495,256,463.495 c-4.465,0-8.084,3.62-8.084,8.084v18.103c0,3.391-2.758,6.149-6.149,6.149c-1.981,0-3.852-0.963-5.004-2.575l-43.372-60.721 c-3.114-4.359-4.76-9.495-4.76-14.851c0-5.357,1.646-10.492,4.76-14.851l43.371-60.721c1.152-1.613,3.022-2.575,5.005-2.575 c3.391,0,6.149,2.758,6.149,6.149v16.698c0,4.465,3.62,8.084,8.084,8.084c36.604,0,71.289-17.724,92.781-47.412 c2.618-3.616,1.809-8.671-1.808-11.289c-3.617-2.619-8.672-1.809-11.289,1.808c-16.869,23.303-43.199,38.025-71.599,40.389v-8.277 c0-12.306-10.011-22.318-22.318-22.318c-7.191,0-13.979,3.493-18.16,9.345l-43.372,60.721c-5.084,7.117-7.772,15.502-7.772,24.249 c0,8.746,2.687,17.131,7.771,24.249l43.372,60.721c4.18,5.852,10.969,9.345,18.16,9.345c12.306,0,22.318-10.011,22.318-22.318 v-10.165c39.925-1.428,78.549-13.423,112.175-34.905c34.934-22.319,62.954-53.786,81.033-90.999 C459.245,349.598,457.57,344.76,453.554,342.809z"></path> </g></svg>
                <span>Dashboard</span>
            </Link>

            <p class="mt-3 w-full border-b font-bold uppercase">Orders</p>
            <Link :href="route('orders.pending')" class="w-full flex flex-wrap space-x-4 p-2 items-center hover:text-purple-800 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.5 2v6h-6M2.5 22v-6h6M2 11.5a10 10 0 0 1 18.8-4.3M22 12.5a10 10 0 0 1-18.8 4.2"/></svg>
                <span>Pending</span>
            </Link>
            <Link :href="route('orders.recents')" class="w-full flex flex-wrap space-x-4 p-2 items-center hover:text-purple-800 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 17l5-5-5-5"/><path d="M13.8 12H3m9 10a10 10 0 1 0 0-20"/></svg>
                <span>Recent</span>
            </Link>
            <Link :href="route('orders.submitted')" class="w-full flex flex-wrap space-x-4 p-2 items-center hover:text-purple-800 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 15v4c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2v-4M17 9l-5 5-5-5M12 12.8V2.5"/></svg>
                <span>Submitted</span>
            </Link>

            <Link :href="route('orders.completed')" class="w-full flex flex-wrap space-x-4 p-2 items-center hover:text-purple-800 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                <span>Completed</span>
            </Link>

            <Link :href="route('orders.running')" class="w-full flex flex-wrap space-x-4 p-2 items-center hover:text-purple-800 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                <span>In Progress</span>
            </Link>

            <Link :href="route('orders.revision')" class="w-full flex flex-wrap space-x-4 p-2 items-center hover:text-purple-800 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 2v6h6M2.66 15.57a10 10 0 1 0 .57-8.38"/></svg>
                <span>Revisions</span>
            </Link>

            <Link :href="route('orders.disputed')" class="w-full flex flex-wrap space-x-4 p-2 items-center hover:text-purple-800 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                <span>Disputed</span>
            </Link>

            <Link :href="route(`orders.cancelled`)" class="w-full flex flex-wrap space-x-4 p-2 items-center hover:text-purple-800 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                <span>Cancelled</span>
            </Link>
        </div>

        <ul class="hidden mt-2 flex flex-col space-y-3">
            <!--<li>
                <Link :href="route('messages.index')" class="pt-3 flex flex-wrap space-x-4 bg-gray-700 rounded p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#d946ef" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    <span>Messages</span>
                </Link>
            </li>-->
        </ul>

    </div>
</template>
