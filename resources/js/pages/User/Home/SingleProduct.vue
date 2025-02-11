<template>
    <Content>
    <div class="bg-gray-100">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-wrap -mx-4">
                <!-- Product Images -->
                <div class="w-full md:w-1/2 px-4 mb-8">
                    <img :src="`/storage/${product.image}`" alt="Product"
                        class="w-full h-auto rounded-lg shadow-md mb-4" id="mainImage" />
                    <div class="flex gap-4 py-4 justify-center overflow-x-auto"></div>
                </div>

                <!-- Product Details -->
                <div class="w-full md:w-1/2 px-4">
                    <h2 class="text-3xl font-bold mb-2">{{ product.name }}</h2>
                    <div class="mb-4">
                        <span v-if="product.discount" class="text-2xl font-bold mr-2">${{ product.discount }}</span>
                        <span v-if="product.regular" class="text-gray-500 line-through">${{ product.regular }}</span>
                    </div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-star"></i>
                        <span class="ml-2 text-gray-600">4.5 (120 reviews)</span>
                    </div>
                    <p v-if="product.description" v-html="getShortDescription(product.description)"
                        class="text-gray-700 mb-6"></p>
                    <div class="mb-6">
                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity:</label>
                        <input type="number" v-model="quantity" id="quantity" name="quantity" min="1" value="1"
                            class="w-12 text-center rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                    </div>

                    <div class="flex space-x-4 mb-6">
                        <button @click="addToCart"
                            class="bg-indigo-600 flex gap-2 items-center text-white px-6 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Add to Cart
                        </button>
                        <button @click="openModal"
                            class="bg-red-600 flex gap-2 items-center text-white px-6 py-2 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Buy Now
                        </button>

                        <!-- Modal -->
                        <Modal ref="modal" title="Quick Checkout">
                            <section v-if="Object.keys(cart).length"
                                class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
                                <form @submit.prevent="submit">
                                    <div>
                                        <div>
                                            <div class="space-y-4">
                                                <div>
                                                    <div>
                                                        <label for="your_name"
                                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                                            Your name
                                                        </label>
                                                        <InputText type="text" placeholder="Enter your name"
                                                            v-model="form.name" :message="form.errors.name
                                                                " />
                                                    </div>

                                                    <div>
                                                        <label for="your_email"
                                                            class="mb-2 mt-4 block text-sm font-medium text-gray-900 dark:text-white">Email*
                                                        </label>
                                                        <InputText type="text" placeholder="Enter your email"
                                                            v-model="form.email" :message="form.errors
                                                                .email
                                                                " />
                                                    </div>

                                                    <div>
                                                        <label for="your_address"
                                                            class="mb-2 mt-4 block text-sm font-medium text-gray-900 dark:text-white">
                                                            Full Address*
                                                        </label>
                                                        <InputText type="text" placeholder="Enter your address" v-model="form.address
                                                            " :message="form.errors
                                                                .address
                                                                " />
                                                    </div>

                                                    <div>
                                                        <label for="mobile"
                                                            class="mb-2 mt-4 block text-sm font-medium text-gray-900 dark:text-white">
                                                            Mobile Number*
                                                        </label>
                                                        <InputText type="text" placeholder="your mobile number" v-model="form.mobile
                                                            " :message="form.errors
                                                                .mobile
                                                                " />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="space-y-4 my-4">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Payment
                                                </h3>

                                                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                                    <div
                                                        class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                                                        <div class="flex items-start">
                                                            <div class="flex items-center">
                                                                <input v-model="form.payment_method
                                                                    " id="credit-card" type="radio"
                                                                    name="payment-method" value="Mobile Banking"
                                                                    class="border-gray-300 bg-white text-primary-600" />
                                                            </div>

                                                            <div class="ms-4 text-sm">
                                                                <label for="credit-card"
                                                                    class="font-medium leading-none text-gray-900 dark:text-white">
                                                                    Mobile
                                                                    Banking
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                                                        <div class="flex items-start">
                                                            <div class="flex h-5 items-center">
                                                                <input id="pay-on-delivery" v-model="form.payment_method
                                                                    " aria-describedby="pay-on-delivery-text"
                                                                    type="radio" name="payment-method"
                                                                    value="credit card"
                                                                    class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                                                            </div>

                                                            <div class="ms-4 text-sm">
                                                                <label for="pay-on-delivery"
                                                                    class="font-medium leading-none text-gray-900 dark:text-white">
                                                                    credit card
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                                                        <div class="flex items-start">
                                                            <div class="flex h-5 items-center">
                                                                <input id="paypal-2" v-model="form.payment_method
                                                                    " aria-describedby="paypal-text" type="radio"
                                                                    name="payment-method" value="Bank Transfer"
                                                                    class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                                                            </div>

                                                            <div class="ms-4 text-sm">
                                                                <label for="paypal-2"
                                                                    class="font-medium leading-none text-gray-900 dark:text-white">
                                                                    Bank
                                                                    Transfer
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="
                                                    form.errors
                                                        .payment_method
                                                ">
                                                    {{
                                                        form.errors
                                                            .payment_method
                                                    }}
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="mt-6 border p-5 w-full space-y-6 sm:mt-8 lg:mt-0 lg:max-w-xs xl:max-w-md">
                                            <div class="text-center text-lg underline">
                                                Your Order
                                            </div>

                                            <div v-for="(item, id) in cart" :key="id"
                                                class="flex flex-col rounded-lg bg-white sm:flex-row">
                                                <img class="m-2 h-24 w-28 rounded-md border object-cover object-center"
                                                    :src="`/storage/${item.image}`" alt="" />
                                                <div class="flex w-full flex-col px-4 py-4">
                                                    <span class="font-semibold">{{ item.name }}</span>
                                                    <p class="text-lg font-bold">
                                                        ${{ item.price }} x
                                                        {{ item.quantity }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="flow-root">
                                                <div class="-my-3 divide-y divide-gray-200 dark:divide-gray-800">
                                                    <dl class="flex items-center justify-between gap-4 py-3">
                                                        <dt
                                                            class="text-base font-normal text-gray-500 dark:text-gray-400">
                                                            Payment Method
                                                        </dt>
                                                        <dd class="text-base font-medium text-gray-900 dark:text-white">
                                                            {{
                                                                form.payment_method
                                                            }}
                                                        </dd>
                                                    </dl>

                                                    <dl class="flex items-center justify-between gap-4 py-3">
                                                        <dt class="text-base font-bold text-gray-900 dark:text-white">
                                                            Total
                                                        </dt>
                                                        <dd class="text-base font-bold text-gray-900 dark:text-white">
                                                            ${{ totalPrice }}
                                                        </dd>
                                                    </dl>
                                                </div>
                                            </div>

                                            <div class="space-y-3">
                                                <button type="submit"
                                                    class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                    Proceed to Payment
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </section>
                            <div v-else class="text-center my-20">
                                <p class="text-2xl">Your cart is empty.</p>
                                <p class="mt-4 text-xl">
                                    First add product to the cart
                                </p>
                            </div>
                        </Modal>

                        <a v-if="product.demo_link" :href="product.demo_link"
                            class="bg-gray-200 flex gap-2 items-center text-gray-800 px-6 py-2 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            View Demo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </Content>
</template>

<script setup>
import { computed, ref } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import Modal from "../../../Components/Modal.vue";
import InputText from "../../../Components/InputText.vue";
import Swal from "sweetalert2";
import Content from '../../../Layouts/Content.vue';

const props = defineProps({
    product: Object,
    cart: Object,
});

const totalPrice = computed(() =>
    Object.values(props.cart).reduce(
        (sum, item) => sum + item.price * item.quantity,
        0
    )
);

const form = useForm({
    name: "",
    email: "",
    address: "",
    mobile: "",
    payment_method: "",
    grand_total: totalPrice,
});

function submit() {
    form.post('/checkout', {
        preserveScroll: true,
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

const quantity = ref(1);

const modal = ref(null);

function openModal() {
    const data = {
        id: props.product.id,
        name: props.product.name,
        image: props.product.image,
        price: props.product.regular || props.product.discount,
        quantity: quantity.value,
    };

    router.post("/cart/add", data, {
        preserveState: true,
        preserveScroll: true,
        onFinish: () => router.reload( {
            only: ["cartLength"],
        }),

    });

    setTimeout(() => {
        modal.value.openModal();
    }, 800);
};


function addToCart() {
    const data = {
        id: props.product.id,
        name: props.product.name,
        image: props.product.image,
        price: props.product.regular || props.product.discount,
        quantity: quantity.value,
    };

    router.post("/cart/add", data, {
        preserveScroll: true,
        onSuccess: () => {
            toast("Item added to the cart", { type: "success" });
        },

    });
}

const getShortDescription = (htmlContent) => {
    if (!htmlContent) return "No description";

    const textContent = htmlContent.replace(/<\/?[^>]+(>|$)/g, "");

    return textContent.length > 50
        ? textContent.slice(0, 1000) + "..."
        : textContent;
};
</script>

<style></style>
