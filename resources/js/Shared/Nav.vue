<script setup>
import NavLink from './NavLink.vue';
</script>

<template>
    <nav>
        <ul class="flex space-x-4">
            <li>
                <NavLink href="/" :active="$page.component === 'Home'" class="flex flex-col items-center">
                    <i class="fas fa-home text-lg mb-1"></i>
                    Home
                </NavLink>
            </li>

            <li>
                <NavLink href="/users" :active="$page.component.startsWith('Users')" class="flex flex-col items-center">
                    <i class="fas fa-users text-lg mb-1"></i>
                    Users
                </NavLink>
            </li>

            <li>
                <NavLink href="/settings" :active="$page.component === 'Settings'" class="flex flex-col items-center">
                    <i class="fas fa-cog text-lg mb-1"></i>
                    Settings
                </NavLink>
            </li>

            <li>
                <NavLink href="/chat" :active="$page.component === 'Chat'" class="flex flex-col items-center">
                    <i class="fas fa-comments text-lg mb-1"></i>
                    Chat
                </NavLink>
            </li>
        </ul>
    </nav>
</template>