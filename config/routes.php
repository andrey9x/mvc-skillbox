<?php

use App\Http\HomeController;

return [
    '/' => fn() => 'routes works from routes.php',
    '/controller' => [new HomeController(), 'index'],
];