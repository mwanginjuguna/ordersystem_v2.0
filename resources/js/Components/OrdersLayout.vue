<script setup>

import BaseLayout from "@/Layouts/BaseLayout";
import OrdersCard from "@/Components/OrdersCard";
import {defineProps} from "vue";
import {Link} from "@inertiajs/inertia-vue3";

const props = defineProps({
    orders: Object,
    ordersTitle: String
});

</script>

<template>
    <BaseLayout>
        <template #header>
            <slot name="heading" />
        </template>

        <OrdersCard>
            <div>
                <div class="p-3 lg:py-10 lg:px-8 m-2 md:grid md:grid-cols-3 lg:mx-8 lg:my-4">
                    <div class="text-center underline text-indigo-500 col-span-3 lg:col-end-3">
                        <h3>{{ ordersTitle }} Orders</h3>
                    </div>
                    <div class="md:col-span-2 lg:col-span-3 col-end-3 text-sm md:text-md space-y-6">
                        <div class="flex justify-between md:max-w-2/3 mx-auto border-b border-indigo-400"
                             v-for="order in orders"
                        >
                            <div>
                                <p>Order Topic: {{ order.title }}</p>
                                <p class="text-xs">Order Id: <span>#{{ order.id }}</span></p>
                            </div>
                            <div class="p-2">
                                <Link href="route"
                                   class="text-sky-400 hover:text-sky-500 underline mx-2">
                                    view
                                </Link>
                                <a href="deleteOrder(order.id)" class="text-red-400 hover:text-red-500 underline mx-2">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </OrdersCard>
    </BaseLayout>
</template>
