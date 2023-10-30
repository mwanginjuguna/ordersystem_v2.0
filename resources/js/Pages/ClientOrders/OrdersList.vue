<script setup>
import OrdersCard from "../../Components/OrdersCard.vue";
import OrderList from "../../Components/OrderList.vue";
import OrdersTitle from "../../Components/OrdersTitle.vue";
import {defineProps} from "vue";
import {Head} from "@inertiajs/inertia-vue3";
import ClientLayout from "../../Layouts/ClientLayout.vue";

defineProps({
    orders: Object,
    info: Array
})

</script>

<template>
    <Head :title=" info['title'] ?? $page.props.websiteName" />
    <ClientLayout>
        <template #header>
            <OrdersTitle :title="info['title'] ?? `Orders`" :about="info['description'] ?? `All orders.` " />
        </template>
        <OrdersCard>
            <section class="bg-white text-gray-900 rounded">
                <!--Orders-->
                <OrderList :orders="orders" :title="info['subtitle'] ?? `Orders`" />
            </section>
        </OrdersCard>
    </ClientLayout>
</template>
