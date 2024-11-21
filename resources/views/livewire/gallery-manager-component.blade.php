<div>
    <h6 class="mt-3">
        Gallery: <strong>{{ $gallery->title ?? 'No gallery linked' }}</strong>
    </h6>

    @if($gallery)
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="dropdown">
                <button class="btn btn-primary btn-sm dropdown-toggle" id="import-image-button" data-bs-toggle="dropdown">
                    <i class="bi bi-upload"></i> Import Image
                </button>
                <ul class="dropdown-menu" aria-labelledby="import-image-button">
                    <li><a class="dropdown-item" href="#" wire:click.prevent="openMediaModal">Select From Media</a></li>
                    <li><a class="dropdown-item" href="#" wire:click.prevent="openComputerUploadModal">Select From Computer</a></li>
                </ul>
            </div>
            <button class="btn btn-secondary btn-sm"><i class="bi bi-arrows-fullscreen"></i> Expand Gallery</button>
            <button class="btn btn-danger btn-sm" wire:click="unlinkGallery"><i class="bi bi-x-circle"></i> Unlink Gallery</button>
        </div>

        <div id="gallery-wrapper" class="d-flex flex-wrap gap-3 mt-3">
            @foreach($gallery->images as $image)
                <div class="gallery-image-wrapper shadow">
                    <img src="{{ $image->path }}" alt="{{ $image->title }}" class="gallery-image img-thumbnail">
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">No gallery linked.</p>
        <div class="mb-4">
            <label for="link-gallery-select" class="form-label">Link an Existing Gallery</label>
            <select id="link-gallery-select" class="form-select" wire:model="selectedGalleryId">
                <option selected disabled>Select a gallery</option>
                @foreach($existingGalleries as $existingGallery)
                    <option value="{{ $existingGallery->id }}">
                        {{ $existingGallery->title }} ({{ $existingGallery->images_count }} images)
                    </option>
                @endforeach
            </select>
            <button class="btn btn-primary mt-3" wire:click="linkGallery"><i class="bi bi-link"></i> Link Gallery</button>
        </div>
    @endif

    <!-- Media Modal -->
    <div class="modal fade" id="mediaModal" tabindex="-1" aria-labelledby="mediaModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="mediaModalLabel" class="modal-title">Select Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-wrap gap-3">
                        @foreach($mediaImages as $mediaImage)
                            <div class="media-image-wrapper">
                                <img src="{{ $mediaImage->path }}" alt="{{ $mediaImage->title }}" class="media-image img-thumbnail" wire:click="addImageToGallery({{ $mediaImage->id }})">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="imageModalLabel" class="modal-title">Image Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modal-image" src="" alt="Selected Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

@push('css')
    <style>
        .gallery-image-wrapper, .media-image-wrapper {
            width: 180px;
            height: 180px;
            margin: 5px;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.2s ease;
        }

        .gallery-image-wrapper:hover, .media-image-wrapper:hover {
            transform: scale(1.05);
        }

        .gallery-image, .media-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            cursor: pointer;
            border-radius: 10px;
        }

        #gallery-wrapper.fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.95);
            z-index: 1050;
            padding: 20px;
            overflow-y: auto;
            border-radius: 10px;
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('livewire:load', () => {
            Livewire.on('error', event => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: event.message,
                });
            });

            Livewire.on('gallery-linked', event => {
                Swal.fire({
                    icon: 'success',
                    title: 'Gallery Linked',
                    text: event.message,
                });
            });

            Livewire.on('gallery-unlinked', event => {
                Swal.fire({
                    icon: 'success',
                    title: 'Gallery Unlinked',
                    text: event.message,
                });
            });

            Livewire.on('show-media-modal', () => {
                const mediaModal = new bootstrap.Modal(document.getElementById('mediaModal'));
                mediaModal.show();
            });
        });
    </script>
@endpush
