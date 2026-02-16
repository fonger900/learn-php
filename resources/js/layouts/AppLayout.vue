<script setup lang="ts">
import AppHeader from '@/components/AppHeader.vue';
import type { BreadcrumbItem } from '@/types';

type Props = {
    breadcrumbs?: BreadcrumbItem[];
};

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <div class="flex min-h-screen w-full flex-col bg-background">
        <AppHeader :breadcrumbs="breadcrumbs" />
        <main class="mx-auto flex w-full max-w-7xl flex-1 flex-col">
            <slot />
        </main>
    </div>
</template>
