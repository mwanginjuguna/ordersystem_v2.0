<script setup>
import ClientLayout from "../Layouts/ClientLayout.vue";
import OrdersCard from "../Components/OrdersCard.vue";
import OrdersTitle from "../Components/OrdersTitle.vue";
import Modal from "../Components/Modal.vue";
import PrimaryButton from "../Components/PrimaryButton.vue";
import SecondaryButton from "../Components/SecondaryButton.vue";
import {Link, Head, usePage, useForm} from "@inertiajs/inertia-vue3";
import {computed, defineProps, onBeforeMount, ref} from "vue";
import {useFormatTime} from "@/Composables/useFornatedTime";
import {useChatroom} from "@/stores/Chatroom";

let chatroom = useChatroom();

let { formatTime } = useFormatTime();

const useAddNewMessage = ref(false);
let chatMessages = chatroom.chatMessages;

const pageUser = computed(() => {
    return usePage().props.value.auth.user;
});

const props = defineProps({
    messages: Object,
    chats: Object,
    recipients: Array,
    users: Object
});

onBeforeMount( () => {
    chatroom.initialize(props.chats, props.recipients, props.messages);
    // console.log('Chatroom recipients: ', JSON.stringify(chatroom.recipients));
})

let form = useForm({
    'message' : '',
    'userId': pageUser.value.id,
    'recipientId': null ?? 1,
    'draft': null,
    'isRead': null,
    'recipientDepartment': null,
    'title': null,
    'description': null,
})

function deleteMessage(id) {
    route('message.delete', id)
}

function sendMessage(chatId) {
    chatroom.sendChatMessage(chatId, form.data(), pageUser.value.id);
}

function loadChat(chatId) {
    chatroom.loadChat(chatId);
    useAddNewMessage.value = true;
}

function getRecipientName(msgId) {
    let recipientName = 'User'
    // console.log(typeof(chatroom.recipients))
    for (let recipient of chatroom.recipients) {
        // console.log("Recipient: "+recipient);
        if (recipient['id'] === msgId) {
            recipientName = recipient['name']
        }
    }
    return recipientName;
}
function modalClose() {
    useAddNewMessage.value = false;
}
</script>

<template>
    <Head title="Chats" />
    <ClientLayout>
        <template #header>
            <OrdersTitle :title="`Chats`" :about="`Recent conversations.`" />
        </template>
        <section>
            <OrdersCard>
                <section class="text-gray-900 rounded">
                    <div class="m-3 ml-4 p-4 lg:pt-6">
                        <button
                            @click.prevent="useAddNewMessage = true"
                            class="mx-auto p-2 px-4 bg-lime-200 text-purple-900 hover:underline border border-slate-700 rounded hover:bg-lime-300 hover:text-purple-800 active:bg-slate-400 active:ring-purple-900 transition ease-in-out hover:duration-500 active:duration-500"
                        >
                            New Chat
                        </button>
                    </div>
                    <!--All Conversations-->
                    <div class="p-3">
                        <div class="pb-3 text-center underline text-indigo-500 col-span-3">
                            <h3>Chats</h3>
                        </div>
                        <div class="space-y-3">
                            <div v-for="chat in chatroom.chats"
                                 class="flex justify-between md:max-w-2/3 lg:w-full mx-auto border-b border-indigo-400 bg-purple-200 rounded-lg p-2 lg:px-6">
                                <div class="text-base font-serif">
                                    <p class="text-sm">
                                        <span class="text-slate-600">
                                            {{ getRecipientName(chat.recipient_id) === 'kanothe' ? 'Admin' : getRecipientName(chat.recipient_id) }}
                                        </span>
                                    </p>
                                    <p class="text-sm">
                                        <span class="text-lime-600"
                                        >{{ formatTime(chat.created_at) }}</span>

                                    </p>
                                </div>
                                <div class="p-2 flex place-items-center">
                                    <button @click.prevent="loadChat(chat.id)"
                                          class="text-sky-400 hover:text-sky-500 underline underline-offset-4 mx-2"
                                    >Open</button>
                                    <Link
                                        :href="'/'"
                                        class="text-red-600 hover:text-red-900 underline mx-2"
                                    >Remove</Link>
                                </div>

                                <Modal :show="useAddNewMessage" @close="modalClose">
                                    <div class="mt-4 py-4 px-5 scroll-auto max-h-screen overflow-y-auto mb-10 font-serif">

                                        <div class="pb-6 rounded">
                                            <h2 class="text-lg font-bold text-gray-900">
                                                Chat Messages.
                                            </h2>

                                            <div v-for="message in chatMessages">
                                                <div class="flex flex-col place-items-start py-2" v-if="message.user_id !== pageUser.id">
                                                    <div class="bg-green-200 px-4 pb-3 rounded-xl max-w-xs">
                                                        <p class="text-lime-700 font-semibold underline text-end text-sm">
                                                            {{ chatStarter.role === 'A' ? 'Admin' : chatStarter.name }}  -
                                                            <span class="text-xs text-gray-700">{{ formatTime(message.created_at) }}</span>
                                                        </p>
                                                        {{ message.message }}
                                                    </div>

                                                </div>
                                                <div class="flex flex-col place-items-end py-2" v-else>

                                                    <div class="bg-amber-200 px-2.5 pb-2 rounded-xl max-w-xs">
                                                        <p class="py-1 flex justify-between text-lime-700 underline text-xs">
                                                            {{ formatTime(message.created_at) }}
                                                        </p>
                                                        {{ message.message }}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="mt-6 pb-8">
                                            <label for="instructions" class="block mb-2 text-sm font-semibold">
                                                New Message:
                                            </label>
                                            <textarea
                                                id="message"
                                                name="message" rows="3"
                                                ref="instructionsInput"
                                                v-model="form.message"
                                                placeholder="Type a message."
                                                class="block p-2.5 w-full text-xs md:text-sm shadow-sm shadow-purple-300 bg-white rounded-lg border border-gray-200 focus:ring-blue-300 focus:border-blue-300">
                                            </textarea>

                                        </div>

                                        <div class="mt-6 flex justify-end">
                                            <SecondaryButton @click="useAddNewMessage = false"> Cancel </SecondaryButton>

                                            <PrimaryButton @click="sendMessage(chat.id)" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                Send Message
                                            </PrimaryButton>
                                        </div>
                                    </div>
                                </Modal>
                            </div>
                        </div>
                    </div>
                </section>
            </OrdersCard>
        </section>
    </ClientLayout>
</template>
