<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session"
    |
    */

    'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users', // For regular users
    ],
    'admin' => [
        'driver' => 'session',
        'provider' => 'admins', // Use the same provider but handle filtering elsewhere
    ],
    'dokter' => [
        'driver' => 'session',
        'provider' => 'dokters', // Provider untuk dokter
        
    ],
],


    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],
    'admins' => [  // Add this provider for admins
        'driver' => 'eloquent',
        'model' => App\Models\User::class, // Use the User model but filter by role
        'filter' => function($query): mixed {
            return $query->where('role_id', 1); // Misalnya role_id 1 untuk admin
        },
    ], // Corrected the placement of the closing bracket and removed the unnecessary semicolon
    
    'dokters' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class, // Or App\Models\Dokter::class if using a Dokter model
    ],
],



    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

  

    'password_timeout' => 10800,

];
