<?php

namespace App\Livewire;

use App\Models\Gallery;
use App\Models\Image;
use Livewire\Component;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GalleryManagerComponent extends Component
{
    public $gallery;
    public $mediaImages = [];
    public $existingGalleries = [];
    public $selectedGalleryId;
    public $selectedGalleryName;
    public $sectionId; // Added property for current section ID

    public function mount($section)
    {
        $this->sectionId = $section->id; // Initialize section ID
        $this->mediaImages = Image::whereNull('gallery_id')->get();
        $this->existingGalleries = Gallery::has('images')->withCount('images')->get();
    }

    public function linkGallery()
    {
        try {
            if (!$this->selectedGalleryId) {
                throw new \Exception('No gallery selected. Please select a gallery to link.');
            }

            $gallery = Gallery::with('images')->findOrFail($this->selectedGalleryId);
            $gallery->update(['section_id' => $this->sectionId]); // Link gallery to section

            $this->selectedGalleryName = $gallery->title;

            // Update images to link to the section
            foreach ($gallery->images as $image) {
                $image->update([
                    'section_id' => $this->sectionId,
                    'gallery_id' => $this->selectedGalleryId,
                ]);
            }

            $this->gallery = $gallery;

            $this->dispatch('gallery-linked', [
                'message' => "Gallery '{$gallery->title}' linked successfully!",
            ]);
        } catch (ModelNotFoundException $e) {
            $this->dispatch('error', [
                'message' => 'Selected gallery does not exist.',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('error', [
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function unlinkGallery()
    {
        if (!$this->gallery) {
            $this->dispatch('error', [
                'message' => 'No gallery is currently linked.',
            ]);
            return;
        }

        try {
            // Unlink images from the section
            foreach ($this->gallery->images as $image) {
                $image->update(['section_id' => null]);
            }

            $this->gallery = null;

            $this->dispatch('gallery-unlinked', [
                'message' => 'Gallery unlinked successfully!',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('error', [
                'message' => 'An error occurred while unlinking the gallery: ' . $e->getMessage(),
            ]);
        }
    }

    public function addImageToGallery($imageId)
    {
        try {
            $image = Image::findOrFail($imageId);
            $image->update([
                'gallery_id' => $this->selectedGalleryId,
                'section_id' => $this->sectionId, // Link image to current section
            ]);

            $this->mediaImages = Image::whereNull('gallery_id')->get();
            $this->existingGalleries = Gallery::has('images')->withCount('images')->get();
        } catch (ModelNotFoundException $e) {
            $this->dispatch('error', [
                'message' => 'The image could not be found.',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('error', [
                'message' => 'An error occurred while adding the image to the gallery: ' . $e->getMessage(),
            ]);
        }
    }

    public function openMediaModal()
    {
        $this->dispatch('show-media-modal');
    }

    public function openComputerUploadModal()
    {
        $this->dispatch('show-upload-modal');
    }

    public function render()
    {
        return view('livewire.gallery-manager-component');
    }
}
