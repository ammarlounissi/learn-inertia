<script setup>
import { Link } from '@inertiajs/vue3';
import NavSidebar from './NavSidebar.vue';

</script>

<template>
    
    <aside class="hidden md:block fixed right-0 top-0 h-full md:w-1/4 lg:w-1/5 bg-gray-800 text-white pt-20">
        <NavSidebar />
    </aside>
</template>
