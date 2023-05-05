<?php

return [
    'props' => [
        'headline' => function ($headline = 'Google Search Preview') {
            return $headline;
        }
    ],
    'computed' => [
        'page' => function() {
            $page = $this->model();
        
            return [
                'url' => $page->url(),
                'title' => $page->title()->value(),
                'meta_title' => $page->meta_title()->value(),
                'meta_description' => $page->meta_description()->value(),
                'isHomePage' => $page->isHomePage(),
            ];
        },
        'site' => function() {
            $site = $this->kirby()->site();
        
            return [
                'meta_title' => $site->meta_title()->value(),
                'meta_description' => $site->meta_description()->value(),
            ];
        },
        'options' => function() {
            return [
                'pageTitleAsHomePageTitle' => option('diesdasdigital.meta-knight.pageTitleAsHomePageTitle', false),
                'siteTitleAsHomePageTitle' => option('diesdasdigital.meta-knight.siteTitleAsHomePageTitle', false),
                'siteTitleAfterPageTitle' => option('diesdasdigital.meta-knight.siteTitleAfterPageTitle', true),
                'separator' => option('diesdasdigital.meta-knight.separator', ' - '),
            ];
        },
    ],
];
