<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

final class PublicImageStorage
{
    /** Store under public/uploads/{folder}/ and return DB path (e.g. uploads/categories/uuid.jpg). */
    public static function store(UploadedFile $file, string $folder): string
    {
        $folder = trim($folder, '/');
        $dir = public_path('uploads/'.$folder);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $ext = strtolower($file->getClientOriginalExtension() ?: $file->guessExtension() ?: 'jpg');
        $name = Str::uuid()->toString().'.'.$ext;
        $file->move($dir, $name);

        return 'uploads/'.$folder.'/'.$name;
    }

    /** Resolve a stored path to a public URL (uploads/, storage/, or absolute http(s)). */
    public static function publicUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'uploads/')) {
            return '/'.$path;
        }

        return '/storage/'.$path;
    }

    /** Remove a file only if it lives under public/uploads/ (avoids arbitrary path deletes). */
    public static function delete(?string $relativePath): void
    {
        if (! $relativePath || ! str_starts_with($relativePath, 'uploads/')) {
            return;
        }

        $full = public_path($relativePath);
        if (is_file($full)) {
            @unlink($full);
        }
    }
}
