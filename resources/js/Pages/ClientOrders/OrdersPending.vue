<script setup>
import ClientLayout from "../../Layouts/ClientLayout.vue";
import OrdersCard from "../../Components/OrdersCard.vue";
import OrderList from "../../Components/OrderList.vue";
import OrdersTitle from "../../Components/OrdersTitle.vue";
import {defineProps} from "vue";
import {Head} from "@inertiajs/inertia-vue3";


defineProps({
    pendingOrders: Object
});

</script>

<template>
    <Head :title="`Pending Orders - ${$page.props.websiteName}`" />
    <ClientLayout>
        <template #header>
            <OrdersTitle :title="`Pending Orders`" :about="`Orders not paid for or awaiting further information`" />
        </template>
        <section>
            <OrdersCard>
                <section class="bg-white text-gray-900 rounded">

                    <!--All Recent Orders-->
                    <div>
                        <OrderList :orders="pendingOrders" :title="`Current Pending Orders`" />
                    </div>
                </section>
            </OrdersCard>
        </section>
    </ClientLayout>
</template>
