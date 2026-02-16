<script setup lang="ts">
import { computed } from 'vue';
import { cn } from '@/lib/utils';
import { Loader2 } from 'lucide-vue-next';

type Props = {
  variant?: 'primary' | 'secondary' | 'ghost' | 'outline';
  size?: 'sm' | 'md' | 'lg';
  loading?: boolean;
  disabled?: boolean;
  class?: string;
};

const props = withDefaults(defineProps<Props>(), {
  variant: 'primary',
  size: 'md',
  loading: false,
  disabled: false,
});

const buttonClasses = computed(() => {
  const base = 'inline-flex items-center justify-center gap-2 rounded-lg font-medium transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed';

  const variants = {
    primary: 'gradient-primary text-white hover:shadow-lg hover:scale-105 active:scale-95',
    secondary: 'gradient-secondary text-white hover:shadow-lg hover:scale-105 active:scale-95',
    ghost: 'bg-transparent hover:bg-accent/10 text-foreground',
    outline: 'border-2 border-primary text-primary hover:bg-primary hover:text-white',
  };

  const sizes = {
    sm: 'px-3 py-1.5 text-sm',
    md: 'px-6 py-2.5 text-base',
    lg: 'px-8 py-3.5 text-lg',
  };

  return cn(base, variants[props.variant], sizes[props.size], props.class);
});
</script>

<template>
  <button :class="buttonClasses" :disabled="disabled || loading">
    <Loader2 v-if="loading" class="h-4 w-4 animate-spin" />
    <slot />
  </button>
</template>
