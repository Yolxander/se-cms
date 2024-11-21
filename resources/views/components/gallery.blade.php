<div>
    <h6 class="mt-3">
        Gallery: <strong>{{ $gallery->title ?? 'No gallery linked' }}</strong>
    </h6>

    @if($gallery)
        <div class="d-flex justify-content-between align-items-center mb-4">
            <button class="btn btn-primary btn-sm" id="import-image-button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-upload"></i> Import Image
            </button>

            <!-- Import Image Dropdown -->
            <div id="import-image-dropdown" class="dropdown-menu">
                <a class="dropdown-item" href="#" id="select-from-media" wire:click="openMediaModal">
                    Select From Media
                </a>
                <a class="dropdown-item" href="#" id="select-from-computer" wire:click="openComputerUploadModal">
                    Select From Computer
                </a>
            </div>

            <button class="btn btn-secondary btn-sm" id="expand-gallery-btn">
                <i class="bi bi-arrows-fullscreen"></i> Expand Gallery
            </button>
        </div>
        <div id="gallery-wrapper" class="d-flex flex-wrap gap-3 mt-3">
            @foreach($gallery->images as $image)
                <div class="gallery-image-wrapper shadow">
                    <img src="{{ $image->path }}"
                         alt="{{ $image->title }}"
                         class="gallery-image img-thumbnail"
                         data-bs-toggle="modal"
                         data-bs-target="#imageModal"
                         data-image-id="{{ $image->id }}" />
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
                        {{ $existingGallery->title }} ({{ $existingGallery->images->count() }} images)
                    </option>
                @endforeach
            </select>
            <button class="btn btn-primary mt-3" wire:click="linkGallery">
                <i class="bi bi-link"></i> Link Gallery
            </button>
            <p class="text-danger mt-2" wire:loading.class="d-none">
                Please ensure the gallery has at least one image before linking.
            </p>
        </div>
    @endif

    <!-- Media Modal -->
    <div class="modal fade" id="mediaModal" tabindex="-1" aria-labelledby="mediaModalLabel" aria-hidden="true">
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
                                <img src="{{ $mediaImage->path }}"
                                     alt="{{ $mediaImage->title }}"
                                     class="media-image img-thumbnail"
                                     wire:click="addImageToGallery({{ $mediaImage->id }})" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
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
        document.addEventListener('DOMContentLoaded', () => {
            const galleryWrapper = document.getElementById('gallery-wrapper');
            const expandGalleryBtn = document.getElementById('expand-gallery-btn');

            if (expandGalleryBtn) {
                expandGalleryBtn.addEventListener('click', () => {
                    galleryWrapper.classList.toggle('fullscreen');
                });
            }

            window.addEventListener('gallery-linked', event => {
                Swal.fire({
                    icon: 'success',
                    title: 'Gallery Linked',
                    text: event.detail.message,
                    timer: 2000,
                });
            });

            window.addEventListener('error', event => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: event.detail.message,
                    timer: 3000,
                });
            });

            window.addEventListener('image-added', event => {
                Swal.fire({
                    icon: 'success',
                    title: 'Image Added',
                    text: event.detail.message,
                    timer: 2000,
                });
            });
        });
    </script>
@endpush
