<?php

return [
    ['GET', '/', ['Src\Controllers\Home', 'show']],
//    ['GET', '/', ['Src\Controllers\Homepage', 'show']],
    ['GET', '/welcome', ['Src\Controllers\Welcome', 'show']],
    ['POST', '/login', ['Src\Controllers\Welcome', 'login']],
    ['POST', '/signup', ['Src\Controllers\Welcome', 'signup']],
    ['GET', '/{slug}', ['Src\Controllers\Page', 'show']],
];