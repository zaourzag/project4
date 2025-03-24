<?php

use App\Models\Product;

return [
	  // Other Scout configuration...

    'meilisearch' => [
        'host' => env('MEILISEARCH_HOST', 'https://edge.meilisearch.com'),
        'key' => env('MEILISEARCH_KEY'),
        'index-settings' => [
            Product::class => [
                'sortableAttributes' => ['naam', 'prijs'],
            ],
        ],
    ],
];
