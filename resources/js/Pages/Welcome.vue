<template>
    <div class="min-h-screen bg-gray-100 md:pb-10">
        <home-nav-layout :canLogin="canLogin" :canRegister="canRegister"/>
        <div class="container mx-auto h-auto lg:w-3/5 md:mt-10 bg-white md:rounded-lg shadow-xl">
            <div class="flex justify-center">
                <h2 class="text-2xl py-4 mt-5">Open Programs</h2>
            </div>

            <div class="container mx-auto h-auto w-4/5 mt-5 pb-8 bg-white rounded-lg">
                <div :key="program.id" v-for="program in programs" class="border rounded py-2 my-2">
                    <div class="flex flex-col justify-center md:flex-row md:justify-between">
                        <div class="flex flex-col md:flex-row md:justify-between">
                            <h4 class="text-lg px-4 py-2 text-center">{{program.Title}}</h4>
                            <p class="px-8 py-4 text-gray-500">{{program.Excerpt}}</p>
                        </div>

                        <div class="px-1 flex flex-col md:flex-row md:items-center">
                            <inertia-link v-if="$page.props.user && activeReportPresent(program.id)" :href="route('JoinProgram')" method="post" :data="{user_id: $page.props.user.id, program_id: program.id }" class="no-underline text-sm px-4 py-2 my-1 border rounded hover:border-transparent text-white bg-green-400 hover:bg-green-300 sm:mt-0">
                                Join
                            </inertia-link>
                            <inertia-link :href="'/program/' + program.id" class="no-underline text-center text-sm px-4 py-2 my-1 lg:mr-2 lg:ml-2 border rounded hover:border-transparent text-white bg-blue-400 hover:bg-blue-300 sm:mt-0">
                                View
                            </inertia-link>

                            <inertia-link :href="route('ContactVendor')" class="no-underline text-center text-sm px-4 py-2 my-1 border rounded hover:border-transparent text-white bg-blue-400 hover:bg-blue-300 sm:mt-0">
                                Contact
                            </inertia-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</template>

<script>

import HomeNavLayout from "../Layouts/HomeNavLayout"

    export default {

        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            programs: Array,
            activeReports: Array,
        },
        
        components: {
            HomeNavLayout,
        },

        methods: {
            activeReportPresent: function(program_id) {
                let isPresent = false;
                this.activeReports.forEach(function(activeReport){
                    if(activeReport.program_id === program_id) {
                        isPresent = true;
                    }
                });
                if(isPresent){
                    return false;
                }
                else {
                    return true;
                }
            },
        },
    }
</script>
