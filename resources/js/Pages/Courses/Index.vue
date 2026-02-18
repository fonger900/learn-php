<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { BookOpen, Clock, Award, Users, CheckCircle2, GraduationCap } from 'lucide-vue-next';
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
        lessons_count: number;
        students_count: number;
        estimated_hours: number;
        is_enrolled: boolean;
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

const levelLabels = {
    beginner: 'Beginner',
    intermediate: 'Intermediate',
    advanced: 'Advanced',
};
</script>

<template>

    <Head title="Courses" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 p-6">
            <!-- Header -->
            <div class="relative overflow-hidden rounded-2xl gradient-full p-8 text-white mb-2">
                <div class="relative z-10">
                    <h1 class="text-4xl font-bold mb-3">Khóa học của chúng tôi</h1>
                    <p class="text-white/90 text-lg">
                        Khám phá các khóa học toàn diện từ cơ bản đến nâng cao
                    </p>
                    <div class="mt-6 flex flex-wrap gap-6">
                        <div class="flex items-center gap-2">
                            <GraduationCap class="h-5 w-5" />
                            <span>{{ courses.length }} khóa học</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <BookOpen class="h-5 w-5" />
                            <span>{{courses.reduce((sum, c) => sum + c.lessons_count, 0)}} bài học</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <Users class="h-5 w-5" />
                            <span>{{courses.reduce((sum, c) => sum + c.students_count, 0)}} học viên</span>
                        </div>
                    </div>
                </div>
                <div class="absolute right-0 top-0 h-full w-1/3 opacity-10">
                    <div class="absolute inset-0">
                        <GraduationCap class="h-64 w-64" />
                    </div>
                </div>
            </div>

            <!-- Courses Grid -->
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <Link v-for="course in courses" :key="course.id" :href="route('courses.show', course.slug)"
                    class="group block">
                    <GradientCard variant="border" hover
                        class="h-full transition-all duration-300 group-hover:shadow-2xl">
                        <!-- Enrolled Badge -->
                        <div v-if="course.is_enrolled" class="mb-3">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-primary/20 text-primary">
                                <CheckCircle2 class="h-3 w-3" />
                                Đã đăng ký
                            </span>
                        </div>

                        <!-- Course Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h2 class="text-2xl font-bold group-hover:text-primary transition-colors mb-2">
                                    {{ course.title }}
                                </h2>
                                <span :class="[
                                    'inline-block px-3 py-1 text-xs font-semibold rounded-full capitalize',
                                    levelColors[course.level as keyof typeof levelColors] || levelColors.beginner
                                ]">
                                    {{ levelLabels[course.level as keyof typeof levelLabels] || course.level }}
                                </span>
                            </div>
                        </div>

                        <!-- Course Description -->
                        <p class="text-sm text-muted-foreground line-clamp-3 mb-6">
                            {{ course.description }}
                        </p>

                        <!-- Course Stats -->
                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <div class="flex items-center gap-2 text-sm">
                                <div class="h-8 w-8 rounded-lg bg-primary/10 flex items-center justify-center">
                                    <BookOpen class="h-4 w-4 text-primary" />
                                </div>
                                <div>
                                    <div class="font-semibold">{{ course.modules_count }}</div>
                                    <div class="text-xs text-muted-foreground">Modules</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <div class="h-8 w-8 rounded-lg bg-secondary/10 flex items-center justify-center">
                                    <GraduationCap class="h-4 w-4 text-secondary" />
                                </div>
                                <div>
                                    <div class="font-semibold">{{ course.lessons_count }}</div>
                                    <div class="text-xs text-muted-foreground">Bài học</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <div class="h-8 w-8 rounded-lg bg-accent/10 flex items-center justify-center">
                                    <Clock class="h-4 w-4 text-accent" />
                                </div>
                                <div>
                                    <div class="font-semibold">{{ Math.round(course.estimated_hours) }}h</div>
                                    <div class="text-xs text-muted-foreground">Thời lượng</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <div class="h-8 w-8 rounded-lg bg-primary/10 flex items-center justify-center">
                                    <Users class="h-4 w-4 text-primary" />
                                </div>
                                <div>
                                    <div class="font-semibold">{{ course.students_count }}</div>
                                    <div class="text-xs text-muted-foreground">Học viên</div>
                                </div>
                            </div>
                        </div>

                        <!-- Hover Indicator -->
                        <div class="pt-4 border-t border-border">
                            <div
                                class="flex items-center justify-between text-primary group-hover:translate-x-1 transition-transform">
                                <span class="text-sm font-medium">
                                    {{ course.is_enrolled ? 'Tiếp tục học' : 'Bắt đầu học' }}
                                </span>
                                <span>→</span>
                            </div>
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
