<template>

    <Head title="Kasir"></Head>
    <AppLayout>
        <div class="card">
            <div class="card-header">
                <h1 class="text-2xl">No Transaksi {{ transaction_id }}</h1>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <div v-for="(category, i) in categories">
                        <button
                            class="mr-3 rounded-3xl px-12 py-2 border-2 border-blue-500 text-blue-500 hover:text-white hover:bg-blue-600 duration-300"
                            type="button" @click="selectedCategory(category.id, category.name)">{{
                                category.name
                            }}</button>
                    </div>
                </div>
                <div v-if="products != null" class="grid md:grid-cols-4 sm:grid-cols-1 gap-4 mt-5">
                    <div v-for="(product, i) in products" :key="i">
                        <transition name="menu" appear>
                            <div class="card">
                                <div class="card-header mx-auto">
                                    <img :src="url + '/storage/' + product.thumbnail" :alt="product.thumbnail"
                                        style="width: 200px; height: 200px;">
                                </div>
                                <div class="card-body text-center">
                                    <div class="m-3">
                                        <span class="text-xl font-bold">{{ product.name }}</span>
                                    </div>
                                    <div>
                                        <button @click="addToChart(product, i)" type="button"
                                            class="w-full py-1 text-white rounded-lg bg-blue-500"><i
                                                class="bi bi-cart-plus"></i> Order</button>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
                <div v-if="products.length < 1">
                    <transition name="menu" appear>
                        <div class="grid grid-cols-2">
                            <div class="mt-3 shadow-lg p-5">
                                Menu kosong
                            </div>
                        </div>
                    </transition>
                </div>
                <div class="mt-5">
                    <h1 class="text-2xl font-bold">List Order</h1>
                    <div class="">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Menu</th>
                                    <th>Diskon</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Sub Total</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(data, i) in cart" :key="i">
                                    <td>{{ i + 1 }}</td>
                                    <td>{{ data.name }}</td>
                                    <td>{{ data.discount }}</td>
                                    <td>{{ data.price }}</td>
                                    <td><input v-model="qty[i]" type="number"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    </td>
                                    <td>{{ subTotalFunc[i] }}</td>
                                    <td><button type="button" @click="removeFromMenu(i)"><i
                                                class="bi bi-trash"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-5">
                    <div>
                        <h1 class="text-2xl font-bold">Detail Transaksi</h1>
                    </div>
                    <div class="grid md:grid-cols-8 mt-3 gap-4">
                        <div class="col-start-1 col-span-3">
                            <form>
                                <div class="row mb-3">
                                    <label for="input_category" class="col-sm-3 col-form-label">No</label>
                                    <div class="col-sm-9">
                                        <input id="input_no_transaction" type="text" class="form-control" disabled
                                            v-model="transactionDetailForm.id_transaction">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="input_category" class="col-sm-3 col-form-label">Atas Nama</label>
                                    <div class="col-sm-9">
                                        <input id="input_customer_name" type="text" class="form-control"
                                            v-model="transactionDetailForm.customer_name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="input_category" class="col-sm-3 col-form-label">Diskon (%)</label>
                                    <div class="col-sm-9">
                                        <input id="input_discount" type="text" class="form-control"
                                            v-model="transactionDetailForm.discount">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="input_category" class="col-sm-3 col-form-label">Total</label>
                                    <div class="col-sm-9">
                                        <input id="input_total_price" type="text" class="form-control" disabled
                                            v-model="transactionDetailForm.total_price">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="input_category" class="col-sm-3 col-form-label">Dibayar</label>
                                    <div class="col-sm-9">
                                        <input id="input_pay" type="text" class="form-control"
                                            v-model="transactionDetailForm.pay">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="input_category" class="col-sm-3 col-form-label">Kembali</label>
                                    <div class="col-sm-9">
                                        <input id="input_change" type="text" class="form-control"
                                            v-model="transactionDetailForm.change" disabled>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-span-2 my-auto flex">
                            <button @click="order"
                                class="mr-3 px-16 py-2 border-2 bg-green-500 text-white hover:bg-green-600 duration-300">
                                <h1 class="text-xl">Cetak Struk</h1>
                            </button>
                            <button @click="cancle(transaction_id)"
                                class="mr-3 px-16 py-2 border-2 bg-red-500 text-white hover:bg-red-600 duration-300">
                                <h1 class="text-xl">Batalkan Order</h1>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import { Head } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import AppLayout from '../../../Layouts/AppLayout.vue';

