<template>
    <Link :href="link" method="DELETE" as="button" type="button"
        class="rounded-md px-2 py-1 bg-red-600 text-md text-red-100 hover:bg-red-600 duration-300">
    <i class="bi bi-trash-fill"></i>
    </Link>
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
