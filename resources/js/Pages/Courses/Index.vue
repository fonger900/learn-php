<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { BookOpen, Clock, Award } from 'lucide-vue-next';
import GradientCard from '@/components/ui/GradientCard.vue';
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

const levelColors = {
    beginner: 'bg-green-500/20 text-green-600 dark:text-green-400',
    intermediate: 'bg-yellow-500/20 text-yellow-600 dark:text-yellow-400',
    advanced: 'bg-red-500/20 text-red-600 dark:text-red-400',
};
</script>

<template>

    <Head title="Courses" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 p-6">
            <!-- Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold">Available Courses</h1>
                    <p class="mt-2 text-muted-foreground">
                        Explore our comprehensive learning paths
                    </p>
                </div>
            </div>

            <!-- Courses Grid -->
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <Link v-for="course in courses" :key="course.id" :href="route('courses.show', course.slug)"
                    class="group block">
                    <GradientCard variant="border" hover
                        class="h-full transition-all duration-300 group-hover:shadow-2xl">
                        <!-- Course Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h2 class="text-xl font-bold group-hover:text-primary transition-colors">
                                    {{ course.title }}
                                </h2>
                            </div>
                            <span :class="[
                                'px-3 py-1 text-xs font-semibold rounded-full capitalize whitespace-nowrap ml-2',
                                levelColors[course.level as keyof typeof levelColors] || levelColors.beginner
                            ]">
                                {{ course.level }}
                            </span>
                        </div>

                        <!-- Course Description -->
                        <p class="text-sm text-muted-foreground line-clamp-3 mb-6">
                            {{ course.description }}
                        </p>

                        <!-- Course Meta -->
                        <div class="flex items-center gap-4 pt-4 border-t border-border">
                            <div class="flex items-center gap-2 text-sm text-muted-foreground">
                                <BookOpen class="h-4 w-4" />
                                <span>{{ course.modules_count }} Modules</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-muted-foreground">
                                <Clock class="h-4 w-4" />
                                <span>~{{ course.modules_count * 2 }}h</span>
                            </div>
                        </div>

                        <!-- Hover Indicator -->
                        <div
                            class="mt-4 flex items-center gap-2 text-primary opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-sm font-medium">Start Learning</span>
                            <span class="transform group-hover:translate-x-1 transition-transform">→</span>
                        </div>
                    </GradientCard>
                </Link>
            </div>

            <!-- Empty State -->
            <div v-if="courses.length === 0" class="flex flex-col items-center justify-center py-16">
                <Award class="h-16 w-16 text-muted-foreground/50 mb-4" />
                <h3 class="text-xl font-semibold mb-2">No courses available yet</h3>
                <p class="text-muted-foreground">Check back soon for new learning opportunities!</p>
            </div>
        </div>
    </AppLayout>
</template>
