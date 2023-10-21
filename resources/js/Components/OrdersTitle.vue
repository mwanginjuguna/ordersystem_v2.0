<template>
    <h1 class="pt-4 font-bold sm:font-bold text-indigo-900 leading-8 text-xl md:text-2xl">
        {{ title }}
    </h1>
    <div class="pb-6 border-b border-purple-100">
        <p class="text-xs text-gray-500 pt-4 pb-6">
            <span class="font-bold">About: </span> {{ about }}
        </p>
        <Link
            :href="route('orders.new')"
            class="mx-auto p-1 md:p-2 md:px-4 bg-slate-200 text-purple-900 text-sm hover:underline border border-slate-300 rounded hover:bg-slate-300 hover:text-purple-800 active:bg-slate-400 active:ring-purple-900 transition ease-in-out hover:duration-500 active:duration-500"
        >
            New Order
        </Link>
    </div>
</template>

<script setup>
import {defineProps} from "vue";
import {Link} from "@inertiajs/inertia-vue3";

defineProps({
    title: String,
    about: String
});
</script>
