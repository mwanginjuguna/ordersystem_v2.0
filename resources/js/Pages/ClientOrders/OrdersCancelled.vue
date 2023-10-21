<script setup>
import ClientLayout from "../../Layouts/ClientLayout.vue";
import OrdersCard from "../../Components/OrdersCard.vue";
import OrderList from "../../Components/OrderList.vue";
import OrdersTitle from "../../Components/OrdersTitle.vue";
import {defineProps} from "vue";
import {Head} from "@inertiajs/inertia-vue3";

defineProps({
    cancelledOrders: Object
});

</script>

<template>
    <Head :title="`Cancelled Orders - ${$page.props.websiteName}`" />
    <ClientLayout>
        <template #header>
            <OrdersTitle :title="`Cancelled Orders`" :about="`Cancelled orders due to dispute, refund or other issues.`" />
        </template>
        <section>
            <OrdersCard>
                <section class="bg-white text-gray-900 rounded">
                    <!--All Recent Orders-->
                    <div>
                        <OrderList :orders="cancelledOrders" :title="`All Cancelled Orders.`" />
                    </div>
                </section>
            </OrdersCard>
        </section>
    </ClientLayout>
</template>
