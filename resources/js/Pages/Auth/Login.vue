<script setup>
import { onMounted } from 'vue'; // تم الاحتفاظ بها لتهيئة الودجيت

defineProps({
    telegramCallbackUrl: String,
});

defineOptions({
    layout: null
});

// تم حذف:
// import { useForm } from '@inertiajs/vue3';
// let form = useForm({ email: '', password: '' });
// let submit = () => { form.post('/login'); }

onMounted(() => {
    // تهيئة وودجيت Telegram
    const script = document.createElement('script');
    script.async = true;
    script.src = 'https://telegram.org/js/telegram-widget.js?22';
    script.setAttribute('data-telegram-login', 'Badis2025_bot'); // اسم البوت الخاص بك
    script.setAttribute('data-size', 'large');
    script.setAttribute('data-auth-url', telegramCallbackUrl);
    script.setAttribute('data-request-access', 'write');

    const container = document.getElementById('telegram-login');
    if (container) {
        container.appendChild(script);
    }
});
</script>

<template>
    <Head title="Log In" />

    <main class="grid place-items-center min-h-screen bg-gray-100">
        <section class="bg-white p-10 rounded-2xl shadow-xl max-w-sm mx-auto border w-full">

            <!-- عنوان موجه لتسجيل الدخول عبر تيليجرام -->
            <h1 class="text-3xl font-extrabold text-gray-800 mb-8 text-center">
                Log In
            </h1>
            <p class="text-gray-600 mb-8 text-center">
                من فضلك قم بتسجيل الدخول باستخدام حساب تيليجرام الخاص بك
            </p>

            <!-- قسم ودجيت Telegram -->
            <div class="flex justify-center">
                <div id="telegram-login"></div> <!-- Placeholder للودجيت -->
            </div>

        </section>
    </main>
</template>
