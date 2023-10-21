<script setup>

import BaseLayout from "../../Layouts/BaseLayout.vue";
import {computed, defineProps, nextTick, onMounted, reactive, ref} from "vue";
import {Link, useForm, Head, usePage} from "@inertiajs/inertia-vue3";
import OrdersCard from "../../Components/OrdersCard.vue";
import OrdersTitle from "../../Components/OrdersTitle.vue";
import Modal from "../../Components/Modal.vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import SecondaryButton from "../../Components/SecondaryButton.vue";
import {useFlash} from "@/Composables/useFlash";
import TextInput from "../../Components/TextInput.vue";
import InputError from "../../Components/InputError.vue";
import axios from "axios";

function showComplete() {
    return (orderObject.status in ['pending', 'new', 'submitted', 'cancelled']);
}

let { flash } = useFlash();
const pageUser = computed(() => {
    return usePage().props.value.auth.user;
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
const receiver = ref('');
let actionsShow = ref(false);

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
    client_id: Number,
    writers: Object,
    writer: String,
    writer_id: Number,
    deadline: String,
    discountAmount: Number,
    currencySymbol: String,
    files: Array,
    senderMessages: Object,
    adminMessages: Object,
    response: String
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
    'writerDeadline': '',
    'message': '',
    'files': [],
    'fileType': '',
    'action': ''
});

const orderForm = useForm({
    'file': ''
})

function uploadFiles(id) {
    form.action = 'upload';
    form.post(route('admin.orders.upload-file', id), {
        onFinish: () => form.reset(),
    });
    form.files = [];
}

function downloadFile(id, filename) {
    fetch(route('admin.files.download', id))
        .then( (response) => {
            return response.blob()
        }).then( (data) => {
            console.log(data)
        let blob = new Blob([data]);
            const url = URL.createObjectURL(blob);
            const a = Object.assign(
                document.createElement('a'),
                {
                    href: url,
                    style:"display: none",
                    download:filename
                });
            console.log(a)
            document.body.appendChild(a);
            a.click();
            URL.revokeObjectURL(url);
            a.remove();
    })
    ;
    //route('admin.files.download', id);
}

function updateInstructions(id) {
    console.log(id);
    form.post(route('admin.orders.store', id), {
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
        form.delete(route('admin.orders.delete', id));
    }
}

function extendDeadline(id) {
    if (confirm("You are adjusting the deadline of the order. Continue?")) {
        form.action = 'extend';
        form.patch(route('admin.orders.extend', id),
            {
                onSuccess: () => confirmExtend.value = false,
                onFinish: () => form.reset()
            }
        );
    }
}

function markCompleted(id) {
    if (confirm("Confirmation. This Order will be marked as completed.")) {
        form.action = 'complete';
        form.patch(route('admin.orders.complete', id),
            {
                onSuccess: () => confirmComplete.value = false,
                onFinish: () => form.reset()
            }
        );
    }
}

function assignWriter(id) {

    form.action = 'assign';

    form.patch(route('admin.orders.assign', id),
        {
            onSuccess: () => confirmAssign.value = false,
            onFinish: () => form.reset()
        }
    );
}

function cancelOrder(id) {
    if (confirm("Confirmation. This Order will be cancelled.")) {

        form.action = 'cancel';

        form.patch(route('admin.orders.cancel', id),
            {
                onSuccess: () => confirmCancel.value = false,
                onFinish: () => form.reset()
            }
        );
    }
}

function disputeOrder(id) {
    if (confirm("Confirmation. This Order will be cancelled.")) {

        form.action = 'dispute';
        form.patch(route('admin.orders.dispute', id),
            {
                onSuccess: () => confirmDispute.value = false,
                onFinish: () => form.reset()
            }
        );
    }
}

function requestRevision(id) {
    if (confirm("Confirmation. This Order will be placed under revision.")) {

        form.action = 'revision';
        form.post(route('admin.orders.revisionRequest', id),
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
            'receiver': receiver.value
        })
    }).then(function(res) {
        return res.json();
    }).then(function(messageData) {
        orderMessages.value = [];
        console.log(JSON.stringify(messageData));
        orderMessages.value.push(messageData);
        messages.value = orderMessages.value[0].messages;
        console.log("order messages: "+ JSON.stringify(orderMessages.value));
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
            'receiver': receiver.value,
            'message': form.message
        })
    }).then(function(res) {
        return res.json();
    }).then(function(messageData) {
        form.reset('message');
        console.log(messageData);
        orderMessages.value = messageData
        messages.value = orderMessages.value[0].messages;
        console.log("order messages: "+orderMessages)
        return messageData;
    });
    showMessage.value = false;
    loadMessages();
    showMessage.value = true;
}

