<?php

Kirby::plugin('diesdasdigital/kirby-seo', [
    "sections" => [
        "basic-meta" => require_once __DIR__ . "/sections/basic-meta.php"
    ]
]);
