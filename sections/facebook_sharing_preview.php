<?php

$og_image_thumb = [
    'width'   => 1200,
    'height'  => 630,
    'quality' => 80,
    'crop'    => true
];

return [
    'props' => [
        'headline' => function ($headline = 'Facebook Sharing Preview') {
            return $headline;
        }
    ],
    'computed' => [
        'page' => function() use ($og_image_thumb) {
            $page = $this->model();
            $img = $page->og_image()->toFile();

            return [
                'title' => $page->title()->value(),
                'og_title' => $page->og_title()->value(),
                'og_image' => $img ? $img->thumb($og_image_thumb)->url() : null,
                'og_description' => $page->og_description()->value(),
                'og_site_name' => $page->og_site_name()->value(),
                'meta_title' => $page->meta_title()->value(),
                'meta_description' => $page->meta_description()->value(),
            ];
        },
        'site' => function() use ($og_image_thumb) {
            $site = $this->kirby()->site();
            $img = $site->og_image()->toFile();

            return [
                'og_title' => $site->og_title()->value(),
                'og_image' => $img ? $img->thumb($og_image_thumb)->url() : null,
                'og_site_name' => $site->og_site_name()->value(),
                'meta_title' => $site->meta_title()->value(),
                'meta_description' => $site->meta_description()->value(),
            ];
        },
    ],
];
