<template>
    <div class="min-h-screen bg-gray-100 md:pb-10">
        <home-nav-layout :canLogin="canLogin" :canRegister="canRegister"/>
        <div class="container flex flex-col justify-center mx-auto lg:w-3/5 md:mt-10 bg-white md:rounded-lg shadow-xl">
            <div class="flex justify-center">
                <h2 class="text-2xl py-4 mt-5">Contact Vendor</h2>
            </div>


            <div class="container flex flex-col justify-center mx-auto h-auto w-4/5 mt-5 pb-8 bg-white rounded-lg">
                <div class="flex justify-start">
                    <inertia-link :href="route('home')" class="no-underline text-center text-sm px-4 py-2 border rounded hover:border-transparent text-white bg-blue-400 hover:bg-blue-300 sm:mt-0">
                        <p> &lt;- Home</p>
                    </inertia-link>
                </div>
                <div class="border rounded py-2 my-2 flex">
                    <div class="flex flex-col w-3/5 justify-start">
                        <form @submit.prevent="form.post('/contact/sendmailvendor', {preserveScroll: true, onSuccess: () => form.reset(),})" novalidate="true">
                            <div class="flex flex-col">
                                <div class="flex flex-col justify-start py-4 px-2">
                                    <label class="text-md text-gray-700 uppercase font-bold" for="vendor">Vendor:</label>
                                    <select name="vendor" v-model="form.vendor" class="shadow appearance-none border rounded w-full py-2 mb-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                        <option :value="null" hidden disabled selected>Please select one</option>
                                        <option :key="program.id" v-for="program in programs" :value="program.user.email">{{program.Title}}</option>
                                    </select>
                                    <div v-if="form.errors.vendor" class="text-red-600">Vendor is required</div>
                                </div>
                                <div class="flex flex-col justify-start py-4 px-2">
                                    <label class="text-md text-gray-700 uppercase font-bold" for="name">Full name:</label>
                                    <input type="text" name="name" v-model="form.name" placeholder="Enter your name..." class="shadow appearance-none border rounded w-full py-2 mb-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <div v-if="form.errors.name" class="text-red-600">Name is required</div>
                                </div>
                                <div v-if="$page.props.user" class="flex flex-col justify-start py-4 px-2">
                                    <label class="text-md text-gray-700 uppercase font-bold" for="email">Email:</label>
                                    <select name="email" v-model="form.email" class="shadow appearance-none border rounded w-full py-2 mb-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                        <option>{{$page.props.user.email}}</option>
                                    </select>
                                    <div v-if="form.errors.email" class="text-red-600">Email is required</div>
                                </div>
                                <div v-else class="flex flex-col justify-start py-4 px-2">
                                    <label class="text-md text-gray-700 uppercase font-bold" for="email">Email:</label>
                                    <input type="email" name="email" v-model="form.email" placeholder="Enter your email..." class="shadow appearance-none border rounded w-full py-2 mb-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <div v-if="form.errors.email" class="text-red-600">Email is required</div>
                                </div>
                                <div class="flex flex-col justify-start py-4 px-2">
                                    <label class="text-md text-gray-700 uppercase font-bold" for="message">Message:</label>
                                    <textarea name="message" v-model="form.message" placeholder="Enter your message..." class="shadow appearance-none border rounded w-full h-32 md:h-64 py-2 mb-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                                    <div v-if="form.errors.message" class="text-red-600">Message is required</div>
                                </div>
                            </div>
                            <div class="flex justify-end px-4">
                                <button type="submit" :disabled="form.processing" class="no-underline text-center text-sm px-4 py-2 border rounded hover:border-transparent text-white bg-green-400 hover:bg-green-300 sm:mt-0">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="w-2/5 flex flex-col justify-center p-4">
                        <p class="py-8 text-gray-500">Please fill in the form on the left to contact the vendor of the selected program. </p>
                        <p class="py-8 text-gray-500">Once the Vendor has seen your message they will be in touch as soon as they can.</p>
                        <p class="py-8 text-gray-500">If you want to contact the site admins, please, <inertia-link :href="route('Contact')" class="no-underline hover:underline text-blue-500 hover:text-blue-600">click here</inertia-link></p>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</template>

<script>

import HomeNavLayout from "../Layouts/HomeNavLayout"
import { useForm } from '@inertiajs/inertia-vue3'

    export default {

        props: {
            'canLogin': Boolean,
            'canRegister': Boolean,
            'programs': Array,
        },
        
        setup() {
            const form = useForm({
                vendor: null,
                name: null,
                email: null,
                message: null,
            })

            return { form }
        },
        
        components: {
            HomeNavLayout,
        },

        methods: {

        },
    }
</script>
