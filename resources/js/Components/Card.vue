<template lang="">
    <div class="card">
        <div class="card-header">
            <h3 class="h4">{{title}}</h3>
        </div>
        <div class="card-body">
            <slot/>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: String
    }
}
</script>

<style>

</style>
