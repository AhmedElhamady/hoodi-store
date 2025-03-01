<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class Helper
{
    public static function storeImage($image, $path)
    {
        $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
        $path = 'images/' . $path;
        $storedPath = $image->storeAs($path, $fileName, 'public');
        return Storage::url($storedPath);
    }

    public static function updateImage($image, $oldImage, $path)
    {
        self::deleteImage($oldImage);
        return self::storeImage($image, $path);
    }

    public static function deleteImage($path)
    {
        $relativePath = str_replace('/storage/', '', $path);
        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }
    }
}
