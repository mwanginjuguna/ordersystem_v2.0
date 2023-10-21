<script setup>
import BaseLayout from "../../Layouts/BaseLayout.vue";
import OrdersCard from "../../Components/OrdersCard.vue";
import OrderList from "../../Components/OrderList.vue";
import OrdersTitle from "../../Components/OrdersTitle.vue";
import {defineProps} from "vue";
import {Head} from "@inertiajs/inertia-vue3";

defineProps({
    orders: Object,
    info: Array
})

</script>

<template>
    <Head :title=" info['title'] ?? $page.props.websiteName" />
    <BaseLayout>
        <template #header>
            <OrdersTitle :title="info['title'] ?? `Orders`" :about="info['description'] ?? `All orders.` " />
        </template>
        <OrdersCard>
            <section class="bg-white text-gray-900 rounded">
                <!--Orders-->
                <OrderList :orders="orders" :title="info['subtitle'] ?? `Orders`" />
            </section>
        </OrdersCard>
    </BaseLayout>
</template>
