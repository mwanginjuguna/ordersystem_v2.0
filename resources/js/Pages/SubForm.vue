<template>
    <section class="relative grid">
        <form @submit.prevent="saveToLocal" style="z-index: 3;" class="max-w-xs mt-6 p-2 lg:px-4 bg-white rounded-xl shadow shadow-purple-200 text-xs relative">
            <p class="font-bold text-slate-800 text-xl">Calculate Price</p>

            <div class="mt-2">
                <label class="font-semibold text-gray-600">
                    Enter your Title/Topic <span class="text-red-500">* required</span>
                </label><br>
                <input type="text"
                       class="border-1 p-1 w-full text-sm border-gray-200 bg-slate-100 leading-none rounded-sm"
                       v-model="form.title"
                       ref="titleInput"
                       name="title" id="title"
                       placeholder="Leave blank to use Writer's Choice" required>
            </div>
            <!--Service TYpes-->
            <div class="mt-2">
                <select id="service_type"
                        v-model="form.service_type_id"
                        @change="getPrice"
                        class="w-full rounded-lg leading-none border-gray-200 bg-slate-100 text-gray-900"
                        name="service_type" autofocus>
                    <option disabled value="">Select type of service</option>
                    <option v-for="service in services" :value="service.id">{{ service.name }}</option>
                </select>
            </div>

            <div class="flex gap-x-3 mt-1">
                <!--Academic Level-->
                <div class="mt-1">
                    <select id="academic_level"
                            v-model="form.academic_level_id"
                            @change="getPrice"
                            class="w-full rounded-lg border-gray-200 bg-slate-100 leading-none text-gray-900"
                            name="academic_level" autofocus>
                        <option disabled value="">Select your school level</option>
                        <option v-for="level in levels" :value="level.id">{{ level.name }}</option>
                    </select>
                </div>
                <!--Deadline-->
                <div class="mt-2">
                    <select id="deadline"
                            v-model="form.deadline"
                            @change="getPrice"
                            class="w-full rounded-lg border-gray-200 leading-none bg-slate-100 text-gray-900"
                            name="deadline" autofocus>
                        <option disabled value="">Select the deadline</option>
                        <option v-for="rate in rates" :value="rate.hours">{{ rate.name }}</option>
                    </select>
                </div>
            </div>

            <!--Pages-->
            <div class="mt-2">

                    <select id="pages"
                            v-model="form.pages"
                            @change="getPrice"
                            class="w-full border-gray-200 rounded-lg leading-none bg-slate-100 text-gray-900"
                            name="pages" autofocus>
                        <option disabled value="">Select number of Pages</option>
                        <option :value="0">0 Pages/ 0 words</option>
                        <option v-for="page in 200" :key="page" :value="page">{{ page }} page(s) / {{ page * 275 }} words</option>
                    </select>
                </div>

            <!--price-->
            <div class="mt-2">
                <p class="text-sm text-gray-700 text-right p-1">Price: <span class="px-1 underline underline-offset-4 font-bold italic text-lg text-purple-900">${{ amount }}</span></p>
            </div>

            <button type="submit" class="mt-4 mx-auto mb-4 p-2 w-full bg-purple-600 hover:bg-purple-700 text-slate-50 rounded-md text-base place-content-center font-bold font-serif flex flex-row">
                Order Now >
                <span id="blinking-cursor" class="text-sm pl-1">|</span>
            </button>

        </form>
            <div class="absolute inset-0 shadow-sm ml-4 mt-5 -mr-6 bg-purple-50 h-[105%] max-w-xs rounded-2xl" style="z-index: 2;"></div>
            <div class="absolute inset-0 shadow-sm ml-8 mt-16 -mr-12 bg-purple-100 border border-purple-200 h-[102%] max-w-xs rounded-2xl" style="z-index: 1;"></div>
    </section>
</template>

<style>
#blinking-cursor {
    font-weight: 100;
    font-size: 20px;
    color: #ffffff;
    -webkit-animation: 1s blink step-end infinite;
    -moz-animation: 1s blink step-end infinite;
    -ms-animation: 1s blink step-end infinite;
    -o-animation: 1s blink step-end infinite;
    animation: 1s blink step-end infinite;
}

@keyframes blink {
    from, to {
        color: transparent;
    }
    50% {
        color: white;
    }
}

@-moz-keyframes blink {
    from, to {
        color: transparent;
    }
    50% {
        color: black;
    }
}

@-webkit-keyframes blink {
    from, to {
        color: transparent;
    }
    50% {
        color: black;
    }
}

@-ms-keyframes blink {
    from, to {
        color: transparent;
    }
    50% {
        color: black;
    }
}

@-o-keyframes blink {
    from, to {
        color: transparent;
    }
    50% {
        color: black;
    }
}
</style>


<script setup>
import {defineProps, onMounted, ref} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import {parseInt} from "lodash/string";
import {useOrderStore} from "@/stores/OrderStore";


const amount = ref(null);
const baseRate = ref(null);
const levelRate = ref(null);
const serviceRate = ref(null);
const discountRate = ref(null);
const currencySymbol = ref(null);
const loginUser = ref(false);
const authUser = ref(false);
const registerUser = ref(true);

const props = defineProps({
    services: Object,
    levels: Object,
    rates: Object,
    spacings: Object,
    currencies: Object,
});

const form = useForm(
    {
        'title': "Writer's Choice",
        'academic_level_id': 2,
        'subject_id': 1,
        'service_type_id': 1,
        'deadline': 336,
        'pages': 1,
        'slides': 0,
        'sources': 1,
        'instructions': '',
        'referencing_style_id': 1,
        'spacing_id': 1,
        'writer_category_id': 1,
        'discount_id': '',
        'currency_id': 2,
        'language_id': 1, 'extra': '',
        'files': [],
        'amount': '',
        'name': '',
        'email': '',
        'password': '',
        'password_confirmation': '',
    }
);
onMounted(getPrice)

let orderStore = useOrderStore();

const saveToLocal = () => {
    orderStore.form = form.data();
    orderStore.saveToLocal(form.data());
    window.location.href='/orders/new';
}

function getPrice() {
    let total = parseInt(Object.values(props.rates).find((x) => Object.values(x).includes(form.deadline)).amount ?? 0);
    baseRate.value = total;
    levelRate.value = Object.values(props.levels).find( (x)=> Object.values(x).includes(form.academic_level_id) ).rate ?? 0;
    serviceRate.value = Object.values(props.services).find( (x)=> Object.values(x).includes(form.service_type_id) ).rate ?? 0;
    let rateTotal = total + total*(levelRate.value/100) + total*(serviceRate.value/100)

    let pages = form.pages;
    let slides = form.slides;

    total = (Math.round(
        ((rateTotal * pages) + (rateTotal * slides)
        ) * 100)/ 100)
        .toFixed(2);

    amount.value = total;
    amount.value = (Math.round(total * 100)/ 100)
            .toFixed(2);
    form.amount = amount.value;
}

function modalClose() {
    authUser.value = false;
}

function authenticateUser ()
{
    authUser.value = true;
}

function toggleLoginRegister(value) {
    if (value === 'login') {
        loginUser.value = true;
        registerUser.value = false;
    } else {
        loginUser.value = false;
        registerUser.value = true;
    }
}
const showCalculator = ref(true);
function toggleCalculator() {
    showCalculator.value = !showCalculator.value;
}

</script>
