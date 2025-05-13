<?php
return [
    'admin_email' => env('ADMIN_EMAIL'),
    'asset_version' => 1.0,
    'profile_image_url' => "/upload/profile/",
    'cms_page_url' => "/upload/pages/",
    'blog_url' => "/upload/blogs/",
    'assistance_url' => "/upload/assistance/",
    'temp_file_url' => "/upload/temp/",

    'default_country_code' => "+91",

    'user_status' => [
        0 => 'Pending',
        1 => 'Active',
        2 => 'Inactive',
    ],
];
