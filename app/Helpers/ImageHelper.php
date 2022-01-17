<?php

namespace App\Helpers;

class ImageHelper {
    public static function store($file, $path) {
        return $file->store($path, ['disk' => 'public']);
    }
}
