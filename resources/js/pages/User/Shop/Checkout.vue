<template>

    <Head title="Digimark | Checkout"></Head>
    <Navigation />
    <section v-if="Object.keys(cart).length" class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <form @submit.prevent="submit" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16">
                <div class="min-w-0 flex-1 space-y-8">
                    <div class="space-y-4">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Delivery Details</h2>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                            <div>
                                <label for="your_name"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Your name
                                </label>
                                <InputText type="text" placeholder="Enter your name" v-model="form.name"
                                    :message="form.errors.name" />

                            </div>

                            <div>
                                <label for="your_email"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Email*
                                </label>
                                <InputText type="text" placeholder="Enter your email" v-model="form.email"
                                    :message="form.errors.email" />
                            </div>

                            <div>
                                <label for="your_address"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Full Address*
                                </label>
                                <InputText type="text" placeholder="Enter your address" v-model="form.address"
                                    :message="form.errors.address" />
                            </div>

                            <div>
                                <label for="mobile"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Mobile Number*
                                </label>
                                <InputText type="text" placeholder="your mobile number" v-model="form.mobile"
                                    :message="form.errors.mobile" />
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Payment</h3>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div
                                class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input v-model="form.payment_method" id="credit-card"
                                            aria-describedby="credit-card-text" type="radio" name="payment-method"
                                            value="Mobile
                                            Banking"
                                            class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                                    </div>

                                    <div class="ms-4 text-sm">
                                        <label for="credit-card"
                                            class="font-medium leading-none text-gray-900 dark:text-white"> Mobile
                                            Banking
                                        </label>
                                        <p id="credit-card-text"
                                            class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">Pay with
                                            Bkash</p>
                                    </div>
                                </div>

                            </div>

                            <div
                                class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input id="pay-on-delivery" v-model="form.payment_method"
                                            aria-describedby="pay-on-delivery-text" type="radio" name="payment-method"
                                            value="credit card"
                                            class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                                    </div>

                                    <div class="ms-4 text-sm">
                                        <label for="pay-on-delivery"
                                            class="font-medium leading-none text-gray-900 dark:text-white"> Pay with
                                            credit card </label>
                                        <p id="pay-on-delivery-text"
                                            class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">Extra
                                            processing fee</p>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input id="paypal-2" v-model="form.payment_method"
                                            aria-describedby="paypal-text" type="radio" name="payment-method"
                                            value="Bank Transfer"
                                            class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                                    </div>

                                    <div class="ms-4 text-sm">
                                        <label for="paypal-2"
                                            class="font-medium leading-none text-gray-900 dark:text-white"> Direct Bank
                                            Transfer </label>
                                        <p id="paypal-text"
                                            class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">Pay with
                                            local bank</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="form.errors.payment_method">{{ form.errors.payment_method }}</div>
                    </div>
                </div>

                <div class="mt-6 border p-5 w-full space-y-6 sm:mt-8 lg:mt-0 lg:max-w-xs xl:max-w-md">

                    <div class="text-center text-lg underline">
                        Your Order
                    </div>

                    <div v-for="(item, id) in cart" :key="id" class="flex flex-col rounded-lg bg-white sm:flex-row">
                        <img class="m-2 h-24 w-28 rounded-md border object-cover object-center"
                            :src="`/storage/${item.image}`" alt="" />
                        <div class="flex w-full flex-col px-4 py-4">
                            <span class="font-semibold">{{ item.name }}</span>
                            <p class="text-lg font-bold">${{ item.price }} x {{ item.quantity }}</p>
                        </div>
                    </div>


                    <div class="flow-root">
                        <div class="-my-3 divide-y divide-gray-200 dark:divide-gray-800">

                            <dl class="flex items-center justify-between gap-4 py-3">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Payment Method</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">{{ form.payment_method
                                    }}
                                </dd>
                            </dl>

                            <dl class="flex items-center justify-between gap-4 py-3">
                                <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                <dd class="text-base font-bold text-gray-900 dark:text-white">${{ totalPrice }}</dd>
                            </dl>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <button type="submit"
                            class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Proceed
                            to Payment</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <div v-else class="text-center my-20">
        <p class="text-2xl">Your cart is empty.</p>
        <p class="mt-4 text-xl">First add product to the cart
        </p>
    </div>
    <Footer />
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Navigation from '../../../Components/Navigation.vue';
import Footer from '../../../Components/Footer.vue';
import InputText from '../../../Components/InputText.vue';
import { computed } from 'vue';
import Swal from 'sweetalert2';

const props = defineProps({
    cart: Object,
})

const totalPrice = computed(() =>
    Object.values(props.cart).reduce((sum, item) => sum + item.price * item.quantity, 0)
);

const form = useForm({
    name: '',
    email: '',
    address: '',
    mobile: '',
    payment_method: '',
    grand_total: totalPrice,
});


function submit() {
    form.post('/checkout', {
        preserveScroll:true,
        onSuccess: () => {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Your order has been successfull",
                showConfirmButton: false,
                timer: 1500
            });
        }
    })
}



</script>

<style></style>