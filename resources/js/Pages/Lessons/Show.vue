<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { computed } from 'vue';
import MarkdownRenderer from '@/components/MarkdownRenderer.vue';
import AnimatedButton from '@/components/ui/AnimatedButton.vue';
import { CheckCircle2, ChevronRight, PlayCircle } from 'lucide-vue-next';

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

// Calculate module progress
const getModuleProgress = (module: typeof props.modules[0]) => {
    const completed = module.lessons.filter(l => l.pivot?.completed_at).length;
    return Math.round((completed / module.lessons.length) * 100);
};
</script>

<template>

    <Head :title="lesson.title" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 p-6 h-full">
            <!-- Sidebar Navigation -->
            <div class="lg:col-span-1 space-y-4 hidden lg:block overflow-y-auto max-h-[calc(100vh-8rem)]">
                <div class="sticky top-0 bg-background/95 backdrop-blur-sm pb-4 z-10">
                    <h3 class="font-bold text-lg">Course Content</h3>
                </div>

                <div v-for="module in modules" :key="module.id" class="space-y-2">
                    <div class="flex items-center justify-between">
                        <h4 class="font-semibold text-sm uppercase tracking-wide text-muted-foreground">
                            {{ module.title }}
                        </h4>
                        <span class="text-xs text-muted-foreground">
                            {{ getModuleProgress(module) }}%
                        </span>
                    </div>

                    <!-- Progress bar for module -->
                    <div class="h-1 bg-muted rounded-full overflow-hidden mb-3">
                        <div class="h-full gradient-primary rounded-full transition-all duration-500"
                            :style="{ width: `${getModuleProgress(module)}%` }"></div>
                    </div>

                    <ul class="space-y-1">
                        <li v-for="l in module.lessons" :key="l.id">
                            <Link :href="route('lessons.show', [course.slug, l.slug])"
                                class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-200"
                                :class="{
                                    'bg-primary text-primary-foreground shadow-md': l.id === lesson.id,
                                    'hover:bg-accent': l.id !== lesson.id
                                }">
                                <CheckCircle2 v-if="l.pivot?.completed_at"
                                    class="h-4 w-4 flex-shrink-0 text-green-500" />
                                <div v-else class="h-4 w-4 flex-shrink-0 rounded-full border-2"
                                    :class="l.id === lesson.id ? 'border-primary-foreground' : 'border-muted-foreground/30'" />
                                <span class="flex-1 truncate">{{ l.title }}</span>
                                <ChevronRight v-if="l.id === lesson.id" class="h-4 w-4 flex-shrink-0" />
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3 max-w-4xl mx-auto w-full">
                <div class="space-y-6">
                    <!-- Lesson Title -->
                    <div>
                        <h1 class="text-4xl font-bold mb-2">{{ lesson.title }}</h1>
                        <div class="h-1 w-20 gradient-primary rounded-full"></div>
                    </div>

                    <!-- Video Player -->
                    <div v-if="lesson.video_url"
                        class="relative aspect-video bg-black rounded-2xl overflow-hidden shadow-2xl">
                        <div
                            class="absolute inset-0 flex items-center justify-center text-white bg-gradient-to-br from-primary/20 to-secondary/20">
                            <div class="text-center">
                                <PlayCircle class="h-20 w-20 mx-auto mb-4 opacity-80" />
                                <p class="text-lg">Video Player</p>
                                <p class="text-sm opacity-70">{{ lesson.video_url }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Lesson Content -->
                    <div class="prose prose-lg dark:prose-invert max-w-none">
                        <MarkdownRenderer :content="lesson.content" />
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between border-t border-border pt-8 mt-12">
                        <AnimatedButton @click="completeLesson" variant="primary" size="lg" :loading="form.processing"
                            :disabled="form.processing">
                            <CheckCircle2 class="h-5 w-5" />
                            {{ form.processing ? 'Saving...' : 'Mark as Complete' }}
                        </AnimatedButton>

                        <Link v-if="nextLesson" :href="route('lessons.show', [course.slug, nextLesson.slug])"
                            class="group flex items-center gap-2 px-6 py-3 rounded-lg border-2 border-primary text-primary hover:bg-primary hover:text-white transition-all duration-300">
                            <span class="font-medium">Next Lesson</span>
                            <ChevronRight class="h-5 w-5 group-hover:translate-x-1 transition-transform" />
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
