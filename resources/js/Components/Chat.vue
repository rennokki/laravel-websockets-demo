<template>
    <div class="p-6 flex flex-row">
        <div class="w-1/4 flex flex-col">
            <ul class="overflow-y-auto h-full mr-3 border rounded-lg p-2">
                <li
                    v-for="user in users"
                    :key="user.id"
                >
                    {{ user.name }}
                </li>
            </ul>
        </div>

        <div class="w-3/4 flex flex-col">
            <ul class="max-h-96 mb-auto overflow-y-auto h-full mr-3 border rounded-lg p-2">
                <template v-if="messages.length === 0">
                    No messages
                </template>
                <template v-else>
                    <li
                        v-for="(message, index) in messages"
                        :key="index"
                    >
                        <span :class="{ 'font-bold': message.user.id === $page.user.id }">
                            {{ message.user.name }}:
                        </span>
                        {{ message.message }}
                    </li>
                </template>
            </ul>
            <div class="mt-5">
                <input
                    v-on:keyup.enter="sendMessage"
                    v-model="message"
                    type="text"
                    class="p-2 w-full border-2 rounded-lg focus:outline-none focus:border-black"
                    placeholder="Type your message and press enter..."
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        message: null,
        users: [],
        messages: [],
    }),
    created () {
        this.$echo
            .join('chat')
            .here(users => {
                console.log(this.$echo.socketId());
                this.users = users;
            })
            .joining(user => {
                let userExists = this.users.filter(existingUser => existingUser.id === user.id).length > 0;

                if (! userExists) {
                    this.users.push(user);
                }
            })
            .leaving(user => {
                this.users.splice(this.users.indexOf(user), 1);
            })
            .listen('.message', event => {
                this.messages.push({ message: event.message, user: { name: event.user.name } })
            });
    },
    beforeDestroy () {
        this.$echo.leave('chat');
    },
    methods: {
        sendMessage () {
            this.$axios.post('/send-message', { message: this.message }, { headers: { 'X-Socket-ID': this.$echo.socketId() } })
                .then(res => {
                    this.messages.push({ message: this.message, user: { name: 'Me' } });
                    this.message = null;
                });
        }
    }
}
</script>
