<script setup lang="ts">
import MarkdownIt from 'markdown-it';
import { createHighlighter } from 'shiki';
import { ref, onMounted, watch } from 'vue';

const props = defineProps<{
    content: string;
}>();

const renderedContent = ref('');

onMounted(async () => {
    const highlighter = await createHighlighter({
        themes: ['github-dark', 'github-light'],
        langs: ['php', 'html', 'css', 'javascript', 'json', 'bash'],
    });

    const md = new MarkdownIt({
        html: true,
        highlight: (code, lang) => {
            if (lang && highlighter.getLoadedLanguages().includes(lang)) {
                return highlighter.codeToHtml(code, { lang, theme: 'github-dark' });
            }
            return highlighter.codeToHtml(code, { lang: 'text', theme: 'github-dark' });
        },
    });

    const render = () => {
        renderedContent.value = md.render(props.content);
    };

    watch(() => props.content, render, { immediate: true });
});
</script>

<template>
    <div class="markdown-content" v-html="renderedContent"></div>
</template>

<style>
.markdown-content pre {
    background-color: #24292e !important; /* GitHub Dark background */
    padding: 1rem;
    border-radius: 0.5rem;
    overflow-x: auto;
}
.markdown-content code {
    font-family: 'Fira Code', monospace;
}
.markdown-content p {
    margin-bottom: 1rem;
}
.markdown-content h2 {
    font-size: 1.5rem;
    font-weight: bold;
    margin-top: 1.5rem;
    margin-bottom: 0.5rem;
}
.markdown-content h3 {
    font-size: 1.25rem;
    font-weight: bold;
    margin-top: 1.25rem;
    margin-bottom: 0.5rem;
}
.markdown-content ul {
    list-style-type: disc;
    padding-left: 1.5rem;
    margin-bottom: 1rem;
}
</style>
