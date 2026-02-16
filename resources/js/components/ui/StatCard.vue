<script setup lang="ts">
import { computed, ref, onMounted } from 'vue';
import type { LucideIcon } from 'lucide-vue-next';
import { cn } from '@/lib/utils';

type Props = {
  title: string;
  value: number | string;
  icon?: LucideIcon;
  trend?: 'up' | 'down' | 'neutral';
  trendValue?: string;
  gradient?: 'primary' | 'secondary' | 'accent';
  class?: string;
};

const props = withDefaults(defineProps<Props>(), {
  trend: 'neutral',
  gradient: 'primary',
});

const displayValue = ref(0);

const gradients = {
  primary: 'from-[hsl(239,84%,67%)] to-[hsl(271,91%,65%)]',
  secondary: 'from-[hsl(271,91%,65%)] to-[hsl(189,94%,43%)]',
  accent: 'from-[hsl(189,94%,43%)] to-[hsl(239,84%,67%)]',
};

const trendColors = {
  up: 'text-green-500',
  down: 'text-red-500',
  neutral: 'text-muted-foreground',
};

const trendIcons = {
  up: '↑',
  down: '↓',
  neutral: '→',
};

// Animate number counting
onMounted(() => {
  if (typeof props.value === 'number') {
    const duration = 1000;
    const steps = 60;
    const increment = props.value / steps;
    let current = 0;

    const timer = setInterval(() => {
      current += increment;
      if (current >= props.value) {
        displayValue.value = props.value;
        clearInterval(timer);
      } else {
        displayValue.value = Math.floor(current);
      }
    }, duration / steps);
  }
});

const formattedValue = computed(() => {
  return typeof props.value === 'number' ? displayValue.value : props.value;
});
</script>

<template>
  <div :class="cn(
    'relative overflow-hidden rounded-xl border border-border bg-card p-6 transition-all duration-300 hover:shadow-lg hover:scale-[1.02]',
    props.class
  )">
    <!-- Gradient background -->
    <div :class="[
      'absolute inset-0 bg-gradient-to-br opacity-5',
      gradients[gradient]
    ]" />

    <div class="relative z-10">
      <div class="flex items-start justify-between">
        <div class="flex-1">
          <p class="text-sm font-medium text-muted-foreground">{{ title }}</p>
          <h3 class="mt-2 text-3xl font-bold">{{ formattedValue }}</h3>
          <p v-if="trendValue" :class="['mt-2 text-sm flex items-center gap-1', trendColors[trend]]">
            <span>{{ trendIcons[trend] }}</span>
            <span>{{ trendValue }}</span>
          </p>
        </div>
        <component v-if="icon" :is="icon"
          :class="['h-10 w-10 opacity-80', `text-[${gradients[gradient].split(' ')[0].replace('from-', '')}]`]" />
      </div>
    </div>
  </div>
</template>
