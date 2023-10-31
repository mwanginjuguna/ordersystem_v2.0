<script setup>
import ClientLayout from "../../Layouts/ClientLayout.vue";
import OrdersCard from "../../Components/OrdersCard.vue";
import {defineProps, onMounted, ref} from "vue";
import {loadScript} from '@paypal/paypal-js';
import {Link, Head} from "@inertiajs/inertia-vue3";
import {useFlash} from "@/Composables/useFlash";

const { flash } = useFlash();

const orderObject = ref(props.order);
const hidePayPal = ref(false);
const props = defineProps({
    order: Object,
    level: String,
    spacing: String,
    subject: String,
    service: String,
    style: String,
    discount: String,
    language: String,
    writerCategory: String,
    user: String,
    writer: String,
    files: Array,
    deadline: String,
    imageUrl: String,
    currencySymbol: String,
    currency: String,
    discountAmount: Number
});

function paid() {
    console.log('Running paid() function to redirect to recent orders')
    const a = Object.assign(
        document.createElement('a'),
        {
            href: `${route('orders.recents')}`,
            style:"display: none",
        });
    document.body.appendChild(a);
    a.click();
}

onMounted(async () => {
    try {
        const paypal = await loadScript({
            'client-id': "AXByLC0wuw6fznWnZABRuNWsYOAlGx_JVw2dJzRSntIaSRL7V0D-hk7SiH3tMNtHWNrtcxEl38xlMXik",
            'currency': props.currency ?? 'USD'
        });
        await paypal.Buttons({
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
                return fetch(route('paypal.pay', props.order.id), {
                    method: 'post',
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    return orderData.id;
                });
            },
            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {

                return fetch(route('paypal.capture', props.order.id), {
                    method: 'post',
                    body: JSON.stringify({
                        orderId : data.orderID,
                        payerId : data.payerID,
                        facilitatorAccessToken : data.facilitatorAccessToken,
                    })
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    const element = document.getElementById('paypal-button-container');
                    element.innerHTML = '';
                    element.innerHTML = '<p>Thank you for your payment!</p>';
                    paid();
                });
            },
            onCancel: (data, actions) => {
                return fetch(route('paypal.capture', props.order.id), {
                    method: 'post',
                    body: JSON.stringify({
                        orderId: data.orderID,
                    })
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    let errorDetail = Array.isArray(orderData.details) && orderData.details[0];

                    if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                        flash('Critical Error!', `Payment Instrument Declined! Try Again.`, 'error');
                        return actions.restart(); // Recoverable state, per:
                        // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
                    }
                    let msg = 'Sorry, your transaction could not be processed.';
                    if (errorDetail) {
                        if (errorDetail.description) msg += '\n\n' + errorDetail.description;
                        if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';
                        flash('Fatal Error!', `${msg}`, 'error'); // Show a failure message (try to avoid alerts in production environments)
                    }
                    flash('Fatal Error!', `Order was Cancelled (Status: ${orderData.error.name})! \n Error Message: ${orderData.error.message}.\n TRY AGAIN!`, 'error');
                });
            },
            onError: (error) => {

            }
        }).render('#paypal-button-container');
    }
    catch (error) {
        flash('Fatal Error!', `Server was unable to initiate payment. Contact support team or try again later.`, 'error');
    }
});

async function sendEmails() {
    try {
        const response = await axios.post(route('emails.orderReceived'), {
            orderId: props.order.id,
        });
    } catch (error) {
        console.error('Error! Could not connect to server.\n ' + error)
    }



}

</script>

