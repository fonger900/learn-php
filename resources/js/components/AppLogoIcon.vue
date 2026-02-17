<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

type Props = {
    className?: HTMLAttributes['class'];
};

defineProps<Props>();
</script>

<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 200 200"
        :class="className"
        v-bind="$attrs"
    >
        <defs>
            <linearGradient id="logoGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color: currentColor; stop-opacity: 0.9" />
                <stop offset="100%" style="stop-color: currentColor; stop-opacity: 1" />
            </linearGradient>
        </defs>
        <circle cx="100" cy="100" r="90" fill="currentColor" opacity="0.1" />
        <path
            d="M100 30 L160 80 L160 140 L100 170 L40 140 L40 80 Z"
            fill="url(#logoGradient)"
            stroke="currentColor"
            stroke-width="2"
        />
        <circle cx="100" cy="100" r="25" fill="currentColor" opacity="0.2" />
    </svg>
</template>
