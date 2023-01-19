<template>
    <Head title="Kasir"></Head>
    <AppLayout>
        <div class="mt-3">
            <Link href="/admin/cashier/transactions" class="rounded-lg px-4 py-3 bg-blue-500 text-white hover:bg-blue-600 duration-300"><i class="bi bi-basket2"></i> Transaksi Baru</Link>
        </div>
    </AppLayout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import AppLayout from '../../../Layouts/AppLayout.vue';

export default {
    components: {
        Head,
        AppLayout,
        Link
    }
}
</script>
