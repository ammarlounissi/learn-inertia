<script setup>
import Nav from './Nav.vue';
import Hamburger from './Hamburger.vue';
import Sidebar from './Sidebar.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();

const username = computed(() => page.props.auth.user.username);

</script>

<template>
    <Head>
        <meta type="description" content="Information about this app" head-key="description">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </Head>
    
    <!-- Header -->
    <section class="fixed top-0 right-0 left-0 z-10 p-6 bg-gray-200 md:hidden">
        <header class="flex justify-between items-center">
            <div class="flex items-center gap-2">
                <h1 class="font-bold text-lg md:hidden">
تطبيق القران                </h1>

                <p>اهلا  , {{ username }}!</p>
            </div>

            
        </header>
    </section>

    <!-- Sidebar -->
    <Sidebar />

    <!-- Main Content -->
    <main class="mr-[20%] mt-20 min-h-screen md:mt-0">
        <section class="p-6 pb-24">
            <div class="max-w-3xl mx-auto">
                <slot />
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="fixed bottom-0 left-0 right-0 bg-[#f5f5dc] shadow-lg md:hidden">
        <div class="max-w-3xl mx-auto px-6 py-3 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <Hamburger />
                <Nav />
            </div>
        </div>
    </footer>
</template>
