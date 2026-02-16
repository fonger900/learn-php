<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { BookOpen, Code2, GraduationCap, Rocket, Sparkles, Trophy, Zap, Star, CheckCircle } from 'lucide-vue-next';
import AnimatedButton from '@/components/ui/AnimatedButton.vue';
import GradientCard from '@/components/ui/GradientCard.vue';
import { dashboard, login, register } from '@/routes';

interface Course {
    id: number;
    title: string;
    slug: string;
    description: string;
    level: string;
}

withDefaults(
    defineProps<{
        canRegister: boolean;
        courses?: Course[];
    }>(),
    {
        canRegister: true,
        courses: () => [],
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

const testimonials = [
    {
        name: 'Sarah Johnson',
        role: 'Full Stack Developer',
        content: 'The best investment I made for my career. The Laravel courses are incredibly detailed and practical.',
        avatar: 'https://i.pravatar.cc/150?u=sarah',
    },
    {
        name: 'Michael Chen',
        role: 'Frontend Engineer',
        content: 'I finally understand Vue.js composition API thanks to these courses. Highly recommended!',
        avatar: 'https://i.pravatar.cc/150?u=michael',
    },
    {
        name: 'Emily Davis',
        role: 'Freelancer',
        content: 'From zero to hero. I built my first SaaS product after completing the masterclass.',
        avatar: 'https://i.pravatar.cc/150?u=emily',
    },
];

const faqs = [
    {
        question: 'Do I get lifetime access?',
        answer: 'Yes! Once you enroll in a course, you have lifetime access to the content and any future updates.',
    },
    {
        question: 'Is this suitable for beginners?',
        answer: 'Absolutely. We have courses ranging from absolute beginner to advanced architectural patterns.',
    },
    {
        question: 'Do you offer a money-back guarantee?',
        answer: 'Yes, we offer a 30-day money-back guarantee if you are not satisfied with your purchase.',
    },
    {
        question: 'Can I download the videos?',
        answer: 'Yes, all video lessons are available for download so you can learn offline.',
    },
];
</script>

<template>

    <Head title="Welcome" />

    <div class="min-h-screen bg-background font-sans text-foreground selection:bg-primary/20 selection:text-primary">
        <!-- Navigation -->
        <header class="glass sticky top-0 z-50 border-b border-border/50 backdrop-blur-md">
            <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-6">
                <div class="flex items-center gap-2">
                    <GraduationCap class="h-8 w-8 text-primary" />
                    <span class="text-xl font-bold tracking-tight">LearnHub</span>
                </div>

                <nav class="flex items-center gap-6">
                    <Link :href="route('courses.index')" class="text-sm font-medium hover:text-primary transition-colors hidden sm:block">
                        Courses
                    </Link>
                    <div class="h-4 w-px bg-border hidden sm:block"></div>
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
                <div class="absolute top-1/4 left-1/4 h-96 w-96 rounded-full bg-primary/10 blur-3xl animate-pulse">
                </div>
                <div class="absolute bottom-1/4 right-1/4 h-96 w-96 rounded-full bg-secondary/10 blur-3xl animate-pulse"
                    style="animation-delay: 2s;"></div>
            </div>

            <div class="mx-auto max-w-7xl px-6">
                <div class="grid gap-12 lg:grid-cols-2 lg:gap-16 items-center">
                    <!-- Hero Content -->
                    <div class="space-y-8 text-center lg:text-left">
                        <div class="inline-flex items-center gap-2 rounded-full glass px-4 py-2 text-sm mx-auto lg:mx-0">
                            <Sparkles class="h-4 w-4 text-primary" />
                            <span class="font-medium">Start your learning journey today</span>
                        </div>

                        <h1 class="text-5xl font-extrabold leading-tight lg:text-7xl tracking-tight">
                            Master Modern
                            <span class="gradient-full bg-clip-text text-transparent">Web Development</span>
                        </h1>

                        <p class="text-lg text-muted-foreground max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                            Learn Laravel, Vue.js, and cutting-edge web technologies through hands-on courses designed
                            by industry experts. Level up your career today.
                        </p>

                        <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                            <AnimatedButton v-if="!$page.props.auth.user" :as="Link" :href="register()"
                                variant="primary" size="lg" class="shadow-lg shadow-primary/20">
                                <Rocket class="h-5 w-5" />
                                Start Learning Free
                            </AnimatedButton>
                            <AnimatedButton v-else :as="Link" :href="dashboard()" variant="primary" size="lg" class="shadow-lg shadow-primary/20">
                                Go to Dashboard
                            </AnimatedButton>
                            <AnimatedButton :as="Link" :href="route('courses.index')" variant="outline" size="lg">
                                <BookOpen class="h-5 w-5" />
                                Browse Courses
                            </AnimatedButton>
                        </div>

                        <div class="flex items-center justify-center lg:justify-start gap-8 pt-4 border-t border-border/50 lg:border-none mt-8 lg:mt-0">
                            <div>
                                <div class="text-3xl font-bold gradient-primary bg-clip-text text-transparent">10K+
                                </div>
                                <div class="text-sm text-muted-foreground font-medium">Students</div>
                            </div>
                            <div>
                                <div class="text-3xl font-bold gradient-secondary bg-clip-text text-transparent">50+
                                </div>
                                <div class="text-sm text-muted-foreground font-medium">Courses</div>
                            </div>
                            <div>
                                <div class="text-3xl font-bold gradient-full bg-clip-text text-transparent">4.9/5</div>
                                <div class="text-sm text-muted-foreground font-medium">Rating</div>
                            </div>
                        </div>
                    </div>

                    <!-- Hero Visual -->
                    <div class="relative hidden lg:block">
                        <div class="relative z-10 transform hover:scale-[1.02] transition-transform duration-500">
                            <GradientCard variant="border" glow class="p-8 backdrop-blur-xl bg-background/80">
                                <div class="space-y-6">
                                    <div class="flex items-center justify-between">
                                         <div class="flex items-center gap-4">
                                            <div
                                                class="h-14 w-14 rounded-xl gradient-primary flex items-center justify-center shadow-lg">
                                                <Code2 class="h-7 w-7 text-white" />
                                            </div>
                                            <div>
                                                <div class="font-bold text-lg">Laravel Fundamentals</div>
                                                <div class="text-sm text-muted-foreground">12 lessons • 8h 30m</div>
                                            </div>
                                         </div>
                                         <div class="px-3 py-1 rounded-full bg-green-500/10 text-green-500 text-xs font-bold uppercase tracking-wider">Active</div>
                                    </div>
                                    
                                    <div class="space-y-2">
                                        <div class="flex justify-between text-sm font-medium">
                                            <span>Progress</span>
                                            <span>65%</span>
                                        </div>
                                        <div class="h-3 bg-muted rounded-full overflow-hidden">
                                            <div class="h-full gradient-primary rounded-full relative" style="width: 65%">
                                                <div class="absolute inset-0 bg-white/20 animate-[shimmer_2s_infinite]"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="pt-4 border-t border-border/50 flex items-center justify-between text-sm">
                                        <span class="text-muted-foreground">Next Lesson: </span>
                                        <span class="font-semibold text-primary">Routing & Controllers</span>
                                    </div>
                                </div>
                            </GradientCard>
                        </div>
                        <!-- Decorative Elements -->
                        <div
                            class="absolute -top-12 -right-12 h-64 w-64 rounded-full gradient-secondary opacity-20 blur-[100px]">
                        </div>
                        <div
                            class="absolute -bottom-12 -left-12 h-64 w-64 rounded-full gradient-full opacity-20 blur-[100px]">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-24 bg-muted/30 relative">
            <div class="mx-auto max-w-7xl px-6">
                <div class="text-center mb-16 space-y-4">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Why Choose LearnHub?</h2>
                    <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                        Everything you need to become a proficient web developer, all in one place.
                    </p>
                </div>

                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                    <GradientCard v-for="(feature, index) in features" :key="index" variant="border" hover
                        class="text-center p-6 h-full">
                        <div
                            class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl gradient-primary shadow-lg shadow-primary/20">
                            <component :is="feature.icon" class="h-7 w-7 text-white" />
                        </div>
                        <h3 class="text-xl font-semibold mb-3">{{ feature.title }}</h3>
                        <p class="text-muted-foreground leading-relaxed">{{ feature.description }}</p>
                    </GradientCard>
                </div>
            </div>
        </section>

        <!-- Featured Courses Section -->
        <section v-if="courses && courses.length > 0" class="py-24">
            <div class="mx-auto max-w-7xl px-6">
                <div class="flex items-center justify-between mb-12">
                     <div class="space-y-1">
                        <h2 class="text-3xl font-bold tracking-tight">Featured Courses</h2>
                        <p class="text-muted-foreground">Start with our most popular learning paths.</p>
                     </div>
                     <Link :href="route('courses.index')" class="text-primary hover:text-primary/80 font-medium flex items-center gap-1 group">
                        View All <ArrowRight class="h-4 w-4 transition-transform group-hover:translate-x-1" />
                     </Link>
                </div>

                <div class="grid gap-8 md:grid-cols-3">
                    <GradientCard v-for="course in courses" :key="course.id" variant="border" hover class="flex flex-col h-full overflow-hidden group">
                        <!-- Placeholder Image Area -->
                        <div class="aspect-video w-full bg-muted relative overflow-hidden">
                             <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-secondary/20 group-hover:scale-105 transition-transform duration-500"></div>
                             <div class="absolute bottom-4 left-4 bg-background/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-foreground">
                                {{ course.level }}
                             </div>
                        </div>
                        
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold mb-2 group-hover:text-primary transition-colors line-clamp-1">{{ course.title }}</h3>
                            <p class="text-muted-foreground text-sm line-clamp-2 mb-6 flex-grow">{{ course.description }}</p>
                            
                            <div class="mt-auto pt-4 border-t border-border/50 flex items-center justify-between">
                                <div class="flex items-center gap-1 text-sm text-yellow-500">
                                    <Star class="h-4 w-4 fill-current" />
                                    <span class="font-bold text-foreground">4.8</span>
                                    <span class="text-muted-foreground">(120)</span>
                                </div>
                                <span class="font-bold text-primary">Start Learning</span>
                            </div>
                        </div>
                        
                        <!-- Full card link -->
                        <Link :href="route('courses.show', course.slug)" class="absolute inset-0 z-10" />
                    </GradientCard>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-24 bg-muted/30">
            <div class="mx-auto max-w-7xl px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold tracking-tight mb-4">What Our Students Say</h2>
                    <p class="text-lg text-muted-foreground">Join thousands of satisfied developers.</p>
                </div>

                <div class="grid gap-8 md:grid-cols-3">
                    <div v-for="(testimonial, index) in testimonials" :key="index" class="relative">
                        <div class="bg-background rounded-2xl p-8 shadow-sm border border-border/50 hover:border-primary/50 transition-colors duration-300">
                            <!-- Quote Icon -->
                            <div class="absolute -top-4 -left-2 text-6xl text-primary/10 font-serif">"</div>
                            
                            <div class="relative z-10">
                                <p class="text-muted-foreground mb-6 italic">"{{ testimonial.content }}"</p>
                                <div class="flex items-center gap-4">
                                    <div class="h-10 w-10 rounded-full bg-muted overflow-hidden">
                                        <!-- Placeholder avatar since external images might break or be blocked -->
                                        <div class="h-full w-full bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center text-xs font-bold text-primary">
                                            {{ testimonial.name.charAt(0) }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-sm">{{ testimonial.name }}</div>
                                        <div class="text-xs text-muted-foreground">{{ testimonial.role }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-24">
            <div class="mx-auto max-w-3xl px-6">
                 <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold tracking-tight mb-4">Frequently Asked Questions</h2>
                </div>

                <div class="space-y-4">
                    <div v-for="(faq, index) in faqs" :key="index" class="border border-border rounded-xl p-6 bg-card/50">
                        <h3 class="font-semibold text-lg mb-2 flex items-center gap-2">
                            <CheckCircle class="h-5 w-5 text-primary" />
                            {{ faq.question }}
                        </h3>
                        <p class="text-muted-foreground ml-7">{{ faq.answer }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-24 px-6">
            <div class="mx-auto max-w-5xl">
                <GradientCard variant="full" class="text-center text-white p-12 lg:p-20 relative overflow-hidden">
                    <div class="relative z-10 space-y-8">
                        <h2 class="text-4xl font-bold tracking-tight lg:text-5xl">Ready to Level Up?</h2>
                        <p class="text-lg text-white/90 max-w-2xl mx-auto leading-relaxed">
                            Join the community of developers mastering their craft with LearnHub. 
                            Start your free trial today and unlock unlimited potential.
                        </p>
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                            <AnimatedButton v-if="!$page.props.auth.user" :as="Link" :href="register()" variant="outline"
                                size="lg" class="bg-white text-primary hover:bg-white/90 border-white min-w-[200px]">
                                <Rocket class="h-5 w-5" />
                                Get Started Now
                            </AnimatedButton>
                            <AnimatedButton v-else :as="Link" :href="dashboard()" variant="outline" size="lg"
                                class="bg-white text-primary hover:bg-white/90 border-white min-w-[200px]">
                                Continue Learning
                            </AnimatedButton>
                            <span class="text-sm text-white/70 block sm:hidden">No credit card required</span>
                        </div>
                        <p class="text-sm text-white/60 hidden sm:block">No credit card required • Cancel anytime</p>
                    </div>
                    
                    <!-- Background Decor -->
                    <div class="absolute inset-0 z-0">
                         <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
                         <div class="absolute bottom-0 left-0 w-64 h-64 bg-black/10 rounded-full blur-3xl transform -translate-x-1/2 translate-y-1/2"></div>
                    </div>
                </GradientCard>
            </div>
        </section>

        <!-- Footer -->
        <footer class="border-t border-border py-12 bg-muted/20">
            <div class="mx-auto max-w-7xl px-6">
                <div class="grid md:grid-cols-4 gap-8 mb-8">
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center gap-2 mb-4">
                            <GraduationCap class="h-6 w-6 text-primary" />
                            <span class="font-bold text-xl">LearnHub</span>
                        </div>
                        <p class="text-muted-foreground max-w-xs">
                            Empowering developers to build the future with modern tools and expert guidance.
                        </p>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-4">Platform</h4>
                        <ul class="space-y-2 text-sm text-muted-foreground">
                            <li><Link :href="route('courses.index')" class="hover:text-primary">Courses</Link></li>
                            <li><a href="#" class="hover:text-primary">Mentorship</a></li>
                            <li><a href="#" class="hover:text-primary">Pricing</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-4">Company</h4>
                        <ul class="space-y-2 text-sm text-muted-foreground">
                            <li><a href="#" class="hover:text-primary">About Us</a></li>
                            <li><a href="#" class="hover:text-primary">Careers</a></li>
                            <li><a href="#" class="hover:text-primary">Blog</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-border pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-muted-foreground">
                        © 2026 LearnHub. All rights reserved.
                    </div>
                    <div class="flex gap-6">
                         <a href="#" class="text-muted-foreground hover:text-primary"><span class="sr-only">Twitter</span><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg></a>
                         <a href="#" class="text-muted-foreground hover:text-primary"><span class="sr-only">GitHub</span><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg></a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>
