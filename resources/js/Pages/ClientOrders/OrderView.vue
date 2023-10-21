<script setup>

import ClientLayout from "../../Layouts/ClientLayout.vue";
import {computed, defineProps, nextTick, onMounted, reactive, ref} from "vue";
import {Link, Head, useForm, usePage} from "@inertiajs/inertia-vue3";
import OrdersCard from "../../Components/OrdersCard.vue";
import OrdersTitle from "../../Components/OrdersTitle.vue";
import Modal from "../../Components/Modal.vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import SecondaryButton from "../../Components/SecondaryButton.vue";
import {useFlash} from "@/Composables/useFlash";
import TextInput from "../../Components/TextInput.vue";
import InputError from "../../Components/InputError.vue";

let { flash } = useFlash();

let pageUser = computed(() => {
    return usePage().props.value.auth.user
})

let changeInstructions = ref(false);
const instructionsInput = ref(null);
const orderObject = reactive(props.order);
let confirmComplete = ref(false);
let confirmRevision = ref(false);
let confirmCancel = ref(false);
let confirmAssign = ref(false);
let confirmExtend = ref(false);
let confirmDispute = ref(false);
let showMessage = ref(false);
let reloadMessageWaitTime = ref(500); // in seconds
let starFill = ref(false);

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
    currencySymbol: String,
    discountAmount: Number
});

const form = useForm({
    'instructions': orderObject.instructions,
    'status': orderObject.status,
    'assigned_to': orderObject.assigned_to ?? '',
    'revision_instructions': orderObject.revision_instructions,
    'cancel_reason': orderObject.cancel_reason,
    'hours': 0,
    'review': '',
    'stars': 5,
    'message': '',
    'files': [],
    'fileType': 'Order File'
});

function uploadFiles(id) {
    form.post(route('orders.upload-file', id), {
        onSuccess: () => modalClose(),
        onFinish: () => form.reset("files"),
    });
    form.reset('files');
    form.files = [];
}

function downloadFile(id, filename) {
    fetch(route('files.download', id))
        .then( (response) => {
            return response.blob()
        }).then( (data) => {
        let blob = new Blob([data]);
        const url = URL.createObjectURL(blob);
        const a = Object.assign(
            document.createElement('a'),
            {
                href: url,
                style:"display: none",
                download:filename
            });
        document.body.appendChild(a);
        a.click();
        URL.revokeObjectURL(url);
        a.remove();
    });
    flash('Success', "File download will start in 3 seconds.", "success")
    //route('admin.files.download', id);
}

function updateInstructions(id) {
    console.log(id);
    form.post(route('orders.show', id), {
        preserveScroll: true,
        onSuccess: () => modalClose(),
        onError: () => instructionsInput.value.focus(),
        onFinish: () => form.reset(),
    });
}

function modalShow() {
    changeInstructions.value = true;
    nextTick(() => instructionsInput.value.focus());
}

function modalClose() {
    changeInstructions.value = false;
}

function deleteOrder(id) {
    if (confirm("Are you sure? Order will be completely deleted from the records.")) {
        form.delete(route('orders.delete', id));
    }
}

//function extendDeadline(id) {
//    if (confirm("You are adjusting the deadline of the order. Continue?")) {
//        form.patch(route('orders.extend', id),
//            {
//                onSuccess: () => confirmExtend.value = false,
//                onFinish: () => form.reset()
//            }
//        );
//    }
//}

function markCompleted(id) {
    if (confirm("Confirmation. This Order will be marked as completed.")) {
        form.stars = orderRating.value
        form.patch(route('orders.complete', id),
            {
                onSuccess: () => confirmComplete.value = false,
                onFinish: () => form.reset()
            }
        );
    }
}

function disputeOrder(id) {
    if (confirm("Confirmation. This Order will be cancelled.")) {
        form.patch(route('orders.dispute', id),
            {
                onSuccess: () => confirmDispute.value = false,
                onFinish: () => form.reset()
            }
        );
    }
}

function requestRevision(id) {
    if (confirm("Confirmation. This Order will be placed under revision.")) {
        form.post(route('orders.revisionRequest', id),
            {
                onSuccess: () => confirmRevision.value = false,
                onFinish: () => form.reset(),
            }
        );
    }
}

