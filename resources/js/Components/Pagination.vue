<template>
    <template v-for="a in link">
        <Link :href="a.url" v-html="a.label" class="p-2">
        </Link>
    </template>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';;

export default {
    components: {
        Link,
    },
    props: {
        link: Array
    }
}
</script>

<style>

</style>
