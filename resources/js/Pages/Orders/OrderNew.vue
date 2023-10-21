<script setup>
import BaseLayout from "../../Layouts/BaseLayout.vue";
import OrdersCard from "../../Components/OrdersCard.vue";
import {defineProps, onMounted, ref} from "vue";
import {Head, useForm} from "@inertiajs/inertia-vue3";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import {parseInt} from "lodash/string";

const amount = ref(null);
const levelRate = ref(null);
const serviceRate = ref(null);
const subjectRate = ref(null);
const spacingRate = ref(null);
const writerRate = ref(null);
const extrasRate = ref(null);
const currencyRate = ref(null);
const discountRate = ref(null);
const discountCode = ref(null);
const discountInvalid = ref(false);

const props = defineProps({
    order: Object,
    errors: Object,
    services: Object,
    levels: Object,
    subjects: Object,
    rates: Object,
    spacings: Object,
    styles: Object,
    writerCategories: Object,
    extras: Object,
    languages: Object,
    currencies: Object,
    discounts: Object,
})

const form = useForm(
    {
        'title': '',
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
        'amount': amount.value,
    }
);

const addOrder = () => {
    // ask user to register or save order to localStorage
    form.post(route('orders.new'), {
        preserveScroll: true,
        onFinish: () => form.reset(),
    });
}

onMounted(getPrice);

function checkDiscount()
{
    if (discountCode)
    {
        const discountItem = Object.values(props.discounts).find( (x) => Object.values(x).includes(discountCode.value) );

        if (discountItem !== null && discountItem !== undefined)
        {
            discountInvalid.value = false;
            form.discount_id = Object.values(props.discounts).find((x) => Object.values(x).includes(discountCode.value)).id;
            discountRate.value = Object.values(props.discounts).find((x) => Object.values(x).includes(discountCode.value)).rate;

            getPrice();
        } else
        {
            discountInvalid.value = true;
        }
    }
}

function getPrice() {
    let total = parseInt(Object.values(props.rates).find((x) => Object.values(x).includes(form.deadline)).amount ?? 0);

    levelRate.value = Object.values(props.levels).find( (x)=> Object.values(x).includes(form.academic_level_id) ).rate ?? 0;
    subjectRate.value = Object.values(props.subjects).find( (x)=> Object.values(x).includes(form.subject_id) ).rate ?? 0;
    serviceRate.value = Object.values(props.services).find( (x)=> Object.values(x).includes(form.service_type_id) ).rate ?? 0;
    spacingRate.value = Object.values(props.spacings).find( (x)=> Object.values(x).includes(form.spacing_id) ).rate ?? 0;
    writerRate.value = Object.values(props.writerCategories).find( (x)=> Object.values(x).includes(form.writer_category_id) ).rate ?? 0;
    currencyRate.value = Object.values(props.currencies).find( (x)=> Object.values(x).includes(form.currency_id) ).rate ?? 0;

    let rateTotal = total + total*(levelRate.value/100) + total*(subjectRate.value/100) + total*(serviceRate.value/100) + total*(spacingRate.value/100) + total*(writerRate.value/100) + total*(currencyRate.value/100)

    let pages = form.pages;
    let slides = form.slides;

    total = (Math.round(
        ((rateTotal * pages) + (rateTotal * slides)
    ) * 100)/ 100)
        .toFixed(2);

    amount.value = total;
    form.amount = total;
    if (discountRate.value !== null)
    {
        amount.value = (Math.round(
            (total - ((discountRate.value / 100) * total))
            * 100)/ 100)
            .toFixed(2);
    } else
    {

        amount.value = (Math.round(total * 100)/ 100)
            .toFixed(2);
    }
}
</script>

