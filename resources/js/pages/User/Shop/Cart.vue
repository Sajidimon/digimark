<template>
    <Content>
        <Head title="Digimark | Cart"></Head>
        <div v-if="Object.keys(cart).length" class="container mx-auto mt-10">
            <div class="sm:flex shadow-md my-10">
                <div class="w-full sm:w-3/4 bg-white px-10 py-10">
                    <h1 class="font-semibold text-2xl border-b pb-8">
                        Shopping Cart
                    </h1>
                    <div
                        v-for="(item, id) in cart"
                        :key="id"
                        class="flex justify-between py-6 border-t"
                    >
                        <div class="flex items-center">
                            <img
                                :src="`/storage/${item.image}`"
                                class="w-16 h-16 rounded"
                            />
                            <span class="ml-4">{{ item.name }}</span>
                        </div>
                        <input
                            type="number"
                            min="1"
                            v-model="item.quantity"
                            class="w-10 h-10 text-center border rounded-md"
                            readonly
                        />
                        <button @click="removeItem(id)" class="text-red-500">
                            Remove
                        </button>
                        <span>${{ item.price }}</span>
                    </div>

                    <button
                        @click="clearCart"
                        class="bg-red-500 text-white px-4 py-2 rounded mt-4"
                    >
                        Clear Cart
                    </button>
                </div>

                <div class="w-full sm:w-1/4 px-8 py-10">
                    <h1 class="font-semibold text-2xl border-b pb-8">
                        Order Summary
                    </h1>
                    <p class="py-4">
                        Total Items: {{ Object.keys(cart).length }}
                    </p>
                    <p>Total Cost: ${{ totalPrice }}</p>
                    <Link
                        href="/checkout"
                        class="bg-indigo-500 text-white px-6 py-2 rounded block text-center mt-4"
                    >
                        Checkout
                    </Link>
                </div>
            </div>
        </div>
        <div v-else class="text-center my-20">
            <p class="text-2xl">Your cart is empty.</p>
            <p class="mt-4 text-xl">
                Return to
                <Link
                    class="text-white rounded py-1 px-3 bg-primary-500"
                    href="/"
                    >Home</Link
                >
            </p>
        </div>
    </Content>
</template>

<script setup>
import { computed } from "vue";
import { router } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import Content from "../../../Layouts/Content.vue";

const props = defineProps({
    cart: Object,
});

const totalPrice = computed(() =>
    Object.values(props.cart).reduce(
        (sum, item) => sum + item.price * item.quantity,
        0
    )
);

function removeItem(id) {
    router.delete(`/cart/remove/${id}`, {
        preserveScroll: true,
        onSuccess: () => {
            toast("Item removed", { type: "success" });
            router.replace(window.location.pathname, {
                only: ["cartLength"],
            });
        },
    });
}

function clearCart() {
    router.delete("/cart/clear", {
        preserveScroll: true,
        onSuccess: () => {
            toast("All Cart removed", { type: "success" });
            router.replace(window.location.pathname, {
                only: ["cartLength"],
            });
        },
    });
}
</script>
