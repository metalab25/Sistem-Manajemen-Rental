<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImageHelpers
{
    public static function cropAvatar($file, $folder = 'default', $width = 300, $height = 300)
    {
        try {
            $path = $file->getRealPath();
            $extension = $file->getClientOriginalExtension();
            list($originalWidth, $originalHeight) = getimagesize($path);

            $aspectRatioOriginal = $originalWidth / $originalHeight;
            $aspectRatioTarget = $width / $height;

            if ($aspectRatioOriginal >= $aspectRatioTarget) {
                $newHeight = $originalHeight;
                $newWidth = (int) ($originalHeight * $aspectRatioTarget);
                $srcX = (int) (($originalWidth - $newWidth) / 2);
                $srcY = 0;
            } else {
                $newWidth = $originalWidth;
                $newHeight = (int) ($originalWidth / $aspectRatioTarget);
                $srcX = 0;
                $srcY = (int) (($originalHeight - $newHeight) / 2);
            }

            $imageCropped = imagecreatetruecolor($width, $height);

            switch ($extension) {
                case 'jpeg':
                case 'jpg':
                    $image = imagecreatefromjpeg($path);
                    break;
                case 'png':
                    $image = imagecreatefrompng($path);
                    break;
                case 'bmp':
                    $image = imagecreatefrombmp($path);
                    break;
                case 'webp':
                    $image = imagecreatefromwebp($path);
                    break;
                default:
                    throw new \Exception("Unsupported image type.");
            }

            imagecopyresampled(
                $imageCropped,
                $image,
                0,
                0,
                $srcX,
                $srcY,
                $width,
                $height,
                $newWidth,
                $newHeight
            );

            $hashedFilename = 'foto_' . Str::random(20) . '.' . $extension;
            $croppedPath = $folder . '/' . $hashedFilename;
            $storagePath = storage_path('app/public/' . $croppedPath);

            switch ($extension) {
                case 'jpeg':
                case 'jpg':
                    imagejpeg($imageCropped, $storagePath);
                    break;
                case 'png':
                    imagepng($imageCropped, $storagePath);
                    break;
                case 'bmp':
                    imagebmp($imageCropped, $storagePath);
                    break;
                case 'webp':
                    imagewebp($imageCropped, $storagePath);
                    break;
            }

            imagedestroy($image);
            imagedestroy($imageCropped);

            return $croppedPath;
        } catch (\Exception $e) {
            report($e);
            return null;
        }
    }

    public static function cropCarImage($file, $folder = 'default', $width = 600, $height = 400)
    {
        try {
            $path = $file->getRealPath();
            $extension = $file->getClientOriginalExtension();
            list($originalWidth, $originalHeight) = getimagesize($path);

            $aspectRatioOriginal = $originalWidth / $originalHeight;
            $aspectRatioTarget = $width / $height;

            if ($aspectRatioOriginal >= $aspectRatioTarget) {
                $newHeight = $originalHeight;
                $newWidth = (int) ($originalHeight * $aspectRatioTarget);
                $srcX = (int) (($originalWidth - $newWidth) / 2);
                $srcY = 0;
            } else {
                $newWidth = $originalWidth;
                $newHeight = (int) ($originalWidth / $aspectRatioTarget);
                $srcX = 0;
                $srcY = (int) (($originalHeight - $newHeight) / 2);
            }

            $imageCropped = imagecreatetruecolor($width, $height);

            switch ($extension) {
                case 'jpeg':
                case 'jpg':
                    $image = imagecreatefromjpeg($path);
                    break;
                case 'png':
                    $image = imagecreatefrompng($path);
                    break;
                case 'bmp':
                    $image = imagecreatefrombmp($path);
                    break;
                case 'webp':
                    $image = imagecreatefromwebp($path);
                    break;
                default:
                    throw new \Exception("Unsupported image type.");
            }

            imagecopyresampled(
                $imageCropped,
                $image,
                0,
                0,
                $srcX,
                $srcY,
                $width,
                $height,
                $newWidth,
                $newHeight
            );

            $hashedFilename = 'car_' . Str::random(20) . '.' . $extension;
            $croppedPath = $folder . '/' . $hashedFilename;
            $storagePath = storage_path('app/public/' . $croppedPath);

            switch ($extension) {
                case 'jpeg':
                case 'jpg':
                    imagejpeg($imageCropped, $storagePath);
                    break;
                case 'png':
                    imagepng($imageCropped, $storagePath);
                    break;
                case 'bmp':
                    imagebmp($imageCropped, $storagePath);
                    break;
                case 'webp':
                    imagewebp($imageCropped, $storagePath);
                    break;
            }

            imagedestroy($image);
            imagedestroy($imageCropped);

            return $croppedPath;
        } catch (\Exception $e) {
            report($e);
            return null;
        }
    }

    public static function cropInteriorImage($file, $folder = 'default', $width = 600, $height = 400)
    {
        try {
            $path = $file->getRealPath();
            $extension = $file->getClientOriginalExtension();
            list($originalWidth, $originalHeight) = getimagesize($path);

            $aspectRatioOriginal = $originalWidth / $originalHeight;
            $aspectRatioTarget = $width / $height;

            if ($aspectRatioOriginal >= $aspectRatioTarget) {
                $newHeight = $originalHeight;
                $newWidth = (int) ($originalHeight * $aspectRatioTarget);
                $srcX = (int) (($originalWidth - $newWidth) / 2);
                $srcY = 0;
            } else {
                $newWidth = $originalWidth;
                $newHeight = (int) ($originalWidth / $aspectRatioTarget);
                $srcX = 0;
                $srcY = (int) (($originalHeight - $newHeight) / 2);
            }

            $imageCropped = imagecreatetruecolor($width, $height);

            switch ($extension) {
                case 'jpeg':
                case 'jpg':
                    $image = imagecreatefromjpeg($path);
                    break;
                case 'png':
                    $image = imagecreatefrompng($path);
                    break;
                case 'bmp':
                    $image = imagecreatefrombmp($path);
                    break;
                case 'webp':
                    $image = imagecreatefromwebp($path);
                    break;
                default:
                    throw new \Exception("Unsupported image type.");
            }

            imagecopyresampled(
                $imageCropped,
                $image,
                0,
                0,
                $srcX,
                $srcY,
                $width,
                $height,
                $newWidth,
                $newHeight
            );

            $hashedFilename = 'interior_' . Str::random(20) . '.' . $extension;
            $croppedPath = $folder . '/' . $hashedFilename;
            $storagePath = storage_path('app/public/' . $croppedPath);

            switch ($extension) {
                case 'jpeg':
                case 'jpg':
                    imagejpeg($imageCropped, $storagePath);
                    break;
                case 'png':
                    imagepng($imageCropped, $storagePath);
                    break;
                case 'bmp':
                    imagebmp($imageCropped, $storagePath);
                    break;
                case 'webp':
                    imagewebp($imageCropped, $storagePath);
                    break;
            }

            imagedestroy($image);
            imagedestroy($imageCropped);

            return $croppedPath;
        } catch (\Exception $e) {
            report($e);
            return null;
        }
    }

    public static function cropCardImage($file, $folder = 'default', $width = 600, $height = 400)
    {
        try {
            $path = $file->getRealPath();
            $extension = $file->getClientOriginalExtension();
            list($originalWidth, $originalHeight) = getimagesize($path);

            $aspectRatioOriginal = $originalWidth / $originalHeight;
            $aspectRatioTarget = $width / $height;

            if ($aspectRatioOriginal >= $aspectRatioTarget) {
                $newHeight = $originalHeight;
                $newWidth = (int) ($originalHeight * $aspectRatioTarget);
                $srcX = (int) (($originalWidth - $newWidth) / 2);
                $srcY = 0;
            } else {
                $newWidth = $originalWidth;
                $newHeight = (int) ($originalWidth / $aspectRatioTarget);
                $srcX = 0;
                $srcY = (int) (($originalHeight - $newHeight) / 2);
            }

            $imageCropped = imagecreatetruecolor($width, $height);

            switch ($extension) {
                case 'jpeg':
                case 'jpg':
                    $image = imagecreatefromjpeg($path);
                    break;
                case 'png':
                    $image = imagecreatefrompng($path);
                    break;
                case 'bmp':
                    $image = imagecreatefrombmp($path);
                    break;
                case 'webp':
                    $image = imagecreatefromwebp($path);
                    break;
                default:
                    throw new \Exception("Unsupported image type.");
            }

            imagecopyresampled(
                $imageCropped,
                $image,
                0,
                0,
                $srcX,
                $srcY,
                $width,
                $height,
                $newWidth,
                $newHeight
            );

            $hashedFilename = 'card' . Str::random(20) . '.' . $extension;
            $croppedPath = $folder . '/' . $hashedFilename;
            $storagePath = storage_path('app/public/' . $croppedPath);

            switch ($extension) {
                case 'jpeg':
                case 'jpg':
                    imagejpeg($imageCropped, $storagePath);
                    break;
                case 'png':
                    imagepng($imageCropped, $storagePath);
                    break;
                case 'bmp':
                    imagebmp($imageCropped, $storagePath);
                    break;
                case 'webp':
                    imagewebp($imageCropped, $storagePath);
                    break;
            }

            imagedestroy($image);
            imagedestroy($imageCropped);

            return $croppedPath;
        } catch (\Exception $e) {
            report($e);
            return null;
        }
    }

    public static function cropRentalImage($file, $folder = 'default', $width = 768, $height = 1024)
    {
        try {
            $path = $file->getRealPath();
            $extension = $file->getClientOriginalExtension();
            list($originalWidth, $originalHeight) = getimagesize($path);

            $aspectRatioOriginal = $originalWidth / $originalHeight;
            $aspectRatioTarget = $width / $height;

            if ($aspectRatioOriginal >= $aspectRatioTarget) {
                $newHeight = $originalHeight;
                $newWidth = (int) ($originalHeight * $aspectRatioTarget);
                $srcX = (int) (($originalWidth - $newWidth) / 2);
                $srcY = 0;
            } else {
                $newWidth = $originalWidth;
                $newHeight = (int) ($originalWidth / $aspectRatioTarget);
                $srcX = 0;
                $srcY = (int) (($originalHeight - $newHeight) / 2);
            }

            $imageCropped = imagecreatetruecolor($width, $height);

            switch ($extension) {
                case 'jpeg':
                case 'jpg':
                    $image = imagecreatefromjpeg($path);
                    break;
                case 'png':
                    $image = imagecreatefrompng($path);
                    break;
                case 'bmp':
                    $image = imagecreatefrombmp($path);
                    break;
                case 'webp':
                    $image = imagecreatefromwebp($path);
                    break;
                default:
                    throw new \Exception("Unsupported image type.");
            }

            imagecopyresampled(
                $imageCropped,
                $image,
                0,
                0,
                $srcX,
                $srcY,
                $width,
                $height,
                $newWidth,
                $newHeight
            );

            $hashedFilename = 'rental' . Str::random(20) . '.' . $extension;
            $croppedPath = $folder . '/' . $hashedFilename;
            $storagePath = storage_path('app/public/' . $croppedPath);

            switch ($extension) {
                case 'jpeg':
                case 'jpg':
                    imagejpeg($imageCropped, $storagePath);
                    break;
                case 'png':
                    imagepng($imageCropped, $storagePath);
                    break;
                case 'bmp':
                    imagebmp($imageCropped, $storagePath);
                    break;
                case 'webp':
                    imagewebp($imageCropped, $storagePath);
                    break;
            }

            imagedestroy($image);
            imagedestroy($imageCropped);

            return $croppedPath;
        } catch (\Exception $e) {
            report($e);
            return null;
        }
    }
}
