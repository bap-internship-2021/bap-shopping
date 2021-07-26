<template>
    <div class="p-2 mt-1">
        <p v-if="productQuantityResource > 0" class="p-2">Số lượng còn lại: <span class="text-blue-900">{{ productQuantityResource }}</span> sản phẩm</p>
        <p v-else class="p-2 text-red-600">Tạm thời hết sản phẩm</p>
        <pre>
            {{ JSON.stringify(formData, null, 2) }}
        </pre>

        <!--    Form add item to cart    -->
        <form class="flex flex-col" @submit.prevent="addProductToCart">
            <input v-model="formData.token" name="_token" type="hidden">
            <input v-model="formData.id" type="hidden"/>
            <input v-model="formData.name" type="hidden"/>
            <input v-model="formData.price" type="hidden"/>
            <input v-model="formData.image" type="hidden">
            <label v-show="productQuantityResource > 0" class="text-blue-900 mt-5 p-2" for="quantity">Nhập số lượng cần mua</label>
            <input v-show="productQuantityResource > 0" id="quantity" v-model.number="formData.quantity"
                   class="my-2  border-2 border-blue-400 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 p-2"
                   placeholder="Số lượng cần mua"
                   type="text"/>
            <button v-if="productQuantityResource > 0"
                    class="bg-indigo-300 border rounded-lg p-2 hover:bg-indigo-200 transition pt-5"
            >
                Thêm vào giỏ hàng
            </button>
            <button v-else
                    class="bg-indigo-300 border rounded-lg p-2 hover:bg-indigo-200 transition pt-5"
                    disabled hidden
            >
                Thêm vào giỏ hàng
            </button>
        </form>
        <!-- Notification status -->
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
                id: document.getElementById("product-id").innerHTML,
                name: document.getElementById("product-name").innerHTML,
                price: document.getElementById("product-price").innerHTML,
                quantity: 1,
                image: document.getElementById("image-path").innerHTML,
                token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },

            notification: '',
            productQuantityResource: 0,
        };
    },
    created() {
        this.getProductQuantity();
    },
    watch: {},
    methods: {
        addProductToCart() {
            if (this.formData.quantity > 0) {
                if (this.productQuantityResource >= this.formData.quantity) {
                    axios
                        .post("http://127.0.0.1:8000/carts", this.formData)
                        .then((response) => {
                            console.log(response)
                            this.notification = 'Thêm vào giỏ hàng thành công'
                        })
                        .catch((error) => {
                            this.notification = 'Xảy ra lỗi, vui lòng thử lại'
                        });
                } else {
                    console.log('Error add product to cart');
                    this.notification = 'Số lượng đơn hàng lớn hơn trong kho, xin vui lòng nhập lại!'
                }
            } else {
                this.notification = 'Số lượng phải lớn hơn 0'
            }

        },
        getProductQuantity() {
            axios
                .get("http://127.0.0.1:8000/api/products/" + this.formData.id)
                .then((response) => {
                    this.productQuantityResource = response.data.quantity;
                })
                .catch((error) => {
                    console.log(error)
                });
        }
    }
}
</script>

<style scoped>
</style>
