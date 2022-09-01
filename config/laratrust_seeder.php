<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'roles' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'questions' => 'c,r,u,d',
            'categories-post' => 'c,r,u,d',
            'posts' => 'c,r,u,d',
            'comments' => 'c,r,u,d',
            'playlist-categories'=> 'c,r,u,d',
            'profiles' => 'u,d'

        ],
        'admin' => [],
        'teacher' => [],
        'student' => [],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
