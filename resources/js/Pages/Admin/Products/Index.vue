<template>
    <AppLayout>

        <Head title="Product"></Head>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="mr-auto">Produk</div>
                            <div>Dashboard / Produk</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mt-3 row">
                            <div class="col-md-12">
                                <div>
                                    <ButtonCreate :link="route('product.create')"></ButtonCreate>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 my-3">
                                        <div v-if="$page.props.flash.success" class="bg-success p-2 rounded">
                                            <span class="text-white">
                                                <i class="bi bi-check-all text-white mr-2"></i>
                                                {{ $page.props.flash.message }}</span>
                                        </div>
                                        <div v-if="$page.props.flash.error" class="bg-danger p-2 rounded">
                                            <span class="text-white">
                                                <i class="bi bi-exclamation-circle-fill text-white mr-2"></i>
                                                {{ $page.props.flash.message }}</span>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Thumbnail</th>
                                            <th>Nama</th>
                                            <th>Kategori</th>
                                            <th>Diskon (%)</th>
                                            <th>Harga Awal</th>
                                            <th>Harga Akhir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(product, i) in products.data" :key="i">
                                            <td>{{ i + 1 }}</td>
                                            <td><img style="width: 100px; height: 100px;"
                                                    :src="url + /storage/ + product.thumbnail" :alt="product.thumbnail">
                                            </td>
                                            <td>{{ product.name }}</td>
                                            <td>{{ product.categories.name }}</td>
                                            <td>{{ product.discount }}</td>
                                            <td>{{ product.old_price }}</td>
                                            <td>{{ product.new_price }}</td>
                                            <td>
                                                <ButtonEdit :href="route('product.edit', product.id)"></ButtonEdit>
                                                <ButtonDelete :href="route('product.destroy', product.id)"
                                                    :class="'ml-1'">
                                                </ButtonDelete>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="float-right">
                                    <Pagination :link="products.links"></Pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>

<script>
import AppLayout from '../../../Layouts/AppLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Card from '../../../Components/Card.vue';
import ButtonCreate from '../../../Components/ButtonCreate.vue';
import Pagination from '../../../Components/Pagination.vue';
import ButtonEdit from '../../../Components/ButtonEdit.vue';
import ButtonDelete from '../../../Components/ButtonDelete.vue';

export default {
    components: {
        AppLayout,
        Head,
        Card,
        ButtonCreate,
        Pagination,
        ButtonEdit,
        ButtonDelete
    }, props: {
        products: Object,
        url: String
    }
}
</script>

<style>

</style>
