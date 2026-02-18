<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { BookOpen, ChevronRight, PlayCircle, Clock, GraduationCap, BarChart } from 'lucide-vue-next';
import AnimatedButton from '@/components/ui/AnimatedButton.vue';
import GradientCard from '@/components/ui/GradientCard.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

const props = defineProps<{
    course: {
        id: number;
        title: string;
        slug: string;
        description: string;
        level: string;
        total_lessons: number;
        estimated_hours: number;
        is_enrolled: boolean;
        completed_lessons: number;
        progress: number;
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
        <div class="bg-background/50 min-h-full">
            <!-- Course Hero -->
            <div class="relative overflow-hidden border-b border-border bg-card/30">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-secondary/5 -z-10"></div>
                <div class="max-w-5xl mx-auto px-6 py-12 lg:py-20">
                    <div class="flex flex-col lg:flex-row gap-12 items-center">
                        <div class="flex-1 space-y-6">
                            <div class="flex items-center gap-3">
                                <span
                                    class="px-3 py-1 text-xs font-bold bg-primary/10 text-primary rounded-full uppercase tracking-wider">
                                    {{ course.level }}
                                </span>
                                <div class="flex items-center gap-1 text-xs font-medium text-muted-foreground">
                                    <BookOpen class="h-3.5 w-3.5" />
                                    <span>{{ course.total_lessons }} Lessons</span>
                                </div>
                            </div>

                            <h1 class="text-4xl lg:text-6xl font-extrabold tracking-tight leading-tight">
                                {{ course.title }}
                            </h1>

                            <p class="text-xl text-muted-foreground leading-relaxed max-w-2xl">
                                {{ course.description }}
                            </p>

                            <div class="flex flex-wrap gap-4 pt-4">
                                <AnimatedButton v-if="course.modules.length > 0 && course.modules[0].lessons.length > 0"
                                    :as="Link"
                                    :href="route('lessons.show', [course.slug, course.modules[0].lessons[0].slug])"
                                    variant="primary" size="lg" class="min-w-[200px]">
                                    <PlayCircle class="h-5 w-5" />
                                    {{ course.is_enrolled ? 'Tiếp tục học' : 'Bắt đầu học' }}
                                </AnimatedButton>
                            </div>
                        </div>

                        <!-- Course Stats Card -->
                        <div class="w-full lg:w-80 shrink-0">
                            <GradientCard variant="border" glow class="p-6 space-y-6 bg-background/80 backdrop-blur-xl">
                                <h4 class="font-bold text-lg border-b border-border pb-4">Tổng quan khóa học</h4>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between text-sm">
                                        <div class="flex items-center gap-2 text-muted-foreground">
                                            <Clock class="h-4 w-4" />
                                            <span>Thời lượng</span>
                                        </div>
                                        <span class="font-semibold">~{{ course.estimated_hours }} giờ</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <div class="flex items-center gap-2 text-muted-foreground">
                                            <BarChart class="h-4 w-4" />
                                            <span>Cấp độ</span>
                                        </div>
                                        <span class="font-semibold capitalize">{{ course.level }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <div class="flex items-center gap-2 text-muted-foreground">
                                            <BookOpen class="h-4 w-4" />
                                            <span>Bài học</span>
                                        </div>
                                        <span class="font-semibold">{{ course.total_lessons }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <div class="flex items-center gap-2 text-muted-foreground">
                                            <GraduationCap class="h-4 w-4" />
                                            <span>Chứng chỉ</span>
                                        </div>
                                        <span class="font-semibold text-green-500">Có</span>
                                    </div>
                                    <div v-if="course.is_enrolled" class="pt-4 border-t border-border">
                                        <div class="space-y-2">
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="text-muted-foreground">Tiến độ</span>
                                                <span class="font-semibold">{{ course.progress }}%</span>
                                            </div>
                                            <div class="h-2 bg-muted rounded-full overflow-hidden">
                                                <div class="h-full bg-gradient-to-r from-primary to-secondary transition-all duration-300"
                                                    :style="{ width: `${course.progress}%` }"></div>
                                            </div>
                                            <p class="text-xs text-muted-foreground">
                                                {{ course.completed_lessons }} / {{ course.total_lessons }} bài học hoàn
                                                thành
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </GradientCard>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Syllabus Section -->
            <div class="max-w-5xl mx-auto px-6 py-16">
                <div class="mb-10 space-y-2">
                    <h2 class="text-3xl font-extrabold tracking-tight">Nội dung khóa học</h2>
                    <p class="text-muted-foreground">Chương trình học toàn diện được thiết kế để thành thạo.</p>
                </div>

                <div class="space-y-10">
                    <div v-for="(module, index) in course.modules" :key="module.id" class="space-y-4">
                        <div class="flex items-center gap-4">
                            <div
                                class="h-10 w-10 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-lg">
                                {{ index + 1 }}
                            </div>
                            <h3 class="text-2xl font-bold tracking-tight">{{ module.title }}</h3>
                        </div>

                        <div class="grid gap-3 pl-14">
                            <Link v-for="lesson in module.lessons" :key="lesson.id"
                                :href="route('lessons.show', [course.slug, lesson.slug])"
                                class="group flex items-center justify-between p-5 bg-card border border-border/50 rounded-2xl hover:border-primary/50 hover:shadow-md transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="h-10 w-10 rounded-xl bg-muted flex items-center justify-center group-hover:bg-primary/10 transition-colors">
                                        <PlayCircle
                                            class="h-5 w-5 text-muted-foreground group-hover:text-primary transition-colors" />
                                    </div>
                                    <span class="font-semibold text-lg group-hover:text-primary transition-colors">
                                        {{ lesson.title }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span
                                        class="text-sm font-medium text-muted-foreground opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-1">
                                        Bắt đầu
                                        <ChevronRight class="h-4 w-4" />
                                    </span>
                                </div>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
