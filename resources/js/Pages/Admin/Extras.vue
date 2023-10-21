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

let confirmNewFeature = ref(false);
const nameInput = ref(null);
const descriptionInput = ref(null);
const rateInput = ref(null);

defineProps({
    extras: Object,
    errors: Object
})

const form = useForm({
    'name': '',
    'rate': '',
    'description': ''
});

const addFeature = () => {
    form.post(route('admin.extras.add'), {
        preserveScroll: true,
        onSuccess: () => modalClose(),
        onError: () => nameInput.value.focus() && rateInput.value.focus() && descriptionInput.value.focus(),
        onFinish: () => form.reset(),
    });
}

const deleteFeature = (id) => {
    if (confirm("Are you sure?")) {
        form.delete(route('admin.extra', id));
    }
}

function modalShow() {
    confirmNewFeature.value = true;

    nextTick(() => nameInput.value.focus() && rateInput.value.focus() && descriptionInput.value.focus());
}
function modalClose() {
    confirmNewFeature.value = false;
    form.reset();
}
</script>

<template>
    <Head title="Customizing Additional Features" />
    <BaseLayout>
        <template #header>
            <h1 class="font-bold sm:font-extrabold text-indigo-900 leading-8 text-center text-xl md:text-4xl">
                Customizing Additional Features
            </h1>
            <p class="justify-self-center text-center text-xs text-gray-500 p-4 border-b border-purple-500">
                <span class="font-bold">About: </span>Manage Additional features offered to your customers.
            </p>
        </template>
        <OrdersCard>
            <div class="grid grid-cols-2">
                <div class="col-span-2 flex justify-between mx-6">
                    <p class="lg:text-indigo-900">Extras</p>
                    <button class="p-2 px-4 mr-12 bg-purple-200 text-slate-900 hover:underline border border-slate-700 rounded hover:bg-purple-300 hover:text-slate-800 active:bg-purple-400 active:ring-slate-900 transition ease-in-out hover:duration-500 active:duration-500" @click="modalShow">Add New</button>
                    <!--modal-->
                    <Modal :show="confirmNewFeature" @close="modalClose">
                        <div class="mt-4 py-4 px-5">
                            <h2 class="text-lg font-medium text-gray-900">
                                Add a new Additional Feature
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Add an extra feature to offer to your customers eg Plagiarism Report at extra $10. The rates expect a fixed amount value in USD e.g 30.5 for $30.50 increase on the total order price.
                            </p>

                            <div class="mt-6">
                                <InputLabel for="name" />

                                <TextInput id="name" ref="nameInput" v-model="form.name"
                                           type="text" class="mt-1 block w-3/4" placeholder="Additional Feature Name"
                                />

                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <InputLabel for="description" />

                                <TextInput id="description" ref="descriptionInput" v-model="form.description"
                                           type="text" class="mt-1 block w-3/4" placeholder="Additional Feature Description"
                                />

                                <InputError :message="form.errors.description" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <InputLabel for="rate" />

                                <TextInput id="rate" ref="rateInput" v-model="form.rate" type="text"
                                           class="mt-1 block w-3/4" placeholder="Additional Feature Rate"
                                           @keyup.enter="addFeature"
                                />

                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end">
                                <SecondaryButton @click="modalClose"> Cancel </SecondaryButton>

                                <PrimaryButton @click="addFeature" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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
                                    <h3 class="font-semibold">All Additional Features</h3>
                                </div>
                                <div class="md:col-span-2 lg:col-span-3 col-end-3 text-sm md:text-base space-y-6">
                                    <div class="flex justify-between md:max-w-2/3 mx-auto border-b"
                                         v-for="extra in extras"
                                    >
                                        <div>
                                            <p>{{ extra.name }} : <span class="text-slate-500 text-xs">{{ extra.description }}</span></p>
                                            <p class="text-xs">Rate: <span>${{ extra.rate }}</span></p>
                                        </div>
                                        <div class="p-2">
                                            <button @click="deleteFeature(extra.id)" :disabled="form.processing" class="text-red-400 hover:text-red-500 underline mx-2">Delete</button>
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
