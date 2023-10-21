<script setup>
import ClientLayout from "../../Layouts/ClientLayout.vue";
import OrdersCard from "../../Components/OrdersCard.vue";
import OrderList from "../../Components/OrderList.vue";
import OrdersTitle from "../../Components/OrdersTitle.vue";
import {defineProps} from "vue";
import {Head} from "@inertiajs/inertia-vue3";

defineProps({
    recents: Object
});

</script>

<template>
    <Head :title="`New Orders - ${$page.props.websiteName}`" />
    <ClientLayout>
        <template #header>
            <OrdersTitle :title="`All New Orders`" :about="`Orders recently placed.`" />
        </template>
        <section>
            <OrdersCard>
                <section class="bg-white text-gray-900 rounded">
                    <!--All Recent Orders-->
                    <div>
                        <OrderList :orders="recents" :title="`Recently Placed New Orders.`" />
                    </div>
                </section>
            </OrdersCard>
        </section>
    </ClientLayout>
</template>
