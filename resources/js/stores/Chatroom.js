import { defineStore} from 'pinia';
import {usePage} from "@inertiajs/inertia-vue3";
import axios from 'axios';
import {useFlash} from "@/Composables/useFlash";

let {flash} = useFlash();

export const useChatroom = defineStore('chatroom', {
    state: () => {
        return {
            chats: {},
            recipients: [],
            messages: [],
            chat: [],
            chatRecipient: {},
            chatMessages: {},
            chatUser: {},
            users: {}
        }
    },
    actions: {
        // initialize
        initialize(chats, recipients, messages={}) {
            this.chats = chats;
            this.recipients = this.recipients.concat(recipients);
            this.messages = messages;
            // console.log('Recipients in chatroom.initialize(): ', this.recipients)
        },
        // load chats
        loadChats() {
            try {
                axios.get(route('chats.index'));
            } catch (error) {
                flash('OOPS!! Something went wrong!', `The connection was terminated by an internal server error.`, 'error');
            }
        },
        // create new chat with a message
        async sendChatMessage(chatId = null, form = {}, userId) {
            try {
                const response = await axios.post(route('chats.store'), {
                    message: form.message,
                    recipientId: form.recipientId,
                    chatId: chatId,
                    userId: userId,
                })

                if (response.status !== 200) {
                    console.log('Server Error! ', response.status);
                    console.log('Error Details! ', response.data);
                    flash('Server Error!', `Unable to process new Chat request. Server responded with error code ${response.status}`, 'error')
                } else {
                    // console.log('Send Chat message success: ', response.data);
                    this.chats = response.data.chats;
                    this.recipients = response.data.recipients;
                    this.users = response.data.users;
                    flash('Sent!', "Message sent successfully.", 'success');
                }
            } catch (error) {
                console.log('Connection Error! ', error)
                flash('OOPS!! Something went wrong!', `The connection was terminated by an internal server error.`, 'error');
            }
        },
        // load chat messages using chatId
        async loadChat(chatId) {
            try {
                const response = await axios.post(route('messages.show', chatId));

                if (response.status === 200) {
                    console.log('Send Chat message success: ', response.data)
                    this.chatMessages = response.data.messages;
                    this.chat = response.data.chat;
                    this.chatRecipient = response.data.recipients;
                    this.chatUser = response.data.user;
                } else {
                    console.log('Server Error! ', response.status);
                    console.log('Error Details! ', response.data);
                    flash('Server Error!', 'Server could not load the messages.', 'error');
                }
            } catch (error) {
                console.log('Connection Error! ', error);
                flash('Connection Error!', 'Something is not right! We could not establish a connection with the server. Try again later or report this case to site admin!', 'error');
            }
        },
        // load all recent messages from all chats
        loadAllMessages() {
            console.log('All messages not loaded.');
        }
        // load replies or reactions

    },
    getters: {
        numberOfChats: () => {
            return this.chats.length;
        },
    }
})
