require('./bootstrap');

import Vue from 'vue'
import App from './vue/App.vue'
import AddProductToCart from './vue/AddProductToCart.vue'

const app = new Vue({
    el: '#app',
    components: { App }
});

// const addProductToCart = new Vue({
//     el: '#add-product-to-cart',
//     components: { App, AddProductToCart },

// })

// Set default value of số lượng cần mua
document.getElementById("quantity").value = 1;