<template>
    <Head :title="`Create A New Order - ${$page.props.websiteName}`" />
    <BaseLayout>
        <template #header>
            <h1 class="font-bold sm:font-extrabold text-indigo-900 leading-8 text-center text-xl md:text-4xl">
                Create a New Order
            </h1>
            <p class="justify-self-center text-center text-xs text-gray-500 p-4 border-b border-purple-500">
                <span class="font-bold">About: </span>Place an order for an assignment or a task.
            </p>
        </template>
        <OrdersCard>
            <section>
                <div class="mx-auto sm:m-2 p-2">
                    <form>
                        <div class="px-4 py-5 sm:p-6 shadow rounded">
                            <div class="mx-4 mb-4">
                                <label class="text-sm font-semibold">
                                    Title/Topic <span class="text-red-500 text-sm">*</span>
                                </label><br>
                                <input type="text"
                                       class="border-1 p-2 w-full md:w-4/5 border-gray-400 text-sm rounded"
                                       v-model="form.title"
                                       ref="titleInput"
                                       name="title" id="title"
                                       placeholder="Enter Topic of your Assignment/Paper" required>
                            </div>
                            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-2">

                                <!--Academic Level-->
                                <div class="mx-4">
                                    <label for="academic_level" class="font-semibold text-sm">
                                        Academic Level
                                    </label>
                                    <select id="academic_level"
                                            v-model="form.academic_level_id"
                                            @change="getPrice"
                                            class="block w-full rounded text-gray-900 text-sm"
                                            name="academic_level" autofocus>
                                            <option disabled value="">Select your school level</option>
                                            <option v-for="level in levels" :value="level.id">{{ level.name }}</option>
                                    </select>
                                </div>

                                <!--Service TYpes-->
                                <div class="mx-4">
                                    <label for="academic_level" class="font-semibold text-sm">
                                        Type of Service
                                    </label>

                                    <select id="service_type"
                                            v-model="form.service_type_id"
                                            @change="getPrice"
                                            class="block w-full rounded text-gray-900 text-sm"
                                            name="service_type" autofocus>
                                        <option disabled value="">Select type of service</option>
                                        <option v-for="service in services" :value="service.id">{{ service.name }}</option>
                                    </select>
                                </div>

                                <!--Subjects-->
                                <div class="mx-4">
                                    <label for="academic_level" class="font-semibold text-sm">
                                        Subject
                                    </label>

                                    <select id="service_type"
                                            v-model="form.subject_id"
                                            @change="getPrice"
                                            class="block w-full rounded text-gray-900 text-sm"
                                            name="service_type" autofocus>
                                        <option disabled value="">Select your area of study</option>
                                        <option v-for="subject in subjects" :value="subject.id">{{ subject.name }}</option>
                                    </select>
                                </div>

                                <!--Deadline-->
                                <div class="mx-4">
                                    <label for="deadline" class="font-semibold text-sm">
                                        Deadline
                                    </label>

                                    <select id="deadline"
                                            v-model="form.deadline"
                                            @change="getPrice"
                                            class="block w-full rounded text-gray-900 text-sm"
                                            name="deadline" autofocus>
                                        <option disabled value="">Select the deadline</option>
                                        <option v-for="rate in rates" :value="rate.hours">{{ rate.name }}</option>
                                    </select>
                                </div>

                                <!--Pages-->
                                <div class="mx-4">
                                    <label for="deadline" class="font-semibold text-sm">
                                        Pages
                                    </label>

                                    <select id="deadline"
                                            v-model="form.pages"
                                            @change="getPrice"
                                            class="block w-full rounded text-gray-900 text-sm"
                                            name="deadline" autofocus>
                                        <option disabled value="">Select number of Pages</option>
                                        <option :value="0">0 Pages/ 0 words</option>
                                        <option v-for="page in 200" :key="page" :value="page">{{ page }} page(s) / {{ page * 275 }} words</option>
                                    </select>
                                </div>

                                <!--slides-->
                                <div class="mx-4">
                                    <label for="slides" class="font-semibold text-sm">
                                        Slides
                                    </label>

                                    <input id="slides"
                                           v-model="form.slides"
                                           @change="getPrice"
                                           type="number"
                                           class="block w-full rounded text-gray-900 text-sm"
                                           name="slides" autofocus>
                                </div>

                                <!--Referencing styles-->
                                <div class="mx-4">
                                    <label for="referencing_style" class="font-semibold text-sm">
                                        Referencing Style
                                    </label>

                                    <select id="referencing_style"
                                            v-model="form.referencing_style_id"
                                            class="block w-full rounded text-gray-900 text-sm"
                                            name="referencing_style" autofocus>
                                        <option disabled value="">Select Referencing Style</option>
                                        <option v-for="style in styles" :value="style.id">{{ style.name }}</option>
                                    </select>
                                </div>

                                <!--Line Spacing-->
                                <div class="mx-4">
                                    <label for="spacing" class="font-semibold text-sm">
                                        Line Spacing
                                    </label>

                                    <select id="spacing"
                                            v-model="form.spacing_id"
                                            @change="getPrice"
                                            class="block w-full rounded text-gray-900 text-sm"
                                            name="spacing" autofocus>
                                        <option disabled value="">Select line spacing</option>
                                        <option v-for="spacing in spacings" :value="spacing.id">{{ spacing.name }}</option>
                                    </select>
                                </div>

                                <!--sources-->
                                <div class="mx-4">
                                    <label for="sources" class="font-semibold text-sm">
                                        Sources
                                    </label>

                                    <input id="sources"
                                           v-model="form.sources"
                                           type="number"
                                           class="block w-full rounded text-gray-900 text-sm"
                                           name="sources" autofocus>
                                </div>
                            </div>

                            <!--instructions-->
                            <div class="mb-8 m-4">
                                <label for="instructions" class="block mb-2 text-sm font-semibold dark:text-white">
                                    Instructions:<span class="text-red-500"> *</span>
                                </label>
                                <textarea id="instructions"
                                          name="instructions" rows="8"
                                          v-model="form.instructions"
                                          class="block p-2.5 w-full text-sm md:text-md shadow-sm shadow-purple-300 bg-white rounded-lg border border-gray-200 focus:ring-blue-300 focus:border-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                          placeholder="Write or Copy-and-Paste Instructions here. You can also attach additional files below ...">
                                </textarea>
                            </div>

                            <div class="grid sm:grid-cols-2 md:grid-cols-3">
                                <div class="m-4">
                                    <label for="writer_category" class="text-sm">
                                        Writer Category:
                                    </label>
                                    <select id="writer_category" class="block w-full md:w-4/5 rounded text-gray-900 text-sm"
                                            v-model="form.writer_category_id"
                                            @change="getPrice"
                                            name="writer_category" autofocus>
                                        <option disabled value="">Select preferred Writer group</option>
                                        <option v-for="category in writerCategories" :value="category.id">{{ category.name }}</option>
                                    </select>
                                </div>
                                <div class="m-4">
                                    <label for="language" class="text-sm">
                                        Language:
                                    </label>
                                    <select id="language"
                                            class="block w-full md:w-4/5 rounded text-gray-900 text-sm"
                                            v-model="form.language_id"
                                            name="language" autofocus>
                                        <option disabled value="">Select preferred Language</option>
                                        <option v-for="language in languages" :value="language.id">{{ language.name }}</option>
                                    </select>
                                </div>
                                <div class="m-4">
                                    <label for="currency" class="text-sm">
                                        Currency:
                                    </label>
                                    <select id="currency"
                                            class="block w-full md:w-4/5 rounded text-gray-900 text-sm"
                                            name="currency"
                                            @change="getPrice"
                                            v-model="form.currency_id"
                                            autofocus>
                                        <option disabled value="">Select default Currency</option>
                                        <option v-for="currency in currencies" :value="currency.id">{{ currency.name }} ({{ currency.symbol }})</option>
                                    </select>
                                </div>
                                <div class="m-4">
                                    <!--Discount-->
                                    <label for="discount" class="text-sm">
                                        Discount:
                                    </label>
                                    <input type="text"
                                           class="border-1 p-2 w-full md:w-4/5 border-gray-400 text-sm rounded"
                                           name="discount" id="discount" v-model="discountCode"
                                           @change="checkDiscount"
                                           placeholder="Enter a Discount Code">
                                    <p v-show="discountInvalid" class="text-xs text-red-400">Invalid/Expired code</p>
                                </div>
                                <div class="m-4">
                                    <p class="block mb-2 text-sm font-medium text-gray-600 dark:text-white">
                                        Additional Features:<span class="text-gray-500 text-xs"> Optional</span>
                                    </p>

                                    <div v-for="extra in extras" class="flex justify-between">
                                        <label for="{{extra.id}}" class="text-sm">
                                            {{extra.name}}:
                                        </label>
                                        <input type="checkbox" id="{{ extra.id }}" name="additional_features"
                                               v-model="form.extra"
                                               :value="extra.name"
                                               class="ml-4 text-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="block">
                                <div class="m-4">
                                    <label for="files">Files</label>
                                    <div class="grid grid-cols-3 mt-3 text-sm">
                                        <input multiple
                                               class="text-black"
                                               type="file" id="files"
                                               @input="form.files = $event.target.files"
                                               name="files[]">
                                    </div>

                                </div>
                                <div class="m-4">
                                    <p>Price: $ {{ amount }}</p>
                                    <input hidden v-model="form.amount" >
                                </div>
                            </div>
                            <PrimaryButton @click="addOrder" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Create Order
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
                New Order Here
            </section>
        </OrdersCard>
    </BaseLayout>
</template>
