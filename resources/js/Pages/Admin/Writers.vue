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

let confirmNewCategory = ref(false);
const nameInput = ref(null);
const rateInput = ref(null);
const descriptionInput = ref(null);

defineProps({
    writerCategories: Object,
    errors: Object
})

const form = useForm({
    'name': '',
    'rate': '',
    'description': ''
});

const addCategory = () => {
    form.post(route('admin.writer_categories.add'), {
        preserveScroll: true,
        onSuccess: () => modalClose(),
        onError: () => nameInput.value.focus() && rateInput.value.focus() && descriptionInput.value.focus(),
        onFinish: () => form.reset(),
    });
}

const deleteCategory = (id) => {
    if (confirm("Are you sure?")) {
        form.delete(route('admin.writer_category', id));
    }
}

function modalShow() {
    confirmNewCategory.value = true;

    nextTick(() => nameInput.value.focus() && rateInput.value.focus() && descriptionInput.value.focus());
}
function modalClose() {
    confirmNewCategory.value = false;
    form.reset();
}
</script>

<template>
    <BaseLayout>
        <template #header>
            <h1 class="font-bold sm:font-extrabold text-indigo-900 leading-8 text-center text-xl md:text-4xl">
                Writer Categories or groups
            </h1>
            <p class="justify-self-center text-center text-xs text-gray-500 p-4 border-b border-purple-500">
                <span class="font-bold">About: </span>All Customize Writers and Writer Categories.
            </p>
        </template>
        <OrdersCard>
            <div class="grid grid-cols-2">
                <div class="col-span-2 flex justify-between mx-6">
                    <p class="lg:text-indigo-900">Writer groups</p>
                    <button class="p-2 px-4 mr-12 bg-purple-200 text-slate-900 hover:underline border border-slate-700 rounded hover:bg-purple-300 hover:text-slate-800 active:bg-purple-400 active:ring-slate-900 transition ease-in-out hover:duration-500 active:duration-500" @click="modalShow">Add New</button>
                    <!--modal-->
                    <Modal :show="confirmNewCategory" @close="modalClose">
                        <div class="mt-4 py-4 px-5">
                            <h2 class="text-lg font-medium text-gray-900">
                                Add a new WriterCategory
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Add a writer category e.g. Expert, Pro, Intermediate. The rates expect a percentage number e.g 30 for 30% increase on the total order price.
                            </p>

                            <div class="mt-6">
                                <InputLabel for="name" />

                                <TextInput id="name" ref="nameInput" v-model="form.name"
                                           type="text" class="mt-1 block w-3/4" placeholder="Writer Category Name"
                                />

                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <InputLabel for="rate" />

                                <TextInput id="rate" ref="rateInput" v-model="form.rate"
                                           type="text" class="mt-1 block w-3/4" placeholder="Category rate eg. 20 for 20%"
                                />

                                <InputError :message="form.errors.rate" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <InputLabel for="description" />

                                <TextInput id="description" ref="descriptionInput" v-model="form.description" type="text"
                                           class="mt-1 block w-3/4" placeholder="Writer Category description."
                                           @keyup.enter="addCategory"
                                />

                                <InputError :message="form.errors.description" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end">
                                <SecondaryButton @click="modalClose"> Cancel </SecondaryButton>

                                <PrimaryButton @click="addCategory" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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
                                    <h3 class="font-semibold">All Writer Categories</h3>
                                </div>
                                <div class="md:col-span-2 lg:col-span-3 col-end-3 text-sm md:text-base space-y-6">
                                    <div class="flex justify-between md:max-w-2/3 mx-auto border-b"
                                         v-for="category in writerCategories"
                                    >
                                        <div>
                                            <p> {{ category.name }}: <span class="text-gray-500 lg:text-sm text-xs">{{category.description}}</span> </p>
                                            <p class="text-xs">Rate: <span>{{ category.rate }}%</span></p>
                                        </div>
                                        <div class="p-2">
                                            <button @click="deleteCategory(category.id)" :disabled="form.processing" class="text-red-400 hover:text-red-500 underline mx-2">Delete</button>
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
