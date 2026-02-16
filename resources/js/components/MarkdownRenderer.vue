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
        let html = md.render(props.content);
        // Wrap tables in a responsive container
        html = html.replace(/<table>/g, '<div class="table-wrapper"><table>');
        html = html.replace(/<\/table>/g, '</table></div>');
        renderedContent.value = html;
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
    padding: 1.25rem;
    border-radius: 0.75rem;
    overflow-x: auto;
    margin-bottom: 1.5rem;
    border: 1px solid rgba(255, 255, 255, 0.1);
}
.markdown-content code {
    font-family: 'Fira Code', ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-size: 0.9em;
}
.markdown-content p {
    margin-bottom: 1.25rem;
    line-height: 1.7;
}
.markdown-content h1 {
    font-size: 2.25rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    letter-spacing: -0.025em;
}
.markdown-content h2 {
    font-size: 1.75rem;
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--border);
}
.markdown-content h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-top: 1.75rem;
    margin-bottom: 0.75rem;
}
.markdown-content ul, .markdown-content ol {
    margin-bottom: 1.25rem;
    padding-left: 1.5rem;
}
.markdown-content ul {
    list-style-type: disc;
}
.markdown-content ol {
    list-style-type: decimal;
}
.markdown-content li {
    margin-bottom: 0.5rem;
}

/* Professional Table Styles */
.markdown-content .table-wrapper {
    width: 100%;
    overflow-x: auto;
    margin-bottom: 2rem;
    border-radius: 0.75rem;
    border: 1px solid var(--border);
    box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1);
}

.markdown-content table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.95rem;
    text-align: left;
}

.markdown-content thead {
    background-color: var(--muted);
}

.markdown-content th {
    padding: 0.75rem 1rem;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.05em;
    color: var(--muted-foreground);
    border-bottom: 1px solid var(--border);
}

.markdown-content td {
    padding: 1rem;
    border-bottom: 1px solid var(--border);
    vertical-align: middle;
}

.markdown-content tr:last-child td {
    border-bottom: none;
}

.markdown-content tr:nth-child(even) {
    background-color: rgba(var(--muted), 0.3);
}

.markdown-content tr:hover td {
    background-color: var(--muted);
    transition: background-color 0.2s ease;
}

.markdown-content blockquote {
    border-left: 4px solid var(--primary);
    padding: 1rem 1.5rem;
    margin: 1.5rem 0;
    background-color: var(--muted);
    border-radius: 0 0.5rem 0.5rem 0;
    font-style: italic;
    color: var(--muted-foreground);
}

.markdown-content hr {
    margin: 2.5rem 0;
    border: 0;
    border-top: 1px solid var(--border);
}
</style>