const messages = ref([]);
const orderMessages = ref([]);
onMounted(() => {
    loadMessages();
    // let orderMessages = loadMessages();
    // messages.value = Array.from( orderMessages);
})

function loadMessages() {
    return fetch(route('show.messages', props.order.id), {
        method: 'post',
        body: JSON.stringify({
            'order_id': props.order.id,
            'user_id': pageUser.value.id,
            'writer_id': props.writer_id,
        })
    }).then(function(res) {
        return res.json();
    }).then(function(messageData) {
        orderMessages.value = [];
        // console.log(JSON.stringify(messageData));
        orderMessages.value.push(messageData);
        messages.value = orderMessages.value[0].messages;
        // console.log("order messages: "+ JSON.stringify(orderMessages.value));
        return messageData;
    });
    // showMessage.value = true;
}

function sendMessage() {
    fetch(route('send.message', props.order.id), {
        method: 'post',
        body: JSON.stringify({
            'order_id': props.order.id,
            'user_id': pageUser.value.id,
            'writer_id': props.writer_id,
            'message': form.message,
            'receiver': null
        })
    }).then(function(res) {
        return res.json();
    }).then(function(messageData) {
        form.reset('message');
        console.log(messageData);
        orderMessages.value = messageData
        console.log("order messages: "+orderMessages)
        return messageData;
    });
    showMessage.value = false;
    loadMessages();
    showMessage.value = true;
}

function toggleMessage()
{
    // messages.value = orderMessages.value[0].messages;
    showMessage.value = true;
    loadMessages();
}

function getTime(timestamp) {
    const dateString = timestamp;
    const date = new Date(dateString);
    const now = new Date();
    const diffMs = now - date;
    const diffMins = Math.floor(diffMs / (1000 * 60));
    const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
    const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));

    if (diffMins < 60) {
        return (diffMins + " minutes ago");
    } else if (diffHours < 24) {
        return (diffHours + " hours ago");
    } else {
        return (diffDays + " days ago");
    }
}

let hoverValue = ref(0);
let orderRating = ref(4);

function hoverRating(value) {
    // Update hoverValue when hovering over stars
    hoverValue.value = value;
}
function setRating() {
    // Set the selected rating when clicking
    orderRating.value = hoverValue.value;
}
function resetHover() {
    // Reset hoverValue when leaving the container
    hoverValue.value = orderRating.value;
}
function selectRating(value) {
    // Select a rating when clicking on a star
    orderRating.value = value;
}
</script>

