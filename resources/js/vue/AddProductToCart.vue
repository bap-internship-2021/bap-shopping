<template>
    <div class="p-2 mt-20">
        <form @submit.prevent="addProductToCart" class="flex flex-col">
            <input type="hidden" v-model="formData.name"/>
            <input type="hidden" v-model="formData.price"/>
            <label class="text-red-300" for="quantity">Nhập số lượng cần mua</label>
            <input id="quantity" type="text" v-model="formData.quantity" class="border border-green-400 rounded-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50" placeholder="Số lượng cần mua"/>
            <button
                class="bg-indigo-300 border rounded-lg p-5 hover:bg-indigo-200 transition mt-5"
            >
                Thêm vào giỏ hàng
            </button>
        </form>
        <p id="notification">{{ notification }}</p>
    </div>
</template>

<script>
import axios from "axios"

export default {
    name: "AddProductToCart",
    data() {
        return {
            formData: {
                name: document.getElementById("product-name").innerHTML,
                price: document.getElementById("product-price").innerHTML,
                quantity: 1,
            },
            notification: '',
        };
    },
    methods: {

        addProductToCart() {
            axios
                .post("http://127.0.0.1:8000/api/carts", this.formData)
                .then((response) => {
                    this.notification = 'Thêm thành công'
                })
                .catch((error) => {
                    this.notification = 'Xảy ra lỗi, vui lòng kiểm tra kết nối của bạn'
                });
        },
    }
}
</script>

<style scoped>
</style>
