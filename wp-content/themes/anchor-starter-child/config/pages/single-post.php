<?php
/**
 * Page config: single-post
 */
return [
    'sections' => [
        [
            'type' => 'hero',
            'props' => [
                'eyebrow' => 'Welcome to Our Blog',
                'heading' => 'Latest Insights and Updates',
                'text' => 'Stay updated with our latest posts',
                'image' => 'blog_hero',
            ],
        ],
        [
            'type' => 'text_block',
            'props' => [
                'heading' => 'Blog Article Title',
                'text' => 'This is the main content of the blog post. Here you\'ll find detailed information about the topic discussed in this post, including insights, tips, and news pertinent to our audience. We aim to provide valuable content that enhances understanding and engagement.',
                'align' => 'left',
                'max_width' => '4xl',
            ],
        ],
        [
            'type' => 'text_block',
            'props' => [
                'heading' => 'Additional Information',
                'text' => 'This section is added for testing purposes. It provides readers with further details, resources, or updates related to the blog post. Our goal is to ensure that every post is comprehensive, informative, and beneficial for our readers.',
                'align' => 'left',
                'max_width' => '4xl',
            ],
        ],
    ],
];
