<script setup>
import ClientLayout from "../../Layouts/ClientLayout.vue";
import OrdersCard from "../../Components/OrdersCard.vue";
import OrderList from "../../Components/OrderList.vue";
import OrdersTitle from "../../Components/OrdersTitle.vue";
import {defineProps} from "vue";
import {Head} from "@inertiajs/inertia-vue3";

defineProps({
    revisionOrders: Object
});

</script>

<template>
    <Head :title="`Revision Orders - ${$page.props.websiteName}`" />
    <ClientLayout>
        <template #header>
            <OrdersTitle :title="`Revision Orders`" :about="`Orders under revision.`" />
        </template>
        <section>
            <OrdersCard>
                <section class="bg-white text-gray-900 rounded">
                    <!--All Recent Orders-->
                    <div>
                        <OrderList :orders="revisionOrders" :title="`Current Orders under Revision`" />
                    </div>
                </section>
            </OrdersCard>
        </section>
    </ClientLayout>
</template>
