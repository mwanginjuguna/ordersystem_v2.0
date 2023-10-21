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
import {useForm, Head} from "@inertiajs/inertia-vue3";

let confirmNewRate = ref(false);
const nameInput = ref(null);
const hoursInput = ref(null);
const amountInput = ref(null);

defineProps({
    rates: Object,
    errors: Object
})

const form = useForm({
    'name': '',
    'hours': '',
    'amount': ''
});

const addRate = () => {
    form.post(route('admin.pricings.add'), {
        preserveScroll: true,
        onSuccess: () => modalClose(),
        onError: () => nameInput.value.focus() && rateInput.value.focus() && descriptionInput.value.focus(),
        onFinish: () => form.reset(),
    });
}

const deleteRate = (id) => {
    if (confirm("Are you sure?")) {
        form.delete(route('admin.pricing', id));
    }
}

function modalShow() {
    confirmNewRate.value = true;

    nextTick(() => nameInput.value.focus() && rateInput.value.focus() && descriptionInput.value.focus());
}
function modalClose() {
    confirmNewRate.value = false;
    form.reset();
}
</script>

<template>
    <Head title="Customizing Prices / Rates" />
    <BaseLayout>
        <template #header>
            <h1 class="font-bold sm:font-extrabold text-indigo-900 leading-8 text-center text-xl md:text-4xl">
                Customizing Prices / Rates
            </h1>
            <p class="justify-self-center text-center text-xs text-gray-500 p-4 border-b border-purple-500">
                <span class="font-bold">About: </span>Customize the base price based on deadline. The default price is calculated from the basis that a 1 page due in 14 days, 24 hrs, and 3 hrs is charged at $12, $20, and $32 at college level.
            </p>
        </template>
        <OrdersCard>
            <div class="grid grid-cols-2">
                <div class="col-span-2 flex justify-between mx-6">
                    <p class="lg:text-indigo-900">Prices</p>
                    <button class="p-2 px-4 mr-12 bg-purple-200 text-slate-900 hover:underline border border-slate-700 rounded hover:bg-purple-300 hover:text-slate-800 active:bg-purple-400 active:ring-slate-900 transition ease-in-out hover:duration-500 active:duration-500" @click="modalShow">Add New</button>
                    <!--modal-->
                    <Modal :show="confirmNewRate" @close="modalClose">
                        <div class="mt-4 py-4 px-5">
                            <h2 class="text-lg font-medium text-gray-900">
                                Add a new Pricing rate
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Add a rate and new deadlines e.g. 30 days = 720 hours = $12 per page. This is the base price.
                            </p>

                            <div class="mt-6">
                                <InputLabel for="name" />

                                <TextInput id="name" ref="nameInput" v-model="form.name"
                                           type="text" class="mt-1 block w-3/4 text-sm" placeholder="Name e.g. 7 days, 6 hours"
                                />

                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <InputLabel for="hours" />

                                <TextInput id="hours" ref="hoursInput" v-model="form.hours"
                                           type="text" class="mt-1 block w-3/4 text-sm"
                                           placeholder="Number of Hours e.g. 168 for 7 days"
                                />

                                <InputError :message="form.errors.hours" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <InputLabel for="rate" />

                                <TextInput id="rate" ref="amountInput" v-model="form.amount" type="text"
                                           class="mt-1 block w-3/4" placeholder="Default Amount e.g. 11.99"
                                           @keyup.enter="addRate"
                                />

                                <InputError :message="form.errors.amount" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end">
                                <SecondaryButton @click="modalClose"> Cancel </SecondaryButton>

                                <PrimaryButton @click="addRate" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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
                                    <h3 class="font-semibold">All Base Prices</h3>
                                </div>
                                <div class="md:col-span-2 lg:col-span-3 col-end-3 text-sm md:text-base space-y-6">
                                    <div class="flex justify-between md:max-w-2/3 mx-auto border-b"
                                         v-for="rate in rates"
                                    >
                                        <div>
                                            <p>{{ rate.name }} : <span class="text-slate-500 text-xs">{{ rate.hours }} hours</span></p>
                                            <p class="text-xs">Amount: <span>${{ rate.amount }}</span></p>
                                        </div>
                                        <div class="p-2">
                                            <button @click="deleteRate(rate.id)" :disabled="form.processing" class="text-red-400 hover:text-red-500 underline mx-2">Delete</button>
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
