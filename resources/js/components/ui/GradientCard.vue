<script setup lang="ts">
import { computed } from 'vue';
import { cn } from '@/lib/utils';

type Props = {
  variant?: 'primary' | 'secondary' | 'full' | 'border';
  hover?: boolean;
  glow?: boolean;
  class?: string;
};

const props = withDefaults(defineProps<Props>(), {
  variant: 'primary',
  hover: false,
  glow: false,
});

const cardClasses = computed(() => {
  const base = 'rounded-xl p-6 transition-all duration-300';
  const variants = {
    primary: 'gradient-primary text-white',
    secondary: 'gradient-secondary text-white',
    full: 'gradient-full text-white',
    border: 'gradient-border bg-card',
  };
  const hoverEffect = props.hover ? 'hover:scale-[1.02] hover:shadow-xl' : '';
  const glowEffect = props.glow ? 'animate-glow' : '';

  return cn(base, variants[props.variant], hoverEffect, glowEffect, props.class);
});
</script>

<template>
  <div :class="cardClasses">
    <slot />
  </div>
</template>
