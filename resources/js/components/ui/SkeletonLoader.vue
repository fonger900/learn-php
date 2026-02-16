<script setup lang="ts">
import { computed } from 'vue';
import { cn } from '@/lib/utils';

type Props = {
  variant?: 'text' | 'circle' | 'rect' | 'card';
  width?: string;
  height?: string;
  class?: string;
};

const props = withDefaults(defineProps<Props>(), {
  variant: 'text',
  width: '100%',
  height: '1rem',
});

const skeletonClasses = computed(() => {
  const base = 'animate-shimmer bg-gradient-to-r from-muted via-muted-foreground/20 to-muted bg-[length:1000px_100%]';

  const variants = {
    text: 'h-4 rounded',
    circle: 'rounded-full',
    rect: 'rounded-lg',
    card: 'h-32 rounded-xl',
  };

  return cn(base, variants[props.variant], props.class);
});

const style = computed(() => ({
  width: props.width,
  height: props.variant === 'text' || props.variant === 'rect' ? props.height : props.width,
}));
</script>

<template>
  <div :class="skeletonClasses" :style="style" />
</template>
