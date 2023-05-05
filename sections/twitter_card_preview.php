<?php

$twitter_image_thumb = [
    'width'   => 1200,
    'height'  => 675,
    'quality' => 80,
    'crop'    => true
];

return [
    'props' => [
        'headline' => function ($headline = 'Twitter Card Preview') {
            return $headline;
        }
    ],
    'computed' => [
        'page' => function() use ($twitter_image_thumb) {
            $page = $this->model();
            $img = $page->twitter_image()->toFile();

            return [
                'url' => $page->url(),
                'title' => $page->title()->value(),
                'twitter_title' => $page->twitter_title()->value(),
                'twitter_image' => $img ? $img->thumb($twitter_image_thumb)->url() : null,
                'twitter_description' => $page->twitter_description()->value(),
                'twitter_card_type' => $page->twitter_card_type()->value(),
                'meta_title' => $page->meta_title()->value(),
                'meta_description' => $page->meta_description()->value(),
            ];
        },
        'site' => function() use ($twitter_image_thumb) {
            $site = $this->kirby()->site();
            $img = $site->twitter_image()->toFile();

            return [
                'twitter_title' => $site->twitter_title()->value(),
                'twitter_image' => $img ? $img->thumb($twitter_image_thumb)->url() : null,
                'twitter_card_type' => $site->twitter_card_type()->value(),
                'meta_title' => $site->meta_title()->value(),
                'meta_description' => $site->meta_description()->value(),
            ];
        },
    ],
];
