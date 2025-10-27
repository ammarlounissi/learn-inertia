<script setup>
import { useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue'; // إضافة لـ onMounted

defineProps({
    telegramCallbackUrl: String,
});

defineOptions({
    layout: null
});


onMounted(() => {
    // إضافة ودجيت Telegram ديناميكيًا
    const script = document.createElement('script');
    script.async = true;
    script.src = 'https://telegram.org/js/telegram-widget.js?22'; // الإصدار الحالي
    script.setAttribute('data-telegram-login', 'Badis2025_bot'); // استبدل بـ bot username الخاص بك
    script.setAttribute('data-size', 'large'); // حجم الزر: large, medium, small
    script.setAttribute('data-auth-url', telegramCallbackUrl); // استخدام الـ URL من الـ props
    script.setAttribute('data-request-access', 'write'); // للسماح بالوصول
    // script.setAttribute('data-radius', '20'); // اختياري: لجعل الزر مدورًا
    // script.setAttribute('data-userpic', 'false'); // اختياري: إخفاء صورة المستخدم

    const container = document.getElementById('telegram-login');
    if (container) {
        container.appendChild(script);
    }
});
</script>

<template>
    <main class="grid place-items-center min-h-screen">
        <section class="bg-white p-8 rounded-xl max-w-md mx-auto border w-full text-center">
            <div class="mb-6">
                <h2 class="text-xl mb-4"> التسجيل عبر تيليجرام</h2>
                <div id="telegram-login"></div> <!-- Placeholder للودجيت -->
            </div>
        </section>
    </main>
</template>