<?php

function modifyArticleContent(string $content): string
{
    $replacements = [
        '<h2>' => '<h2 class="text-4xl font-bold mb-4 mt-6">',
        '</h2>' => '</h2>',
        '<h3>' => '<h3 class="text-2xl font-semibold mb-2 mt-4">',
        '</h3>' => '</h3>',
        '<strong>' => '<strong class="font-bold">',
        '</strong>' => '</strong>',
        '<em>' => '<em class="italic">',
        '</em>' => '</em>',
        '<u>' => '<u class="underline">',
        '</u>' => '</u>',
        '<s>' => '<s class="line-through">',
        '</s>' => '</s>',
        '<ul>' => '<ul class="list-disc pl-6 my-4">',
        '<ol>' => '<ol class="list-decimal pl-6 my-4">',
        '<li>' => '<li class="mb-2">',
        '<blockquote>' => '<blockquote class="border-l-4 pl-4 italic text-gray-600 my-4">',
        '</blockquote>' => '</blockquote>',
        '<code>' => '<code class="bg-gray-100 px-1 py-0.5 rounded text-sm text-pink-600 font-mono">',
        '</code>' => '</code>',
        '<pre>' => '<pre class="bg-gray-100 p-4 rounded overflow-x-auto text-sm text-gray-800 font-mono">',
        '</pre>' => '</pre>',
        '<a ' => '<a class="text-blue-600 underline hover:text-blue-800" ',
    ];

    return str_replace(array_keys($replacements), array_values($replacements), $content);
}
