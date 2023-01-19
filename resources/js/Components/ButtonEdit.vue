<template>
    <Link :href="link"
        class="rounded-md px-2 py-1 bg-yellow-600 text-md text-yellow-100 hover:bg-yellow-600 duration-300">
    <i class="bi bi-pencil-square"></i></Link>
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
