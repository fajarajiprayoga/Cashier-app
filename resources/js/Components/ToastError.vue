<template>
    <div class="row position-relative z-10">
        <div class="col-5 bg-danger p-2 border rounded position-absolute top-0 end-0">
            <div class="flex">
                <div>
                    <i class="bi bi- exclamation-circle-fill text-white mr-2"></i>
                </div>
                <div>
                    <span class="text-white text-sm">{{ $page.props.flash.message }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>
