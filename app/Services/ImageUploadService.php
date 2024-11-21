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
        // Firebase credentials JSON directly
        $firebaseConfig = [
            "type" => "service_account",
            "project_id" => "sempre-studios-893c8",
            "private_key_id" => "e7c5eedcf1d551c1068de929f9712c2f1b91c481",
            "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCmw2+UxjWbbx50\nqjnNTypNbm0UrAvaXjj8vbtcsLRi4FhqMpvJcP6S8oLyHrQwu5fMblejQTkXTzXl\nnxVfS6Le9EW0huKvwVfwY6uiC6roUd8C6HYuTTFUJ8du4TZfeibye2znpkmbPY9B\nk7qg1FOX3NjIuTLAwPVd+EkyDy2kL9rS0B3zb+ciigyMw0kc7dooK7EmdjGVU5yf\nzRS2hNicFsF7IUEDV46YQ7JmG/OAInAB/0ei/6G2VaHlHHthfxmc+AobFDIf3KnJ\nMSY7eDWpQw4wtJ4d+lzhiQtr0X/Wbc014eJZFUcqx0yOuBwhlLDi9RNiFavsCe/n\nM+zuaSDzAgMBAAECggEAKETiQWE5ma6UAqUGbzLyKp+DPK4s8I63ISTpxQCwln3J\nK9/LqbGc77wa7b+HUItEJSvyAqyhziSlBa1MGmZnzoHbATRfMgS0qQpQbEF4BECc\n4xViUFz4j/NJH9fHavfSxtQSIMARXyjW2oWDWAndo7rDKHk8LbqKpaXqeumaYl59\ni1dmETHYb2HKir4m/1jOeGsuDxPtUKBitoItLa35sSa5EVjY/jqjzwURWOHPYOuP\n0gMZ/yhAJGZti9tlZJCKX70ZeSebDa+bXUqSGiezCjqGVuRY56wJJ+oAKP/YONfC\nNK6FpjcdEn2o4P90737taVzZnEZPRyDdCI3QwBcQYQKBgQDmm93WbWlcTAUwEVWT\nfUhga7JOKJypTQKa00gdtnVOI8TUbx1PqSn+oLN3n+P/hnQXIgviWyf8TZH95ywK\nZT83foHbpT7pSRXumFwVt8drLOzX+qalx7JKJHaMilgK7rwmu56gFEuQik8Lzt3+\nlzAx7bosF9Tq6jEGxXpS1osDIQKBgQC5H/f9u7dt72L2/JYIjVRrHf/Yccc/I9G1\nkbhKJCwNzekuGWs/fcGA1Ne7RcRiaodbrBDvArdtCkCYo7t5xyKlN+QztqistzBx\nfhutI5TiK0zHoWX3CuiP8eTR/scoEnTmIf4M/vM3qhttN0LNXOgb20EuLFHcEkWt\npwFIZ2C1kwKBgQCqx4dTwxchyRKWdF/hqAgvj9IuW5kZL/Tb39gqWPMqeQbNI7Sb\nR/XXof8GehyJIXNbplUSvtsv1+pkFAzjbfORD1jv5sJeVUeuuJqJYt6GGnETyYYc\ng3Ufvz0j+1gUUJR6QrvIZP9I/YRohDyWzDRe5WTYPpXpmqHQF/Ls4gF0wQKBgFv/\nuCVfeWvn0H2/zuvXGIHXOcMd4A/PxDMAhN5LlZ0SnHQta6/01gopPEC0DkF+gWAc\nZZnx9qf4tVtl2xBM1znWSdEtUCvtKeTs7+IeUaoILLL00ZBw2lxWsQlvHRgb+/42\nHGPm+4XJQrIHCWq3Zh4Z2w2QNuowJnKDEU8jGNuDAoGBAM4ifWRTF4i99XmmTT73\n1w1QLOGy7/DyUCP6DzBoU2LOfW/S/lTPSLQ7VfIn2lv2X0x7ROTgdGMiC3fpB3Ct\n1sI07/YoTTxkauzcE761OgQCyCF/sCini2C+6/DVGRbc2Eoe3qNeYtEBBOouh/jA\nGETrMz1vufHvmt7+efkvC9tn\n-----END PRIVATE KEY-----\n",
            "client_email" => "firebase-adminsdk-gkp49@sempre-studios-893c8.iam.gserviceaccount.com",
            "client_id" => "114696175474042316067",
            "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
            "token_uri" => "https://oauth2.googleapis.com/token",
            "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
            "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-gkp49%40sempre-studios-893c8.iam.gserviceaccount.com",
            "universe_domain" => "googleapis.com",
        ];

        $factory = (new Factory)->withServiceAccount($firebaseConfig);
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