export default {
    components: {
        Head,
        AppLayout
    }, props: {
        transaction_id: Number,
        categories: Object,
        products: Object,
        url: String
    }, data() {
        return {
            selected_category: null,
            products: this.products,
            cart: [],
            cartFinal: [],
            qty: [],
            transactionDetailForm: {
                id_transaction: this.transaction_id,
                customer_name: null,
                discount: 0,
                total_price: this.transactionDetails,
                pay: null,
                change: null,
                products: []
            },
        }
    },
    computed: {
        totalItem() {
            var result = 0;
            this.qty.forEach(element => {
                result += element;
            });

            return result;
        },
        subTotalFunc() {
            var tes = [];
            var cartStored = []

            for (var i = 0; i < this.cart.length; i++) {
                tes[i] = this.cart[i].price * this.qty[i];
                var cartData = JSON.parse(localStorage.getItem('cart'))[i];

                const newStored = {
                    'id': cartData.id,
                    'name': cartData.name,
                    'discount': cartData.discount,
                    'qty': this.qty[i],
                    'price': tes[i],
                };
                cartStored.push(newStored);
            }
            const parsed = JSON.stringify(cartStored)
            localStorage.setItem('cart', parsed);
            this.cartFinal = cartStored;

            var data = this.cartFinal;

            var total = 0
            data.forEach(element => {
                total += element.price;
            });


            //Total
            if (this.transactionDetailForm.discount != null) {
                this.transactionDetailForm.total_price = total - (total * (this.transactionDetailForm.discount / 100));
            } else {
                this.transactionDetailForm.total_price = total;
            }

            //Kembali
            if (this.transactionDetailForm.pay != null) {
                this.transactionDetailForm.change = this.transactionDetailForm.pay - this.transactionDetailForm.total_price;
            }

            return tes;
        },
    }
    , methods: {
        selectedCategory(id, name) {
            this.selected_category = name;

            axios.get(route('cashier.showMenu', id),).then((res) => {
                this.products = res.data.data;
            }).catch((err) => {
                alert('Error!');
            })
        },

        addToChart(menus, i) {
            var menuStored = {
                'id': menus.id,
                'name': menus.name,
                'discount': menus.discount,
                'qty': 1,
                'price': menus.new_price,
            };
            this.qty[i] = 1;
            this.cart.push(menuStored);
            const parsed = JSON.stringify(this.cart);
            localStorage.setItem('cart', parsed);
        },

        removeFromMenu(index) {
            this.cart.splice(index, 1);
            const parsed = JSON.stringify(this.cart);

            localStorage.setItem('cart', parsed);
        },

        order() {
            const cart = this.cartFinal;
            this.transactionDetailForm.products = cart;

            if (this.transactionDetailForm.pay != null && this.transactionDetailForm.change > 0 && this.transactionDetailForm.customer_name != null) {
                Inertia.post(route('cashier.store'), this.transactionDetailForm);

                localStorage.removeItem('cart');
            }
        },
        cancle(id) {
            Inertia.delete(route('cashier.destroy', id));

            localStorage.removeItem('cart');
        }

    }
}
</script>

<style>
.menu-enter-active,
.menu-leave-active {
    transition: opacity .4s ease;
}

.menu-enter-from,
.menu-leave-to {
    opacity: 0;
}
</style>
