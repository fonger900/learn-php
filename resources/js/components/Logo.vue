<script setup>
defineProps({
  class: {
    type: String,
    default: 'h-8 w-8',
  },
})
</script>

<template>
  <svg
    :class="class"
    viewBox="0 0 200 200"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
  >
    <defs>
      <linearGradient id="logoGradient" x1="0%" y1="0%" x2="100%" y2="100%">
        <stop offset="0%" style="stop-color: #3b82f6; stop-opacity: 1" />
        <stop offset="100%" style="stop-color: #8b5cf6; stop-opacity: 1" />
      </linearGradient>
    </defs>

    <circle cx="100" cy="100" r="90" fill="url(#logoGradient)" opacity="0.1" />
    <path
      d="M100 30 L160 80 L160 140 L100 170 L40 140 L40 80 Z"
      fill="url(#logoGradient)"
      stroke="url(#logoGradient)"
      stroke-width="2"
    />
    <circle cx="100" cy="100" r="25" fill="white" />
  </svg>
</template>
