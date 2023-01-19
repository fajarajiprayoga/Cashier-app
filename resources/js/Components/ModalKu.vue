<template>
    <div>
        <transition name="fade" appear>
            <div @click="showModal = false" class="bgModal absolute inset-0 bg-gray-400/40" v-if="showModal">
            </div>
        </transition>

        <transition name="slide">
            <div class="card modalKu absolute w-full bg-white px-2 pt-2 max-w-screen-sm" v-if="showModal">
                <div class="card-header">
                    <h1 class="text-xl">{{ modalTitle }}</h1>
                    <hr>
                </div>
                <div class="card-body">
                    <slot />
                    <div v-if="modalInfo" class="float-right">
                        <button @click="showModal = false" type="button"
                            class="bg-gray-500 text-white px-4 py-2 mr-2">Close</button>
                    </div>
                    <div v-else class="float-right">
                        <button @click="showModal = false" type="button"
                            class="bg-gray-500 text-white px-4 py-2 mr-2">Close</button>
                        <button class="bg-blue-500 text-white px-4 py-2">Ok</button>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>

export default {
    props: {
        showModal: {
            type: Boolean,
            default: false
        },
        modalTitle: {
            type: String,
            default: 'Title'
        }, modalInfo: {
            type: Boolean,
            default: false
        }
    }
}
</script>

<style>
.bgModal {
    z-index: 98;
}

.modalKu {
    top: 35%;
    left: 40%;
    z-index: 99;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
