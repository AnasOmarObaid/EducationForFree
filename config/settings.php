<?php

return [
    /*
	|--------------------------------------------------------------------------
	| Default Settings Store
	|--------------------------------------------------------------------------
	|
	| This option controls the default settings store that gets used while
	| using this settings library.
	|
	| Supported: "json", "database"
	|
	*/
    'store' => 'json',

    /*
	|--------------------------------------------------------------------------
	| JSON Store
	|--------------------------------------------------------------------------
	|
	| If the store is set to "json", settings are stored in the defined
	| file path in JSON format. Use full path to file.
	|
	*/
    'path' => storage_path() . '/settings.json',

    /*
	|--------------------------------------------------------------------------
	| Database Store
	|--------------------------------------------------------------------------
	|
	| The settings are stored in the defined file path in JSON format.
	| Use full path to JSON file.
	|
	*/
    // If set to null, the default connection will be used.
    'connection' => null,
    // Name of the table used.
    'table' => 'settings',
    // If you want to use custom column names in database store you could
    // set them in this configuration
    'keyColumn' => 'key',
    'valueColumn' => 'value',

    /*
    |--------------------------------------------------------------------------
    | Cache settings
    |--------------------------------------------------------------------------
    |
    | If you want all setting calls to go through Laravel's cache system.
    |
    */
    'enableCache' => true,
    // Whether to reset the cache when changing a setting.
    'forgetCacheByWrite' => true,
    // TTL in seconds.
    'cacheTtl' => 15,

    /*
    |--------------------------------------------------------------------------
    | Default Settings
    |--------------------------------------------------------------------------
    |
    | Define all default settings that will be used before any settings are set,
    | this avoids all settings being set to false to begin with and avoids
    | hardcoding the same defaults in all 'Settings::get()' calls
    |
    */
    'defaults' => [
        'system_name' => 'EducationForFree',
        'system_version'  => '1.0.0',
        'facebook_link' => 'https://www.facebook.com/profile.php?id=educationforfree',
        'twitter_link' => 'https://twitter.com/educationforfree',
        'linkedin_link' => 'https://www.linkedin.com/in/educationforfree/',
        'email_link' => 'info@educationforfree.online',
        'email_password' => 'ao(123456)',
        'system_content'   =>   ' the development is the process of creating technology-based education. The term was originally used to define automated learning systems that allowed students to learn on their own time at their own speed via a computer. The term that proceeded Education4F was, in fact, computer-based training.',
        'system_phone'  => '+002 059-8548-436',
        'system_url'    => 'educationforfree.online',
        'system_activation' => 1,
        'system_post_create' => 1,
        'system_comment_post_create'    => 1,
        'system_series_create' => 1,
        'system_comment_series_create'  => 1,
        'system_user_register'  => 1,
        'system_notification'   => 1,
    ]
];