function toggleMessage()
{
    showMessage.value = true;
}

async function showClient(fileId) {
    try {
        const response = await axios.post(route('admin.showClient', fileId))

        // handle success
        if (response.status === 200) {
            console.log(response)
            flash('Success Updating File.', `File options updated successfully. The client can now see and download the file.`, 'success');
            document.location.reload();
        } else {
            console.log(response);

            flash(`Error!`, `Server error occured.`, 'error');
        }
    } catch (error) {
        console.log(error);

        flash(`Error! ${error.name}`, `An error was encountered while establishing a connection with the server. The server responded with ${error.message}`, 'warning');
    }

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

function toggleActions() {
    actionsShow.value = !actionsShow.value;
}
</script>

<template>
    <Head :title="`Order #${ order.id }: ${ order.title }`" />
    <BaseLayout>
        <template #header>
            <OrdersTitle :title="`Order #${order.id}: ${ order.title }`" :about="`Order details page.`"/>
        </template>
        <OrdersCard>
            <div class="max-w-sm lg:max-w-3xl flex flex-col sm:flex-row gap-y-3 sm:justify-between text-xs lg:text-sm">
                <div>
                    <button
                        @click.prevent="toggleMessage()"
                        class="p-2 text-lime-500 hover:text-lime-400 font-semibold underline bg-slate-800 hover:bg-slate-900 rounded-lg flex justify-between">
                        <span class="place-self-center"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#33d420" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></span>
                        <span class="pl-2">Order Messages</span>
                    </button>
                </div>

                <div class="relative">
                    <div @click="toggleActions()" class="py-2 px-3 w-fit flex flex-row items-center cursor-pointer bg-slate-100 hover:bg-slate-200 active:border active:border-green-300 rounded transition-all duration-300 ease-in-out">
                        <p>Actions</p>
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 10L12 14L16 10" stroke="#330066" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </div>

                    <div :class="actionsShow ? `block` : `hidden` " class="absolute w-32 mt-1 flex flex-col gap-y-3 py-2 px-1 items-start bg-slate-100 hover:bg-slate-200 rounded border border-slate-300 text-slate-900 hover:text-sm transition-all duration-300 ease-in-out">
                        <button @click.prevent="deleteOrder( order.id )" class="place-items-start text-red-500 hover:text-red-600 underline">
                            Delete Order
                        </button>

                        <button @click.prevent="confirmExtend = true" class="place-items-start text-fuchsia-500 hover:text-fuchsia-600 underline">Extend Deadline
                        </button>

                        <button @click.prevent="confirmAssign = true"
                                v-if="!writer"
                                class="place-items-start text-purple-500 hover:text-purple-600 underline">
                            Assign Writer
                        </button>

                        <button @click="confirmComplete = true" v-if="order.status !== 'completed'" class="place-items-start text-green-500 hover:text-green-600 underline">
                            Mark Complete
                        </button>

                        <button @click.prevent="confirmRevision = true" class="place-items-start text-sky-500 hover:text-sky-600 underline">
                            Request Revision
                        </button>

                        <button  @click.prevent="confirmCancel = true" class="place-items-start text-yellow-500 hover:text-yellow-600 underline">
                            Cancel
                        </button>

                        <button @click="confirmDispute = true"
                                v-if="order.status === 'cancelled'"
                                class="place-items-start text-sky-500 hover:text-sky-600 underline">
                            Dispute
                        </button>
                    </div>
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
                            </p>
                            <p class="border-b">Amount:
                                <span v-if="order.paid === 1" class="ml-4 md:text-sm text-green-600">
                                    {{currencySymbol}} {{ order.amount }}
                                </span>
                                <span v-else-if="order.amount_due" class="ml-4 md:text-sm text-red-600">
                                    {{currencySymbol}} {{order.amount_due}}
                                </span>
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

                <!--Files-->
                <div class="mt-6 col-span-3">
                    <h3 class="pt- 3 font-bold">Files:</h3>
                    <!--upload/add files-->
                    <div class="p-2.5 py-6 grid gap-x-4 gap-y-3 mt-4 mb-6 bg-slate-200 max-w-2xl text-sm text-slate-800 rounded border border-fuchsia-200">
                        <label class="font-semibold">Add files</label>
                        <input multiple
                               class="text-black bg-white pl-1.5 py-1.5 rounded-md"
                               type="file" id="files"
                               @input="form.files = $event.target.files"
                               name="files[]">
                        <select v-model="form.fileType" class="text-slate-900 rounded-md border-none md:w-2/3">
                            File Type:
                            <option value="">Select File Type</option>
                            <option value="Draft">Draft</option>
                            <option value="Final Copy">Final Copy</option>
                            <option value="Plagiarism Report">Plagiarism Report</option>
                        </select>
                        <button class="flex flex-wrap gap-x-2 mt-4 w-fit px-3 py-1.5 bg-purple-600 hover:bg-purple-700 font-semibold rounded-lg hover:underline text-slate-100 transition-all duration-150 ease-in-out" @click.prevent="uploadFiles(order.id)">
                            Upload
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#f3e8ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.2 15c.7-1.2 1-2.5.7-3.9-.6-2-2.4-3.5-4.4-3.5h-1.2c-.7-3-3.2-5.2-6.2-5.6-3-.3-5.9 1.3-7.3 4-1.2 2.5-1 6.5.5 8.8m8.7-1.6V21"/><path d="M16 16l-4-4-4 4"/></svg>
                        </button>
                    </div>

                    <!--show files-->
                    <div v-if="files.length > 0" class="mt-3 px-3 text-sm border border-gray-200 rounded-lg overflow-x-hidden" v-for="file in files">
                        <div class="grid grid-cols-4 gap-x-2 py-3">
                            <Link class="col-span-4 underline underline-offset-4 decoration-dashed text-slate-700 font-semibold p-2 flex flex-row"

                            >
                                <svg width="15px" height="15px" viewBox="-2.56 -2.56 69.12 69.12" xmlns="http://www.w3.org/2000/svg" fill="#000000" stroke="#000000" stroke-width="0.00064">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g fill-rule="evenodd" clip-rule="evenodd"> <path d="M5.113-.026c-2.803 0-5.074 2.272-5.074 5.074v53.841c0 2.803 2.271 5.074 5.074 5.074h45.773c2.801 0 5.074-2.271 5.074-5.074v-38.605l-18.901-20.31h-31.946z" fill="#7113be"></path> <path d="M55.977 20.352v1h-12.799s-6.312-1.26-6.129-6.707c0 0 .208 5.707 6.004 5.707h12.924z" fill="#5e7b97"></path> <path d="M37.074 0v14.561c0 1.656 1.104 5.791 6.104 5.791h12.799l-18.903-20.352z" opacity=".5" fill="#ffffff"></path> </g> <path d="M26.6 41.467c1.134-1.134 1.134-2.986 0-4.12s-2.986-1.134-4.12 0l-9.167 9.167c-1.134 1.134-1.134 2.986 0 4.12s2.986 1.134 4.12 0l5.625-5.602c.324-.324.324-.856 0-1.181s-.856-.324-1.181 0l-3.542 3.519c-.486.509-1.273.509-1.759 0-.509-.486-.509-1.273 0-1.759l3.519-3.542c1.319-1.296 3.426-1.296 4.722 0 1.296 1.319 1.296 3.426 0 4.722l-5.625 5.625c-2.106 2.106-5.532 2.106-7.662 0-2.106-2.129-2.106-5.555 0-7.662l9.166-9.167c2.13-2.129 5.556-2.129 7.662 0 2.129 2.106 2.129 5.532 0 7.662l-.903.902c-.046-.926-.37-1.829-.926-2.616l.071-.068z" fill="#ffffff"></path> </g></svg>
                                <span class="pl-2">{{ file.name }}</span>
                            </Link>
                            <p>
                                Uploaded by:
                                <span v-if="file.uploaded_by === 'U'" class="font-semibold text-purple-500"> Client </span>
                                <span v-else-if="file.uploaded_by === 'A'" class="text-blue-600 font-semibold"> Admin </span>
                                <span v-else class="text-green-600 font-semibold"> Quality Assurance </span>
                            </p>
                            <p>Filetype: <span class="text-purple-900 font-semibold">{{ file.type }}</span></p>

                            <Link class="p-1 px-2 w-fit rounded-md text-slate-800 bg-purple-200" @click="downloadFile(file.id, file.name)" :as="`button`">Download</Link>

                            <button @click.prevent="showClient(file.id)" class="text-purple-900 font-semibold flex flex-row gap-x-2 place-items-center" v-if="file.uploaded_by !== 'X'">
                                Show client
                                <input :checked="file.show_client" type="checkbox" class="rounded-full border-purple-500 shadow-sm shadow-purple-400">
                            </button>
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

                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>

                    <div class="flex">
                        <label class="block mr-2">
                            <input type="radio" name="rating" value="1" v-model="rating" class="form-checkbox" />
                            <span class="ml-2 text-xs">1 star</span>
                        </label>
                        <label class="block mr-2">
                            <input type="radio" name="rating" value="1" v-model="rating" class="form-checkbox" />
                            <span class="ml-2 text-xs">2 star</span>
                        </label>
                        <label class="block mr-2">
                            <input type="radio" name="rating" value="1" v-model="rating" class="form-checkbox" />
                            <span class="ml-2 text-xs">3 star</span>
                        </label>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="confirmComplete = false"> Cancel </SecondaryButton>

                        <PrimaryButton @click="markCompleted(order.id)" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Mark Complete
                        </PrimaryButton>
                    </div>
                </div>

            </Modal>
            <Modal :show="confirmCancel" @close="modalClose">
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
                        <SecondaryButton @click="confirmCancel = false"> Cancel </SecondaryButton>

                        <PrimaryButton @click="cancelOrder(order.id)" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Cancel Order
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
            <Modal :show="confirmExtend" @close="modalClose">
                <div class="mt-4 py-4 px-5">
                    <h2 class="text-lg font-medium text-gray-900">
                        Enter amount of hours.
                    </h2>

                    <div class="mt-6">
                        <input type="number"
                               id="hours"
                               name="hours"
                               ref="hoursInput"
                               v-model="form.hours"
                               class="block w-full rounded text-gray-900 text-sm">
                    </div>


                    <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="confirmExtend = false"> Cancel </SecondaryButton>

                        <PrimaryButton @click="extendDeadline(order.id)" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Add Hours
                        </PrimaryButton>
                    </div>
                </div>

            </Modal>
            <Modal :show="showMessage" @close="modalClose">
                <div class="mt-4 py-4 px-5 font-serif max-h-screen scroll-auto overflow-y-auto mb-12">

                    <div class="mx-12 my-3 bg-amber-50 px-10 py-6 rounded">
                        <h2 class="text-lg text-center font-bold text-gray-900">
                            Messages for Order #{{ order.id }} {{ pageUser.id }}.
                        </h2>

                        <div v-for="message in messages">
                            <div class="flex flex-col place-items-start m-2 py-2" v-if="message.user_id !== pageUser.id">
                                <div class="bg-green-200 px-4 py-2 rounded-xl max-w-xs">
                                <p class="text-lime-700 underline text-end text-sm">
                                    {{ props.user ?? 'Sender' }} - <span class="text-xs text-gray-700">{{ getTime(message.created_at) }}</span>
                                </p>
                                    {{ message.message }}
                                </div>

                            </div>
                            <div class="flex flex-col place-items-end m-2 py-2" v-else>
                                <div class="bg-indigo-200 px-2.5 py-3 rounded-xl max-w-xs">
                                <p class="text-lime-700 font-semibold underline -mt-2.5 text-end text-sm">
                                    Me ~ <span class="text-xs text-gray-700">{{ getTime(message.created_at) }}</span>
                                </p>
                                    {{ message.message }}
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="m-6 py-4 px-8 mx-12 bg-amber-200 rounded-xl">
                        <label for="instructions" class="block mb-2 text-sm font-semibold dark:text-white">
                            New Message:
                        </label>
                        <textarea
                            id="message"
                            name="message" rows="5"
                            ref="instructionsInput"
                            v-model="form.message"
                            class="block p-2.5 w-full text-sm md:text-md shadow-sm shadow-purple-300 bg-white rounded-lg border border-gray-200 focus:ring-blue-300 focus:border-blue-300">
                        </textarea>
                        <div class="flex flex-wrap space-x-8 m-3 text-sm">
                            <p>Send To: {{ receiver }} </p>
                            <select class="rounded" name="receiver" v-model="receiver">
                                <option value="">Select Receiver</option>
                                <option value="client">Client</option>
                                <option value="writer">Writer</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="showMessage = false"> Cancel </SecondaryButton>

                        <PrimaryButton @click="sendMessage(order.id)" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Send Message
                        </PrimaryButton>
                    </div>
                </div>
            </Modal>
            <Modal :show="confirmAssign" @close="modalClose">
                <div class="mt-4 py-4 px-5">
                    <h2 class="text-lg font-medium text-gray-900">
                        Select Writer.
                    </h2>
                    <div class="mt-6">
                        <select id="assigned_to"
                                v-model="form.assigned_to"
                                class="block w-full rounded text-gray-900 text-sm"
                                name="assigned_to" autofocus>
                            <option disabled value="">Select a writer</option>
                            <option class="text-slate-900" v-for="wr in writers" :value="wr.id">{{ wr.name }}</option>
                        </select>
                    </div>

                    <div>
                        <label class="font-bold mt-4 p-4">
                            Select Deadline
                        </label>
                        <input type="datetime-local" v-model="form.writerDeadline" class="mt-4 px-4 rounded text-gray-900 text-sm">
                    </div>

                    <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="confirmAssign = false"> Cancel </SecondaryButton>

                        <PrimaryButton @click="assignWriter(order.id)" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Assign Writer
                        </PrimaryButton>
                    </div>
                </div>

            </Modal>
        </OrdersCard>
    </BaseLayout>
</template>
