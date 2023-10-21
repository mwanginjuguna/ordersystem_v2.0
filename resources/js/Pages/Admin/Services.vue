<script setup>
import AdminSettings from "../../Components/AdminSettings.vue";
import {ref} from "vue";
import {Head} from "@inertiajs/inertia-vue3";

defineProps({
    services: Object
});
</script>
<template>
    <Head title="Services" />
    <AdminSettings :delete-route="`admin.service`" :model-object="services" :add-route="`admin.services`"
                   :setting-title="`Service Type`"
                   :setting-description="`Add a service e.g. Essay Writing Service, Report Writing, Coding, Dissertation. The rates expect a percentage number e.g 20 for 20% increase on the total order price.`"
    >
    </AdminSettings>
</template>
