<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card card-background card-background-after-none align-items-start mt-4 mb-5">
                        <div class="full-background"
                             style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
                        <div class="card-body text-start p-4 w-100">
                            <h3 class="text-white mb-2">Gallery: {{ $gallery->title }}</h3>
                            <p class="mb-4 font-weight-semibold">
                                Manage and organize the images in your gallery.
                            </p>
                            <a href="{{ route('galleries.index') }}"
                               class="btn btn-outline-white btn-blur btn-icon d-flex align-items-center mb-0">
                                <span class="btn-inner--icon">
                                    <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="d-block me-2">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M7 14C10.866 14 14 10.866 14 7C14 3.13401 10.866 0 7 0C3.13401 0 0 3.13401 0 7C0 10.866 3.13401 14 7 14ZM6.61036 4.52196C6.34186 4.34296 5.99664 4.32627 5.71212 4.47854C5.42761 4.63081 5.25 4.92731 5.25 5.25V8.75C5.25 9.0727 5.42761 9.36924 5.71212 9.52149C5.99664 9.67374 6.34186 9.65703 6.61036 9.47809L9.23536 7.72809C9.47879 7.56577 9.625 7.2926 9.625 7C9.625 6.70744 9.47879 6.43424 9.23536 6.27196L6.61036 4.52196Z" />
                                    </svg>
                                </span>
                                <span class="btn-inner--text">Back to Galleries</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card border shadow-xs">
                        <div class="card-header border-bottom pb-0">
                            <h6 class="font-weight-semibold text-lg mb-0">Images in {{ $gallery->title }}</h6>
                            <p class="text-sm mb-sm-0">Manage and organize your images below.</p>
                        </div>
                        <div class="card-body px-4 py-4">
                            <div class="row">
                                @foreach($gallery->images as $image)
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100">
                                            <img src="{{ asset($image->path) }}" alt="{{ $image->title }}"
                                                 class="card-img-top img-thumbnail"
                                                 style="width: 100%; height: 200px; object-fit: cover; cursor: pointer;"
                                                 data-bs-toggle="modal" data-bs-target="#imageModal"
                                                 data-image-path="{{ asset($image->path) }}"
                                                 data-image-title="{{ $image->title }}"
                                                 data-image-id="{{ $image->id }}">
                                            <div class="card-body text-center">
                                                <h6 class="text-sm font-weight-semibold">{{ $image->title }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card border shadow-xs">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Gallery Management</h6>
                                    <p class="text-sm mb-sm-0">Upload and manage your gallery images</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">
                            <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="images" class="form-label">Upload Images</label>
                                        <input type="file" name="images[]" id="images" class="form-control" multiple>
                                    </div>
                                </div>
                                <input type="hidden" name="gallery_id" value="{{ $gallery->id }}">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Image Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex">
                    <div class="w-50">
                        <img id="modalImage" src="" alt="Selected Image" class="img-fluid rounded">
                    </div>
                    <div class="w-50 ps-4">
                        <h6 id="modalTitle" class="font-weight-semibold"></h6>

                        <!-- Replace Image -->
                        <form id="replaceForm" method="POST" enctype="multipart/form-data" action="">
                            @csrf
                            @method('PATCH')
                            <div class="mb-2">
                                <label for="replaceImage" class="form-label">Replace Image</label>
                                <input type="file" name="image" id="replaceImage" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mb-2">Replace</button>
                        </form>

                        <!-- Delete Image -->
                        <form id="deleteForm" method="POST" action="{{ route('images.destroy', ':id') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>



                        <!-- Move to Another Gallery -->
                        <form id="moveForm" method="POST" action="">
                            @csrf
                            @method('PATCH')
                            <div class="mb-2">
                                <label for="moveGallery" class="form-label">Move to Gallery</label>
                                <select name="gallery_id" id="moveGallery" class="form-select" required>
                                    @foreach($galleries as $availableGallery)
                                        @if($availableGallery->id !== $gallery->id)
                                            <option value="{{ $availableGallery->id }}">{{ $availableGallery->title }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-secondary btn-sm mb-2">Move</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const imageModal = document.getElementById('imageModal');
                const modalImage = document.getElementById('modalImage');
                const modalTitle = document.getElementById('modalTitle');
                const replaceForm = document.getElementById('replaceForm');
                const deleteForm = document.getElementById('deleteForm');
                const moveForm = document.getElementById('moveForm');

                imageModal.addEventListener('show.bs.modal', (event) => {
                    const button = event.relatedTarget;
                    const imageId = button.getAttribute('data-image-id');
                    const imagePath = button.getAttribute('data-image-path');
                    const imageTitle = button.getAttribute('data-image-title');

                    // Update modal content
                    modalImage.src = imagePath;
                    modalTitle.textContent = imageTitle;

                    // Update form actions dynamically
                    replaceForm.action = `/images/${imageId}/replace`;
                    deleteForm.action = deleteForm.action.replace(':id', imageId); // Replace :id with the actual image ID
                    moveForm.action = `/images/${imageId}/move`;
                });
            });


        </script>
    @endpush
</x-app-layout>
