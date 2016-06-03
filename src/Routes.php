<?php

return [
    ['GET', '/', ['App\Controllers\Home', 'show']],
//    ['GET', '/', ['App\Controllers\Homepage', 'show']],
    ['GET', '/welcome', ['App\Controllers\Welcome', 'show']],
    ['GET', '/{slug}', ['App\Controllers\Page', 'show']],
];