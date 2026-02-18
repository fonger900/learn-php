<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { BookOpen, Code2, GraduationCap, Rocket, Sparkles, Trophy, Zap, Star, CheckCircle, ArrowRight } from 'lucide-vue-next';
import Logo from '@/components/Logo.vue';
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
        title: 'Khóa học Toàn diện',
        description: 'Học từ các khóa học được biên soạn kỹ lưỡng bao gồm Laravel, Vue.js và phát triển web hiện đại.',
    },
    {
        icon: Code2,
        title: 'Dự án Thực tế',
        description: 'Xây dựng các ứng dụng thực tế và củng cố kỹ năng với các bài tập thực hành.',
    },
    {
        icon: Trophy,
        title: 'Theo dõi Tiến độ',
        description: 'Theo dõi hành trình học tập của bạn với hệ thống ghi nhận tiến độ chi tiết và thành tích.',
    },
    {
        icon: Zap,
        title: 'Học theo Tốc độ của Bạn',
        description: 'Học bất cứ khi nào và bất cứ đâu với quyền truy cập trọn đời vào tất cả nội dung.',
    },
];

const testimonials = [
    {
        name: 'Sarah Johnson',
        role: 'Lập trình viên Full Stack',
        content: 'Khoản đầu tư tốt nhất cho sự nghiệp của tôi. Các khóa học Laravel cực kỳ chi tiết và thực tế.',
        avatar: 'https://i.pravatar.cc/150?u=sarah',
    },
    {
        name: 'Michael Chen',
        role: 'Kỹ sư Frontend',
        content: 'Cuối cùng tôi cũng hiểu Composition API của Vue.js nhờ các khóa học này. Rất đáng học!',
        avatar: 'https://i.pravatar.cc/150?u=michael',
    },
    {
        name: 'Emily Davis',
        role: 'Freelancer',
        content: 'Từ con số 0 đến chuyên gia. Tôi đã xây dựng sản phẩm SaaS đầu tiên sau khi hoàn thành khóa masterclass.',
        avatar: 'https://i.pravatar.cc/150?u=emily',
    },
];

