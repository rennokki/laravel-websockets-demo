<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Laravel WebSockets Demo
            </h2>

            <div>
                Logged in as {{ $page.user.name }}
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <chat />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from './../Layouts/AppLayout';
import Chat from './../Components/Chat';

export default {
    components: {
        AppLayout,
        Chat,
    },
}
</script>
