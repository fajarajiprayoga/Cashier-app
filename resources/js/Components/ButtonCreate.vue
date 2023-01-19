<template>
    <Link :href="link" class="rounded-lg px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 duration-300">
    Tambah</Link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link
    }, props: {
        link: String
    }
}
</script>

<style>

</style>
