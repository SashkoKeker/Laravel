<?php

namespace App\Services\Store;

use App\Models\Store;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    const PUBLIC_DIR = 'public/';

    /**
     * @param Store $store
     * @return void
     */
    public function deleteStoreImage(Store $store): void
    {
        $oldImage = $this->getImagePath($store->image);

        if (Storage::fileExists($oldImage)) {
            Storage::delete($oldImage);
        }
    }

    /**
     * @param UploadedFile $imageFile
     * @return string
     */
    public function storeImage(UploadedFile $imageFile): string
    {
        // Зберігаємо зображення у папці 'public/images'
        $imagePath = $imageFile->store('public/images');

        // Отримуємо шлях до зображення у папці 'public'
        return str_replace('public/', '', $imagePath);
    }

    /**
     * @param string $path
     * @return string
     */
    private function getImagePath(string $path): string
    {
        return self::PUBLIC_DIR . $path;
    }
}
