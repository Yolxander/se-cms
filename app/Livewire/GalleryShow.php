<?php
namespace App\Http\Livewire;

use App\Models\Gallery;
use App\Models\Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class GalleryShow extends Component
{
    use WithFileUploads, WithPagination;

    public $gallery;
    public $images = [];
    public $selectedImageId;
    public $selectedImagePath;

    protected $listeners = [
        'reorder' => 'updateOrder',
    ];

    public function mount(Gallery $gallery)
    {
        $this->gallery = $gallery;
        $this->images = $gallery->images()->orderBy('order')->get();
    }

    public function openImageModal($imageId)
    {
        $this->selectedImageId = $imageId;
        $this->selectedImagePath = Image::findOrFail($imageId)->path;
        $this->dispatchBrowserEvent('show-image-modal');
    }

    public function deleteImage()
    {
        $image = Image::findOrFail($this->selectedImageId);
        $image->delete();

        $this->images = $this->gallery->images()->orderBy('order')->get();
        $this->dispatchBrowserEvent('hide-image-modal');
    }

    public function replaceImage()
    {
        // Logic to replace the image.
    }

    public function changeGallery()
    {
        // Logic to move the image to another gallery.
    }

    public function updateOrder($order)
    {
        foreach ($order as $index => $id) {
            Image::where('id', $id)->update(['order' => $index + 1]);
        }

        $this->images = $this->gallery->images()->orderBy('order')->get();
    }

    public function render()
    {
        return view('livewire.gallery-show');
    }
}
