<?php

return [
  "routes" => [
    "web" => [
      "prefix" => "lyra",
      "name" => "lyra.",
    ],
    "api" => [
      "prefix" => "lyra-api",
      "name" => "lyra-api."
    ]
  ],

  /*
  |--------------------------------------------------------------------------
  | Path to the Lyra Assets
  |--------------------------------------------------------------------------
  */
  'assets_path' => '/vendor/sertxudeveloper/lyra/assets',

  /*
  |--------------------------------------------------------------------------
  | Title and description of the Lyra Panel
  |--------------------------------------------------------------------------
  */
  "admin" => [
    "title" => "Lyra Panel",
    "description" => "Bootstrap your app and turn ideas into reality"
  ],

  /*
  |--------------------------------------------------------------------------
  | Specify the authenticator driver to use in the login
  |
  | If you select the basic driver, the user will be authenticated using the default Laravel authenticator driver.
  | With this driver, all the user will be blocked except those ones specified in the config file.
  | Besides the notifications functionality should be added manually to the User model.
  |
  | If you select the Lyra driver, the user will be authenticated using the Lyra provider and the Lyra guard.
  | With this driver, only the user registered in Lyra will be able to log in and access.
  | Besides the Lyra driver require its own user table in the database, so it won't work until you run the migration.
  | In addition, the notifications functionality will require another table to work.
  |
  | Supported: "basic", "lyra"
  |--------------------------------------------------------------------------
  */
  'authenticator' => 'basic',

  /*
   * Enable or disable the notificator system
   */
  'notificator' => false,

  /*
  |--------------------------------------------------------------------------
  | Lyra menu
  |
  | The keys "lyra" and "media" keys cannot be removed or modified,
  | if this is done it is possible for Lyra to stop working properly
  | as they are part of the core. Do it at your own risk.
  |--------------------------------------------------------------------------
  */
  "menu" => [
    [
      "name" => "Dashboard",
      "key" => "lyra",
      "icon" => "fas fa-home",
    ],
    [
      "name" => "Media Manager",
      "key" => "media",
      "icon" => "fas fa-photo-video"
    ],
    /* Add your own resources here */
  ],

  /*
  |--------------------------------------------------------------------------
  | Lyra widgets
  |--------------------------------------------------------------------------
  */
  "widgets" => [
    "row" => [
      "SertxuDeveloper\Lyra\Http\Widgets\UserWidget",
    ]
  ]
];
