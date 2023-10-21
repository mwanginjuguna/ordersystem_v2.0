<script setup>
import { defineProps } from "vue";

defineProps({
    theme: String,
    default: 'dark'
});

</script>

<template>
    <div :class="{
            'py-2': true,
            'bg-gray-700 border-gray-600 text-white': theme === 'dark',
            'bg-gray-100 border-gray-700 text-black': theme === 'light'
            }">
        <h2 v-if="$slots.heading"  class="font-bold mb-2">

            <slot name="heading" />

        </h2>

        <slot/>

        <footer v-if="$slots.footer" class="border-t border-gray-600 mt-4 pt-2 text-sm">

            <slot name="footer"/>

        </footer>
    </div>
</template>
