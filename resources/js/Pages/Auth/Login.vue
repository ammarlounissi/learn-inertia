<script setup>
import { useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue'; // إضافة لـ onMounted

defineProps({
    telegramCallbackUrl: String,
});

defineOptions({
    layout: null
});

let form = useForm({
    email: '',
    password: ''
});

let submit = () => {
    form.post('/login');
}

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
    <Head title="Log In" />

    <main class="grid place-items-center min-h-screen">
        <section class="bg-white p-8 rounded-xl max-w-md mx-auto border w-full">
            <h1 class="text-3xl mb-6">Log In</h1>

            <form @submit.prevent="submit">
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="email"> Email </label>

                    <input v-model="form.email" class="border p-2 w-full rounded" type="email" name="email" id="email"
                        required />

                    <div v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 text-xs mt-1"></div>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="password"> Password
                    </label>

                    <input v-model="form.password" class="border p-2 w-full rounded" type="password" name="password"
                        required id="password" />

                    <div v-if="form.errors.password" v-text="form.errors.password" class="text-red-500 text-xs mt-1">
                    </div>
                </div>

                <div class="mb-6">
                    <button type="submit"
                        class="bg-blue-400 text-white cursor-pointer rounded py-2 px-4 hover:bg-blue-500 disabled:cursor-not-allowed disabled:opacity-70"
                        :disabled="form.processing">
                        Log In
                    </button>
                </div>
            </form>

            <!-- إضافة ودجيت Telegram هنا -->
            <div class="mb-6">
                <h2 class="text-xl mb-4">Or Log In with Telegram</h2>
                <div id="telegram-login"></div> <!-- Placeholder للودجيت -->
            </div>
        </section>
    </main>
</template>