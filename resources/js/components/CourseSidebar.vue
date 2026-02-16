<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { CheckCircle2, ChevronDown, ChevronRight, PlayCircle, BookOpen } from 'lucide-vue-next';
import { ref, computed } from 'vue';
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '@/components/ui/collapsible';

interface Lesson {
    id: number;
    title: string;
    slug: string;
    pivot?: { completed_at: string };
}

interface Module {
    id: number;
    title: string;
    lessons: Lesson[];
}

const props = defineProps<{
    course: {
        title: string;
        slug: string;
    };
    currentLessonId: number;
    modules: Module[];
}>();

// Track which modules are open. Default to the module containing the current lesson.
const openModules = ref<number[]>(
    props.modules
        .filter(m => m.lessons.some(l => l.id === props.currentLessonId))
        .map(m => m.id)
);

const toggleModule = (moduleId: number) => {
    if (openModules.value.includes(moduleId)) {
        openModules.value = openModules.value.filter(id => id !== moduleId);
    } else {
        openModules.value.push(moduleId);
    }
};

const getModuleProgress = (module: Module) => {
    if (!module.lessons.length) return 0;
    const completed = module.lessons.filter(l => l.pivot?.completed_at).length;
    return Math.round((completed / module.lessons.length) * 100);
};

const totalProgress = computed(() => {
    const allLessons = props.modules.flatMap(m => m.lessons);
    if (!allLessons.length) return 0;
    const completed = allLessons.filter(l => l.pivot?.completed_at).length;
    return Math.round((completed / allLessons.length) * 100);
});
</script>

<template>
    <div class="flex flex-col h-full bg-background border-r border-border">
        <!-- Course Header & Progress -->
        <div class="p-6 border-b border-border bg-muted/30">
            <div class="flex items-center gap-3 mb-4">
                <div class="h-10 w-10 rounded-xl gradient-primary flex items-center justify-center text-white shadow-lg">
                    <BookOpen class="h-5 w-5" />
                </div>
                <h3 class="font-bold text-lg leading-tight line-clamp-2">{{ course.title }}</h3>
            </div>
            
            <div class="space-y-2">
                <div class="flex justify-between text-xs font-bold uppercase tracking-wider text-muted-foreground">
                    <span>Course Progress</span>
                    <span>{{ totalProgress }}%</span>
                </div>
                <div class="h-2 bg-muted rounded-full overflow-hidden">
                    <div class="h-full gradient-primary rounded-full transition-all duration-700 ease-out"
                        :style="{ width: `${totalProgress}%` }">
                    </div>
                </div>
            </div>
        </div>

        <!-- Modules List -->
        <div class="flex-1 overflow-y-auto py-4 custom-scrollbar">
            <div v-for="(module, index) in modules" :key="module.id" class="mb-2">
                <Collapsible :open="openModules.includes(module.id)" @update:open="toggleModule(module.id)">
                    <CollapsibleTrigger class="w-full text-left">
                        <div class="flex items-center justify-between px-6 py-3 hover:bg-muted/50 transition-colors group">
                            <div class="flex flex-col gap-1 min-w-0">
                                <span class="text-[10px] font-bold uppercase tracking-[0.1em] text-muted-foreground group-hover:text-primary transition-colors">
                                    Module {{ index + 1 }}
                                </span>
                                <h4 class="font-bold text-sm truncate pr-4 group-hover:text-foreground transition-colors">
                                    {{ module.title }}
                                </h4>
                            </div>
                            <div class="flex items-center gap-3 shrink-0">
                                <div v-if="getModuleProgress(module) === 100" class="text-green-500">
                                    <CheckCircle2 class="h-4 w-4" />
                                </div>
                                <span v-else class="text-[10px] font-bold text-muted-foreground bg-muted px-1.5 py-0.5 rounded">
                                    {{ getModuleProgress(module) }}%
                                </span>
                                <ChevronDown 
                                    class="h-4 w-4 text-muted-foreground transition-transform duration-200"
                                    :class="{ 'rotate-180': openModules.includes(module.id) }" 
                                />
                            </div>
                        </div>
                    </CollapsibleTrigger>

                    <CollapsibleContent class="px-3 pb-2 space-y-1 overflow-hidden transition-all data-[state=closed]:animate-collapsible-up data-[state=open]:animate-collapsible-down">
                        <li v-for="l in module.lessons" :key="l.id" class="list-none">
                            <Link :href="route('lessons.show', [course.slug, l.slug])"
                                class="group flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm transition-all duration-200"
                                :class="{
                                    'bg-primary/10 text-primary font-semibold shadow-sm': l.id === currentLessonId,
                                    'text-muted-foreground hover:bg-muted hover:text-foreground': l.id !== currentLessonId
                                }">
                                <!-- Status Icon -->
                                <div class="shrink-0">
                                    <CheckCircle2 v-if="l.pivot?.completed_at"
                                        class="h-4 w-4 text-green-500" />
                                    <PlayCircle v-else-if="l.id === currentLessonId"
                                        class="h-4 w-4 animate-pulse" />
                                    <div v-else class="h-4 w-4 rounded-full border-2 border-muted-foreground/20 group-hover:border-primary/50 transition-colors" />
                                </div>
                                
                                <span class="flex-1 truncate leading-tight">{{ l.title }}</span>
                                
                                <ChevronRight v-if="l.id === currentLessonId" class="h-3 w-3 shrink-0 opacity-50" />
                            </Link>
                        </li>
                    </CollapsibleContent>
                </Collapsible>
            </div>
        </div>
    </div>
</template>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
    width: 4px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: hsl(var(--muted));
    border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: hsl(var(--muted-foreground) / 0.3);
}
</style>
