<script setup>
import ClientLayout from "../../Layouts/ClientLayout.vue";
import OrdersCard from "../../Components/OrdersCard.vue";
import OrderList from "../../Components/OrderList.vue";
import OrdersTitle from "../../Components/OrdersTitle.vue";
import {defineProps} from "vue";
import {Head} from "@inertiajs/inertia-vue3";

defineProps({
    completedOrders: Object
});

</script>

<template>
    <Head :title="`Completed Orders: ${$page.props.websiteName}`" />
    <ClientLayout>
        <template #header>
            <OrdersTitle :title="`Completed Orders`" :about="`Completed Orders.`" />
        </template>
        <section>
            <OrdersCard>
                <section class="bg-white text-gray-900 rounded">
                    <!--All Recent Orders-->
                    <div>
                        <OrderList :orders="completedOrders" :title="`Done.`" />
                    </div>
                </section>
            </OrdersCard>
        </section>
    </ClientLayout>
</template>
