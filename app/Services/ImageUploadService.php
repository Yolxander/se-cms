<?php

// App\Services\ImageUploadService.php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Factory;

class ImageUploadService
{
    protected $firebaseStorage;

    public function __construct()
    {
        $firebaseCredentials = base_path(env('FIREBASE_CREDENTIALS'));
        $factory = (new Factory)->withServiceAccount($firebaseCredentials);
        $this->firebaseStorage = $factory->createStorage();
    }

    public function uploadImage($file, $sectionId = null, $galleryId = null)
    {

        // Fetch the page name associated with the section
        $pageName = null;
        if ($sectionId) {
            $section = \App\Models\Section::with('page')->find($sectionId);
            if ($section && $section->page) {
                $pageName = $section->page->name; // Assuming the page model has a 'name' column
            }
        }

        // Default to a generic folder if page name is not found
        $folderName = $pageName ? str_slug($pageName) : 'default';

        // Construct the file path with the page name
        $filePath = $folderName . '/uploads/' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Upload to Firebase Storage
        $bucket = $this->firebaseStorage->getBucket();
        $bucket->upload(fopen($file->getPathname(), 'r'), ['name' => $filePath]);

        // Generate a signed URL for the uploaded file
        $storageReference = $bucket->object($filePath);
        $imageUrl = $storageReference->signedUrl(new \DateTime('+1 year'));

        // Create the image record in the database
        return Image::create([
            'section_id' => $sectionId,
            'gallery_id' => $galleryId,
            'path' => $imageUrl,
            'image_size' => $file->getSize(),
            'title' => $file->getClientOriginalName(),
        ]);
    }


    public function replaceImage($image, $newFile)
    {
        $bucket = $this->firebaseStorage->getBucket();
        $firebaseImage = $bucket->object($image->path);

        if ($firebaseImage->exists()) {
            $firebaseImage->delete();
        }

        $filePath = 'uploads/' . uniqid() . '.' . $newFile->getClientOriginalExtension();
        $bucket->upload(fopen($newFile->getPathname(), 'r'), ['name' => $filePath]);

        $storageReference = $bucket->object($filePath);
        $newImageUrl = $storageReference->signedUrl(new \DateTime('+1 year'));

        $image->update(['path' => $newImageUrl]);
    }

    public function deleteImage($image)
    {
        $bucket = $this->firebaseStorage->getBucket();
        $firebaseImage = $bucket->object($image->path);

        if ($firebaseImage->exists()) {
            $firebaseImage->delete();
        }

        // Optionally delete the image record from the database
        $image->delete();
    }
}
