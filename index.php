<?php

Kirby::plugin('diesdasdigital/kirby-seo', [
    'sections' => [
        'basic_meta' => require_once __DIR__ . '/sections/basic_meta.php'
    ]
]);
