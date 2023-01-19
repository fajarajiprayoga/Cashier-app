<script setup>
import Header from "./Admin/Header.vue"
import Sidebar from "./Admin/Sidebar.vue"
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';


</script>

<template>
    <div>

        <Header></Header>

        <Sidebar></Sidebar>

        <main id="main" class="main">

            <slot />

        </main><!-- End #main -->

    </div>
</template>
