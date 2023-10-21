<script setup>
import ClientLayout from "../../Layouts/ClientLayout.vue";
import OrdersCard from "../../Components/OrdersCard.vue";
import OrdersTitle from "../../Components/OrdersTitle.vue";
import Modal from "../../Components/Modal.vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import SecondaryButton from "../../Components/SecondaryButton.vue";
import {Link, Head, usePage} from "@inertiajs/inertia-vue3";
import {defineProps, ref} from "vue";
import {useFormatTime} from "@/Composables/useFornatedTime";

let { formatTime } = useFormatTime();

const useAddNewMessage = ref(false);

const props = defineProps({
    messages: Object,
    chats: Object,
    recipients: Array
})

function deleteMessage(id) {
    route('message.delete', id)
}

function getRecipientName(msgId) {
    for (let recipient of props.recipients) {
        return recipient.id === msgId ? recipient.name : 'User';
    }
}
function modalClose() {
    useAddNewMessage.value = false;
}
</script>

<template>
    <Head title="Messages" />
    <ClientLayout>
        <template #header>
            <OrdersTitle :title="`Order Messages`" :about="`Recent conversations.`" />
        </template>
        <section>
            <OrdersCard>
                <section class="bg-white text-gray-900 rounded">
                    <div class="m-3 ml-4 p-4 lg:pt-6">
                        <button
                            @click.prevent="useAddNewMessage = true"
                            class="mx-auto p-2 px-4 bg-lime-200 text-purple-900 hover:underline border border-slate-700 rounded hover:bg-lime-300 hover:text-purple-800 active:bg-slate-400 active:ring-purple-900 transition ease-in-out hover:duration-500 active:duration-500"
                        >
                            New Chat
                        </button>
                    </div>
                    <!--All Conversations-->
                    <div>
                        <div class="p-3 lg:py-10 lg:px-8 m-2 md:grid md:grid-cols-3 lg:mx-8 lg:my-4">
                            <div class="text-center underline text-indigo-500 col-span-3">
                                <h3>Messages</h3>
                            </div>
                            <div class="md:col-span-2 lg:col-span-3 space-y-6">
                                <div v-for="chat in chats"
                                     class="flex justify-between md:max-w-2/3 lg:w-full mx-auto border-b border-indigo-400 bg-purple-200 rounded-lg p-2 lg:px-6">
                                    <div class="text-slate-700 text-base font-serif">
                                        <p>
                                            <strong>to</strong>:
                                            <span class="text-blue-900 text-sm">{{ getRecipientName(message.to) }}</span>
                                        </p>
                                        <p class="">
                                            <strong>from</strong>:
                                            <span class="text-blue-600 text-sm">#{{ message.user.name }}</span>
                                        </p>
                                        <p class="text-sm">
                                            sent:
                                            <span class="text-gray-600"
                                            >#{{ formatTime(message.created_at) }}</span>

                                        </p>
                                    </div>
                                    <div class="p-2">
                                        <Link :href="'/'"
                                              class="text-sky-400 hover:text-sky-500 underline mx-2"
                                        >view</Link>
                                        <Link
                                            :href="'/'"
                                            class="text-red-400 hover:text-red-500 underline mx-2"
                                        >Delete</Link>
                                    </div>
                                </div>

                                <div class="flex justify-between lg:w-full mx-auto border border-indigo-400 bg-purple-200 rounded-lg p-2 lg:px-6">
                                    <div class="grid grid-cols-2 gap-4">
                                        <p>
                                            from:
                                            <span class="text-gray-600">{{ "message.sender.name" }}</span>
                                        </p>
                                        <p class="text-xs">
                                            to:
                                            <span class="text-gray-600">#{{ "message.receiver.name" }}</span>
                                        </p>
                                        <p class="text-xs">
                                            sent:
                                            <span class="text-gray-600">#{{ 'formatTime(message.created_at)' }}</span>
                                        </p>
                                    </div>
                                    <div class="p-2">
                                        <Link
                                              class="text-sky-400 hover:text-sky-500 underline mx-2"
                                        >view</Link>
                                        <Link

                                            class="text-red-400 hover:text-red-500 underline mx-2"
                                        >Delete</Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <Modal :show="useAddNewMessage" @close="modalClose">
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

                                <PrimaryButton @click="sendMessage" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Send Message
                                </PrimaryButton>
                            </div>
                        </div>
                    </Modal>
                </section>
            </OrdersCard>
        </section>
    </ClientLayout>
</template>
