<template>
    <AppLayout>

        <Head title="Edit Produk"></Head>
        <div class="row">
            <div class="col-lg-9">
                <Card :title="'Form Edit Produk'">
                    <form @submit.prevent="update" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label for="input_name" class="col-sm-3 col-form-label">Nama Produk</label>
                            <div class="col-sm-9">
                                <input id="input_name" type="text" class="form-control" v-model="form.name">
                                <InputError :message="errors.name"></InputError>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="input_category" class="col-sm-3 col-form-label">Kategori</label>
                            <div class="col-sm-9">
                                <select id="input_category" class="form-control" v-model="form.category_id">
                                    <option v-for="category in categories" :value="category.id">{{ category.name }}
                                    </option>
                                </select>
                                <InputError :message="errors.category_id"></InputError>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="input_description" class="col-sm-3 col-form-label">Deskripsi Produk</label>
                            <div class="col-sm-9">
                                <textarea v-model="form.description" id="input_description" cols="56"
                                    rows="3"></textarea>
                                <InputError :message="errors.description"></InputError>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="input_old_price" class="col-sm-3 col-form-label">Harga Awal</label>
                            <div class="col-sm-9">
                                <input id="input_old_price" type="text" class="form-control" v-model="form.old_price">
                                <InputError :message="errors.old_price"></InputError>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="input_discount" class="col-sm-3 col-form-label">Diskon</label>
                            <div class="col-sm-9">
                                <input id="input_discount" type="text" class="form-control" v-model="form.discount">
                                <InputError :message="errors.discount"></InputError>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="input_thumbnail" class="col-sm-3 col-form-label">Thumbnail</label>
                            <div class="col-sm-9">
                                <img style="width: 100px; height: 100px;" :src="url + '/storage/' + product.thumbnail"
                                    alt="">
                                <input id="input_thumbnail" type="file" class="form-control p-2"
                                    @input="form.thumbnail = $event.target.files[0]">
                                <InputError :message="errors.thumbnail"></InputError>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="input_thumbnail" class="col-sm-3 col-form-label">Multi Image</label>
                            <div class="col-sm-9">
                                <div class="flex">
                                    <img v-for="img in multi_img" style="width: 100px; height: 100px;"
                                        :src="url + '/storage/' + img.photo_path" alt="">
                                </div>
                                <input id="input_multi_img" type="file" class="form-control p-2"
                                    @input="form.multi_img = $event.target.files" multiple>
                                <InputError :message="errors.multi_img"></InputError>
                            </div>
                        </div>
                        <div class="float-right">
                            <ButtonBack :link="route('product.index')"></ButtonBack>
                            <button
                                class="rounded-lg px-4 py-2 ml-2 bg-blue-500 text-blue-100 hover:bg-blue-600 duration-300">Simpan</button>
                        </div>
                    </form>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '../../../Layouts/AppLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Card from '../../../Components/Card.vue';
import ButtonBack from '../../../Components/ButtonBack.vue';
import InputError from '../../../Components/InputError.vue';
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';

export default {
    components: {
        AppLayout,
        Head,
        Card,
        ButtonBack,
        InputError
    }, props: {
        product: Object,
        errors: Object,
        categories: Object,
        multi_img: Object,
        url: String
    }, data() {
        return {
            form: {
                name: this.product.name,
                description: this.product.description,
                category_id: this.product.category_id,
                old_price: this.product.old_price,
                discount: this.product.discount,
                thumbnail: null,
                multi_img: null,
                _method: 'put'
            }
        }
    }, methods: {
        update() {
            Inertia.post(route('product.update', this.product.id), this.form);
        }
    }
}
</script>

<style>

</style>
