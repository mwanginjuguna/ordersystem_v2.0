<script setup>
import {ref} from "vue";

const showFlash = ref(true)
function hideFlash () {
    showFlash.value = !showFlash;
}
</script>

<template>
    <div>
        <section v-show="showFlash" v-if="$page.props.flash.message">
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex">
                    <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                    <div>
                        <div class="flex justify-between">
                            <p class="font-bold">Alert</p>
                            <button @click="hideFlash">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>

                        <p class="text-sm">{{ $page.props.flash.message }}</p>
                    </div>
                </div>
            </div>
        </section>
        <section v-show="showFlash" v-if="$page.props.flash.success">
            <div class=" rounded-lg mx-auto items-center text-center py-4 lg:px-4">
                <div class="p-6 bg-indigo-100 items-center text-indigo-800 leading-none lg:rounded-xl flex lg:inline-flex" role="alert">
                    <span class="flex rounded-full bg-green-400 uppercase px-3 py-2 text-xs font-bold mr-3">Success</span>
                    <span class="font-semibold mr-2 text-left flex-auto">{{ $page.props.flash.success }}</span>
                    <button @click="hideFlash">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
            </div>
        </section>
    </div>
</template>
