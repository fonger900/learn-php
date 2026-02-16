<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { CheckCircle2, ChevronRight, PlayCircle, List } from 'lucide-vue-next';
import { computed, ref } from 'vue';
import CourseSidebar from '@/components/CourseSidebar.vue';
import MarkdownRenderer from '@/components/MarkdownRenderer.vue';
import AnimatedButton from '@/components/ui/AnimatedButton.vue';
import { Sheet, SheetContent, SheetTrigger } from '@/components/ui/sheet';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

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
        pivot?: { completed_at: string };
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
const isMobileSidebarOpen = ref(false);

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
        <div class="flex flex-col lg:flex-row h-[calc(100vh-4rem)] overflow-hidden">
            <!-- Desktop Sidebar Navigation -->
            <div class="hidden lg:block w-80 shrink-0 h-full border-r border-border overflow-y-auto">
                <CourseSidebar :course="course" :current-lesson-id="lesson.id" :modules="modules" />
            </div>

            <!-- Mobile Navigation Trigger (Floating) -->
            <div class="lg:hidden fixed bottom-6 right-6 z-40">
                <Sheet v-model:open="isMobileSidebarOpen">
                    <SheetTrigger as-child>
                        <button class="h-14 w-14 rounded-full gradient-primary text-white shadow-2xl flex items-center justify-center hover:scale-110 active:scale-95 transition-transform">
                            <List class="h-6 w-6" />
                        </button>
                    </SheetTrigger>
                    <SheetContent side="left" class="p-0 w-80">
                        <CourseSidebar :course="course" :current-lesson-id="lesson.id" :modules="modules" @click="isMobileSidebarOpen = false" />
                    </SheetContent>
                </Sheet>
            </div>

            <!-- Main Content Area -->
            <div class="flex-1 overflow-y-auto bg-background/50 custom-scrollbar">
                <div class="max-w-4xl mx-auto px-6 py-10">
                    <div class="space-y-8">
                        <!-- Lesson Header -->
                        <div class="space-y-4">
                            <div class="flex items-center gap-2 text-sm font-medium text-primary uppercase tracking-wider">
                                <span>{{ course.title }}</span>
                                <ChevronRight class="h-4 w-4 text-muted-foreground" />
                                <span class="text-muted-foreground">Lesson</span>
                            </div>
                            <h1 class="text-4xl font-extrabold tracking-tight lg:text-5xl leading-tight">
                                {{ lesson.title }}
                            </h1>
                            <div class="h-1.5 w-24 gradient-primary rounded-full"></div>
                        </div>

                        <!-- Video Player -->
                        <div v-if="lesson.video_url"
                            class="relative aspect-video bg-black rounded-3xl overflow-hidden shadow-2xl group border border-border/50">
                            <div
                                class="absolute inset-0 flex items-center justify-center text-white bg-gradient-to-br from-black/40 via-transparent to-black/40">
                                <div class="text-center transform group-hover:scale-110 transition-transform duration-500">
                                    <PlayCircle class="h-24 w-24 mx-auto mb-4 text-white/90 drop-shadow-2xl" />
                                    <p class="text-xl font-bold tracking-wide">Start Video Lesson</p>
                                    <p class="text-sm opacity-60 mt-2 font-mono">{{ lesson.video_url }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Lesson Content -->
                        <div class="prose prose-lg dark:prose-invert max-w-none prose-headings:font-bold prose-a:text-primary hover:prose-a:underline bg-card/30 p-8 rounded-3xl border border-border/50">
                            <MarkdownRenderer :content="lesson.content" />
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-border pt-10 mt-12 mb-20">
                            <AnimatedButton @click="completeLesson" 
                                :variant="lesson.pivot?.completed_at ? 'outline' : 'primary'" 
                                size="lg" 
                                :loading="form.processing"
                                :disabled="form.processing || !!lesson.pivot?.completed_at"
                                class="w-full sm:w-auto min-w-[200px] h-14 rounded-2xl text-lg shadow-lg shadow-primary/10">
                                <CheckCircle2 class="h-6 w-6" :class="{ 'text-green-500': lesson.pivot?.completed_at }" />
                                {{ form.processing ? 'Saving...' : (lesson.pivot?.completed_at ? 'Lesson Completed' : 'Mark as Complete') }}
                            </AnimatedButton>

                            <Link v-if="nextLesson" :href="route('lessons.show', [course.slug, nextLesson.slug])"
                                class="group flex items-center justify-center gap-3 w-full sm:w-auto px-8 h-14 rounded-2xl border-2 border-primary/20 text-primary hover:bg-primary hover:text-white hover:border-primary transition-all duration-300 font-bold text-lg shadow-sm">
                                <span>Next Lesson</span>
                                <ChevronRight class="h-6 w-6 group-hover:translate-x-1 transition-transform" />
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: hsl(var(--border));
    border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: hsl(var(--muted-foreground) / 0.3);
}
</style>
