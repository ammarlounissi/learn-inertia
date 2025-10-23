<script setup>
import { ref } from 'vue';
import NavSidebar from './NavSidebar.vue';

const open = ref(false);

function toggle() {
    open.value = !open.value;
}

function close() {
    open.value = false;
}
</script>

<template>
    <div>
        <button @click="toggle" class="p-2 rounded-md bg-gray-100 hover:bg-gray-200 focus:outline-none relative z-50" aria-haspopup="true" :aria-expanded="open">
            <!-- أيقونة همبرغر بسيطة -->
            <span class="block w-5 h-0.5 bg-gray-700 mb-1"></span>
            <span class="block w-5 h-0.5 bg-gray-700 mb-1"></span>
            <span class="block w-5 h-0.5 bg-gray-700"></span>
        </button>

        <!-- القائمة المنبثقة بحجم كامل -->
        <template v-if="open">
            <!-- طبقة خلفية شفافة -->
            <div class="fixed inset-0 bg-black/50 z-40" @click="close"></div>
            
            <!-- القائمة الرئيسية -->
            <div class="fixed inset-y-0 right-0 w-80 bg-white shadow-xl z-50 overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold">القائمة</h2>
                        <button @click="close" class="p-2 hover:bg-gray-100 rounded-full">
                            ✕
                        </button>
                    </div>
                    <!-- نعيد استخدام NavSidebar داخل الهامبرغر؛ نغلفه لتنسيق القائمة المنبثقة -->
                    <div class="text-gray-700">
                        <NavSidebar @linkClicked="close" />
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<style scoped>
/* تغييرات صغيرة للتحكم في ظهور القائمة عند الحاجة */
</style>
