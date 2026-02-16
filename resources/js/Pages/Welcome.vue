<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard, login, register } from '@/routes';
import GradientCard from '@/components/ui/GradientCard.vue';
import AnimatedButton from '@/components/ui/AnimatedButton.vue';
import { BookOpen, Code2, GraduationCap, Rocket, Sparkles, Trophy, Zap } from 'lucide-vue-next';

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);

const features = [
    {
        icon: BookOpen,
        title: 'Comprehensive Courses',
        description: 'Learn from expertly crafted courses covering Laravel, Vue.js, and modern web development.',
    },
    {
        icon: Code2,
        title: 'Hands-on Projects',
        description: 'Build real-world applications and strengthen your skills with practical exercises.',
    },
    {
        icon: Trophy,
        title: 'Track Your Progress',
        description: 'Monitor your learning journey with detailed progress tracking and achievements.',
    },
    {
        icon: Zap,
        title: 'Learn at Your Pace',
        description: 'Study whenever and wherever you want with lifetime access to all content.',
    },
];
</script>

<template>

    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <div class="min-h-screen bg-background">
        <!-- Navigation -->
        <header class="glass sticky top-0 z-50 border-b border-border/50">
            <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-6">
                <div class="flex items-center gap-2">
                    <GraduationCap class="h-8 w-8 text-primary" />
                    <span class="text-xl font-bold">LearnHub</span>
                </div>

                <nav class="flex items-center gap-4">
                    <Link v-if="$page.props.auth.user" :href="dashboard()"
                        class="text-sm font-medium hover:text-primary transition-colors">
                        Dashboard
                    </Link>
                    <template v-else>
                        <Link :href="login()" class="text-sm font-medium hover:text-primary transition-colors">
                            Log in
                        </Link>
                        <AnimatedButton v-if="canRegister" :as="Link" :href="register()" variant="primary" size="sm">
                            Get Started
                        </AnimatedButton>
                    </template>
                </nav>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="relative overflow-hidden py-20 lg:py-32">
            <!-- Animated Background -->
            <div class="absolute inset-0 -z-10">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/5 via-secondary/5 to-accent/5"></div>
                <div class="absolute top-1/4 left-1/4 h-96 w-96 rounded-full bg-primary/10 blur-3xl animate-float">
                </div>
                <div class="absolute bottom-1/4 right-1/4 h-96 w-96 rounded-full bg-secondary/10 blur-3xl animate-float"
                    style="animation-delay: 2s;"></div>
            </div>

            <div class="mx-auto max-w-7xl px-6">
                <div class="grid gap-12 lg:grid-cols-2 lg:gap-16 items-center">
                    <!-- Hero Content -->
                    <div class="space-y-8">
                        <div class="inline-flex items-center gap-2 rounded-full glass px-4 py-2 text-sm">
                            <Sparkles class="h-4 w-4 text-primary" />
                            <span>Start your learning journey today</span>
                        </div>

                        <h1 class="text-5xl font-bold leading-tight lg:text-6xl">
                            Master Modern
                            <span class="gradient-full bg-clip-text text-transparent"> Web Development</span>
                        </h1>

                        <p class="text-lg text-muted-foreground">
                            Learn Laravel, Vue.js, and cutting-edge web technologies through hands-on courses designed
                            by
                            industry experts.
                        </p>

                        <div class="flex flex-wrap gap-4">
                            <AnimatedButton v-if="!$page.props.auth.user" :as="Link" :href="register()"
                                variant="primary" size="lg">
                                <Rocket class="h-5 w-5" />
                                Start Learning Free
                            </AnimatedButton>
                            <AnimatedButton v-else :as="Link" :href="dashboard()" variant="primary" size="lg">
                                Go to Dashboard
                            </AnimatedButton>
                            <AnimatedButton variant="outline" size="lg">
                                <BookOpen class="h-5 w-5" />
                                Browse Courses
                            </AnimatedButton>
                        </div>

                        <div class="flex items-center gap-8 pt-4">
                            <div>
                                <div class="text-3xl font-bold gradient-primary bg-clip-text text-transparent">10K+
                                </div>
                                <div class="text-sm text-muted-foreground">Students</div>
                            </div>
                            <div>
                                <div class="text-3xl font-bold gradient-secondary bg-clip-text text-transparent">50+
                                </div>
                                <div class="text-sm text-muted-foreground">Courses</div>
                            </div>
                            <div>
                                <div class="text-3xl font-bold gradient-full bg-clip-text text-transparent">4.9/5</div>
                                <div class="text-sm text-muted-foreground">Rating</div>
                            </div>
                        </div>
                    </div>

                    <!-- Hero Visual -->
                    <div class="relative">
                        <div class="relative z-10">
                            <GradientCard variant="border" glow class="p-8">
                                <div class="space-y-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-12 w-12 rounded-lg gradient-primary flex items-center justify-center">
                                            <Code2 class="h-6 w-6 text-white" />
                                        </div>
                                        <div>
                                            <div class="font-semibold">Laravel Fundamentals</div>
                                            <div class="text-sm text-muted-foreground">12 lessons • 8h 30m</div>
                                        </div>
                                    </div>
                                    <div class="h-2 bg-muted rounded-full overflow-hidden">
                                        <div class="h-full gradient-primary rounded-full" style="width: 65%"></div>
                                    </div>
                                    <div class="text-sm text-muted-foreground">65% Complete</div>
                                </div>
                            </GradientCard>
                        </div>
                        <div
                            class="absolute -top-4 -right-4 h-32 w-32 rounded-full gradient-secondary opacity-20 blur-2xl">
                        </div>
                        <div
                            class="absolute -bottom-4 -left-4 h-32 w-32 rounded-full gradient-full opacity-20 blur-2xl">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-20 bg-muted/30">
            <div class="mx-auto max-w-7xl px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold mb-4">Why Choose LearnHub?</h2>
                    <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                        Everything you need to become a proficient web developer
                    </p>
                </div>

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                    <GradientCard v-for="(feature, index) in features" :key="index" variant="border" hover
                        class="text-center">
                        <div
                            class="mb-4 inline-flex h-16 w-16 items-center justify-center rounded-2xl gradient-primary">
                            <component :is="feature.icon" class="h-8 w-8 text-white" />
                        </div>
                        <h3 class="text-lg font-semibold mb-2">{{ feature.title }}</h3>
                        <p class="text-sm text-muted-foreground">{{ feature.description }}</p>
                    </GradientCard>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20">
            <div class="mx-auto max-w-7xl px-6">
                <GradientCard variant="full" class="text-center text-white p-12 lg:p-16">
                    <h2 class="text-3xl font-bold mb-4 lg:text-4xl">Ready to Start Learning?</h2>
                    <p class="text-lg text-white/90 mb-8 max-w-2xl mx-auto">
                        Join thousands of students already learning with LearnHub. Start your journey today!
                    </p>
                    <AnimatedButton v-if="!$page.props.auth.user" :as="Link" :href="register()" variant="outline"
                        size="lg" class="bg-white text-primary hover:bg-white/90 border-white">
                        <Rocket class="h-5 w-5" />
                        Get Started Now
                    </AnimatedButton>
                    <AnimatedButton v-else :as="Link" :href="dashboard()" variant="outline" size="lg"
                        class="bg-white text-primary hover:bg-white/90 border-white">
                        Continue Learning
                    </AnimatedButton>
                </GradientCard>
            </div>
        </section>

        <!-- Footer -->
        <footer class="border-t border-border py-12">
            <div class="mx-auto max-w-7xl px-6">
                <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                    <div class="flex items-center gap-2">
                        <GraduationCap class="h-6 w-6 text-primary" />
                        <span class="font-semibold">LearnHub</span>
                    </div>
                    <div class="text-sm text-muted-foreground">
                        © 2026 LearnHub. Built with Laravel & Vue.js
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>
