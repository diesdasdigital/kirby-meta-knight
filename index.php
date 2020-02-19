<?php

Kirby::plugin('diesdasdigital/kirby-seo', [
    'sections' => [
        'google_search_preview' => require_once __DIR__ . '/sections/google_search_preview.php',
        'facebook_sharing_preview' => require_once __DIR__ . '/sections/facebook_sharing_preview.php',
        'twitter_card_preview' => require_once __DIR__ . '/sections/twitter_card_preview.php'
    ],
    'blueprints' => [
        'seo' => __DIR__ . '/blueprints/seo.yml'
    ]
]);
