<script setup>
import BaseLayout from "../../Layouts/BaseLayout.vue";
import OrdersCard from "../../Components/OrdersCard.vue";
import Panel from "../../Components/Panel.vue";
import {nextTick, ref, defineProps} from "vue";
import Modal from "../../Components/Modal.vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import SecondaryButton from "../../Components/SecondaryButton.vue";
import TextInput from "../../Components/TextInput.vue";
import InputLabel from "../../Components/InputLabel.vue";
import InputError from "../../Components/InputError.vue"
import {useForm, Head} from "@inertiajs/inertia-vue3";

let confirmNewDiscount = ref(false);
const codeInput = ref(null);
const daysInput = ref(null);
const rateInput = ref(null);

defineProps({
    discounts: Object,
    errors: Object
})

const form = useForm({
    'code': '',
    'rate': '',
    'active': true,
    'days_active': ''
});

const addDiscount = () => {
    form.post(route('admin.discounts.add'), {
        preserveScroll: true,
        onSuccess: () => modalClose(),
        onError: () => codeInput.value.focus() && rateInput.value.focus() && daysInput.value.focus(),
        onFinish: () => form.reset(),
    });
}

const deleteDiscount = (id) => {
    if (confirm("Are you sure?")) {
        form.delete(route('admin.discount', id));
    }
}

function modalShow() {
    confirmNewDiscount.value = true;

    nextTick(() => nameInput.value.focus() && rateInput.value.focus() && daysInput.value.focus());
}
function modalClose() {
    confirmNewDiscount.value = false;
    form.reset();
}
</script>

<template>
    <Head title="Customizing Discounts Offers" />
    <BaseLayout>
        <template #header>
            <h1 class="font-bold sm:font-extrabold text-indigo-900 leading-8 text-center text-xl md:text-4xl">
                Customizing Discounts Offers
            </h1>
            <p class="justify-self-center text-center text-xs text-gray-500 p-4 border-b border-purple-500">
                <span class="font-bold">About: </span>Add a discount code with its components such as rate for percent-off, days-active for number of days the code will remain active until it expires. All codes are active immediately they are created.
            </p>
        </template>
        <OrdersCard>
            <div class="grid grid-cols-2">
                <div class="col-span-2 flex justify-between mx-6">
                    <p class="lg:text-indigo-900">%</p>
                    <button class="p-2 px-4 mr-12 bg-purple-200 text-slate-900 hover:underline border border-slate-700 rounded hover:bg-purple-300 hover:text-slate-800 active:bg-purple-400 active:ring-slate-900 transition ease-in-out hover:duration-500 active:duration-500" @click="modalShow">Add New</button>
                    <!--modal-->
                    <Modal :show="confirmNewDiscount" @close="modalClose">
                        <div class="mt-4 py-4 px-5">
                            <h2 class="text-lg font-medium text-gray-900">
                                Add a new Discount
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Add a Discount code with percent off.
                            </p>

                            <div class="mt-6">
                                <InputLabel for="code" />

                                <TextInput id="code" ref="codeInput" v-model="form.code"
                                           type="text" class="mt-1 block w-3/4 text-sm" placeholder="Discount Code"
                                />

                                <InputError :message="form.errors.code" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <InputLabel for="rate" />

                                <TextInput id="rate" ref="rateInput" v-model="form.rate" type="text"
                                           class="mt-1 block w-3/4" placeholder="Percent off eg 20 for 20% off. Don't include % symbol"
                                />

                                <InputError :message="form.errors.rate" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <InputLabel for="days_active" />

                                <TextInput id="days_active" ref="daysInput" v-model="form.days_active" type="text"
                                           class="mt-1 block w-3/4" placeholder="Days Active"
                                           @keyup.enter="addDiscount"
                                />

                                <InputError :message="form.errors.days_active" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end">
                                <SecondaryButton @click="modalClose"> Cancel </SecondaryButton>

                                <PrimaryButton @click="addDiscount" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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
                                    <h3 class="font-semibold">All Discounts</h3>
                                </div>
                                <div class="md:col-span-2 lg:col-span-3 col-end-3 text-sm md:text-base space-y-6">
                                    <div class="flex justify-between md:max-w-2/3 mx-auto border-b"
                                         v-for="discount in discounts"
                                    >
                                        <div>
                                            <p>{{ discount.code }} :
                                                <span v-if="discount.active === 1" class="text-green-500 text-xs">Active</span>
                                                <span v-if="discount.active === 0" class="text-gray-500 text-xs">Inactive</span>
                                            </p>
                                            <div class="flex flex-wrap space-x-8">
                                                <p class="text-xs">Days active: <span>{{ discount.days_active }}</span></p>
                                                <p class="text-xs">Percent off: <span>{{ discount.rate }}%</span></p>
                                            </div>

                                        </div>
                                        <div class="p-2">
                                            <button @click="deleteDiscount(discount.id)" :disabled="form.processing" class="text-red-400 hover:text-red-500 underline mx-2">Delete</button>
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