<template>
    <Head :title="`Order #${order.id} Preview - ${$page.props.websiteName}`" />
    <ClientLayout>
        <OrdersCard>
            <h1 class="text-xl font-bold text-purple-900 uppercase underline">
                Order #{{order.id}} Preview
            </h1>
            <section class="grid md:grid-cols-3 rounded py-2 px-3">
                <div class="md:col-span-3 pb-6 text-base">
                    <div class="p-1.5 grid gap-2">
                        <h3 class="md:text-lg font-semibold lg:font-bold mb-3">
                            Order Summary
                        </h3>
                        <div class="flex flex-col space-y-2.5 text-sm">
                            <p>A <span class="underline text-gray-700">{{order.pages}} </span> Page(s)
                                <span class="underline text-gray-700">{{ level }}</span> level <span class="underline text-gray-700">{{ service }}</span> task/assignment in
                                <span class="underline text-gray-700">{{ subject }}</span> Subject/Discipline.
                            </p>
                            <p>
                                Due
                                <span v-if="deadline.endsWith('ago')" class="underline md:text-sm text-red-400">
                                    {{ deadline }}</span>
                                <span v-if="deadline.endsWith('now')" class="underline md:text-sm text-lime-800">
                                    {{ deadline }}</span>.
                            </p>
                            <p>
                                Written in
                                <span class="underline text-gray-700 font-sans">{{style}}</span> and
                                <span class="underline text-gray-700 font-sans">{{spacing}}</span> line spacing with
                                <span class="underline text-gray-700 font-sans">{{order.sources}}</span> sources/references.
                            </p>
                            <p class="border-b">Language:
                                <span class="ml-4 md:text-sm text-gray-600">{{ language }}</span></p>
                        </div>
                    </div>
                </div>

                <!--administrative details-->
                <div class="md:col-span-1">
                    <div class="p-3 grid gap-3">
                        <h3 class="text-md md:text-lg font-semibold lg:font-bold mb-3">
                            Administrative Details
                        </h3>
                        <div class="flex flex-col space-y-2.5 text-sm text-gray-800">
                            <p class="border-b">Assigned to:
                                <span class="ml-4 md:text-sm text-gray-600" v-if="writer">{{ writer }}</span>
                                <span class="ml-4 md:text-sm text-gray-600" v-else>Expert Writer</span>

                            </p>
                            <p class="border-b">Expert Level:
                                <span class="ml-4 md:text-sm text-gray-600">{{ writerCategory }}</span>
                            </p>
                            <p class="border-b">Belongs to:
                                <span class="ml-4 md:text-sm text-gray-600">{{ user }}</span>
                            </p>
                            <p class="border-b">Paid:
                                <span v-if="order.paid === 1" class="ml-4 font-semibold uppercase md:text-sm text-green-600">
                                    Yes
                                </span>
                                <span v-else class="ml-4 md:text-sm font-semibold uppercase text-red-600">
                                    No
                                </span>
                            </p>
                            <p class="border-b">Amount:
                                <span class="ml-4 md:text-sm" :class="order.paid === 1 ? `text-gray-600` : `text-red-500`">
                                    {{ currencySymbol }} {{ order.amount }}
                                </span>
                            </p>
                            <p class="border-b">Status:
                                <span class="ml-4 md:text-sm text-gray-600">{{ order.status }}</span>
                            </p>
                            <p class="border-b" v-if="discount">Coupon:
                                <span class="text-gray-600 text-xs">"{{ discount }}" </span> =
                                <span class="underline text-green-600 text-xs"> {{ discountAmount }}% OFF</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 mt-3 lg:pt-7" v-if="order.paid == 0" >
                    <p class="text-red-500 text-xs lg:text-sm">* Complete payment for the expert to start working on your order.</p>
                    <div class="py-6 text-white rounded-lg flex flex-col space-x-3">
                        <p class="text-sky-500 mg:text-lg border-2 border-green-400 px-6 mb-4 m-2 py-2 font-bold rounded-md">
                            Total Due: <span class="underline ml-4">{{ currencySymbol }} {{ order.amount }}</span>
                        </p>
                        <!--
                        <Link :class="'mg:text-lg uppercase font-bold mx-auto'">Continue to Checkout: <span class="text-slate-900 font-serif">{{ currencySymbol }} {{ order.amount }}</span></Link> -->

                        <div id="paypal-button-container"></div>
                        <!--
                        <Link :href="route('make-payment', order.id)">
                            <img alt="Checkout" class="round-lg" v-bind:src="'/checkout-with-paypal.png'">
                        </Link>
                        -->
                    </div>
                </div>

                <!--Instructions-->
                <div class="mt-6 md:col-span-3">
                    <div class="min-w-2/3 m-2 p-3 px-6">
                        <h3 class="text-lg font-bold">
                            Order Instructions
                        </h3>

                        <hr class="border-1 w-full mx-auto border-blue-900 mb-4">
                        <h3 class="text-md text-gray-700 font-semibold mr-4 border-b border-gray-200">Order title:
                            <span class="text-gray-500 font-medium">{{order.title}}</span>
                        </h3>
                        <p class="my-6 text-justify leading-tight decoration-1 whitespace-pre-wrap">
                            {{ order.instructions }}
                        </p>
                    </div>
                </div>
            </section>
        </OrdersCard>
    </ClientLayout>
</template>
