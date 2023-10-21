<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import SubForm from "@/Pages/SubForm.vue";
import { ref, onMounted } from 'vue'
import GuestLayout from "@/Layouts/GuestLayout.vue";

const scrollY = ref(0)
const imgClass = ref('max-w-[4rem]')

// Update the image class based on scroll position
window.addEventListener('scroll', () => {
    scrollY.value = window.scrollY

    if (scrollY.value > 0) {
        imgClass.value = 'max-w-[2rem] h-auto transition-all duration-300'
    } else {
        imgClass.value = 'max-w-[4rem] h-auto transition-all duration-300'
    }
})

onMounted(() => {
    // Initial scroll position
    scrollY.value = window.scrollY
});

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});

</script>

<template>
    <Head title="Case Study Pro" />
    <GuestLayout>
        <div
            class="relative min-h-screen bg-gray-50 sm:pt-0"
        >
            <div class="sm:px-6 lg:px-12 py-4 lg:py-12">
                <!-- hero section -->
                <div class="max-w-7xl grid lg:grid-cols-3 h-full pt-8 sm:pt-0 gap-2">
                    <div class="pb-10 px-8 lg:col-span-2">
                        <h1 class="text-center lg:text-left text-3xl  lg:text-5xl text-slate-700 font-extrabold font-serif uppercase">Case Study Pro</h1>

                        <p class="mt-9 md:py-2 px-4 text-justify text-slate-600 font-medium text-xl border-l-4">
                            Looking for case study writing assistance? Our team of talented and experienced writers can help with custom writing, editing, and research services. <br>
                            Our case study writers, analysts, and researchers are Ph.D. experts dedicated to providing technical case study help across the world.
                        </p>

                        <button type="submit" class="mt-9 mb-4 p-2 bg-purple-600 hover:bg-purple-700 text-slate-50 rounded-md text-xl font-bold font-serif flex flex-row">
                            Write My Case Study
                            <span id="blinking-cursor" class="text-sm pl-1">|</span>
                        </button>

                        <div class="mt-9">
                            <p class="text-slate-600 text-lg font-medium">We have served <span class="text-xl font-bold text-purple-900">450+</span> happy customers.</p>
                            <p class="mt-3 text-purple-500 font-semibold underline underline-offset-4">Starts at $14.00 per page (275 words)</p>
                        </div>

                        <!--stats-->
                        <div class="mt-3 pt-8 grid lg:grid-cols-2 gap-5 text-sm border-t">

                            <div class="flex flex-row gap-x-6 border rounded-md border-purple-200 p-1 px-3 bg-white">
                                <svg class="place-self-center" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" width="54px" height="54px" fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle style="fill:#52267e;" cx="256" cy="256" r="256"></circle> <path style="fill:#490a66;" d="M286.029,133.18l-9.869,4.942l-44.297-44.297l5.086,23.249l27.112,27.112l-44.26,22.171 l-21.413,30.501l45.547,45.547v31.873l-18.061-18.061l-7.04,54.555l80.551,80.551l-74.043,33.62l81.92,81.922 c87.747-17.836,159.185-80.549,189.309-163.14L286.029,133.18z"></path> <polygon style="fill:#FFEDB5;" points="231.862,93.827 250.916,124.554 286.029,133.18 262.692,160.797 265.338,196.856 231.862,183.198 198.385,196.856 201.032,160.797 177.697,133.18 212.808,124.554 "></polygon> <polygon style="fill:#FEE187;" points="231.862,93.827 250.916,124.554 286.029,133.18 262.692,160.797 265.338,196.856 231.862,183.198 "></polygon> <path style="fill:#FFC61B;" d="M225.871,256.217c0,0-10.474-0.684-10.299,9.042v53.039c0,14.105,5.604,27.632,15.579,37.605 l7.373,7.373v38.419h70.68v-36.4l5.951-5.951c10.885-10.885,16.999-25.648,16.999-41.043v-71.521 c0-6.284-4.842-11.762-11.123-11.952c-6.499-0.195-11.828,5.015-11.828,11.471v23.599h-2.975v-30.117 c0-5.825-4.158-11.04-9.933-11.804c-6.99-0.926-13.017,4.555-13.017,11.374V269.9h-3.718v-38.391c0-5.825-4.158-11.04-9.933-11.804 c-6.99-0.926-13.019,4.555-13.019,11.373V269.9h-3.718V175.8c0-5.825-4.158-11.04-9.933-11.804 c-6.99-0.926-13.019,4.555-13.019,11.373v132.767h-4.067L225.871,256.217z"></path> <path style="fill:#EAA22F;" d="M321.034,234.827c-6.499-0.195-11.828,5.015-11.828,11.471v23.599h-2.975V239.78 c0-5.827-4.158-11.04-9.933-11.804c-6.99-0.926-13.017,4.555-13.017,11.373v30.548h-3.718v-38.391c0-5.825-4.158-11.04-9.933-11.804 c-0.138-0.017-0.274-0.017-0.41-0.031v182.027h39.988v-36.4l5.951-5.951c10.885-10.885,16.999-25.648,16.999-41.043v-71.527 C332.157,240.493,327.315,235.015,321.034,234.827z"></path> <rect x="225.349" y="383.052" style="fill:#D35933;" width="96.539" height="41.898"></rect> <rect x="269.222" y="383.052" style="fill:#B54324;" width="52.669" height="41.896"></rect> </g></svg>

                                <div>
                                    <p class="pb-1 border-b border-purple-200 w-full text-base font-semibold text-slate-700">
                                        200+ Returning Customers
                                    </p>
                                    <p><strong>Tested and Trusted</strong> by over 200 individuals and businesses.</p>
                                </div>
                            </div>

                            <div class="flex flex-row gap-x-6 border rounded-md border-purple-200 p-1 px-3 bg-white">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" class="place-self-center" width="54px" height="54px" fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle style="fill:#4d277c;" cx="256" cy="256" r="256"></circle> <path style="fill:#3a0e5d;" d="M304.752,507.344c114.907-22.157,202.435-121.135,207.038-241.385L399.563,153.733l-47.599,59.001 L202.842,236.18l-59.318-59.318l-19.463,10.988l54.074,54.074L49.931,252.523L304.752,507.344z"></path> <path style="fill:#FFEDB5;" d="M131.036,180.874l14.72,5.584c9.037,3.427,18.694,4.918,28.344,4.377l72.607-4.079l134.066,117.65 c5.172,4.539,4.858,12.685-0.646,16.813l-2.236,1.676c-3.943,2.956-9.383,2.881-13.241-0.184l-95.661-75.991 c-1.526-1.212-3.718-1.088-5.098,0.291l-1.458,1.458c-1.6,1.6-1.474,4.232,0.272,5.672l76.436,62.997 c5.042,4.156,5.287,11.797,0.519,16.267l0,0c-3.863,3.622-9.778,3.92-13.986,0.707l-80.951-61.802 c-1.633-1.246-3.958-0.984-5.273,0.593l0,0c-1.391,1.67-1.119,4.163,0.603,5.491l64.872,50.055 c5.701,4.399,5.604,13.031-0.191,17.303l-0.586,0.431c-3.843,2.832-9.087,2.815-12.91-0.041l-66.127-49.381 c-1.633-1.221-3.936-0.948-5.241,0.617l-0.007,0.009c-1.398,1.679-1.115,4.184,0.624,5.508l44.863,34.126 c5.017,3.815,5.73,11.09,1.552,15.808l-1.583,1.788c-3.415,3.856-9.075,4.775-13.534,2.196L89.864,263.215L131.036,180.874z"></path> <path style="fill:#FEE187;" d="M89.865,263.216l161.921,93.596c4.46,2.577,10.119,1.66,13.534-2.196l1.583-1.788 c4.179-4.718,3.465-11.993-1.552-15.808l-44.863-34.126c-1.739-1.322-2.022-3.829-0.624-5.508l0.007-0.009 c1.305-1.565,3.606-1.838,5.241-0.617l66.127,49.381c3.825,2.857,9.068,2.874,12.91,0.041l0.586-0.431 c0.105-0.078,0.195-0.167,0.297-0.247L120.16,202.628L89.865,263.216z"></path> <path style="fill:#FFC61B;" d="M390.808,174.013l44.111,81.361l-62.736,41.662l-102.928-89.695l-64.424,24.91 c-5.587,2.16-11.912,1.024-16.4-2.944l0,0c-8.613-7.618-6.637-21.559,3.753-26.486l85.685-40.627 c3.853-1.827,8.325-1.82,12.173,0.017l50.853,24.288c5.603,2.676,12.033,3.041,17.903,1.017L390.808,174.013z"></path> <polygon style="fill:#EAA22F;" points="330.733,260.915 372.183,297.036 434.919,255.374 411.393,211.98 "></polygon> <rect x="73.192" y="159.309" transform="matrix(-0.8827 -0.47 0.47 -0.8827 81.1817 449.6475)" style="fill:#FF7F4F;" width="47.047" height="110.764"></rect> <g> <polygon style="fill:#D35933;" points="49.931,252.523 91.464,274.637 117.763,225.242 77.112,201.476 "></polygon> <rect x="387.872" y="157.36" transform="matrix(0.8256 -0.5643 0.5643 0.8256 -48.2914 269.2509)" style="fill:#D35933;" width="47.047" height="110.764"></rect> </g> <polygon style="fill:#B54324;" points="462.069,245.182 431.173,199.98 390.885,224.422 423.222,271.734 "></polygon> </g></svg>
                                <div>
                                    <p class="pb-1 border-b border-purple-200 w-full text-base font-semibold text-slate-700">
                                        7K+ Approved Case Studies
                                    </p>
                                    <p>
                                        Professional case studies delivered to our esteemed customers. We are <em>Growing Fast!</em>
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-row gap-x-6 border rounded-md border-purple-200 p-1 px-3 bg-white">
                                <svg class="place-self-center" height="54px" width="54px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#8f00d1" stroke="#8f00d1">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g transform="translate(1 1)"> <path style="fill:#FDCC00;" d="M366.258,502.467H143.734c-13.96,0-25.267-11.315-25.267-25.276V32.809 c0-13.96,11.307-25.276,25.267-25.276h222.524c13.961,0,25.276,11.315,25.276,25.276v444.382 C391.542,491.152,380.218,502.467,366.258,502.467"></path> <polygon style="fill:#ed94ff;" points="118.467,434.2 391.533,434.2 391.533,58.733 118.467,58.733 "></polygon> <g> <path style="fill:#00DA6C;" d="M341.741,295.721l-28.433-20.685c-4.361-2.176-7.108-6.63-7.108-11.503v-13.235 c0.947-1.075,2.031-2.466,3.191-4.104c4.591-6.494,7.484-8.047,9.89-15.539c4.326-1.34,7.518-5.333,7.518-10.086v-14.123 c0-3.106-1.382-5.888-3.533-7.825V178.2c0,0,0.367-34.133-42.667-34.133s-39.723,32.367-39.723,32.367v20.42 c-2.15,1.946-3.533,4.719-3.533,7.825v14.123c0,3.729,1.954,6.997,4.881,8.892C245.75,243.062,255,254.113,255,254.113v12.911 c0,4.71-2.577,9.037-6.707,11.29l-31.496,17.186c-9.105,4.966-14.763,14.498-14.763,24.866V331.8H357.4v-10.743 C357.4,310.33,351.333,300.517,341.741,295.721"></path> <path style="fill:#00DA6C;" d="M216.796,295.499l20.992-11.452c-0.12-0.12-0.017-0.154,0.23-0.128l10.283-5.607 c4.13-2.253,6.699-6.579,6.699-11.29v-12.911c0,0-3.746-4.497-7.39-11.725v-0.009c-0.478-0.947-0.947-1.946-1.408-2.987 c-0.068-0.145-0.128-0.282-0.196-0.427c-0.469-1.067-0.922-2.176-1.357-3.328c-0.034-0.077-0.06-0.154-0.085-0.23 c-0.384-1.024-0.742-2.082-1.084-3.166c-0.085-0.29-0.179-0.589-0.273-0.888c-0.35-1.195-0.691-2.407-0.981-3.661 c-2.918-1.894-4.881-5.163-4.881-8.892v-14.123c0-3.106,1.382-5.879,3.533-7.825v-19.942c-4.992-3.874-16.546-7.245-28.544-7.245 c-33.766,0-34.133,25.028-34.133,25.028v17.638c-1.852,1.673-3.533,4.07-3.533,6.758v12.194c0,3.217,1.69,6.05,4.215,7.68 c3.055,13.269,15.932,25.745,15.932,25.745v11.145c0,4.062-2.219,7.808-5.794,9.754l-23.671,14.84 c-7.859,4.284-12.749,12.518-12.749,21.47v9.882h49.434v-11.435C202.034,309.997,207.7,300.466,216.796,295.499"></path> </g> <g> <path style="fill:#ed94ff;" d="M468.333,178.2c-4.719,0-8.533-3.823-8.533-8.533v-34.133c0-4.71,3.814-8.533,8.533-8.533 c4.719,0,8.533,3.823,8.533,8.533v34.133C476.867,174.377,473.052,178.2,468.333,178.2z"></path> <path style="fill:#ed94ff;" d="M485.4,161.133h-34.133c-4.719,0-8.533-3.823-8.533-8.533s3.814-8.533,8.533-8.533H485.4 c4.719,0,8.533,3.823,8.533,8.533S490.119,161.133,485.4,161.133z"></path> <path style="fill:#ed94ff;" d="M41.667,7.533c0,18.867-15.266,34.133-34.133,34.133c18.867,0,34.133,15.266,34.133,34.133 c0-18.867,15.266-34.133,34.133-34.133C56.933,41.667,41.667,26.401,41.667,7.533"></path> <path style="fill:#ed94ff;" d="M75.8,383c0,4.71-3.823,8.533-8.533,8.533s-8.533-3.823-8.533-8.533s3.823-8.533,8.533-8.533 S75.8,378.29,75.8,383"></path> <path style="fill:#ed94ff;" d="M33.133,229.4c0,4.71-3.823,8.533-8.533,8.533s-8.533-3.823-8.533-8.533s3.823-8.533,8.533-8.533 S33.133,224.69,33.133,229.4"></path> <path style="fill:#ed94ff;" d="M451.267,314.733c0,4.71-3.823,8.533-8.533,8.533s-8.533-3.823-8.533-8.533 s3.823-8.533,8.533-8.533S451.267,310.023,451.267,314.733"></path> <path style="fill:#ed94ff;" d="M511,493.933c0,4.71-3.823,8.533-8.533,8.533s-8.533-3.823-8.533-8.533s3.823-8.533,8.533-8.533 S511,489.223,511,493.933"></path> <path style="fill:#ed94ff;" d="M280.6,468.333c0,14.14-11.46,25.6-25.6,25.6c-14.14,0-25.6-11.46-25.6-25.6 c0-14.14,11.46-25.6,25.6-25.6C269.14,442.733,280.6,454.194,280.6,468.333"></path> </g> <path style="fill:#FFA800;" d="M366.258,7.533h-25.6c13.961,0,25.276,11.315,25.276,25.276v444.382 c0,13.96-11.315,25.276-25.276,25.276h25.6c13.961,0,25.276-11.315,25.276-25.276V32.809 C391.542,18.848,380.218,7.533,366.258,7.533"></path> <path style="fill:#FFFFFF;" d="M143.742,7.533h25.6c-13.96,0-25.276,11.315-25.276,25.276v444.382 c0,13.96,11.315,25.276,25.276,25.276h-25.6c-13.96,0-25.276-11.315-25.276-25.276V32.809 C118.467,18.848,129.782,7.533,143.742,7.533"></path> <path d="M366.258,511H143.734c-18.637,0-33.801-15.164-33.801-33.809V32.809C109.933,14.164,125.097-1,143.734-1h222.524 c18.654,0,33.818,15.164,33.818,33.809v444.382C400.075,495.836,384.911,511,366.258,511z M143.734,16.067 c-9.224,0-16.734,7.509-16.734,16.742v444.382c0,9.233,7.509,16.742,16.734,16.742h222.524c9.233,0,16.751-7.509,16.751-16.742 V32.809c0-9.233-7.518-16.742-16.751-16.742H143.734z"></path> <path d="M400.067,442.733H109.933V50.2h290.133V442.733z M127,425.667h256v-358.4H127V425.667z"></path> <path d="M289.133,41.667h-42.667c-4.71,0-8.533-3.823-8.533-8.533s3.823-8.533,8.533-8.533h42.667c4.719,0,8.533,3.823,8.533,8.533 S293.852,41.667,289.133,41.667z"></path> <path d="M220.867,41.667h-8.533c-4.71,0-8.533-3.823-8.533-8.533s3.823-8.533,8.533-8.533h8.533c4.71,0,8.533,3.823,8.533,8.533 S225.577,41.667,220.867,41.667z"></path> <path d="M109.933,101.4c-4.71,0-8.533-3.823-8.533-8.533v-8.533c0-4.71,3.823-8.533,8.533-8.533c4.71,0,8.533,3.823,8.533,8.533 v8.533C118.467,97.577,114.644,101.4,109.933,101.4z"></path> <path d="M109.933,135.533c-4.71,0-8.533-3.823-8.533-8.533v-8.533c0-4.71,3.823-8.533,8.533-8.533c4.71,0,8.533,3.823,8.533,8.533 V127C118.467,131.71,114.644,135.533,109.933,135.533z"></path> <path d="M109.933,169.667c-4.71,0-8.533-3.823-8.533-8.533V152.6c0-4.71,3.823-8.533,8.533-8.533c4.71,0,8.533,3.823,8.533,8.533 v8.533C118.467,165.844,114.644,169.667,109.933,169.667z"></path> <path d="M255,502.467c-18.824,0-34.133-15.309-34.133-34.133c0-18.824,15.309-34.133,34.133-34.133s34.133,15.309,34.133,34.133 C289.133,487.158,273.824,502.467,255,502.467z M255,451.267c-9.412,0-17.067,7.654-17.067,17.067 c0,9.412,7.654,17.067,17.067,17.067s17.067-7.654,17.067-17.067C272.067,458.921,264.412,451.267,255,451.267z"></path> <path d="M357.4,340.333H202.034c-4.71,0-8.533-3.814-8.533-8.533v-11.435c0-13.491,7.364-25.89,19.209-32.358l31.496-17.186 c1.391-0.759,2.261-2.219,2.261-3.797V256.98c-3.004-4.19-8.661-13.082-11.819-24.448c-3.712-3.567-5.845-8.491-5.845-13.722 v-14.123c0-3.942,1.254-7.782,3.533-10.991v-16.904c-0.213-3.072-0.478-16.154,9.429-27.127 c8.457-9.37,21.521-14.114,38.818-14.114c16.794,0,29.926,4.676,39.049,13.892c12.186,12.322,12.16,28.194,12.151,28.868v17.16 c2.278,3.2,3.533,7.048,3.533,10.999v14.123c0,6.827-3.593,12.954-9.284,16.35c-1.886,4.403-4.036,7.048-6.289,9.805 c-1.007,1.237-2.133,2.611-3.396,4.395c-0.555,0.785-1.101,1.527-1.621,2.21v10.18c0,1.647,0.913,3.14,2.398,3.874 c0.418,0.213,0.819,0.461,1.195,0.734l27.904,20.292c12.177,6.391,19.712,18.824,19.712,32.623V331.8 C365.933,336.519,362.119,340.333,357.4,340.333z M210.567,323.267h138.3v-2.21c0-7.552-4.19-14.327-10.94-17.698 c-0.418-0.205-0.828-0.461-1.203-0.734l-27.938-20.318c-6.878-3.763-11.119-10.88-11.119-18.773v-13.235 c0-2.082,0.759-4.087,2.142-5.649c0.777-0.887,1.664-2.031,2.62-3.379c1.536-2.167,2.893-3.832,4.113-5.333 c2.355-2.893,3.43-4.215,4.617-7.885c0.853-2.654,2.944-4.719,5.598-5.547c0.725-0.222,1.51-0.922,1.51-1.929v-14.123 c0-0.734-0.452-1.246-0.717-1.485c-1.792-1.613-2.816-3.917-2.816-6.34V178.2c-0.017-2.637-1.152-25.6-34.133-25.6 c-12.16,0-20.915,2.808-26.018,8.337c-5.803,6.298-5.205,14.635-5.205,14.72l0.034,21.197c0,2.415-1.024,4.71-2.807,6.323 c-0.333,0.299-0.725,0.802-0.725,1.502v14.123c0,0.981,0.691,1.536,0.99,1.732c1.86,1.203,3.183,3.089,3.678,5.257 c2.995,13.047,10.94,22.767,11.025,22.869c1.263,1.527,1.963,3.473,1.963,5.461v12.911c0,7.825-4.267,15.019-11.145,18.773 L220.884,303c-6.366,3.465-10.317,10.129-10.317,17.374L210.567,323.267L210.567,323.267z"></path> <path d="M202.034,340.333H152.6c-4.71,0-8.533-3.814-8.533-8.533v-9.882c0-12.083,6.588-23.177,17.195-28.962l23.219-14.584 c1.289-0.717,1.792-1.579,1.792-2.517v-7.714c-4.07-4.454-11.588-13.713-14.916-24.32c-3.319-3.285-5.231-7.765-5.231-12.535 v-12.194c0-3.507,1.237-6.963,3.533-10.027v-14.37c0.171-11.691,9.301-33.562,42.667-33.562c13.235,0,26.812,3.635,33.775,9.037 c2.082,1.613,3.302,4.104,3.302,6.741v19.942c0,2.415-1.024,4.71-2.807,6.323c-0.333,0.299-0.725,0.802-0.725,1.502v14.123 c0,1.007,0.76,1.587,0.998,1.732c1.86,1.212,3.174,3.089,3.669,5.248c0.248,1.084,0.546,2.133,0.853,3.166l0.248,0.811 c0.273,0.853,0.58,1.775,0.913,2.663c0.452,1.203,0.845,2.167,1.254,3.098c0.58,1.306,0.99,2.176,1.408,3.004 c3.115,6.187,6.323,10.112,6.349,10.146c1.254,1.527,1.963,3.465,1.963,5.444v12.911c0,7.825-4.267,15.019-11.136,18.773 l-10.291,5.615c-0.043,0.017-0.077,0.043-0.12,0.06c-0.034,0.026-0.077,0.043-0.111,0.068l-20.992,11.452 c-6.366,3.473-10.317,10.138-10.317,17.374V331.8C210.567,336.519,206.744,340.333,202.034,340.333z M161.133,323.267H193.5v-2.901 c0-13.491,7.356-25.882,19.2-32.358l0,0l20.105-10.965c0.546-0.384,1.143-0.708,1.766-0.964l9.626-5.248 c1.391-0.759,2.253-2.219,2.253-3.797V256.98c-1.647-2.304-4.096-6.024-6.477-10.743c-0.538-1.075-1.067-2.202-1.587-3.362 c-0.734-1.655-1.246-2.91-1.741-4.207c-0.538-1.425-0.939-2.628-1.323-3.857c-0.017-0.051-0.307-0.998-0.324-1.049 c-0.12-0.401-0.239-0.811-0.35-1.22c-3.721-3.576-5.862-8.499-5.862-13.739v-14.123c0-3.942,1.254-7.782,3.533-10.991v-11.827 c-4.352-1.835-11.691-3.661-20.011-3.661c-23.646,0-25.472,13.952-25.6,16.742v17.391c0,2.415-1.024,4.71-2.816,6.332 c-0.521,0.469-0.76,0.853-0.802,0.947l0.077,11.674c1.869,1.203,3.499,3.601,3.994,5.76c2.022,8.789,10.479,18.534,13.568,21.547 c1.647,1.604,2.586,3.814,2.586,6.118v11.145c0,7.211-3.934,13.815-10.257,17.246l-23.211,14.575 c-5.564,3.046-8.747,8.397-8.747,14.234v1.357H161.133z"></path> <path d="M41.667,84.333c-4.71,0-8.533-3.823-8.533-8.533c0-14.114-11.486-25.6-25.6-25.6C2.823,50.2-1,46.377-1,41.667 s3.823-8.533,8.533-8.533c14.114,0,25.6-11.486,25.6-25.6c0-4.71,3.823-8.533,8.533-8.533S50.2,2.823,50.2,7.533 c0,14.114,11.486,25.6,25.6,25.6c4.71,0,8.533,3.823,8.533,8.533S80.51,50.2,75.8,50.2c-14.114,0-25.6,11.486-25.6,25.6 C50.2,80.51,46.377,84.333,41.667,84.333z M33.108,41.667c3.234,2.432,6.127,5.325,8.559,8.559 c2.432-3.234,5.325-6.127,8.559-8.559c-3.234-2.432-6.127-5.325-8.559-8.559C39.235,36.342,36.342,39.235,33.108,41.667z"></path> <path d="M459.8,169.667c-4.719,0-8.533-3.823-8.533-8.533V127c0-4.71,3.814-8.533,8.533-8.533s8.533,3.823,8.533,8.533v34.133 C468.333,165.844,464.519,169.667,459.8,169.667z"></path> <path d="M476.867,152.6h-34.133c-4.719,0-8.533-3.823-8.533-8.533c0-4.71,3.814-8.533,8.533-8.533h34.133 c4.719,0,8.533,3.823,8.533,8.533C485.4,148.777,481.586,152.6,476.867,152.6z"></path> <path d="M67.267,374.467c0,4.71-3.823,8.533-8.533,8.533s-8.533-3.823-8.533-8.533s3.823-8.533,8.533-8.533 S67.267,369.756,67.267,374.467"></path> <path d="M24.6,220.867c0,4.71-3.823,8.533-8.533,8.533s-8.533-3.823-8.533-8.533s3.823-8.533,8.533-8.533 S24.6,216.156,24.6,220.867"></path> <path d="M442.733,306.2c0,4.71-3.823,8.533-8.533,8.533s-8.533-3.823-8.533-8.533s3.823-8.533,8.533-8.533 S442.733,301.49,442.733,306.2"></path> <path d="M502.467,485.4c0,4.71-3.823,8.533-8.533,8.533s-8.533-3.823-8.533-8.533s3.823-8.533,8.533-8.533 S502.467,480.69,502.467,485.4"></path> </g> </g></svg>
                                <div>
                                    <p class="pb-1 border-b border-purple-200 w-full font-semibold text-base text-slate-700">
                                        3.1k+ Average Monthly Users
                                    </p>
                                    <p>
                                        Our case study services have a global audience of more than 3K readers and customers.
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-row gap-x-6 border rounded-md border-purple-200 p-1 px-3 bg-white">
                                <svg class="place-self-center" fill="#6b00b3" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 256 240" enable-background="new 0 0 256 240" xml:space="preserve" stroke="#6b00b3">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M212.263,2.009V2l-0.013,0.004L212.237,2v0.009L170.5,15.917v55.667c0,0,0.496,25.75,41.75,41.75 c41.254-16,41.75-41.75,41.75-41.75V15.917L212.263,2.009z M206.84,74.28l-20.349-20.344l7.385-7.385l12.973,12.977l23.789-23.719 l7.371,7.393L206.84,74.28z M31.002,145.014c0-2.499,1.606-4.194,4.194-4.194s4.194,1.606,4.194,4.194V238h91.469v-92.986 c0-2.499,1.606-4.194,4.194-4.194c2.499,0,4.194,1.606,4.194,4.194V238h29.092V136.625c0-22.934-18.74-41.585-41.585-41.585h-8.388 L85.17,154.336L53.401,95.04h-9.816C20.651,95.04,2,113.78,2,136.625V238h29.092v-92.986H31.002z M86.474,83.69 c-28.043,0-51.089-20.685-54.976-47.618c0.555,1.249,1.527,2.082,2.499,3.054c6.108,6.108,16.243,6.108,22.351,0 c0.972-0.972,1.805-2.082,2.499-3.054c5.553-9.718,16.104-16.382,27.766-16.382c17.492,0,32.069,14.161,32.069,32.069 S104.383,83.69,86.474,83.69z M73.17,107.04c0-6.627,5.373-12,12-12s12,5.373,12,12s-5.373,12-12,12S73.17,113.668,73.17,107.04z"></path> </g></svg>
                                <div>
                                    <p class="pb-1 border-b border-purple-200 w-full font-semibold text-base text-slate-700">
                                        57 Top Writers and Analysts
                                    </p>
                                    <p>
                                        A diverse team of Talented Writers and Researchers 13 countries collaborating remotely.
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!--mini form-->
                    <div class="lg:col-span-1 px-2 mx-auto">
                        <!--subform-->
                        <SubForm
                            :levels="$page.props.levels"
                            :rates="$page.props.rates"
                            :services="$page.props.services"
                            :currencies="$page.props.currencies"
                        ></SubForm>
                    </div>
                </div>

                <!--our sercices-->
                <div class="lg:mt-16 mt-36 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6 my-auto">
                            <h2 class="pb-10 text-slate-800 font-extrabold text-4xl lg:text-[4rem] font-serif">
                                Our Services
                            </h2>
                            <div class="pb-3 flex flex-row gap-4">
                                <svg
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                    class="w-5 h-5 text-gray-500"
                                >
                                    <path
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                                    ></path>
                                </svg>
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                    <a href="orders/new" class="underline text-gray-900 dark:text-white"
                                    >Professional Research and Writing Case Study Services</a
                                    >
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Our services are academic-based, specifically designed to help students with homework and assignments from school. We diversify these services into three major groups.
                                </div>
                            </div>
                        </div>

                        <div class="border">
                            <div class="grid divide-y divide-purple-300">
                                <div class="grid grid-cols-5 p-1 px-3 bg-gray-100">
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 504 504" xml:space="preserve" height="64px" class="place-self-center" width="64px" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect x="26" y="2" style="fill:#ffffff;" width="368" height="496"></rect> <rect x="26" y="2" style="fill:#33A5D2;" width="368" height="68"></rect> <polygon style="fill:#d100ca;" points="483.6,438 462,497.2 440,438 "></polygon> <rect x="438" y="34" style="fill:#5200a3;" width="44" height="404"></rect> <path style="fill:#d100ca;" d="M482,34.8V10.4c0-6.4-4-8.8-10.8-8.8h-18.8c-6.8,0-14.4,2.4-14.4,8.8v24.4H482z"></path> <path d="M392,504H24c-2.4,0-4-1.6-4-4V4c0-2.4,1.6-4,4-4h368c2.4,0,4,1.6,4,4v496C396,502.4,394.4,504,392,504z M28,496h360V8H28 V496z"></path> <path d="M392,76H24c-2.4,0-4-1.6-4-4V4c0-2.4,1.6-4,4-4h368c2.4,0,4,1.6,4,4v68C396,74.4,394.4,76,392,76z M28,68h360V8H28V68z"></path> <path d="M350,148H70c-2.4,0-4-1.6-4-4s1.6-4,4-4h280c2.4,0,4,1.6,4,4S352.4,148,350,148z"></path> <path d="M126,188H70c-2.4,0-4-1.6-4-4s1.6-4,4-4h56c2.4,0,4,1.6,4,4S128.4,188,126,188z"></path> <path d="M350,188H162c-2.4,0-4-1.6-4-4s1.6-4,4-4h188c2.4,0,4,1.6,4,4S352.4,188,350,188z"></path> <path d="M350,228h-32c-2.4,0-4-1.6-4-4s1.6-4,4-4h32c2.4,0,4,1.6,4,4S352.4,228,350,228z"></path> <path d="M282,228H70c-2.4,0-4-1.6-4-4s1.6-4,4-4h212c2.4,0,4,1.6,4,4S284.4,228,282,228z"></path> <path d="M350,268H70c-2.4,0-4-1.6-4-4s1.6-4,4-4h280c2.4,0,4,1.6,4,4S352.4,268,350,268z"></path> <path d="M350,388H70c-2.4,0-4-1.6-4-4s1.6-4,4-4h280c2.4,0,4,1.6,4,4S352.4,388,350,388z"></path> <path d="M126,308H70c-2.4,0-4-1.6-4-4s1.6-4,4-4h56c2.4,0,4,1.6,4,4S128.4,308,126,308z"></path> <path d="M350,308H162c-2.4,0-4-1.6-4-4s1.6-4,4-4h188c2.4,0,4,1.6,4,4S352.4,308,350,308z"></path> <path d="M350,348h-32c-2.4,0-4-1.6-4-4s1.6-4,4-4h32c2.4,0,4,1.6,4,4S352.4,348,350,348z"></path> <path d="M282,348H70c-2.4,0-4-1.6-4-4s1.6-4,4-4h212c2.4,0,4,1.6,4,4S284.4,348,282,348z"></path> <path d="M126,428H70c-2.4,0-4-1.6-4-4s1.6-4,4-4h56c2.4,0,4,1.6,4,4S128.4,428,126,428z"></path> <path d="M350,428H162c-2.4,0-4-1.6-4-4s1.6-4,4-4h188c2.4,0,4,1.6,4,4S352.4,428,350,428z"></path> <path d="M458,498.8c-1.6,0-3.2-1.2-3.6-2.8l-22-59.2c0-0.4-0.4-0.8-0.4-1.2V34c0-2.4,1.6-4,4-4s4,1.6,4,4v400.4l18,48.4l18-48.4V34 c0-2.4,1.6-4,4-4c2.4,0,4,1.6,4,4v401.2c0,0.4,0,0.8-0.4,1.2l-22,59.2C461.2,497.6,459.6,498.8,458,498.8z"></path> <path d="M478,444h-40c-2.4,0-4-1.6-4-4s1.6-4,4-4h40c2.4,0,4,1.6,4,4S480.4,444,478,444z"></path> <path d="M480,42c-2.4,0-4-1.6-4-4V10.8c0-1.2,0-2,0-2.4C475.2,8,472.8,8,471.2,8h-23.6c-7.6,0-7.6,0.8-7.6,2.8V38c0,2.4-1.6,4-4,4 s-4-1.6-4-4V10.8C432,0,442,0,447.6,0h23.6c6.4,0,12.8,0,12.8,10.8V38C484,40.4,482.4,42,480,42z"></path> <path d="M478,40h-40c-2.4,0-4-1.6-4-4s1.6-4,4-4h40c2.4,0,4,1.6,4,4S480.4,40,478,40z"></path> <path d="M466,428h-28c-2.4,0-4-1.6-4-4s1.6-4,4-4h28c2.4,0,4,1.6,4,4S468.4,428,466,428z"></path> </g></svg>
                                    <div class="mt-2 col-span-4">
                                        <p class="text-lg lg:text-2xl font-semibold text-purple-900">
                                            Case Study Writing Service
                                        </p>
                                        <p class="py-2">
                                            Our team of experienced writers is dedicated to crafting high-quality and compelling case studies tailored to meet your specific needs. We understand that a well-written case study can make all the difference in showcasing your expertise, attracting new clients, and boosting your business. With our expertise in various industries, we can effectively communicate your unique value proposition and help you achieve your goals.
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-5 p-1 px-3 bg-gray-100">
                                    <svg class="place-self-center" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 507.6 507.6" xml:space="preserve" width="64px" height="64px" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier">
                                        <path style="fill:#EF934A;" d="M461.4,473.6c0,17.6-14.4,28-32,28h-356c-17.6,0-24-10.4-24-28v-396c0-17.6,6.4-32,24-32h356 c17.6,0,32,14.4,32,32V473.6z"></path> <rect x="81.4" y="69.6" style="fill:#F4EFEF;" width="348" height="404"></rect> <path style="fill:#FFC52F;" d="M353.4,89.6V56.8c0-17.6-11.6-31.2-29.2-31.2H283C279.4,13.6,269,6,256.2,6 c-12.4,0-23.2,7.6-26.8,19.6h-41.6c-17.6,0-34.8,13.6-34.8,31.2v32.8H353.4z"></path> <path style="fill:#F4EFEF;" d="M256.6,40.8c-6.8,0-12-5.2-12-12s5.2-12,12-12s12,5.2,12,12S263,40.8,256.6,40.8z"></path> <path d="M427.4,479.6h-348c-2.4,0-4-1.6-4-4v-404c0-2.4,1.6-4,4-4h70c2.4,0,4,1.6,4,4s-1.6,4-4,4h-66v396h340v-396h-70 c-2.4,0-4-1.6-4-4s1.6-4,4-4h74c2.4,0,4,1.6,4,4v404C431.4,477.6,429.8,479.6,427.4,479.6z"></path> <path d="M432.6,507.6h-356c-19.2,0-32.8-14.8-32.8-35.2V77.2c0-20,13.2-33.6,32.8-33.6h73.2c2.4,0,4,1.6,4,4s-1.6,4-4,4H76.6 c-15.2,0-24.8,10-24.8,25.6v395.2c0,16,10.4,27.2,24.8,27.2h356c16.8,0,23.2-14,23.2-27.2V77.2c0-16.4-8.4-25.6-23.2-25.6h-78.8 c-2.4,0-4-1.6-4-4s1.6-4,4-4h78.8c19.2,0,31.2,12.8,31.2,33.6v395.2C463.4,493.6,451.4,507.6,432.6,507.6z"></path> <path d="M256.6,44.8c-8.8,0-16-7.2-16-16s7.2-16,16-16s16,7.2,16,16S265.4,44.8,256.6,44.8z M256.6,20.8c-4.4,0-8,3.6-8,8s3.6,8,8,8 s8-3.6,8-8S261,20.8,256.6,20.8z"></path> <path d="M351.4,91.6h-200c-2.4,0-4-1.6-4-4V52.8c0-20,21.2-33.2,40.8-33.2H227C231.8,7.6,243,0,256.6,0s24.8,7.6,29.6,19.6h38.4 c19.2,0,31.2,12.8,31.2,33.2v34.8C355.4,89.6,353.8,91.6,351.4,91.6z M155.4,83.6h192V52.8c0-16-8.4-25.2-23.2-25.2H283 c-1.6,0-3.2-1.2-4-2.8C276.2,14.4,267,8,256.2,8s-20,6.4-22.8,16.8c-0.4,1.6-2,2.8-4,2.8h-41.6c-16,0-32.8,10-32.8,25.2v30.8H155.4z "></path> <path d="M390.6,195.6h-164c-2.4,0-4-1.6-4-4s1.6-4,4-4h164c2.4,0,4,1.6,4,4S393,195.6,390.6,195.6z"></path> <path d="M274.6,259.6h-48c-2.4,0-4-1.6-4-4s1.6-4,4-4h48c2.4,0,4,1.6,4,4S277,259.6,274.6,259.6z"></path> <path d="M390.6,259.6h-80c-2.4,0-4-1.6-4-4s1.6-4,4-4h80c2.4,0,4,1.6,4,4S393,259.6,390.6,259.6z"></path> <path d="M390.6,387.6h-48c-2.4,0-4-1.6-4-4s1.6-4,4-4h48c2.4,0,4,1.6,4,4S393,387.6,390.6,387.6z"></path> <path d="M306.6,387.6h-80c-2.4,0-4-1.6-4-4s1.6-4,4-4h80c2.4,0,4,1.6,4,4S309,387.6,306.6,387.6z"></path> <path d="M390.6,323.6h-164c-2.4,0-4-1.6-4-4s1.6-4,4-4h164c2.4,0,4,1.6,4,4S393,323.6,390.6,323.6z"></path> <path d="M157,205.2c-1.2,0-2-0.4-2.8-1.2l-19.6-19.6c-1.6-1.6-1.6-4,0-5.6s4-1.6,5.6,0l16.8,16.8l33.2-33.2c1.6-1.6,4-1.6,5.6,0 s1.6,4,0,5.6l-36,36C159,204.8,158.2,205.2,157,205.2z"></path> <path d="M157,269.2c-1.2,0-2-0.4-2.8-1.2l-19.6-19.6c-1.6-1.6-1.6-4,0-5.6s4-1.6,5.6,0l16.8,16.8l33.2-33.2c1.6-1.6,4-1.6,5.6,0 s1.6,4,0,5.6l-36,36C159,268.8,158.2,269.2,157,269.2z"></path> <path d="M157,332.8c-1.2,0-2-0.4-2.8-1.2L134.6,312c-1.6-1.6-1.6-4,0-5.6s4-1.6,5.6,0l16.8,16.8l33.2-33.2c1.6-1.6,4-1.6,5.6,0 s1.6,4,0,5.6l-36,36C159,332.4,158.2,332.8,157,332.8z"></path> <path d="M157,396.8c-1.2,0-2-0.4-2.8-1.2L134.6,376c-1.6-1.6-1.6-4,0-5.6s4-1.6,5.6,0l16.8,16.8l33.2-33.2c1.6-1.6,4-1.6,5.6,0 s1.6,4,0,5.6l-36,36C159,396.8,158.2,396.8,157,396.8z"></path> </g></svg>
                                    <div class="mt-2 col-span-4">
                                        <p class="text-lg lg:text-2xl font-semibold text-purple-900">
                                            Case Study Proofreading and Editing
                                        </p>
                                        <p class="py-2">
                                            Even the most well-researched case studies can benefit from a fresh pair of eyes. Our editing and proofreading services ensure that your case studies are error-free, polished, and deliver your message with maximum impact. Our meticulous editors will carefully review your content for grammar, spelling, clarity, tone, mood, and coherence, ensuring that your case studies are of the highest quality.
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-5 p-1 px-3 bg-gray-100">
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 504 504" xml:space="preserve"
                                         class="place-self-center"
                                         width="64px"
                                         height="64px"
                                         fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0">
                                        </g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier">
                                        <rect x="32" y="57" style="fill:#F4EFEF;" width="440" height="324"></rect> <rect x="16" y="25" style="fill:#E36D60;" width="472" height="32"></rect> <path style="fill:#54B265;" d="M363.6,218.6c0,61.2-49.6,110.4-110.4,110.4c-61.2,0-110.4-49.6-110.4-110.4 c0-61.2,49.6-110.4,110.4-110.4C314,107.8,363.6,157.4,363.6,218.6z"></path> <path style="fill:#F4EFEF;" d="M234.8,267.8c-7.6,5.2-14.8,2-14.8-7.2v-84.4c0-8.8,7.2-12,14.8-7.2l60,40c7.6,5.2,7.6,13.2-0.4,18.4 L234.8,267.8z"></path> <path d="M470,387H30c-2.4,0-4-1.6-4-4V61c0-2.4,1.6-4,4-4s4,1.6,4,4v318h432V61c0-2.4,1.6-4,4-4s4,1.6,4,4v322 C474,385.4,472.4,387,470,387z"></path> <path d="M486,63h-34c-2.4,0-4-1.6-4-4s1.6-4,4-4h30V31H18v24h398c2.4,0,4,1.6,4,4s-1.6,4-4,4H14c-2.4,0-4-1.6-4-4V27 c0-2.4,1.6-4,4-4h472c2.4,0,4,1.6,4,4v32C490,61.4,488.4,63,486,63z"></path> <path d="M500,31H4c-2.4,0-4-1.6-4-4s1.6-4,4-4h496c2.4,0,4,1.6,4,4S502.4,31,500,31z"></path> <path d="M250,29c-2.4,0-4-1.6-4-4V5c0-2.4,1.6-4,4-4s4,1.6,4,4v20C254,27.4,252.4,29,250,29z"></path> <path d="M250,501c-2.4,0-4-1.6-4-4V385c0-2.4,1.6-4,4-4s4,1.6,4,4v112C254,499.4,252.4,501,250,501z"></path> <path d="M368,503H136c-2.4,0-4-1.6-4-4s1.6-4,4-4h232c2.4,0,4,1.6,4,4S370.4,503,368,503z"></path> <path d="M226.4,273.8c-2,0-4.4-0.4-6-1.6c-4-2.4-6.4-6.4-6.4-12v-84.4c0-5.2,2.4-9.6,6.4-12c4.4-2.4,10.4-2,15.6,1.6l60.4,40 c4.8,3.2,7.2,7.2,7.2,12s-2.8,9.6-8,12.8l-60,40l0,0C232.8,273,229.6,273.8,226.4,273.8z M226.4,171c-0.8,0-1.6,0-2.4,0.4 c-2,1.2-2.4,3.6-2.4,4.8v84.4c0,1.2,0.4,4,2.4,4.8s4.8,0.4,7.2-1.2l60-40c2.8-1.6,4.4-4,4.4-6s-1.2-4-3.6-5.6l-60.4-40 C230,171.4,228,171,226.4,171z"></path> <path d="M252.8,333c-63.2,0-114.4-51.2-114.4-114.4c0-63.2,51.2-114.4,114.4-114.4s114.4,51.2,114.4,114.4 C367.6,281.4,316,333,252.8,333z M252.8,111.8c-58.8,0-106.4,47.6-106.4,106.4S194,324.6,252.8,324.6c58.8,0,106.4-47.6,106.4-106.4 C359.6,159.8,311.6,111.8,252.8,111.8z"></path> </g></svg>
                                    <div class="mt-2 col-span-4">
                                        <p class="text-lg lg:text-2xl font-semibold text-purple-900">
                                            Slides/PowerPoint Presentations
                                        </p>
                                        <p class="py-2">
                                            Impress your audience with visually stunning and persuasive case study presentations. Our team of skilled designers and content experts will transform your case study into a captivating slide deck, complete with engaging visuals, clear messaging, and a professional layout. Whether you need to present at a conference, pitch to potential investors, or share your success stories internally, we've got you covered.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 max-w-3xl px-4 mx-auto lg:pt-14 mt-8">
                    <img class="rounded-lg shadow-sm shadow-purple-400" alt="case study writing service" :src="`https://www.simplypsychology.org/wp-content/uploads/case-study.jpeg`">
                </div>
                <!--how it works-->
                <div class="mt-3 md:mt-6 py-4 md:py-10 md:px-10 lg:px-16 px-3 md:col-span-2 font-serif">
                    <div class="px-3 py-20 text-slate-700">
                        <h3 class="text-slate-700 text-center font-bold text-3xl">
                            How It Works: <span class="text-purple-700 italic">Simple. Secure. Confidential.</span>
                        </h3>

                        <ol class="mt-6 md:pl-14 grid lg:grid-cols-2 gap-4 place-content-center">
                            <li>
                                <div class="mt-3 pb-3 grid grid-cols-3">
                                    <svg class="place-self-center" height="50px" width="50px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 392.566 392.566" xml:space="preserve" fill="#000000">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#56ACE0;" d="M311.857,285.43h-73.374c-17.39,29.737-31.547,51.523-33.099,53.915 c-4.331,6.659-13.964,6.659-18.295,0c-1.552-2.392-15.709-24.178-33.099-53.915H80.681l-50.618,85.333h332.412L311.857,285.43z"></path> <path style="fill:#FFFFFF;" d="M102.855,115.216c2.78,49.907,79.968,176.485,93.414,197.948 c32.582-52.17,93.414-157.543,93.414-197.947c0-51.523-41.891-93.414-93.414-93.414S100.01,63.758,102.855,115.216z"></path> <path style="fill:#7e38ff;" d="M196.269,43.588c-39.499,0-71.628,32.129-71.628,71.628c0,10.667,6.788,30.319,17.648,54.368h60.38 c6.206,0,11.313,5.042,11.313,11.313c0,6.206-5.042,11.313-11.313,11.313h-49.713c2.651,5.301,5.43,10.796,8.275,16.291h21.204 c6.271,0,11.313,5.042,11.313,11.313c0,6.271-5.042,11.313-11.313,11.313h-9.18c7.37,13.382,15.063,26.958,23.014,40.339 c38.012-64.065,71.628-132.267,71.628-156.186C267.897,75.717,235.768,43.588,196.269,43.588z"></path> <g> <path style="fill:#194F82;" d="M391.049,376.065l-63.612-107.119c-1.939-3.297-5.56-5.301-9.374-5.301h-66.974 c28.768-51.006,60.444-114.877,60.444-148.428c0-63.547-51.717-115.2-115.2-115.2s-115.2,51.717-115.2,115.2 c0,33.552,31.677,97.422,60.444,148.428H74.54c-3.879,0-7.434,2.004-9.374,5.301L1.554,376.065 c-4.331,7.24,0.905,16.485,9.374,16.485H381.61C390.079,392.55,395.315,383.37,391.049,376.065z M102.855,115.216 c-2.844-51.459,41.891-93.414,93.414-93.414s93.414,41.891,93.414,93.414c0,40.404-60.768,145.842-93.414,197.948 C182.823,291.766,105.635,165.123,102.855,115.216z M30.063,370.764L30.063,370.764l50.618-85.333h73.309 c17.39,29.737,31.547,51.523,33.099,53.915c4.331,6.659,13.964,6.659,18.295,0c1.552-2.392,15.709-24.178,33.099-53.915h73.309 l50.618,85.333H30.063z"></path> <path style="fill:#194F82;" d="M140.544,102.416h12.671v20.04c0,5.56-3.556,6.206-4.848,6.206c-2.78,0-5.495-1.422-8.016-4.202 l-4.978,6.788c3.814,3.879,8.275,5.883,13.382,5.883c4.073,0,13.964-1.487,13.964-15.127V94.271h-22.174 C140.544,94.271,140.544,102.416,140.544,102.416z"></path> <path style="fill:#194F82;" d="M257.231,124.978c0.323-7.37-6.012-9.762-8.663-10.279c0.711-0.323,6.271-2.069,6.271-9.18 c0-11.313-12.218-11.313-15.063-11.313h-16.549v42.602h18.618C247.663,136.808,256.778,135.321,257.231,124.978z M232.665,102.158 h4.59c2.78,0,4.784,0.323,5.947,0.905c1.164,0.582,1.745,1.939,1.745,3.814c0,1.939-0.646,3.168-1.939,3.685 c-1.228,0.517-3.232,0.84-5.883,0.84h-4.461L232.665,102.158L232.665,102.158z M232.665,128.727H232.6v-9.762h5.624 c3.103,0,5.43,0.323,6.853,0.905c1.487,0.646,2.133,1.875,2.133,3.879c0,1.939-0.646,3.232-2.004,3.943 c-1.293,0.711-3.426,1.034-6.077,1.034H232.665z"></path> <path style="fill:#194F82;" d="M215.081,115.216c0-8.339-5.883-22.044-22.303-22.044c-14.869,0-22.303,11.83-22.303,22.044 c0,8.339,5.947,22.044,22.303,22.044C207.582,137.261,215.081,125.43,215.081,115.216z M192.713,128.921 c-6.465,0-12.606-5.689-12.671-13.705h0.065c0-6.594,4.848-13.705,12.671-13.705c6.594,0,12.671,5.689,12.606,13.705 C205.384,121.81,200.471,128.921,192.713,128.921z"></path> </g> </g></svg>
                                    <p class="col-span-2 max-w-xl place-self-center text-justify">
                                        <span class="text-lg font-bold text-slate-700 font-mono">Place an Order: </span>Select the service you need and provide us with the necessary details, such as the topic, deadline, and any specific requirements.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <div class="mt-3 pb-3 grid grid-cols-3">
                                    <svg class="place-self-center" height="50px" width="50px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 392.591 392.591" xml:space="preserve" fill="#000000">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#FFFFFF;" d="M207.35,258.844c0-38.271,31.16-69.366,69.366-69.366c8.986,0,17.519,1.745,25.471,4.913V31.483 c0-5.301-4.331-9.632-9.632-9.632H77.928c-5.301,0-9.632,4.331-9.632,9.632v263.499c0,5.301,4.331,9.632,9.632,9.632h146.877 C213.944,292.461,207.35,276.493,207.35,258.844z"></path> <path style="fill:#FFC10D;" d="M263.463,123.927c-6.012,0-10.925-4.848-10.925-10.925c0-6.012,4.848-10.925,10.925-10.925h16.808 V82.683H243.94c-6.012,0-10.925-4.848-10.925-10.925c0-6.012,4.848-10.925,10.925-10.925h36.331v-6.4 c0-6.012-4.848-10.925-10.925-10.925H100.942c-6.012,0-10.925,4.848-10.925,10.925v217.471c0,6.012,4.848,10.925,10.925,10.925 h110.739c-2.78-7.499-4.396-15.58-4.396-24.048c0-38.271,31.16-69.366,69.366-69.366c1.228,0,2.457,0.065,3.62,0.129v-65.681 h-16.808V123.927z"></path> <g> <path style="fill:#FFFFFF;" d="M163.455,102.4c6.594,0,11.96-5.301,11.96-11.96c0-6.659-5.43-11.96-11.96-11.96 s-11.96,5.43-11.96,11.96S156.926,102.4,163.455,102.4z"></path> <path style="fill:#FFFFFF;" d="M201.338,172.154c0-3.168-1.681-6.077-4.396-7.564c-3.814-2.069-7.822-3.814-11.96-5.172 l-14.222,16.097c-4.202,4.655-12.218,4.655-16.291,0l-14.222-16.097c-4.202,1.422-8.21,3.103-11.96,5.172 c-2.715,1.487-4.396,4.396-4.396,7.564v18.941h77.64v-18.941H201.338z"></path> </g> <g> <path style="fill:#56ACE0;" d="M262.752,326.788v31.806l7.046-5.818c4.008-3.232,9.762-3.232,13.77,0l7.046,5.818v-31.806 c-4.461,0.905-9.18,1.422-13.899,1.422C271.867,328.275,267.213,327.693,262.752,326.788z"></path> <path style="fill:#56ACE0;" d="M276.651,211.329c-26.182,0-47.515,21.333-47.515,47.515c0,26.182,21.333,47.515,47.515,47.515 s47.515-21.333,47.515-47.515C324.296,232.663,302.962,211.329,276.651,211.329z"></path> </g> <g> <path style="fill:#194F82;" d="M163.455,124.186c18.618,0,33.745-15.127,33.745-33.745s-15.127-33.81-33.745-33.81 S129.71,71.758,129.71,90.376S144.837,124.186,163.455,124.186z M163.455,78.416c6.594,0,11.96,5.43,11.96,11.96 s-5.43,11.96-11.96,11.96s-11.96-5.301-11.96-11.96C151.496,83.717,156.926,78.416,163.455,78.416z"></path> <path style="fill:#194F82;" d="M207.35,145.39c-7.37-4.008-15.321-7.046-23.661-8.986c-3.943-0.905-7.952,0.388-10.667,3.426 l-10.602,11.96l-10.602-11.96c-2.651-3.038-6.723-4.331-10.667-3.426c-8.339,1.939-16.291,4.978-23.661,8.986 c-9.762,5.301-15.774,15.515-15.774,26.764v29.802c0,6.012,4.848,10.925,10.925,10.925h99.426c6.012,0,10.925-4.848,10.925-10.925 v-29.802C223.124,160.97,217.112,150.691,207.35,145.39z M201.209,191.095h-77.511v-18.941c0-3.168,1.681-6.077,4.396-7.564 c3.814-2.069,7.822-3.814,11.96-5.172l14.222,16.097c4.202,4.655,12.218,4.655,16.291,0l14.222-16.097 c4.202,1.422,8.21,3.103,11.96,5.172c2.715,1.487,4.396,4.396,4.396,7.564v18.941H201.209z"></path> <path style="fill:#194F82;" d="M185.177,245.786h-68.008c-6.012,0-10.925,4.848-10.925,10.925c0,6.012,4.848,10.925,10.925,10.925 h68.008c6.012,0,10.925-4.848,10.925-10.925C196.102,250.634,191.189,245.786,185.177,245.786z"></path> <path style="fill:#194F82;" d="M323.973,208.226V31.547C323.973,14.158,309.815,0,292.554,0H77.928 c-17.39,0-31.547,14.158-31.547,31.547v263.499c0,17.39,14.158,31.547,31.547,31.547h163.038v55.079 c0,9.18,10.667,14.287,17.778,8.404l18.036-14.675l18.036,14.675c7.111,5.818,17.778,0.776,17.778-8.404v-63.418 c20.105-12.154,33.616-34.133,33.616-59.345C346.082,238.933,337.548,220.897,323.973,208.226z M224.676,304.679H77.928 c-5.43,0-9.762-4.331-9.762-9.632V31.547c0-5.301,4.331-9.632,9.632-9.632H292.36c5.301,0,9.632,4.331,9.632,9.632v162.909 c-7.887-3.168-16.485-4.913-25.471-4.913c-38.271,0-69.366,31.16-69.366,69.366C207.221,276.428,213.88,292.461,224.676,304.679z M290.744,358.594h-0.065l-7.046-5.818c-4.008-3.232-9.762-3.232-13.77,0l-7.046,5.818v-31.806 c4.461,0.905,9.18,1.422,13.964,1.422c4.784,0,9.438-0.453,13.899-1.422v31.806H290.744z M276.651,306.36 c-26.182,0-47.515-21.333-47.515-47.515c0-26.182,21.333-47.515,47.515-47.515s47.515,21.333,47.515,47.515 C324.296,285.026,302.962,306.36,276.651,306.36z"></path> </g> </g></svg>
                                    <p class="col-span-2 max-w-xl place-self-center text-justify">
                                        <span class="text-lg font-bold text-slate-700 font-mono">Assigning the Expert: </span>We match your project with the most qualified writer/editor/designer in your field, ensuring that they understand your industry and can deliver exceptional results.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <div class="mt-3 pb-3  grid grid-cols-3">
                                    <svg class="place-self-center" height="50px" width="50px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 392.598 392.598" xml:space="preserve" fill="#000000">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#FFC10D;" d="M86.885,72.663c13.964,0,25.406-11.442,25.406-25.406s-11.442-25.406-25.406-25.406 S61.479,33.293,61.479,47.257S72.921,72.663,86.885,72.663z"></path> <g> <path style="fill:#56ACE0;" d="M140.929,145.519c-7.37-4.008-15.127-7.176-23.337-9.438l-20.428,57.341 c-3.426,9.632-17.067,9.632-20.558,0l-20.558-57.341c-8.21,2.263-15.903,5.43-23.337,9.438 c-6.788,3.685-11.055,11.119-11.055,19.329v48.42H151.79v-48.42h0.129C151.984,156.638,147.717,149.204,140.929,145.519z"></path> <path style="fill:#56ACE0;" d="M305.778,179.265c-13.964,0-25.406,11.442-25.406,25.406c0,13.964,11.378,25.406,25.406,25.406 c13.964,0,25.406-11.442,25.406-25.406C331.184,190.707,319.741,179.265,305.778,179.265z"></path> </g> <path style="fill:#FFC10D;" d="M370.812,322.327c0-8.21-4.267-15.58-11.055-19.329c-7.37-4.008-15.127-7.176-23.337-9.438 l-20.299,57.277c-3.426,9.632-17.067,9.632-20.558,0l-20.558-57.341c-8.21,2.263-15.903,5.43-23.337,9.438 c-6.788,3.685-11.055,11.119-11.055,19.329v48.42h130.133v-48.356H370.812z"></path> <g> <path style="fill:#6741be;" d="M86.885,94.449c26.053,0,47.192-21.204,47.192-47.192c0-26.053-21.204-47.192-47.192-47.192 S39.693,21.269,39.693,47.257S60.897,94.449,86.885,94.449z M86.885,21.786c13.964,0,25.406,11.442,25.406,25.406 s-11.442,25.406-25.406,25.406S61.479,61.22,61.479,47.192S72.921,21.786,86.885,21.786z"></path> <path style="fill:#6741be;" d="M173.77,224.194v-59.345c0-16.226-8.598-30.966-22.432-38.465 c-11.96-6.594-25.018-11.184-38.659-13.834c-5.236-1.034-10.537,2.004-12.347,7.046l-13.446,37.689l-13.446-37.689 c-1.745-5.107-7.046-8.016-12.347-7.046c-13.705,2.651-26.634,7.24-38.659,13.834C8.598,133.883,0,148.622,0,164.849v59.345 c0,6.012,4.848,10.925,10.925,10.925h151.919C168.921,235.055,173.77,230.206,173.77,224.194z M152.113,213.269H21.851v-48.42 c0-8.21,4.267-15.58,11.055-19.329c7.37-4.008,15.127-7.176,23.337-9.438L76.8,193.422c3.491,9.632,17.067,9.632,20.558,0 l20.428-57.341c8.21,2.263,15.903,5.43,23.337,9.438c6.788,3.685,11.055,11.119,11.055,19.329v48.42H152.113z"></path> <path style="fill:#6741be;" d="M370.166,283.798c-11.96-6.594-25.018-11.184-38.659-13.834c-5.236-1.034-10.537,2.004-12.348,7.046 l-13.446,37.689l-13.446-37.689c-1.745-5.107-7.046-8.016-12.347-7.046c-13.705,2.651-26.634,7.24-38.659,13.834 c-13.834,7.499-22.432,22.238-22.432,38.465v59.345c0,6.012,4.848,10.925,10.925,10.925h151.919 c6.012,0,10.925-4.848,10.925-10.925v-59.281C392.598,306.101,384,291.297,370.166,283.798z M370.941,370.747H240.679v-48.42 c0-8.21,4.267-15.58,11.055-19.329c7.37-4.008,15.127-7.176,23.337-9.438l20.558,57.341c3.491,9.632,17.067,9.632,20.558,0 l20.428-57.341c8.21,2.263,15.903,5.43,23.337,9.438c6.788,3.685,11.055,11.119,11.055,19.329v48.42H370.941z"></path> <path style="fill:#6741be;" d="M258.521,204.671c0,26.053,21.204,47.192,47.192,47.192c26.053,0,47.192-21.204,47.192-47.192 c0-26.053-21.204-47.192-47.192-47.192S258.521,178.618,258.521,204.671z M331.184,204.671c0,13.964-11.442,25.406-25.406,25.406 c-13.964,0-25.406-11.442-25.406-25.406c0-13.964,11.378-25.406,25.406-25.406C319.741,179.265,331.184,190.707,331.184,204.671z"></path> <path style="fill:#6741be;" d="M181.204,315.087c-9.956,6.788-26.182,9.891-37.43,7.952c-17.842-2.457-33.099-12.606-42.085-27.798 l-0.259-0.453l17.713,4.461c5.883,1.487,11.766-2.069,13.188-7.887c1.487-5.883-2.069-11.766-7.887-13.188l-43.766-11.055 c-5.883-1.487-11.766,2.069-13.188,7.887l-11.055,43.766c-1.487,5.883,2.069,11.766,7.887,13.188 c5.883,1.487,11.766-2.069,13.188-7.887l4.784-18.747c10.925,17.778,27.669,31.612,47.774,37.172 c35.556,9.051,58.246-6.335,61.802-8.339c5.301-3.038,7.176-9.826,4.008-15.063C192.84,313.923,186.376,312.242,181.204,315.087z"></path> <path style="fill:#6741be;" d="M248.889,69.301c17.842,2.457,33.099,12.606,42.085,27.798l0.259,0.453l-17.713-4.461 c-5.883-1.487-11.766,2.069-13.188,7.887c-1.487,5.883,2.069,11.766,7.887,13.188l43.766,11.055 c5.883,1.487,11.766-2.069,13.188-7.887l11.055-43.766c1.487-5.883-2.069-11.766-7.887-13.188 c-5.883-1.487-11.766,2.069-13.188,7.887l-4.784,18.747c-10.925-17.778-27.669-31.612-47.774-37.172 c-35.556-9.051-58.246,6.335-61.802,8.339c-5.301,3.038-7.176,9.826-4.008,15.063c3.038,5.107,9.568,6.788,14.675,3.943 C221.414,70.465,237.64,67.362,248.889,69.301z"></path> </g> </g></svg>
                                    <p class="col-span-2 max-w-xl place-self-center text-justify">
                                        <span class="font-bold text-slate-700 font-mono">Collaboration and Communication: </span>Stay in touch with your assigned expert throughout the process. You can provide feedback, ask questions, and monitor the progress of your case study.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <div class="mt-3 pb-3  grid grid-cols-3">
                                    <svg class="place-self-center" height="50px" width="50px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 392.792 392.792" xml:space="preserve" fill="#000000">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#FFFFFF;" d="M21.851,269.244h181.592c-2.069-6.723-3.232-13.899-3.232-21.398 c0-39.693,32.323-72.016,72.016-72.016s72.016,32.323,72.016,72.016c0,7.434-1.164,14.61-3.232,21.398h29.802V21.907H21.851V269.244 z"></path> <path style="fill:#8c26f2;" d="M344.048,245.713c2.909-1.939,4.978-5.301,4.978-9.115V54.683c0-6.012-4.848-10.925-10.925-10.925 H54.626c-6.012,0-10.925,4.848-10.925,10.925v181.915c0,6.012,4.848,10.925,10.925,10.925H200.21"></path> <g> <path style="fill:#FFC10D;" d="M257.293,318.311v37.495l7.176-7.046c4.267-4.202,10.99-4.202,15.192,0l7.176,7.046v-37.495 c-4.784,1.034-9.762,1.552-14.869,1.552C267.119,319.862,262.141,319.345,257.293,318.311z"></path> <path style="fill:#FFC10D;" d="M322.392,247.911c0-27.669-22.497-50.23-50.23-50.23c-16.485,0-31.095,8.016-40.275,20.299 c6.659,0,14.545-0.065,21.915-0.065h0.065c6.012,0,10.925,4.848,10.925,10.796c0.065,6.012-4.784,10.99-10.796,10.99 c-9.568,0.065-28.962,0.065-31.354,0.065c-0.453,2.65-0.711,5.301-0.711,8.145c0,2.844,0.323,5.495,0.711,8.21 c3.879,0,9.051-0.065,13.834-0.065c6.271-0.065,10.99,4.719,11.055,10.731c0.065,6.012-4.719,10.99-10.731,11.055 c-1.745,0-3.297,0.065-4.848,0.065c9.18,12.283,23.725,20.234,40.21,20.234C299.895,298.076,322.392,275.58,322.392,247.911z"></path> </g> <g> <path style="fill:#194F82;" d="M324.396,74.012H68.267c-6.012,0-10.925-4.848-10.925-10.925s4.848-10.925,10.925-10.925h256 c6.012,0,10.925,4.848,10.925,10.925S330.408,74.012,324.396,74.012z"></path> <path style="fill:#194F82;" d="M324.396,114.157H68.267c-6.012,0-10.925-4.848-10.925-10.925c0-6.077,4.848-10.925,10.925-10.925 h256c6.012,0,10.925,4.848,10.925,10.925C335.192,109.244,330.408,114.157,324.396,114.157z"></path> <path style="fill:#194F82;" d="M324.396,154.303H68.267c-6.012,0-10.925-4.848-10.925-10.925c0-6.012,4.848-10.925,10.925-10.925 h256c6.012,0,10.925,4.848,10.925,10.925C335.192,149.39,330.408,154.303,324.396,154.303z"></path> <path style="fill:#194F82;" d="M178.101,194.448H68.267c-6.012,0-10.925-4.848-10.925-10.925c0-6.012,4.848-10.925,10.925-10.925 h109.834c6.012,0,10.925,4.848,10.925,10.925C188.962,189.535,184.113,194.448,178.101,194.448z"></path> <path style="fill:#194F82;" d="M174.287,234.529H68.267c-6.012,0-10.925-4.848-10.925-10.925c0-6.012,4.848-10.925,10.925-10.925 h106.02c6.012,0,10.925,4.848,10.925,10.925C185.212,229.616,180.364,234.529,174.287,234.529z"></path> <path style="fill:#194F82;" d="M381.737,0.121H10.925C4.913,0.121,0,4.969,0,11.046v269.123c0,6.012,4.848,10.925,10.925,10.925 h203.766c5.624,7.499,12.735,13.834,20.816,18.683v71.952c0,9.632,11.572,14.545,18.554,7.822l18.101-17.713l18.166,17.713 c6.853,6.723,18.554,1.875,18.554-7.822v-71.952c8.145-4.784,15.127-11.184,20.881-18.683h52.105 c6.012,0,10.925-4.848,10.925-10.925V10.982C392.598,4.969,387.749,0.121,381.737,0.121z M287.03,355.806l-7.176-7.046 c-4.267-4.202-10.99-4.202-15.192,0l-7.176,7.046v-37.495c4.784,1.034,9.762,1.552,14.869,1.552c5.107,0,10.02-0.517,14.869-1.552 v37.495H287.03z M272.226,298.076c-16.485,0-31.095-7.952-40.21-20.234c1.552,0,3.103,0,4.848-0.065 c6.012-0.065,10.796-5.042,10.731-11.055c-0.065-6.012-4.784-10.796-11.055-10.731c-4.784,0.065-9.956,0.065-13.834,0.065 c-0.453-2.715-0.711-5.43-0.711-8.21c0-2.78,0.323-5.495,0.711-8.145c2.327,0.065,21.721,0,31.354-0.065 c6.012-0.065,10.925-4.913,10.796-10.99c-0.065-6.012-4.913-10.796-10.925-10.796h-0.065c-7.434,0.065-15.386,0.065-21.915,0.065 c9.18-12.283,23.725-20.299,40.275-20.299c27.669,0,50.23,22.497,50.23,50.23C322.392,275.58,299.895,298.076,272.226,298.076z M370.812,269.244H341.01c2.069-6.723,3.232-13.899,3.232-21.398c0-39.693-32.323-72.016-72.016-72.016 s-72.016,32.388-72.016,72.081c0,7.434,1.164,14.61,3.232,21.398H21.851V21.907h348.962L370.812,269.244L370.812,269.244z"></path> </g> </g></svg>
                                    <p class="col-span-2 max-w-xl place-self-center text-justify">
                                        <span class="text-lg font-bold text-slate-700 font-mono">Delivery and Revisions: </span>We deliver the completed work within the agreed-upon timeframe. If you require any revisions, we'll be happy to make them until you're completely satisfied.
                                    </p>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 p-6 border-t">
                    <div class="px-5 lg:px-10 grid place-content-center">
                        <h2 class="pb-10 text-slate-800 font-extrabold text-4xl text-center lg:text-[4rem] font-serif">
                            About Us
                        </h2>
                        <img class="max-w-[16rem] md:max-w-[20rem] rounded-lg" alt="Logo" :src="`https://gatewayassignment.com/wp-content/uploads/2023/05/default.png`">
                    </div>

                    <div class="mt-6 grid place-content-center max-w-xl">
                        <p class="px-4 pt-6 font-bold text-2xl text-purple-700">Case Study Pro</p>
                        <p class="py-4 pb-6 px-6 text-xl font-semibold text-slate-800 font-serif border-b border-purple-500"> Your One-Stop Solution for Professional Case Study Writing Services!</p>
                        <p class="pt-2 text-justify text-lg lg:text-xl font-serif text-slate-700">
                            At Case Study Pro, we are a team of professionals passionate about helping businesses succeed through the power of persuasive storytelling. With years of experience in the industry, we have collaborated with numerous clients from various sectors, producing outstanding case studies that have made a significant impact.
                            <span class="block mt-2">
                                Our expertise, dedication to quality, and commitment to client satisfaction set us apart as the leading provider of case study writing services.
                            </span>
                        </p>
                    </div>

                    <!--mission-->
                    <div class="p-6 mt-9 lg:mt-14 max-w-md grid place-self-center rounded shadow-lg shadow-purple-300">
                        <p class="pb-4 border-t-2 border-purple-500 uppercase text-purple-600 font-bold text-sm">mission</p>
                        <h3 class="mt-3 font-bold text-2xl text-slate-900 italic">Our Mission</h3>
                        <p class="text-slate-700 text-justify">
                            Our mission is to empower businesses by providing them with top-notch case study writing services that drive growth, build credibility, and inspire action. We believe that every success story deserves to be told effectively, and we are here to make that happen for you.
                        </p>
                    </div>

                    <!--vision-->
                    <div class="p-6 mt-9 lg:mt-14 max-w-md grid place-self-center rounded shadow-lg shadow-purple-300">
                        <p class="pb-4 border-t-2 border-amber-500 uppercase text-amber-600 font-bold text-sm">Vision</p>
                        <h3 class="mt-3 font-bold text-2xl text-slate-900 italic">Our Vision</h3>
                        <p class="text-slate-700 text-justify">
                            We envision a world where businesses of all sizes can leverage the power of persuasive case studies to achieve their goals, make a lasting impact, and create a positive change in their industries. Through our services, we aim to be the catalyst for their success.
                        </p>
                    </div>
                </div>

            </div>

            <div class="max-w-6xl mx-auto mt-4 md:mt-9 border-t">
                <!--testimonials-->
                <div class="p-6 py-8 lg:px-14">
                    <div class="text-slate-800 max-w-3xl">
                        <h3 class="py-4 text-xl md:text-3xl font-serif font-extrabold text-center underline underline-offset-4 uppercase">
                            Testimonials
                        </h3>
                        <p class="p-3 md:pl-8">
                            Read what our satisfied clients have to say about their experience working with us. Our testimonials showcase the positive impact our case studies have had on our clients' businesses. We take pride in consistently delivering exceptional results and exceeding our clients' expectations.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4 md:gap-x-6 mt-4 lg:mt-9 p-6 py-8 lg:px-14 shadow-lg rounded-lg bg-white">
                        <div class="max-w-lg">
                            <p class="text-lg font-bold border-l-4 pl-3 text-slate-800">
                                <span class="text-xl">"</span>Lorem ipsum dolor sit amet consectetur adipiscing elit hac ullamcorper aliquet vivamus nisl et aliquam vestibul.<span class="text-xl">"</span>
                            </p>

                            <div class="flex gap-x-3 pl-6 mt-3">
                                <svg fill="#290137"  class="place-self-center" width="34px" height="34px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#290137">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M2,21h8a1,1,0,0,0,0-2H3.071A7.011,7.011,0,0,1,10,13a5.044,5.044,0,1,0-3.377-1.337A9.01,9.01,0,0,0,1,20,1,1,0,0,0,2,21ZM10,5A3,3,0,1,1,7,8,3,3,0,0,1,10,5Zm13,8.5v5a.5.5,0,0,1-.5.5h-1v2L19,19H14.5a.5.5,0,0,1-.5-.5v-5a.5.5,0,0,1,.5-.5h8A.5.5,0,0,1,23,13.5Z"></path></g></svg>

                                <div class="flex flex-col gap-y-1 text-sm text-slate-700 font-semibold">
                                    <p>Jake Lozyech</p>
                                    <a class="text-slate-600">CEO, RMT Solutions</a>
                                </div>
                            </div>
                        </div>

                        <div class="max-w-lg md:pl-3">
                            <p class="text-lg font-bold border-l-4 pl-3 text-slate-800">
                                <span class="text-xl">"</span>Lorem ipsum dolor sit amet consectetur adipiscing elit hac ullamcorper aliquet vivamus nisl et aliquam vestibul.<span class="text-xl">"</span>
                            </p>

                            <div class="flex gap-x-3 pl-6 mt-3">
                                <svg fill="#290137"  class="place-self-center" width="34px" height="34px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#290137">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M2,21h8a1,1,0,0,0,0-2H3.071A7.011,7.011,0,0,1,10,13a5.044,5.044,0,1,0-3.377-1.337A9.01,9.01,0,0,0,1,20,1,1,0,0,0,2,21ZM10,5A3,3,0,1,1,7,8,3,3,0,0,1,10,5Zm13,8.5v5a.5.5,0,0,1-.5.5h-1v2L19,19H14.5a.5.5,0,0,1-.5-.5v-5a.5.5,0,0,1,.5-.5h8A.5.5,0,0,1,23,13.5Z"></path></g></svg>

                                <div class="flex flex-col gap-y-1 text-sm text-slate-700 font-semibold">
                                    <p>Dr. Jim Kisinga Lozyech</p>
                                    <a class="text-slate-600">VP Toto Ltd.</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="p-6 py-8 lg:px-14 lg:py-16 bg-slate-300 text-slate-900 font-medium grid md:grid-cols-3 gap-x-6 place-content-center">
                    <img alt="Case Study" class="rounded-lg shadow-md" :src="`https://eutraining.eu/sites/default/files/Case%20Studies%20-%20All%20the%20Details%20You%20Wanted%20to%20Know.jpg`">
                    <div class="max-w-2xl mx-auto md:col-span-2">
                        <p>Remember, a compelling case study can be a game-changer for your career, business, and education. Don't miss out on the opportunity to showcase your expertise and attract new clients. Start your journey with Case Study Pro today!</p>
                        <Link :href="`/orders/new`" class="mt-3 lg:mt-6 px-4 py-2 w-fit text-xl text-white font-bold flex gap-x-2 bg-purple-600 rounded-lg">
                            Get Started<span class="pl-3 text-sm place-self-center">></span>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>

</template>


<style scoped>
/* Other styles */

/* Add the transition properties */
.max-w-[2rem], .max-w-[4rem] {
    transition-property: max-width;
}
</style>
