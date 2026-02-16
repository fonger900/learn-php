<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { dashboard } from '@/routes';
import StatCard from '@/components/ui/StatCard.vue';
import ProgressRing from '@/components/ui/ProgressRing.vue';
import GradientCard from '@/components/ui/GradientCard.vue';
import { BookOpen, GraduationCap, Trophy, TrendingUp } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

// Mock data - in real app this would come from props
const stats = {
    coursesEnrolled: 5,
    lessonsCompleted: 24,
    totalHours: 12.5,
    achievements: 8,
};

const recentActivity = [
    { lesson: 'Introduction to Laravel', course: 'Laravel Fundamentals', completed: true, time: '2 hours ago' },
    { lesson: 'Database Migrations', course: 'Laravel Fundamentals', completed: true, time: '5 hours ago' },
    { lesson: 'Eloquent Relationships', course: 'Advanced Laravel', completed: false, time: 'In progress' },
];
</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 p-6">
            <!-- Welcome Section -->
            <div class="relative overflow-hidden rounded-2xl gradient-full p-8 text-white">
                <div class="relative z-10">
                    <h1 class="text-3xl font-bold mb-2">Welcome back! 👋</h1>
                    <p class="text-white/90">Continue your learning journey and achieve your goals.</p>
                </div>
                <div class="absolute right-0 top-0 h-full w-1/3 opacity-20">
                    <div class="absolute inset-0 animate-float">
                        <GraduationCap class="h-48 w-48" />
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                <StatCard title="Courses Enrolled" :value="stats.coursesEnrolled" :icon="BookOpen" trend="up"
                    trend-value="+2 this month" gradient="primary" />
                <StatCard title="Lessons Completed" :value="stats.lessonsCompleted" :icon="GraduationCap" trend="up"
                    trend-value="+12 this week" gradient="secondary" />
                <StatCard title="Learning Hours" :value="`${stats.totalHours}h`" :icon="TrendingUp" trend="up"
                    trend-value="+3.5h this week" gradient="accent" />
                <StatCard title="Achievements" :value="stats.achievements" :icon="Trophy" trend="neutral"
                    trend-value="2 pending" gradient="primary" />
            </div>

            <!-- Main Content Grid -->
            <div class="grid gap-6 lg:grid-cols-3">
                <!-- Progress Overview -->
                <GradientCard variant="border" class="lg:col-span-2">
                    <h2 class="text-xl font-bold mb-6">Recent Activity</h2>
                    <div class="space-y-4">
                        <div v-for="(activity, index) in recentActivity" :key="index"
                            class="flex items-center gap-4 p-4 rounded-lg bg-muted/30 hover:bg-muted/50 transition-colors">
                            <div class="flex-shrink-0">
                                <div :class="[
                                    'h-10 w-10 rounded-full flex items-center justify-center',
                                    activity.completed ? 'bg-green-500/20 text-green-500' : 'bg-primary/20 text-primary'
                                ]">
                                    <GraduationCap class="h-5 w-5" />
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium truncate">{{ activity.lesson }}</p>
                                <p class="text-sm text-muted-foreground">{{ activity.course }}</p>
                            </div>
                            <div class="flex-shrink-0 text-sm text-muted-foreground">
                                {{ activity.time }}
                            </div>
                        </div>
                    </div>
                </GradientCard>

                <!-- Course Progress -->
                <GradientCard variant="border">
                    <h2 class="text-xl font-bold mb-6">Overall Progress</h2>
                    <div class="flex flex-col items-center justify-center py-8">
                        <ProgressRing :value="68" size="lg" color="primary" />
                        <p class="mt-6 text-center text-sm text-muted-foreground">
                            You've completed 68% of your enrolled courses
                        </p>
                    </div>
                    <div class="mt-6 space-y-3">
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span>Laravel Fundamentals</span>
                                <span class="text-muted-foreground">85%</span>
                            </div>
                            <div class="h-2 bg-muted rounded-full overflow-hidden">
                                <div class="h-full gradient-primary rounded-full" style="width: 85%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span>Advanced Laravel</span>
                                <span class="text-muted-foreground">45%</span>
                            </div>
                            <div class="h-2 bg-muted rounded-full overflow-hidden">
                                <div class="h-full gradient-secondary rounded-full" style="width: 45%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span>Vue.js Mastery</span>
                                <span class="text-muted-foreground">20%</span>
                            </div>
                            <div class="h-2 bg-muted rounded-full overflow-hidden">
                                <div class="h-full gradient-full rounded-full" style="width: 20%"></div>
                            </div>
                        </div>
                    </div>
                </GradientCard>
            </div>
        </div>
    </AppLayout>
</template>
