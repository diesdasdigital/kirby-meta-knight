<?php

return [
    'props' => [
        'headline' => function ($headline = 'Basic Meta') {
            return $headline;
        },
        'basicMeta' => function($basicMeta = []) {
          return $basicMeta;
        }
    ]
];
