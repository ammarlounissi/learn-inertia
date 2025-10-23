<script setup>
import NavLink from './NavLink.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const emit = defineEmits(['linkClicked']);

const page = usePage();
const username = computed(() => page.props.auth.user.username);
</script>

<template>
    <div class="flex items-center gap-2 mb-6">
        <p>اهلا , {{ username }}!</p>
    </div>
    
    <nav @click="emit('linkClicked')">
        <ul class="flex flex-col space-y-2 text-right">
            <li>
                <NavLink href="/" :active="$page.component === 'Home'">
                    الصفحة الرئيسية
                </NavLink>
            </li>

            <li>
                <NavLink href="/dashboard" :active="$page.component === 'Dashboard'">
                    لوحة التحكم
                </NavLink>
            </li>

            <li>
                <NavLink href="/posts" :active="$page.component.startsWith('Posts')">
                    المقالات
                </NavLink>
            </li>

            <li>
                <NavLink href="/users" :active="$page.component.startsWith('Users')">
                    المستخدمين
                </NavLink>
            </li>

            <li>
                <NavLink href="/settings" :active="$page.component === 'Settings'">
                    الإعدادات
                </NavLink>
            </li>

            <!-- فاصل قبل تسجيل الخروج -->
            <div class="my-4 border-t border-gray-200 dark:border-gray-700"></div>

            <li>
                <NavLink href="/logout" method="post" as="button" class="w-full text-red-600 hover:text-red-700">
                    تسجيل الخروج
                </NavLink>
            </li>
        </ul>
    </nav>
</template>
