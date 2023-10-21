import { defineStore} from 'pinia';
import {useForm} from "@inertiajs/inertia-vue3";
import axios from 'axios';
import {useFlash} from "@/Composables/useFlash";

export const useOrderStore = defineStore('OrderStore',{
    state: () => {
        return {
            form : useForm({
                title: `Writer's Choice`,
                academic_level_id: 2,
                subject_id: 1,
                service_type_id: 1,
                deadline: 336,
                pages: 1,
                slides: 0,
                sources: 1,
                instructions: '',
                referencing_style_id: 1,
                spacing_id: 1,
                writer_category_id: 1,
                discount_id: '',
                currency_id: 2,
                language_id: 1,
                extra: '',
                files: [],
                amount: '',
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                }),
            currencies: {},
            discounts: {},
            extras: {},
            languages: {},
            levels: {},
            order: Object,
            services : {},
            rates: {},
            spacings: {},
            styles: {},
            subjects : {},
            writerCategories: {},
        }
    },
    actions: {
        // Function to make a GET request to load order dependencies
        async loadOrderDependencies() {
            const {flash} = useFlash();
            try {
                const response = await axios.get('/api/orders/new')

                // check response status
                if (response.status === 200) {
                    // Handle the response data
                    console.log(response.data);
                    const orderData = response.data;

                    // update dependencies
                    this.currencies = orderData.currencies ?? null;
                    this.discounts = orderData.discounts ?? null;
                    this.extras = orderData.extras ?? null;
                    this.languages = orderData.languages ?? null;
                    this.levels = orderData.levels ?? null;
                    this.order = orderData.order ?? null;
                    this.rates = orderData.rates ?? null;
                    this.spacings = orderData.spacings ?? null;
                    this.styles = orderData.styles ?? null;
                    this.subjects = orderData.subjects ?? null;
                    this.writerCategories = orderData.writerCategories ?? null;
                } else {
                    // handle bad response
                    flash('Oops', `Could not initialize some details. Server responded with ${response.status} status code! Kindly reload the page.`, 'error')
                }

            } catch (error) {
                // Handle any errors
                console.error(error)
                flash(`Error! ${error.name}`, `Unable to complete the request. Failed to establish a connection.\n ${error.message}`, 'error')
            }
        },
        // save order details to localStorage
        saveToLocal(formData = this.form) {
            localStorage.setItem('newOrder', JSON.stringify(formData));
        },
        // retrieve order details from localStorage
        getFromLocal() {
            this.form = JSON.parse(localStorage.getItem('newOrder'));
        },
        // save form to db
        async saveToDB(formData = this.form) {
            const {flash} = useFlash();
            try {
                const response = await axios.post(route('orders.new'), formData);

                // handle successful post request
                if (response.status === 200) {
                    console.log("Success.", response.data); // Removed unnecessary JSON.stringify()
                    localStorage.removeItem('newOrder');
                    flash('Success!', 'Order saved successfully. Redirecting to Checkout.', 'success');
                    setTimeout(() => { // Changed setInterval to setTimeout
                        window.location.href = `/orders/preview/${response.data.order.id}`;
                    }, 4000);
                }
            } catch (error) {
                console.log(error)
                // catch error
                flash('Error!', `The request was not successful. Failed to establish connection with the server.`, 'error')
            }
        }
    },

    getters: {
        /*getPrice() {
            let total = parseInt(Object.values(this.rates).find((x) => Object.values(x).includes(this.form.deadline)).amount ?? 0);
            // let levelRate = Object.values(this.levels).find( (x)=> Object.values(x).includes(this.form.academic_level_id) ).rate ?? 0;
            // let serviceRate = Object.values(this.services).find( (x)=> Object.values(x).includes(this.form.service_type_id) ).rate ?? 0;

            let levelRate = Object.values(this.levels).some(x => Object.values(x).includes(this.form.academic_level_id)) ? Object.keys(this.levels).find(key => Object.values(this.levels[key]).includes(this.form.academic_level_id)).rate : 0;

            let serviceRate = Object.values(this.services).some(x => Object.values(x).includes(this.form.service_type_id)) ? Object.keys(this.services).find(key => Object.values(this.services[key]).includes(this.form.service_type_id)).rate : 0;


            let rateTotal = total + total*(levelRate/100) + total*(serviceRate/100)

            let pages = this.form.pages;
            let slides = this.form.slides;

            total = (Math.round(
                ((rateTotal * pages) + (rateTotal * slides)
                ) * 100)/ 100)
                .toFixed(2);

            let amount = total;
            amount = (Math.round(total * 100)/ 100)
                    .toFixed(2);
            this.form.amount = amount;
            return amount;
        }*/
    }
})
