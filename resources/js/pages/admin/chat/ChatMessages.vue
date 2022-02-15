<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages" :key="message.id">
            <div class="clearfix">
                <div class="header">
                    <strong>
                        {{ message.user }}
                    </strong>
                </div>
                <p>
                    {{ message.message }}
                </p>
            </div>
        </li>
        <li>
            <input type="text" v-model="text" placeholder="Message"/>
        </li>
        <button @click="sendMessage">Send</button>
    </ul>
</template>
<script>
import axios from "axios";

export default {
    name: "ChatMessages",
    inject: ['window'],
    data() {
        return {
            messages: [],
            text: null,
        };
    },
    created() {
        this.fetchMessages();
        this.window.Echo.channel('test')
            .listen('MessageSent', (e) => {
                this.messages.push(e.message);
            })
    },
    methods: {
        fetchMessages() {
            //GET request to the messages route in our Laravel server to fetch all the messages
            axios.get('/messages').then(response => {
                //Save the response in the messages array to display on the chat view
                this.messages = response.data.data;
            });
        },
        //Receives the message that was emitted from the ChatForm Vue component
        sendMessage() {
            const receiverID = 147
            //Pushes it to the messages array
            // this.messages.push(msg, receiverID);
            //POST request to the messages route with the message data in order for our Laravel server to broadcast it.
            axios.post(`/messages/${receiverID}`, {message: this.text}).then(response => {
                this.text = null;
            });
        }
    }
};
</script>
