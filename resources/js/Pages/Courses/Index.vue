<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

defineProps<{
    courses: Array<{
        id: number;
        title: string;
        slug: string;
        description: string;
        level: string;
        modules_count: number;
    }>;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Courses',
        href: '/courses',
    },
];
</script>

<template>
    <Head title="Courses" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 p-4">
            <h1 class="text-2xl font-bold">Available Courses</h1>
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                <Link
                    v-for="course in courses"
                    :key="course.id"
                    :href="route('courses.show', course.slug)"
                    class="block rounded-xl border border-sidebar-border bg-sidebar p-6 hover:bg-sidebar-accent/50 transition-colors"
                >
                    <div class="flex items-start justify-between">
                        <h2 class="text-xl font-semibold">{{ course.title }}</h2>
                        <span class="px-2 py-1 text-xs font-medium bg-sidebar-accent rounded-full capitalize">
                            {{ course.level }}
                        </span>
                    </div>
                    <p class="mt-2 text-sm text-neutral-500 line-clamp-3">
                        {{ course.description }}
                    </p>
                    <div class="mt-4 flex items-center text-sm text-neutral-400">
                        <span>{{ course.modules_count }} Modules</span>
                    </div>
                </Link>
            </div>
        </div>
    </AppLayout>
</template>
