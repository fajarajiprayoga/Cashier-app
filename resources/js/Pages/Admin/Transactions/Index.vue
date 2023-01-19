<template>
    <div>
        <AppLayout>

            <Head title="Data Transaksi"></Head>
            <Card :title="'Data Transaksi'">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Customer</th>
                            <th>Menu</th>
                            <th>Harga</th>
                            <th>Bayar</th>
                            <th>Kembali</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(transaction, i) in transactions.data" :key="i">
                            <td>{{ i + 1 }}</td>
                            <td>{{ transaction.customer_name }}</td>
                            <td><button @click="openModal(transaction.id)" type="button" class="text-2xl"><i
                                        class="bi bi-eye-fill"></i></button></td>
                            <td>{{ transaction.total_price }}</td>
                            <td>{{ transaction.pay }}</td>
                            <td>{{ transaction.change }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="float-right">
                    <Pagination :link="transactions.links"></Pagination>
                </div>
            </Card>
        </AppLayout>
        <ModalKu :show-modal="showModal" :modal-title="modalTitle" :modal-info="modalInfo">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Menu</th>
                        <th>Diskon</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product, i) in productDetail" :key="i">
                        <td>{{ i+ 1 }}</td>
                        <td>{{ product.name }}</td>
                        <td>{{ product.discount }}%</td>
                        <td>{{ product.price }}</td>
                        <td>{{ product.qty }}</td>
                        <td>{{ product.sub_total }}</td>
                    </tr>
                </tbody>
            </table>
        </ModalKu>
    </div>
</template>

<script>
import AppLayout from '../../../Layouts/AppLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Card from '../../../Components/Card.vue';
import ModalKu from '../../../Components/ModalKu.vue';
import { Inertia } from '@inertiajs/inertia';
import axios from 'axios';
import Pagination from '../../../Components/Pagination.vue';

export default {
    components: {
        AppLayout,
        Head,
        Card,
        ModalKu,
        Pagination
    }, props: {
        transactions: Object,
    }, data() {
        return {
            showModal: false,
            modalInfo: null,
            modalTitle: null,
            productDetail: [],
        }
    }, methods: {
        openModal(id) {
            this.showModal = !this.showModal;
            this.modalInfo = true
            this.modalTitle = 'Detail Produk'

            this.productDetail.splice(0);

            axios.get(route('transaction.detailProduct', id)).then((res) => {
                var data = res.data.data;

                data.forEach(element => {
                    var detail = {
                        transaction_id: element.transaction_id,
                        name: element.products.name,
                        discount: element.discount,
                        price: element.new_price,
                        qty: element.count,
                        sub_total: element.sub_total,
                        date: element.created_at
                    }

                    this.productDetail.push(detail);
                });
            }).catch((err) => {
                console.log(err);
            })
        }
    }
}
</script>

<style>

</style>
