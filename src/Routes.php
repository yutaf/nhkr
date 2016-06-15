<?php

return [
//    ['GET', '/', ['Src\Controllers\Home', 'show']],
//    ['GET', '/', ['Src\Controllers\Homepage', 'show']],
    ['GET', '/', ['Src\Controllers\Welcome', 'show']],
    ['POST', '/', ['Src\Controllers\Welcome', 'signup']],
    ['GET', '/login', ['Src\Controllers\Login', 'show']],
    ['POST', '/login', ['Src\Controllers\Login', 'login']],
    ['GET', '/{slug}', ['Src\Controllers\Page', 'show']],
];