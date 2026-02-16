<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { BookOpen, GraduationCap, Trophy, TrendingUp } from 'lucide-vue-next';
import GradientCard from '@/components/ui/GradientCard.vue';
import ProgressRing from '@/components/ui/ProgressRing.vue';
import StatCard from '@/components/ui/StatCard.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

interface Stats {
    coursesEnrolled: number;
    lessonsCompleted: number;
    totalHours: number;
    achievements: number;
}

interface Activity {
    lesson: string;
    course: string;
    completed: boolean;
    time: string;
}

interface CourseProgress {
    title: string;
    percent: number;
}

const props = defineProps<{
    stats: Stats;
    recentActivity: Activity[];
    coursesProgress: CourseProgress[];
    totalCompletion: number;
}>();
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
                <StatCard title="Courses Enrolled" :value="props.stats.coursesEnrolled" :icon="BookOpen" trend="up"
                    trend-value="+2 this month" gradient="primary" />
                <StatCard title="Lessons Completed" :value="props.stats.lessonsCompleted" :icon="GraduationCap" trend="up"
                    trend-value="+12 this week" gradient="secondary" />
                <StatCard title="Learning Hours" :value="`${props.stats.totalHours}h`" :icon="TrendingUp" trend="up"
                    trend-value="+3.5h this week" gradient="accent" />
                <StatCard title="Achievements" :value="props.stats.achievements" :icon="Trophy" trend="neutral"
                    trend-value="2 pending" gradient="primary" />
            </div>

            <!-- Main Content Grid -->
            <div class="grid gap-6 lg:grid-cols-3">
                <!-- Progress Overview -->
                <GradientCard variant="border" class="lg:col-span-2">
                    <h2 class="text-xl font-bold mb-6">Recent Activity</h2>
                    <div class="space-y-4">
                        <div v-for="(activity, index) in props.recentActivity" :key="index"
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
                        <ProgressRing :value="props.totalCompletion" size="lg" color="primary" />
                        <p class="mt-6 text-center text-sm text-muted-foreground">
                            You've completed {{ props.totalCompletion }}% of your enrolled courses
                        </p>
                    </div>
                    <div class="mt-6 space-y-3">
                        <div v-for="(course, index) in props.coursesProgress" :key="index">
                            <div class="flex justify-between text-sm mb-1">
                                <span>{{ course.title }}</span>
                                <span class="text-muted-foreground">{{ course.percent }}%</span>
                            </div>
                            <div class="h-2 bg-muted rounded-full overflow-hidden">
                                <div class="h-full rounded-full"
                                    :class="index % 3 === 0 ? 'gradient-primary' : (index % 3 === 1 ? 'gradient-secondary' : 'gradient-full')"
                                    :style="{ width: `${course.percent}%` }"></div>
                            </div>
                        </div>
                    </div>
                </GradientCard>
            </div>
        </div>
    </AppLayout>
</template>
