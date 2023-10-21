import { defineStore} from 'pinia';
import {usePage} from "@inertiajs/inertia-vue3";
import axios from 'axios';
import {useFlash} from "@/Composables/useFlash";

let {flash} = useFlash();

export const useMessageStore = defineStore('MessageStore', {
    state : () => {
        return {
            messages : {}
        }
    },
    actions : {
        async loadMessages(userId = usePage().props.auth.user.id) {
            try {
                return await fetch(route('messages.show', userId), {
                    method: 'post',
                    body: JSON.stringify({
                        'user_id': userId,
                    })
                }).then(function(res) {

                    return res.json();

                }).then(function(messageData) {
                    // console.log(JSON.stringify(messageData));
                    this.messages = messageData.messages
                    // console.log("order messages: "+ JSON.stringify(orderMessages.value));
                    return messageData;
                });
            } catch (error) {
                console.log(error);
                flash(`Fatal Error!`, 'Could not establish connection with the server.', 'error')
            }
        },
        async sendNewMessage(message, to, receiverDepartment = 'admin', userId = usePage().props.auth.user.id) {
            try {
                const response = await axios.post(route('messages.new'), {
                    userId: userId,
                    message: message,
                    to: to,
                    receiver_department: receiverDepartment
                });

                if (response.status === 200) {
                    flash('Success!', 'Message sent successfully.', 'success');
                    console.log('Success message data: ', response.data);
                    this.messages = response.data.messages;
                } else {
                    flash('Server Error!', `There was a server error in sending your message. Server responded with ${response.status} server error. Try again Later.`, 'error')
                }
            } catch (error) {
                flash('Fatal Error!', 'Failed to establish a connection with the server.', 'error')
            }
        }
    },
    getters: {
        messageCount: () => {
            return this.messages.length
        }
    }
});
