<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { computed } from 'vue';
import MarkdownRenderer from '@/Components/MarkdownRenderer.vue';

const props = defineProps<{
    course: {
        title: string;
        slug: string;
    };
    lesson: {
        id: number;
        title: string;
        slug: string;
        content: string;
        video_url: string | null;
    };
    modules: Array<{
        id: number;
        title: string;
        lessons: Array<{
            id: number;
            title: string;
            slug: string;
            pivot?: { completed_at: string };
        }>;
    }>;
}>();

const form = useForm({});

const completeLesson = () => {
    form.post(route('lessons.complete', props.lesson.id), {
        preserveScroll: true,
    });
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Courses',
        href: '/courses',
    },
    {
        title: props.course.title,
        href: `/courses/${props.course.slug}`,
    },
    {
        title: props.lesson.title,
        href: '#',
    },
];

// Helper to find next lesson
const nextLesson = computed(() => {
    let foundCurrent = false;
    for (const module of props.modules) {
        for (const l of module.lessons) {
            if (foundCurrent) return l;
            if (l.id === props.lesson.id) foundCurrent = true;
        }
    }
    return null;
});
</script>

<template>
    <Head :title="lesson.title" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 p-4 h-full">
            <!-- Sidebar Navigation -->
            <div class="lg:col-span-1 border-r border-sidebar-border pr-4 hidden lg:block overflow-y-auto max-h-[calc(100vh-8rem)]">
                <h3 class="font-bold mb-4 text-lg">Course Content</h3>
                <div v-for="module in modules" :key="module.id" class="mb-6">
                    <h4 class="font-medium text-sm text-neutral-500 mb-2 uppercase">{{ module.title }}</h4>
                    <ul class="space-y-1">
                        <li v-for="l in module.lessons" :key="l.id">
                            <Link
                                :href="route('lessons.show', [course.slug, l.slug])"
                                class="block px-3 py-2 rounded-md text-sm transition-colors"
                                :class="{'bg-sidebar-accent font-medium': l.id === lesson.id, 'hover:bg-sidebar-accent/50': l.id !== lesson.id}"
                            >
                                <div class="flex items-center gap-2">
                                     <span v-if="l.pivot?.completed_at" class="text-green-500">✓</span>
                                     <span>{{ l.title }}</span>
                                </div>
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3 max-w-3xl mx-auto w-full">
                <h1 class="text-3xl font-bold mb-6">{{ lesson.title }}</h1>
                
                <div v-if="lesson.video_url" class="aspect-video bg-black rounded-xl mb-8 flex items-center justify-center text-white">
                    <!-- Placeholder for video player -->
                    <span>Video Player: {{ lesson.video_url }}</span>
                </div>

                <div class="prose dark:prose-invert max-w-none mb-12">
                    <MarkdownRenderer :content="lesson.content" />
                </div>

                <div class="flex items-center justify-between border-t border-sidebar-border pt-6 mt-8">
                    <button
                        @click="completeLesson"
                        class="px-6 py-2 bg-primary text-primary-foreground rounded-lg font-medium hover:opacity-90 transition-opacity"
                        :disabled="form.processing"
                    >
                        {{ form.processing ? 'Saving...' : 'Mark as Complete' }}
                    </button>
                    
                    <Link
                        v-if="nextLesson"
                        :href="route('lessons.show', [course.slug, nextLesson.slug])"
                        class="px-6 py-2 border border-sidebar-border rounded-lg hover:bg-sidebar-accent transition-colors"
                    >
                        Next Lesson ->
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