const faqs = [
    {
        question: 'Tôi có được truy cập trọn đời không?',
        answer: 'Có! Một khi bạn đăng ký khóa học, bạn sẽ có quyền truy cập trọn đời vào nội dung và các bản cập nhật trong tương lai.',
    },
    {
        question: 'Khóa học có phù hợp cho người mới bắt đầu?',
        answer: 'Hoàn toàn phù hợp. Chúng tôi có các khóa học từ cơ bản đến nâng cao về cấu trúc kiến trúc.',
    },
    {
        question: 'Có chính sách hoàn tiền không?',
        answer: 'Có, chúng tôi hoàn tiền trong vòng 30 ngày nếu bạn không hài lòng.',
    },
    {
        question: 'Tôi có thể tải video xuống không?',
        answer: 'Có, tất cả bài giảng video đều có thể tải xuống để bạn học ngoại tuyến.',
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
                    <Logo class="h-8 w-8 text-primary" />
                    <span class="text-xl font-bold tracking-tight">HocPHP</span>
                </div>

                <nav class="flex items-center gap-6">
                    <Link :href="route('courses.index')"
                        class="text-sm font-medium hover:text-primary transition-colors hidden sm:block">
                        Khóa học
                    </Link>
                    <div class="h-4 w-px bg-border hidden sm:block"></div>
                    <Link v-if="$page.props.auth.user" :href="dashboard()"
                        class="text-sm font-medium hover:text-primary transition-colors">
                        Bảng điều khiển
                    </Link>
                    <template v-else>
                        <Link :href="login()" class="text-sm font-medium hover:text-primary transition-colors">
                            Đăng nhập
                        </Link>
                        <AnimatedButton v-if="canRegister" :as="Link" :href="register()" variant="primary" size="sm">
                            Bắt đầu ngay
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
                        <div
                            class="inline-flex items-center gap-2 rounded-full glass px-4 py-2 text-sm mx-auto lg:mx-0">
                            <Sparkles class="h-4 w-4 text-primary" />
                            <span class="font-medium">Bắt đầu hành trình học tập ngay hôm nay</span>
                        </div>

                        <h1 class="text-5xl font-extrabold leading-tight lg:text-7xl tracking-tight">
                            Chinh phục
                            <span class="gradient-full bg-clip-text text-transparent">Lập trình Web Hiện đại</span>
                        </h1>

                        <p class="text-lg text-muted-foreground max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                            Học Laravel, Vue.js và các công nghệ web tiên tiến qua các khóa học thực chiến từ chuyên
                            gia. Nâng
                            tầm sự nghiệp của bạn ngay hôm nay.
                        </p>

                        <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                            <AnimatedButton v-if="!$page.props.auth.user" :as="Link" :href="register()"
                                variant="primary" size="lg" class="shadow-lg shadow-primary/20">
                                <Rocket class="h-5 w-5" />
                                Học Thử Miễn Phí
                            </AnimatedButton>
                            <AnimatedButton v-else :as="Link"
                                :href="route('lessons.show', ['nhap-mon-php', 'php-la-gi'])" variant="primary" size="lg"
                                class="shadow-lg shadow-primary/20">
                                Tiếp tục học
                            </AnimatedButton>
                            <AnimatedButton :as="Link" :href="route('courses.index')" variant="outline" size="lg">
                                <BookOpen class="h-5 w-5" />
                                Xem Khóa học
                            </AnimatedButton>
                        </div>

                        <div
                            class="flex items-center justify-center lg:justify-start gap-8 pt-4 border-t border-border/50 lg:border-none mt-8 lg:mt-0">
                            <div>
                                <div class="text-3xl font-bold gradient-primary bg-clip-text text-transparent">10K+
                                </div>
                                <div class="text-sm text-muted-foreground font-medium">Học viên</div>
                            </div>
                            <div>
                                <div class="text-3xl font-bold gradient-secondary bg-clip-text text-transparent">50+
                                </div>
                                <div class="text-sm text-muted-foreground font-medium">Khóa học</div>
                            </div>
                            <div>
                                <div class="text-3xl font-bold gradient-full bg-clip-text text-transparent">4.9/5</div>
                                <div class="text-sm text-muted-foreground font-medium">Đánh giá</div>
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
                                                <div class="font-bold text-lg">Laravel Cơ bản</div>
                                                <div class="text-sm text-muted-foreground">12 bài • 8h 30m</div>
                                            </div>
                                        </div>
                                        <div
                                            class="px-3 py-1 rounded-full bg-green-500/10 text-green-500 text-xs font-bold uppercase tracking-wider">
                                            Đang học</div>
                                    </div>

                                    <div class="space-y-2">
                                        <div class="flex justify-between text-sm font-medium">
                                            <span>Tiến độ</span>
                                            <span>65%</span>
                                        </div>
                                        <div class="h-3 bg-muted rounded-full overflow-hidden">
                                            <div class="h-full gradient-primary rounded-full relative"
                                                style="width: 65%">
                                                <div class="absolute inset-0 bg-white/20 animate-[shimmer_2s_infinite]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="pt-4 border-t border-border/50 flex items-center justify-between text-sm">
                                        <span class="text-muted-foreground">Bài tiếp theo: </span>
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
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Tại sao chọn HocPHP?</h2>
                    <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                        Mọi thứ bạn cần để trở thành lập trình viên web chuyên nghiệp, tất cả ở một nơi.
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
                        <h2 class="text-3xl font-bold tracking-tight">Khóa học Nổi bật</h2>
                        <p class="text-muted-foreground">Bắt đầu với các lộ trình học phổ biến nhất của chúng tôi.</p>
                    </div>
                    <Link :href="route('courses.index')"
                        class="text-primary hover:text-primary/80 font-medium flex items-center gap-1 group">
                        Xem Tất cả
                        <ArrowRight class="h-4 w-4 transition-transform group-hover:translate-x-1" />
                    </Link>
                </div>

                <div class="grid gap-8 md:grid-cols-3">
                    <GradientCard v-for="course in courses" :key="course.id" variant="border" hover
                        class="flex flex-col h-full overflow-hidden group">
                        <!-- Placeholder Image Area -->
                        <div class="aspect-video w-full bg-muted relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-primary/20 to-secondary/20 group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div
                                class="absolute bottom-4 left-4 bg-background/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-foreground">
                                {{ course.level }}
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold mb-2 group-hover:text-primary transition-colors line-clamp-1">
                                {{
                                    course.title }}</h3>
                            <p class="text-muted-foreground text-sm line-clamp-2 mb-6 flex-grow">{{ course.description
                                }}</p>

                            <div class="mt-auto pt-4 border-t border-border/50 flex items-center justify-between">
                                <div class="flex items-center gap-1 text-sm text-yellow-500">
                                    <Star class="h-4 w-4 fill-current" />
                                    <span class="font-bold text-foreground">4.8</span>
                                    <span class="text-muted-foreground">(120)</span>
                                </div>
                                <span class="font-bold text-primary">Bắt đầu học</span>
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
                    <h2 class="text-3xl font-bold tracking-tight mb-4">Học viên nói gì về chúng tôi</h2>
                    <p class="text-lg text-muted-foreground">Gia nhập cộng đồng hàng ngàn lập trình viên hài lòng.</p>
                </div>

                <div class="grid gap-8 md:grid-cols-3">
                    <div v-for="(testimonial, index) in testimonials" :key="index" class="relative">
                        <div
                            class="bg-background rounded-2xl p-8 shadow-sm border border-border/50 hover:border-primary/50 transition-colors duration-300">
                            <!-- Quote Icon -->
                            <div class="absolute -top-4 -left-2 text-6xl text-primary/10 font-serif">"</div>

                            <div class="relative z-10">
                                <p class="text-muted-foreground mb-6 italic">"{{ testimonial.content }}"</p>
                                <div class="flex items-center gap-4">
                                    <div class="h-10 w-10 rounded-full bg-muted overflow-hidden">
                                        <!-- Placeholder avatar since external images might break or be blocked -->
                                        <div
                                            class="h-full w-full bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center text-xs font-bold text-primary">
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
                    <h2 class="text-3xl font-bold tracking-tight mb-4">Câu hỏi Thường gặp</h2>
                </div>

                <div class="space-y-4">
                    <div v-for="(faq, index) in faqs" :key="index"
                        class="border border-border rounded-xl p-6 bg-card/50">
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
                        <h2 class="text-4xl font-bold tracking-tight lg:text-5xl">Sẵn sàng Nâng trình?</h2>
                        <p class="text-lg text-white/90 max-w-2xl mx-auto leading-relaxed">
                            Tham gia cộng đồng lập trình viên đang làm chủ kỹ năng với HocPHP.
                            Bắt đầu học thử ngay hôm nay và khai phá tiềm năng vô hạn.
                        </p>
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                            <AnimatedButton v-if="!$page.props.auth.user" :as="Link" :href="register()"
                                variant="outline" size="lg"
                                class="bg-white text-primary hover:bg-white/90 border-white min-w-[200px]">
                                <Rocket class="h-5 w-5" />
                                Bắt đầu Ngay
                            </AnimatedButton>
                            <AnimatedButton v-else :as="Link"
                                :href="route('lessons.show', ['nhap-mon-php', 'php-la-gi'])" variant="outline" size="lg"
                                class="bg-white text-primary hover:bg-white/90 border-white min-w-[200px]">
                                Tiếp tục học
                            </AnimatedButton>
                            <span class="text-sm text-white/70 block sm:hidden">Không cần thẻ tín dụng</span>
                        </div>
                        <p class="text-sm text-white/60 hidden sm:block">Không cần thẻ tín dụng • Hủy bất cứ lúc nào</p>
                    </div>

                    <!-- Background Decor -->
                    <div class="absolute inset-0 z-0">
                        <div
                            class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-64 h-64 bg-black/10 rounded-full blur-3xl transform -translate-x-1/2 translate-y-1/2">
                        </div>
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
                            <Logo class="h-6 w-6 text-primary" />
                            <span class="font-bold text-xl">HocPHP</span>
                        </div>
                        <p class="text-muted-foreground max-w-xs">
                            Trao quyền cho lập trình viên xây dựng tương lai với các công cụ hiện đại và sự hướng dẫn
                            chuyên
                            sâu.
                        </p>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-4">Nền tảng</h4>
                        <ul class="space-y-2 text-sm text-muted-foreground">
                            <li>
                                <Link :href="route('courses.index')" class="hover:text-primary">Khóa học</Link>
                            </li>
                            <li><a href="#" class="hover:text-primary">Cố vấn</a></li>
                            <li><a href="#" class="hover:text-primary">Bảng giá</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-4">Công ty</h4>
                        <ul class="space-y-2 text-sm text-muted-foreground">
                            <li><a href="#" class="hover:text-primary">Về chúng tôi</a></li>
                            <li><a href="#" class="hover:text-primary">Tuyển dụng</a></li>
                            <li><a href="#" class="hover:text-primary">Blog</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-border pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-muted-foreground">
                        © 2026 HocPHP. Bảo lưu mọi quyền.
                    </div>
                    <div class="flex gap-6">
                        <a href="#" class="text-muted-foreground hover:text-primary"><span
                                class="sr-only">Twitter</span><svg class="h-5 w-5" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg></a>
                        <a href="#" class="text-muted-foreground hover:text-primary"><span
                                class="sr-only">GitHub</span><svg class="h-5 w-5" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                    clip-rule="evenodd" />
                            </svg></a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>
