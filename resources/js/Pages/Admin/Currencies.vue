<script setup>
import BaseLayout from "../../Layouts/BaseLayout.vue";
import OrdersCard from "../../Components/OrdersCard.vue";
import NavLink from "../../Components/NavLink.vue";
import Panel from "../../Components/Panel.vue";
import {nextTick, ref, defineProps} from "vue";
import Modal from "../../Components/Modal.vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import SecondaryButton from "../../Components/SecondaryButton.vue";
import TextInput from "../../Components/TextInput.vue";
import InputLabel from "../../Components/InputLabel.vue";
import InputError from "../../Components/InputError.vue"
import {useForm} from "@inertiajs/inertia-vue3";

let confirmNewCurrency = ref(false);
const nameInput = ref(null);
const symbolInput = ref(null);
const rateInput = ref(null);

defineProps({
    currencies: Object,
    errors: Object
})

const form = useForm({
    'name': '',
    'symbol': '',
    'rate': ''
});

const addCurrency = () => {
    form.post(route('admin.currencies'), {
        preserveScroll: true,
        onSuccess: () => modalClose(),
        onError: () => nameInput.value.focus() && rateInput.value.focus() && symbolInput.value.focus(),
        onFinish: () => form.reset(),
    });
}

const deleteCurrency = (id) => {
    if (confirm("Are you sure?")) {
        form.delete(route('admin.currency', id));
    }
}

function modalShow() {
    confirmNewCurrency.value = true;

    nextTick(() => nameInput.value.focus() && rateInput.value.focus() && symbolInput.value.focus());
}
function modalClose() {
    confirmNewCurrency.value = false;
    form.reset();
}
</script>

<template>
    <BaseLayout>
        <template #header>
            <h1 class="font-bold sm:font-extrabold text-indigo-900 leading-8 text-center text-xl md:text-4xl">
                Customizing Currencies
            </h1>
            <p class="justify-self-center text-center text-xs text-gray-500 p-4 border-b border-purple-500">
                <span class="font-bold">About: </span>Customize the base currency and exchange rates with other currencies. The default currency is USD and other prices are converted to USD based on exchange rates you provide. e.g. CNY is China Yuan (¥). 1¥ = 0.15 USD. This is the ex. rate used to convert client's currency to USD.
                Note: PayPal only supports the following currencies: 'AUD', 'BRL', 'CAD', 'CZK', 'DKK', 'EUR', 'HKD', 'HUF', 'ILS', 'INR', 'JPY', 'MYR', 'MXN', 'NOK', 'NZD', 'PHP', 'PLN', 'GBP', 'SGD', 'SEK', 'CHF', 'TWD', 'THB', 'USD', 'RUB', 'CNY'.
            </p>
        </template>
        <OrdersCard>
            <div class="grid grid-cols-2">
                <div class="col-span-2 flex justify-between mx-6">
                    <p class="lg:text-indigo-900">$$$</p>
                    <button class="p-2 px-4 mr-12 bg-purple-200 text-slate-900 hover:underline border border-slate-700 rounded hover:bg-purple-300 hover:text-slate-800 active:bg-purple-400 active:ring-slate-900 transition ease-in-out hover:duration-500 active:duration-500" @click="modalShow">Add New</button>
                    <!--modal-->
                    <Modal :show="confirmNewCurrency" @close="modalClose">
                        <div class="mt-4 py-4 px-5">
                            <h2 class="text-lg font-medium text-gray-900">
                                Add a new Currency
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Add a currency and exchange rates.
                            </p>

                            <div class="mt-6">
                                <InputLabel for="name" />

                                <TextInput id="name" ref="nameInput" v-model="form.name"
                                           type="text" class="mt-1 block w-3/4 text-sm" placeholder="Name e.g. 7 days, 6 hours"
                                />

                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <InputLabel for="symbol" />

                                <TextInput id="symbol" ref="symbolInput" v-model="form.symbol"
                                           type="text" class="mt-1 block w-3/4 text-sm"
                                           placeholder="Currency symbol"
                                />

                                <InputError :message="form.errors.symbol" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <InputLabel for="rate" />

                                <TextInput id="rate" ref="rateInput" v-model="form.rate" type="text"
                                           class="mt-1 block w-3/4" placeholder="Default Ex. Rate"
                                           @keyup.enter="addCurrency"
                                />

                                <InputError :message="form.errors.rate" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end">
                                <SecondaryButton @click="modalClose"> Cancel </SecondaryButton>

                                <PrimaryButton @click="addCurrency" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Add New
                                </PrimaryButton>
                            </div>
                        </div>

                    </Modal>
                </div>
                <Panel class="col-span-2">
                    <template #default>
                        <div>
                            <div class="p-3 lg:py-10 lg:px-8 m-2 md:grid md:grid-cols-3 lg:mx-8 lg:my-4">
                                <div class="text-center underline col-span-3 lg:col-end-3">
                                    <h3 class="font-semibold">All Currencies</h3>
                                </div>
                                <div class="md:col-span-2 lg:col-span-3 col-end-3 text-sm md:text-base space-y-6">
                                    <div class="flex justify-between md:max-w-2/3 mx-auto border-b"
                                         v-for="currency in currencies"
                                    >
                                        <div>
                                            <p>{{ currency.name }} : <span class="text-slate-500 text-xs">({{ currency.symbol }}) </span></p>
                                            <p class="text-xs">Exchange Rate: <span>{{ currency.rate }}</span></p>
                                        </div>
                                        <div class="p-2">
                                            <button @click="deleteCurrency(currency.id)" :disabled="form.processing" class="text-red-400 hover:text-red-500 underline mx-2">Delete</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </template>
                </Panel>
            </div>
        </OrdersCard>
    </BaseLayout>
</template>