<template>
    <Head :title="`Order #${$page.props.order.id}: ${$page.props.order.title}`" />
    <ClientLayout>
        <OrdersTitle :title="`Order #${order.id}: ${order.title}`" :about="`Order Details.`" />
        <OrdersCard>
            <!--actions-->
            <div class="flex flex-wrap space-x-4 lg:space-x-6 text-sm">
                <button
                    @click.prevent="toggleMessage()"
                    class="px-2 py-1.5 flex flex-wrap text-white text-sm hover:text-white font-semibold hover:underline bg-fuchsia-800 hover:bg-fuchsia-900 rounded-lg">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffe4fb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></span>
                    <span class="pl-2">Order Messages</span>
                </button>

                <button v-if="order.status === `pending` ?? order.status === `complete` " @click.prevent="deleteOrder( order.id )" class="text-red-500 hover:text-red-600 underline">
                    Delete Order
                </button>

                <button @click="confirmComplete = true" v-if="order.status !== 'complete' && order.status === 'submitted'" class="text-green-500 hover:text-green-600 underline">
                    Mark Complete
                </button>
                <div v-if="order.status !== 'pending' && order.status === 'submitted'" class="flex flex-wrap space-x-4 lg:space-x-6">
                    <button @click.prevent="confirmRevision = true" class="text-sky-500 hover:text-sky-600 underline">
                        Request Revision
                    </button>

                    <button @click="confirmDispute = true" v-if="order.status !== 'disputed' && order.status !== 'submitted'" class="text-sky-500 hover:text-sky-600 underline">
                        Dispute
                    </button>
                </div>
            </div>

            <section class="mt-5 grid md:grid-cols-3 rounded font-serif py-2 lg:py-5">

                <!--order details-->
                <div class="col-span-3 md:col-span-2 md:pr-3">
                    <div class="grid gap-2">
                        <h3 class="md:text-lg font-semibold lg:font-bold mb-3">
                            Order Details
                        </h3>
                        <div class="w-fit flex flex-col space-y-2.5 text-sm">
                            <p class="border-b">Academic Level:
                                <span class="ml-4 md:text-sm text-gray-600">{{ level }}</span></p>
                            <p class="border-b">Service Type:
                                <span class="ml-4 md:text-sm text-gray-600">{{ service }}</span></p>
                            <p class="border-b">Subject:
                                <span class="ml-4 md:text-sm text-gray-600">{{ subject }}</span></p>
                            <p class="border-b">Spacing:
                                <span class="ml-4 md:text-sm text-gray-600">{{ spacing }}</span></p>
                            <p class="border-b">Referencing Style:
                                <span class="ml-4 md:text-sm text-gray-600">{{ style }}</span></p>
                            <p class="border-b">Sources:
                                <span class="ml-4 md:text-sm text-gray-600">{{ order.sources }} references/sources</span></p>
                            <p class="border-b">Pages:
                                <span class="ml-4 md:text-sm text-gray-600">{{order.pages}} Pages/{{ order.pages*275 }} words</span></p>
                            <p class="border-b">Slides:
                                <span class="ml-4 md:text-sm text-gray-600">{{order.slides}} Slides</span></p>
                            <p class="border-b">Deadline:
                                <span v-if="deadline.endsWith('ago')" class="ml-4 md:text-sm text-red-600">
                                    {{ deadline }}</span>
                                <span v-if="deadline.endsWith('now')" class="ml-4 md:text-sm text-lime-600">
                                    {{ deadline }}</span>
                            </p>
                            <p class="border-b">Language:
                                <span class="ml-4 md:text-sm text-gray-600">{{ language }}</span></p>
                        </div>
                    </div>
                </div>

                <!--administrative details-->
                <div class="col-span-3 md:col-span-1 md:border-l pt-4 mt-2 md:pl-3 md:ml-2">
                    <div class="grid gap-3">
                        <h3 class="text-md md:text-lg font-semibold lg:font-bold mb-3">
                            Administrative Details
                        </h3>
                        <div class="flex flex-col space-y-2.5 text-sm text-gray-800">
                            <p class="border-b">Writer:
                                <span class="ml-4 md:text-sm text-gray-600" v-if="writer">{{ writer }}</span>
                                <span class="ml-4 md:text-sm text-gray-600" v-else>Expert Writer</span>

                            </p>
                            <p class="border-b">Writer Category:
                                <span class="ml-4 md:text-sm text-gray-600">{{ writerCategory }}</span>
                            </p>
                            <p class="border-b">Client:
                                <span class="ml-4 md:text-sm text-gray-600">{{ user }}</span>
                            </p>
                            <p class="border-b">Paid:
                                <span v-if="order.paid === 1" class="ml-4 md:text-sm text-green-600">
                                    Yes
                                </span>
                                <span v-else class="ml-4 md:text-sm text-red-600">
                                    No
                                </span>
                                <Link v-if="order.paid !== 1"
                                      :href="route('orders.preview', order.id)"
                                      :class="'block my-2 text-center underline bg-green-600 text-white rounded-lg p-1.5'">Pay Now: {{ currencySymbol }} {{ order.amount }}</Link>
                            </p>
                            <p class="border-b">Amount:
                                <span class="ml-4 md:text-sm text-gray-600">{{ currencySymbol }} {{ order.amount }}</span>
                            </p>
                            <p class="border-b">Status:
                                <span class="ml-4 md:text-sm text-gray-600">{{ order.status }}</span>
                            </p>
                            <p class="border-b" v-if="discount">Discount:
                                <span class="md:text-sm text-gray-600">"{{ discount }}" </span> =
                                <span class="underline text-green-600"> {{ discountAmount }}% OFF</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!--files-->
                <div class="col-span-3 mt-6 pb-6 border-b">
                    <p class="font-semibold py-2">
                        Files: <span class="text-xs text-gray-500 font-light">Upload any relevant files. Files help our writers understand your task better.</span>
                    </p>

                    <div class="p-2.5 flex flex-row max-w-2xl rounded-md bg-gray-200 border border-fuchsia-200">
                        <label class="hidden md:block my-auto pr-3 lg:font-semibold text-sm">Add files</label>

                        <div class="flex flex-wrap gap-y-2 md:w-full text-xs md:text-sm">
                            <input multiple
                                   class="text-black bg-white pl-1.5 py-1.5 md:w-2/3 md:rounded-l-lg"
                                   type="file" id="files"
                                   placeholder="Upload files"
                                   @input="form.files = $event.target.files"
                                   name="files[]">
                            <button class="bg-white px-2 py-1.5 md:rounded-r-lg border-l flex flex-row gap-x-2 font-semibold" @click.prevent="uploadFiles(order.id)">
                                Upload <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#18e516" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.2 15c.7-1.2 1-2.5.7-3.9-.6-2-2.4-3.5-4.4-3.5h-1.2c-.7-3-3.2-5.2-6.2-5.6-3-.3-5.9 1.3-7.3 4-1.2 2.5-1 6.5.5 8.8m8.7-1.6V21"/><path d="M16 16l-4-4-4 4"/></svg>
                            </button>
                        </div>

                    </div>

                    <div class="mt-3 px-3 text-xs md:text-sm border border-gray-200 rounded-lg overflow-x-hidden" v-for="file in files">
                        <div class="grid grid-cols-3 gap-x-2 py-3" v-if="file.uploaded_by === 'U' || file.show_client">
                            <p class="col-span-3 pb-3 hover:underline underline-offset-4 decoration-dashed text-slate-700 font-semibold flex flex-wrap"

                            >
                                <svg width="18px" height="18px" class="hidden md:block" viewBox="-2.56 -2.56 69.12 69.12" xmlns="http://www.w3.org/2000/svg" fill="#000000" stroke="#000000" stroke-width="0.00064">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g fill-rule="evenodd" clip-rule="evenodd"> <path d="M5.113-.026c-2.803 0-5.074 2.272-5.074 5.074v53.841c0 2.803 2.271 5.074 5.074 5.074h45.773c2.801 0 5.074-2.271 5.074-5.074v-38.605l-18.901-20.31h-31.946z" fill="#8170ff"></path> <path d="M55.977 20.352v1h-12.799s-6.312-1.26-6.129-6.707c0 0 .208 5.707 6.004 5.707h12.924z" fill="#5e7b97"></path> <path d="M37.074 0v14.561c0 1.656 1.104 5.791 6.104 5.791h12.799l-18.903-20.352z" opacity=".5" fill="#ffffff"></path> </g> <path d="M26.6 41.467c1.134-1.134 1.134-2.986 0-4.12s-2.986-1.134-4.12 0l-9.167 9.167c-1.134 1.134-1.134 2.986 0 4.12s2.986 1.134 4.12 0l5.625-5.602c.324-.324.324-.856 0-1.181s-.856-.324-1.181 0l-3.542 3.519c-.486.509-1.273.509-1.759 0-.509-.486-.509-1.273 0-1.759l3.519-3.542c1.319-1.296 3.426-1.296 4.722 0 1.296 1.319 1.296 3.426 0 4.722l-5.625 5.625c-2.106 2.106-5.532 2.106-7.662 0-2.106-2.129-2.106-5.555 0-7.662l9.166-9.167c2.13-2.129 5.556-2.129 7.662 0 2.129 2.106 2.129 5.532 0 7.662l-.903.902c-.046-.926-.37-1.829-.926-2.616l.071-.068z" fill="#ffffff"></path> </g></svg>
                                <span class="pl-2 flex flex-wrap">{{ file.name }}</span>
                            </p>
                            <p>
                                Uploaded by: <span class="text-purple-900 font-semibold">{{ file.uploaded_by === 'U' ? 'Client' : 'Admin'}}</span>
                            </p>
                            <p>Filetype: <span class="text-purple-900 font-semibold">{{ file.type }}</span></p>

                            <Link class="p-1 px-2 w-fit rounded-md text-slate-800 bg-purple-200" @click="downloadFile(file.id, file.name)" :as="`button`">Download</Link>
                        </div>
                    </div>
                </div>

                <!--Instructions-->
                <div class="mt-6 col-span-3">
                    <div class="rounded bg-white">
                        <div class=" flex justify-between">
                            <h3 class="text-lg font-bold">
                                Order Instructions
                            </h3>
                            <div class="flex flex-wrap align-baseline underline text-cyan-500 gap-2">
                                <button @click="modalShow">Edit</button>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#49eefc" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                            </div>

                            <!--Instructions Edit Modal-->
                            <Modal :show="changeInstructions">
                                <template #default>
                                    <div class="mt-4 py-4 px-5">
                                        <h2 class="text-lg font-medium text-gray-900">
                                            Edit Instructions
                                        </h2>

                                        <p class="mt-1 text-sm text-gray-600">
                                            <span class="font-semibold mr-3">Old Instructions: </span><br>
                                        </p>
                                        <div class="my-6 text-justify">
                                            <pre class="whitespace-pre-wrap">
                                                {{ order.instructions }}
                                            </pre>
                                        </div>


                                        <!--instructions-->
                                        <div class="mt-6 mb-8 m-4">
                                            <label for="instructions" class="block mb-2 text-sm font-semibold dark:text-white">
                                                Instructions:<span class="text-red-500"> *</span>
                                            </label>
                                            <textarea id="instructions"
                                                      name="instructions" rows="8"
                                                      ref="instructionsInput"
                                                      v-model="form.instructions"
                                                      class="block p-2.5 w-full text-sm md:text-md shadow-sm shadow-purple-300 bg-white rounded-lg border border-gray-200 focus:ring-blue-300 focus:border-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            </textarea>
                                        </div>

                                        <div class="mt-6 flex justify-end">
                                            <SecondaryButton @click="modalClose"> Cancel </SecondaryButton>

                                            <PrimaryButton @click="updateInstructions(order.id)" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                Update Instructions
                                            </PrimaryButton>
                                        </div>
                                    </div>
                                </template>


                            </Modal>
                        </div>

                        <hr class="border-1 w-full mx-auto border-blue-900 mb-4">

                        <h3 class="text-md text-gray-700 font-semibold mr-4 border-b border-gray-200">Order title:
                            <span class="text-gray-500 font-medium">{{order.title}}</span>
                        </h3>

                        <p class="my-6 text-gray-700 font-sans font-medium whitespace-pre-wrap">
                            {{ order.instructions }}
                        </p>
                    </div>
                </div>
            </section>

            <Modal :show="confirmComplete" @close="modalClose">
                <div class="mt-4 py-4 px-5">
                    <h2 class="text-lg font-medium text-gray-900">
                        Please Rate the Writer to Complete the order.
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        Rate your overall satisfaction with the order you received.
                    </p>

                    <div class="mt-6">
                        <TextInput id="name" ref="nameInput" v-model="form.review"
                                   type="text" class="mt-1 block w-3/4" placeholder="Leave a Review"
                        />

                        <InputError :message="form.errors.review" class="mt-2" />
                    </div>

                    <div @loadeddata="resetHover()" class="flex">
                        <svg v-for="i in 5" :key="i" width="24px" height="24px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                             class="iconify iconify--emojione cursor-pointer"
                             preserveAspectRatio="xMidYMid meet" fill="#fff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier">
                            <path d="M62 25.2H39.1L32 3l-7.1 22.2H2l18.5 13.7l-7 22.1L32 47.3L50.5 61l-7.1-22.2L62 25.2z"
                                  v-on:mouseover="hoverRating(i)"
                                  @click="setRating()"
                                  :class="i >= hoverValue+1 ? `fill-amber-100` : `fill-[#ffce31]` "
                                  ></path></g>
                        </svg>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="confirmComplete = false"> Cancel </SecondaryButton>

                        <PrimaryButton @click="markCompleted(order.id)" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Mark Complete
                        </PrimaryButton>
                    </div>
                </div>

            </Modal>
            <Modal :show="confirmDispute" @close="modalClose">
                <div class="mt-4 py-4 px-5">
                    <h2 class="text-lg font-medium text-gray-900">
                        Enter a reason for this action to continue.
                    </h2>

                    <div class="mt-6">
                        <textarea id="cancel_reason"
                                  name="cancel_reason" rows="8"
                                  ref="cancelInput"
                                  v-model="form.cancel_reason"
                                  class="block p-2.5 w-full text-sm md:text-md shadow-sm shadow-purple-300 bg-white rounded-lg border border-gray-200 focus:ring-blue-300 focus:border-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </textarea>
                    </div>


                    <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="confirmDispute = false"> Cancel </SecondaryButton>

                        <PrimaryButton @click="disputeOrder(order.id)" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Add Dispute
                        </PrimaryButton>
                    </div>
                </div>

            </Modal>
            <Modal :show="confirmRevision" @close="modalClose">
                <div class="mt-4 py-4 px-5">
                    <h2 class="text-lg font-medium text-gray-900">
                        Enter instructions to be followed to complete the revision.
                    </h2>

                    <div class="mt-6">
                        <textarea id="cancel_reason"
                                  name="cancel_reason" rows="8"
                                  ref="cancelInput"
                                  v-model="form.revision_instructions"
                                  class="block p-2.5 w-full text-sm md:text-md shadow-sm shadow-purple-300 bg-white rounded-lg border border-gray-200 focus:ring-blue-300 focus:border-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </textarea>
                    </div>


                    <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="confirmRevision = false"> Cancel </SecondaryButton>

                        <PrimaryButton @click="requestRevision(order.id)" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Request Revision
                        </PrimaryButton>
                    </div>
                </div>

            </Modal>
            <Modal :show="showMessage" @close="modalClose">
                <div class="mt-4 py-4 px-5 font-serif scroll-auto max-h-screen overflow-y-auto mb-10">

                    <div class="mx-12 my-3 bg-amber-50 px-10 py-6 rounded">
                        <h2 class="text-lg text-center font-bold text-gray-900">
                            Messages for Order #{{ order.id }} {{ pageUser.id }}.
                        </h2>

                        <div v-for="message in messages">
                            <div class="flex flex-col place-items-start m-2 py-2" v-if="message.user_id !== pageUser.id">
                                <p class="bg-green-200 px-4 pb-3 rounded-xl max-w-xs">
                                <span class="text-lime-700 font-semibold underline text-end text-sm">
                                    {{ 'Admin' ?? 'Sender' }}  - <span class="text-xs text-gray-700">{{ getTime(message.created_at) }}</span>
                                </span>
                                    <br>
                                    {{ message.message }}
                                </p>

                            </div>
                            <div class="flex flex-col place-items-end m-2 py-2" v-else>

                                <p class="bg-indigo-200 px-2.5 pb-2 rounded-xl max-w-xs">
                                <span class="text-lime-700 font-semibold underline -mt-2.5 text-end text-sm">
                                    Me ~ <span class="text-xs text-gray-700">{{ getTime(message.created_at) }}</span>
                                </span>
                                    <br> {{ message.message }}
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="m-6 py-4 px-8 mx-12 bg-fuchsia-300 rounded-lg pb-8">
                        <label for="instructions" class="block mb-2 text-sm font-semibold dark:text-white">
                            New Message:
                        </label>
                        <textarea
                            id="message"
                            name="message" rows="5"
                            ref="instructionsInput"
                            v-model="form.message"
                            class="block p-2.5 w-full text-sm md:text-md shadow-sm shadow-purple-300 bg-white rounded-lg border border-gray-200 focus:ring-blue-300 focus:border-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </textarea>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="showMessage = false"> Cancel </SecondaryButton>

                        <PrimaryButton @click="sendMessage(order.id)" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Send Message
                        </PrimaryButton>
                    </div>
                </div>
            </Modal>
        </OrdersCard>
    </ClientLayout>
</template>
