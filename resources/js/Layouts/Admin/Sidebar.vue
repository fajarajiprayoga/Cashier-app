<template>
    <div>
        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">

            <ul class="sidebar-nav" id="sidebar-nav">

                <li class="nav-item">
                    <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="nav-link">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </NavLink>
                </li>
                <li class="nav-item">
                    <NavLink :href="route('category.index')" :active="route().current('category.index')"
                        class="nav-link">
                        <i class="bi bi-grid"></i>
                        <span>Kategori</span>
                    </NavLink>
                </li>
                <li class="nav-item">
                    <NavLink :href="route('product.index')" :active="route().current('product.index')" class="nav-link">
                        <i class="bi bi-grid"></i>
                        <span>Product</span>
                    </NavLink>
                </li>
                <li class="nav-item">
                    <NavLink :href="route('cashier.index')" :active="route().current('cashier.index')" class="nav-link">
                        <i class="bi bi-grid"></i>
                        <span>Kasir</span>
                    </NavLink>
                </li>
                <li class="nav-item">
                    <NavLink :href="route('transaction.index')" :active="route().current('transaction.index')"
                        class="nav-link">
                        <i class="bi bi-grid"></i>
                        <span>Data Transaksi</span>
                    </NavLink>
                </li>
            </ul>

        </aside><!-- End Sidebar-->
    </div>
</template>

<script>
import NavLink from '../../Components/NavLink.vue';

export default {
    components: {
        NavLink
    }
}
</script>
