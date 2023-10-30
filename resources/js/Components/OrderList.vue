<template>
    <div class="grid pb-4">
        <div class="pb-6 font-bold underline text-purple-700">
            <h3>{{ title }}</h3>
        </div>

        <div class="text-sm md:text-base space-y-6">
            <div v-for="order in orders"
                 class="flex justify-between border-b border-indigo-100">
                <div>
                    <p>
                        <span class="font-bold text-xs">Title: </span>

                        <Link :href="route(isAdmin ? 'admin.orders.show' : 'orders.show', order.id)"
                              class="text-sky-500 hover:text-sky-600 hover:underline underline-offset-2"
                        >
                            {{ order.title }}
                        </Link>
                    </p>

                    <p class="text-xs">Order Id: <span>#{{ order.id }}</span></p>
                    <p class="text-xs">Deadline:
                        <span v-if="formatTime(order.due_at).endsWith('ago')" class="pl-2 text-red-500">
                                                {{ formatTime(order.due_at) }}
                                            </span>
                        <span v-else class="pl-2 text-green-500">
                                                {{ formatTime(order.due_at) }}
                                            </span>
                    </p>
                </div>

                <div class="grid place-content-end hidden sm:block">
                    <Link :href="route(isAdmin ? 'admin.orders.show' : 'orders.show', order.id)" class="text-sky-400 hover:text-sky-500 underline mx-2">
                        View
                    </Link>
                    <Link :href="route(isAdmin ? 'admin.orders.delete' : 'orders.delete', order.id)" class="text-red-400 hover:text-red-500 underline mx-2">
                        Delete
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {defineProps} from "vue";
import {Link} from "@inertiajs/inertia-vue3";
import {useFormatTime} from "@/Composables/useFornatedTime";

let { formatTime } = useFormatTime();

defineProps({
    orders: Object,
    title: String,
    isAdmin: false
})

</script>
