<?php

return [
    ['GET', '/', ['Src\Controllers\Home', 'show']],
//    ['GET', '/', ['Src\Controllers\Homepage', 'show']],
    ['GET', '/welcome', ['Src\Controllers\Welcome', 'show']],
    ['GET', '/{slug}', ['Src\Controllers\Page', 'show']],
];