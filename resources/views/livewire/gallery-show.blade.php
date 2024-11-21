<div>
    <h6 class="mt-3">
        Gallery: <strong>{{ $gallery->title }}</strong>
    </h6>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <button class="btn btn-primary btn-sm" wire:click="bulkUpload">
            <i class="bi bi-upload"></i> Bulk Upload Images
        </button>

        <button class="btn btn-secondary btn-sm" wire:click="editGallery">
            <i class="bi bi-pencil"></i> Edit Gallery
        </button>
    </div>

    <div id="gallery-wrapper" class="d-flex flex-wrap gap-3 mt-3">
        @foreach($images as $image)
            <div class="gallery-image-wrapper shadow" wire:sortable.item="{{ $image->id }}">
                <img src="{{ $image->path }}" alt="{{ $image->title }}" class="gallery-image img-thumbnail"
                     wire:click="openImageModal({{ $image->id }})" />
            </div>
        @endforeach
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="imageModalLabel" class="modal-title">Manage Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex">
                    <div class="w-50">
                        <button class="btn btn-danger mb-2 w-100" wire:click="deleteImage">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                        <button class="btn btn-primary mb-2 w-100" wire:click="replaceImage">
                            <i class="bi bi-arrow-repeat"></i> Replace
                        </button>
                        <button class="btn btn-secondary mb-2 w-100" wire:click="changeGallery">
                            <i class="bi bi-folder"></i> Change Gallery
                        </button>
                    </div>
                    <div class="w-50">
                        <img src="{{ $selectedImagePath }}" alt="Selected Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('css')
        <style>
            .gallery-image-wrapper {
                width: 180px;
                height: 180px;
                margin: 5px;
                border-radius: 10px;
                overflow: hidden;
                transition: transform 0.2s ease;
            }

            .gallery-image-wrapper:hover {
                transform: scale(1.05);
            }

            .gallery-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                cursor: pointer;
            }
        </style>
    @endpush

    @push('js')
        <script>
            document.addEventListener('livewire:load', () => {
                Livewire.on('show-image-modal', () => {
                    const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
                    imageModal.show();
                });

                Livewire.on('hide-image-modal', () => {
                    const imageModal = bootstrap.Modal.getInstance(document.getElementById('imageModal'));
                    if (imageModal) {
                        imageModal.hide();
                    }
                });
            });
        </script>
    @endpush
</div>
