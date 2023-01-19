<template>
    <AppLayout>

        <Head title="Tambah Kategori"></Head>
        <div class="row">
            <div class="col-md-6">
                <Card :title="'Hello World'">
                    <form class="mt-3" @submit.prevent="update">
                        <div class="row mb-3">
                            <label for="input_category" class="col-sm-3 col-form-label">Kategori</label>
                            <div class="col-sm-9">
                                <input id="input_category" type="text" class="form-control" v-model="form.name">
                                <InputError :message="errors.name"></InputError>
                            </div>
                        </div>
                        <div class="float-right">
                            <ButtonBack :link="route('category.index')"></ButtonBack>
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
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import ButtonBack from '../../../Components/ButtonBack.vue';
import Card from '../../../Components/Card.vue';
import InputError from '../../../Components/InputError.vue';

export default {
    props: {
        category: Object,
        errors: Object
    },
    components: {
        AppLayout,
        Head,
        ButtonBack,
        Card,
        InputError
    }, data() {
        return {
            form: {
                name: this.category.name
            }
        }
    }, methods: {
        update() {
            Inertia.put(route('category.update', this.category.id), this.form)
        }
    }
}
</script>

<style>

</style>
