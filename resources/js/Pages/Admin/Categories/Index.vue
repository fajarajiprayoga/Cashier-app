<template>
    <AppLayout>

        <Head title="Kategori"></Head>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="mr-auto">Kategori</div>
                            <div>Dashboard / Kategori</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mt-3 row">
                            <div class="col-lg-12">
                                <div class="">
                                    <ButtonCreate :link="route('category.create')"></ButtonCreate>
                                </div>
                                <div class="my-3">
                                    <div v-if="$page.props.flash.success" class="bg-success p-2 rounded">
                                        <span class="text-white"><i class="bi bi-check-all text-white mr-2"></i>{{
        $page.props.flash.message
}}</span>
                                    </div>
                                    <div v-if="$page.props.flash.error" class="bg-danger p-2 rounded">
                                        <span class="text-white"><i
                                                class="bi bi-exclamation-circle-fill text-white mr-2"></i>{{
        $page.props.flash.message
}}</span>
                                    </div>
                                </div>
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(category, i) in categories.data" :key="i">
                                            <td>{{ i + 1 }}</td>
                                            <td>{{ category.name }}</td>
                                            <td>
                                                <div>
                                                    <ButtonEdit :href="route('category.edit', category.id)">
                                                    </ButtonEdit>
                                                    <ButtonDelete :class="`ml-1`"
                                                        :href="route('category.destroy', category.id)">
                                                    </ButtonDelete>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="float-right">
                                    <Pagination :link="categories.links"></Pagination>
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
import NavLink from '../../../Components/NavLink.vue';
import Pagination from '../../../Components/Pagination.vue';
import { Link } from '@inertiajs/inertia-vue3';
import AppLayout from '../../../Layouts/AppLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { ref } from 'vue';
import ButtonCreate from '../../../Components/ButtonCreate.vue';
import ButtonDelete from '../../../Components/ButtonDelete.vue';
import ButtonEdit from '../../../Components/ButtonEdit.vue';

export default {
    components: {
        AppLayout,
        NavLink,
        Head,
        Link,
        Pagination,
        ButtonCreate,
        ButtonDelete,
        ButtonEdit
    }, props: {
        categories: Object,
        errors: Object
    }
}
</script>

<style>

</style>
