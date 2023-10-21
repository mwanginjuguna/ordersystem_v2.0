<script setup>
import ClientLayout from "../../Layouts/ClientLayout.vue";
import OrdersCard from "../../Components/OrdersCard.vue";
import {Link, Head} from "@inertiajs/inertia-vue3";
import {defineProps} from "vue";


defineProps({
    submittedOrders: Object
})

function deleteOrder(id) {
    route('orders.delete', id)
}

function getOrder(id) {
    route('orders.show', id)
}
</script>

<template>
    <Head :title="`Submitted Orders: ${$page.props.websiteName}`" />
    <ClientLayout>
        <template #header>
            <h1 class="pt-4 font-bold sm:font-extrabold text-indigo-900 leading-8 text-xl md:text-4xl">
                Submitted Orders
            </h1>
            <p class="text-xs text-gray-500 p-4">
                <span class="font-bold">About: </span>Submitted orders awaiting confirmation.
            </p>
        </template>
        <section>
            <OrdersCard>
                <section class="bg-white text-gray-900 rounded">
                    <div class="m-3 ml-4 p-4 lg:pt-6">
                        <Link
                            :href="route('orders.new')"
                            class="mx-auto p-2 px-4 bg-slate-200 text-purple-900 hover:underline border border-slate-700 rounded hover:bg-slate-300 hover:text-purple-800 active:bg-slate-400 active:ring-purple-900 transition ease-in-out hover:duration-500 active:duration-500"
                        >
                            New Order
                        </Link>
                    </div>
                    <!--All Recent Orders-->
                    <div>
                        <div class="md:grid md:grid-cols-3 pb-6">
                            <div class="text-center underline text-indigo-500 col-span-3">
                                <h3>Recently Submitted Orders</h3>
                            </div>
                            <div class="md:col-span-2 lg:col-span-3 text-sm md:text-base space-y-6">
                                <div v-for="submitted in submittedOrders"
                                     class="flex justify-between md:max-w-2/3 lg:w-full mx-auto border-b border-indigo-100">
                                    <div>
                                        <p>Order Topic: {{ submitted.title }}</p>
                                        <p class="text-xs">Order Id: <span>#{{ submitted.id }}</span></p>
                                    </div>
                                    <div class="p-2">
                                        <Link :href="route('orders.show', submitted.id)"
                                              class="text-sky-400 hover:text-sky-500 underline mx-2">
                                            view
                                        </Link>
                                        <Link :href="route('orders.delete', submitted.id)" class="text-red-400 hover:text-red-500 underline mx-2">Delete</Link>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </section>
            </OrdersCard>
        </section>
    </ClientLayout>
</template>
