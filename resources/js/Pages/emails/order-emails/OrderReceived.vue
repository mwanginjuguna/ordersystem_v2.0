<script setup>
import {defineProps} from "vue";
import {Link} from "@inertiajs/inertia-vue3";

defineProps({
    order: Object,
    user: String,
    level: String,
    spacing: String,
    subjectType: String,
    service: String,
    style: String,
    discount: String,
    deadline: String,
    imageUrl: String,
    currency: String,
    discountAmount: String
})
</script>

<template>
        <div class="p-6 bg-white rounded">
            <h1 class="text-2xl font-bold">Thank You for Your Order! - (Order #{{ order.id }})</h1>
            <p class="my-4">Dear {{ user }},</p>
            <p class="my-4">Thank you for placing your order with us. To ensure that your order can be assigned to an expert for completion, please complete payment as soon as possible.</p>
            <p class="my-4">Order Details:</p>
            <ul>
                <li class="my-2">
                    Order #{{ order.id }} - {{ order.topic }}
                </li>
                <li class="my-2">
                    Service Type/Task: {{ service }}
                </li>
                <li class="my-2">
                    Academic Level: {{ level }}
                </li>
                <li class="my-2">
                    Subject area / Discipline: {{ subjectType }}
                </li>
                <li class="my-2">
                    Due
                    <span v-if="deadline.endsWith('ago')" class="underline md:text-sm text-red-400">
                                    {{ deadline }}</span>
                    <span v-if="deadline.endsWith('now')" class="underline md:text-sm text-lime-800">
                                    {{ deadline }}</span>.
                </li>
                <li class="my-2" v-if="order.pages > 0">
                    Pages: {{ order.pages }} / {{ order.pages * 275 }} words
                </li>
                <li class="my-2" v-if="order.slides > 0">
                    Slides: {{ order.slides }}
                </li>
                <li class="my-2" v-if="discountAmount > 0">
                    Discount/Coupon: "{{ discount }}" - {{ discountAmount }}% Off
                </li>
            </ul>
            <p class="my-4 font-bold text-white bg-green-600 mx-auto py-2 px-4 rounded-r-md">
                Total Due: {{currency}} {{ order.amount }}
            </p>
            <p class="my-4">
                To complete payment, please follow this link:
                <Link :href="route('orders.preview', order.id)" class="text-blue-500 hover:text-blue-600 underline">
                    Pay Now
                </Link>
            </p>
            <p class="my-4">Thank you for your business!</p>
        </div>
</template>
