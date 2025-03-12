<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Exception;

trait FileTraits
{
    public static function fileUploadToFolder($file, $folder)
    {
        try {
            // Ensure the folder exists or create it
            if (!File::exists(public_path($folder))) {
                File::makeDirectory(public_path($folder), 0755, true);
            }

            // Generate a unique file name
            $imageName = rand() . '_' . time() . '.' . $file->extension();
            $path = $folder . '/' . $imageName;

            // Store the file in the public folder
            $file->move(public_path($folder), $imageName);

            // Return the public URL of the uploaded file
            return $path;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return ''; // You can return a specific value or throw an exception
        }
    }
}
