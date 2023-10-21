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

let confirmNewItem = ref(false);
const nameInput = ref(null);
const rateInput = ref(null);

let loadStylesForm = ref(false);

let loadSpacingsForm = ref(false);

defineProps({
    styles: Object,
    spacings: Object,
    errors: Object
})

const form = useForm({
    'name': '',
    'rate': ''
});

function loadStyles() {
    loadStylesForm.value = true;
    nextTick(() => nameInput.value.focus() && rateInput.value.focus());
}

function loadSpacings() {
    loadSpacingsForm.value = true;
    nextTick(() => nameInput.value.focus() && rateInput.value.focus());
}

const addStyle = () => {
    form.post(route('admin.styles.add'), {
        preserveScroll: true,
        onSuccess: () => modalClose(),
        onError: () => nameInput.value.focus() && rateInput.value.focus(),
        onFinish: () => form.reset(),
    });
}

const addSpacing = () => {
    form.post(route('admin.spacings'), {
        preserveScroll: true,
        onSuccess: () => modalClose(),
        onError: () => nameInput.value.focus() && rateInput.value.focus(),
        onFinish: () => form.reset(),
    });
}

const deleteStyle = (id) => {
    if (confirm("Are you sure?")) {
        form.delete(route('admin.style', id));
    }
}

const deleteSpacing = (id) => {
    if (confirm("Are you sure?")) {
        form.delete(route('admin.spacing', id));
    }
}

function modalShow() {
    confirmNewItem.value = true;

    nextTick(() => nameInput.value.focus() && rateInput.value.focus());
}
function modalClose() {
    loadSpacingsForm.value = false;
    loadStylesForm.value = false;
    form.reset();
}
</script>

<template>
    <Head title="Customizing Line SPacing and Referencing Styles" />
    <BaseLayout>
        <template #header>
            <h1 class="font-bold sm:font-extrabold text-indigo-900 leading-8 text-center text-xl md:text-2xl">
                Customize Line Spacing and Referencing Styles
            </h1>
            <p class="justify-self-center text-center text-xs text-gray-500 p-4 border-b border-purple-500">
                <span class="font-bold">About: </span>Manage and customize all line spacing and referencing styles and how they affect the pricing of every order.
            </p>
        </template>
        <OrdersCard>
            <div class="grid grid-cols-2">
                <div class="col-span-2 flex justify-between mx-6">
                    <p class="lg:text-indigo-900">Styles & Line Spacing</p>
                    <button class="p-2 px-4 mr-12 bg-purple-200 text-slate-900 hover:underline border border-slate-700 rounded hover:bg-purple-300 hover:text-slate-800 active:bg-purple-400 active:ring-slate-900 transition ease-in-out hover:duration-500 active:duration-500" @click="loadStyles">Add Styles</button>

                    <button class="p-2 px-4 mr-12 bg-purple-200 text-slate-900 hover:underline border border-slate-700 rounded hover:bg-purple-300 hover:text-slate-800 active:bg-purple-400 active:ring-slate-900 transition ease-in-out hover:duration-500 active:duration-500" @click="loadSpacings">Add Spacing(s)</button>
                    <!--modal-->
                    <Modal :show="loadStylesForm" @close="modalClose">
                        <div class="mt-4 py-4 px-5">
                            <h2 class="text-lg font-medium text-gray-900">
                                Add a new Referencing Style
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Add a style e.g. APA, OSCOLA. The rates expect a number e.g 30 to increase on the total order price by 30%.
                            </p>

                            <div class="mt-6">
                                <InputLabel for="name" />

                                <TextInput id="name" ref="nameInput" v-model="form.name"
                                           type="text" class="mt-1 block w-3/4" placeholder="Referencing Style Name"
                                />

                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <InputLabel for="rate" />

                                <TextInput id="rate" ref="rateInput" v-model="form.rate" type="text"
                                           class="mt-1 block w-3/4" placeholder="Referencing Style Rate"
                                           @keyup.enter="addStyle"
                                />

                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end">
                                <SecondaryButton @click="modalClose"> Cancel </SecondaryButton>

                                <PrimaryButton @click="addStyle" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Add New
                                </PrimaryButton>
                            </div>
                        </div>

                    </Modal>
                    <Modal :show="loadSpacingsForm" @close="modalClose">
                        <div class="mt-4 py-4 px-5">
                            <h2 class="text-lg font-medium text-gray-900">
                                Add a new Line spacing
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Add spacing eg. Double spacing, 1.15 spacing. The rates expect a number e.g 30% to increase on the total order price by 30%.
                            </p>

                            <div class="mt-6">
                                <InputLabel for="name" />

                                <TextInput id="name" ref="nameInput" v-model="form.name"
                                           type="text" class="mt-1 block w-3/4" placeholder="Line Spacing Name"
                                />

                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <InputLabel for="rate" />

                                <TextInput id="rate" ref="rateInput" v-model="form.rate" type="text"
                                           class="mt-1 block w-3/4" placeholder="Spacing Rate. eg 0"
                                           @keyup.enter="addSpacing"
                                />

                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end">
                                <SecondaryButton @click="modalClose"> Cancel </SecondaryButton>

                                <PrimaryButton @click="addSpacing" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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
                                    <h3 class="font-semibold">All Referencing Styles</h3>
                                </div>
                                <div class="md:col-span-2 lg:col-span-3 col-end-3 text-sm md:text-base space-y-6">
                                    <div class="flex justify-between md:max-w-2/3 mx-auto border-b"
                                         v-for="style in styles"
                                    >
                                        <div>
                                            <p> {{ style.name }} </p>
                                            <p class="text-xs">Rate: <span>{{ style.rate }}%</span></p>
                                        </div>
                                        <div class="p-2">
                                            <button @click="deleteStyle(style.id)" :disabled="form.processing" class="text-red-400 hover:text-red-500 underline mx-2">Delete</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </template>
                </Panel>

                <Panel v-show="true" class="col-span-2">
                    <template #default>
                        <div>
                            <div class="p-3 lg:py-10 lg:px-8 m-2 md:grid md:grid-cols-3 lg:mx-8 lg:my-4">
                                <div class="text-center underline col-span-3 lg:col-end-3">
                                    <h3 class="font-semibold">All Line Spacings</h3>
                                </div>
                                <div class="md:col-span-2 lg:col-span-3 col-end-3 text-sm md:text-base space-y-6">
                                    <div class="flex justify-between md:max-w-2/3 mx-auto border-b"
                                         v-for="spacing in spacings"
                                    >
                                        <div>
                                            <p> {{ spacing.name }} </p>
                                            <p class="text-xs">Rate: <span>{{ spacing.rate }}%</span></p>
                                        </div>
                                        <div class="p-2">
                                            <button @click="deleteSpacing(spacing.id)" :disabled="form.processing" class="text-red-400 hover:text-red-500 underline mx-2">Delete</button>
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
