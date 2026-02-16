<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

const props = defineProps<{
    course: {
        id: number;
        title: string;
        slug: string;
        description: string;
        level: string;
        modules: Array<{
            id: number;
            title: string;
            lessons: Array<{
                id: number;
                title: string;
                slug: string;
            }>;
        }>;
    };
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Courses',
        href: '/courses',
    },
    {
        title: props.course.title,
        href: `/courses/${props.course.slug}`,
    },
];
</script>

<template>
    <Head :title="course.title" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-6 p-4 max-w-4xl mx-auto w-full">
            <div class="space-y-4">
                <span class="px-2 py-1 text-xs font-medium bg-sidebar-accent rounded-full capitalize">
                    {{ course.level }}
                </span>
                <h1 class="text-4xl font-bold">{{ course.title }}</h1>
                <p class="text-lg text-neutral-600 dark:text-neutral-400">
                    {{ course.description }}
                </p>
            </div>

            <div class="space-y-6">
                <h2 class="text-2xl font-semibold">Syllabus</h2>
                <div v-for="module in course.modules" :key="module.id" class="space-y-2">
                    <h3 class="text-xl font-medium">{{ module.title }}</h3>
                    <div class="border rounded-xl divide-y overflow-hidden border-sidebar-border">
                        <Link
                            v-for="lesson in module.lessons"
                            :key="lesson.id"
                            :href="route('lessons.show', [course.slug, lesson.slug])"
                            class="block p-4 hover:bg-sidebar-accent/50 transition-colors flex justify-between items-center group"
                        >
                            <span>{{ lesson.title }}</span>
                            <span class="text-sidebar-accent-foreground opacity-0 group-hover:opacity-100 transition-opacity">
                                Start ->
                            </span>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
