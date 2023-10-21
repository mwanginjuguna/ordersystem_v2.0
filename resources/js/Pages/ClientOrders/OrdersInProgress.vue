<script setup>
import ClientLayout from "../../Layouts/ClientLayout.vue";
import OrdersCard from "../../Components/OrdersCard.vue";
import OrderList from "../../Components/OrderList.vue";
import OrdersTitle from "../../Components/OrdersTitle.vue";
import {defineProps} from "vue";
import {Head} from "@inertiajs/inertia-vue3";

defineProps({
    runningOrders: Object
});

</script>

<template>
    <Head :title="`Running Orders - ${$page.props.websiteName}`" />
    <ClientLayout>
        <template #header>
            <OrdersTitle :title="`Running Orders`" :about="`Orders that writers are working on.`" />
        </template>
        <section>
            <OrdersCard>
                <section class="bg-white text-gray-900 rounded">
                    <!--All Recent Orders-->
                    <div>
                        <OrderList :orders="runningOrders" :title="`Current Orders in Progress`" />
                    </div>
                </section>
            </OrdersCard>
        </section>
    </ClientLayout>
</template>
