<script setup lang="ts">
import { computed } from 'vue';

type Props = {
  value: number;
  max?: number;
  size?: 'sm' | 'md' | 'lg';
  showPercentage?: boolean;
  color?: 'primary' | 'secondary' | 'accent';
};

const props = withDefaults(defineProps<Props>(), {
  max: 100,
  size: 'md',
  showPercentage: true,
  color: 'primary',
});

const percentage = computed(() => Math.min((props.value / props.max) * 100, 100));

const sizes = {
  sm: { ring: 60, stroke: 4, text: 'text-sm' },
  md: { ring: 100, stroke: 6, text: 'text-lg' },
  lg: { ring: 140, stroke: 8, text: 'text-2xl' },
};

const colors = {
  primary: 'hsl(239 84% 67%)',
  secondary: 'hsl(271 91% 65%)',
  accent: 'hsl(189 94% 43%)',
};

const ringSize = sizes[props.size].ring;
const strokeWidth = sizes[props.size].stroke;
const radius = (ringSize - strokeWidth) / 2;
const circumference = radius * 2 * Math.PI;
const offset = computed(() => circumference - (percentage.value / 100) * circumference);
</script>

<template>
  <div class="relative inline-flex items-center justify-center">
    <svg :width="ringSize" :height="ringSize" class="transform -rotate-90">
      <!-- Background circle -->
      <circle :cx="ringSize / 2" :cy="ringSize / 2" :r="radius" :stroke-width="strokeWidth" stroke="currentColor"
        fill="none" class="text-muted/20" />
      <!-- Progress circle -->
      <circle :cx="ringSize / 2" :cy="ringSize / 2" :r="radius" :stroke-width="strokeWidth" :stroke="colors[color]"
        fill="none" :stroke-dasharray="circumference" :stroke-dashoffset="offset" stroke-linecap="round"
        class="transition-all duration-1000 ease-out" />
    </svg>
    <div v-if="showPercentage" class="absolute inset-0 flex items-center justify-center">
      <span :class="['font-bold', sizes[size].text]">
        {{ Math.round(percentage) }}%
      </span>
    </div>
  </div>
</template>
