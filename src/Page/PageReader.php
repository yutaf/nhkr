<?php

namespace Src\Page;

interface PageReader
{
    public function readBySlug($slug);
}