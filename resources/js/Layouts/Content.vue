<template>
    <Navigation :categories="categories" :settingsData="settingsData" />
    <slot></slot>
    <Footer
        :pages="pages"
        :categories="categories"
        :products="products"
        :services="services"
        :settingsData="settingsData"
    />
</template>

<script setup>
import Navigation from "../Components/Navigation.vue";
import Footer from "../Components/Footer.vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();

const pages = page.props.pages;
const categories = page.props.categories;
const products = page.props.products;
const services = page.props.services;
const settingsData = page.props.settingsData;
</script>
