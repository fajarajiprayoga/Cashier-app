<template>
    <Link :href="link" class="rounded-lg px-4 py-2 bg-green-500 text-white hover:bg-green-600 duration-300">
    Kembali</Link>
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
