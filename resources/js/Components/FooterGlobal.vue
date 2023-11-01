<template>
    <footer class="mt-6 lg:mt-12 border-t pb-6">
        <div class="grid md:grid-cols-3 gap-6 divide-y md:divide-y-0 max-w-5xl mx-auto p-6">
            <div class="pt-3 text-slate-600 font-medium text-sm md:text-base flex flex-col gap-y-3">
                <p class="pb-6 font-bold text-lg text-slate-700">Company</p>

                <Link :href="`#`" class="hover:text-blue-500 hover:underline underline-offset-4">
                    What We Do
                </Link>

                <Link :href="route('home')" class="hover:text-blue-500 hover:underline underline-offset-4">
                    Home
                </Link>

                <Link :href="`#`" class="hover:text-blue-500 hover:underline underline-offset-4">
                    Blog
                </Link>

                <Link :href="route('orders.new')" class="hover:text-blue-500 hover:underline underline-offset-4">
                    Order Now
                </Link>

            </div>

            <div class="pt-3 text-slate-600 font-medium text-sm md:text-base flex flex-col gap-y-3">
                <p class="pb-6 font-bold text-lg text-slate-700">Links</p>

                <Link :href="`#`" class="hover:text-blue-500 hover:underline underline-offset-4">
                    Sample Case Studies
                </Link>

                <Link :href="`/orders/new`" class="hover:text-blue-500 hover:underline underline-offset-4">
                    Write My Case Study
                </Link>

                <Link :href="`#`" class="hover:text-blue-500 hover:underline underline-offset-4">
                    Case Study Assignment Help
                </Link>

                <Link :href="`#`" class="hover:text-blue-500 hover:underline underline-offset-4">
                    FAQ
                </Link>

            </div>

            <div class="pt-3 md:pl-5 text-slate-600 font-medium text-sm md:text-base flex flex-col gap-y-3">
                <p class="pb-6 font-bold text-lg text-slate-700">Contact Us</p>

                <Link :href="`#`" class="hover:text-blue-500 hover:underline underline-offset-4">
                    francis.kanothe@gmail.com
                </Link>

                <Link :href="route('orders.new')" class="hover:text-blue-500 underline underline-offset-4">
                    Place an Order
                </Link>

                <!--// integrate messaging/chat function-->
                <Link :href="`#`" disabled class="p-2 px-3 w-fit hover:text-slate-50 text-slate-200 font-semibold bg-purple-500 hover:bg-purple-600 border rounded shadow-md hover:underline underline-offset-4">
                    Chat with an expert
                </Link>

            </div>
        </div>
        <div class="mt-6 mx-auto max-w-3xl">
            <div class="flex justify-between px-3 text-xs">
                <p class="">Copyright Protected. Property of <Link :href="`#`">{{ $page.props.websiteName }}</Link> - {{ currentYear }}.</p>
                <Link
                    :href="`https://mwangikanothe.com/#contact`"
                    :target="`_blank`"
                    class="text-green-500 rounded hover:text-base hover:underline underline-offset-4">
                    Developed by Kanothe
                </Link>
            </div>

        </div>
    </footer>
</template>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import {ref} from "vue";

const currentYear = ref(new Date().getFullYear());
</script>
