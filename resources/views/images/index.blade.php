<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar/>
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card card-background card-background-after-none align-items-start mt-4 mb-5">
                        <div class="full-background"
                             style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
                        <div class="card-body text-start p-4 w-100">
                            <h3 class="text-white mb-2">Manage Your Photo Gallery</h3>
                            <p class="mb-4 font-weight-semibold">
                                Upload and organize your images with ease.
                            </p>
                            <button type="button"
                                    class="btn btn-outline-white btn-blur btn-icon d-flex align-items-center mb-0">
                                <span class="btn-inner--icon">
                                    <svg width="14" height="14" viewBox="0 0 14 14"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="d-block me-2">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M7 14C10.866 14 14 10.866 14 7C14 3.13401 10.866 0 7 0C3.13401 0 0 3.13401 0 7C0 10.866 3.13401 14 7 14ZM6.61036 4.52196C6.34186 4.34296 5.99664 4.32627 5.71212 4.47854C5.42761 4.63081 5.25 4.92731 5.25 5.25V8.75C5.25 9.0727 5.42761 9.36924 5.71212 9.52149C5.99664 9.67374 6.34186 9.65703 6.61036 9.47809L9.23536 7.72809C9.47879 7.56577 9.625 7.2926 9.625 7C9.625 6.70744 9.47879 6.43424 9.23536 6.27196L6.61036 4.52196Z"/>
                                    </svg>
                                </span>
                                <span class="btn-inner--text">Learn More</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card border shadow-xs">
                        <div class="card-header border-bottom pb-0">
                            <h6 class="font-weight-semibold text-lg mb-0">Gallery</h6>
                            <p class="text-sm mb-sm-0">View and manage uploaded images</p>
                        </div>
                        <div class="card-body px-4 py-4">
                            <div class="row">
                                @foreach($images as $image)
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100">
                                            <img src="{{ asset($image->path) }}" alt="{{ $image->title }}"
                                                 class="card-img-top img-thumbnail"
                                                 style="width: 100%; height: 200px; object-fit: cover; cursor: pointer;"
                                                 data-bs-toggle="modal" data-bs-target="#imagePreviewModal"
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
                                    <div class="col-md-6 mb-3">
                                        <label for="images" class="form-label">Upload Images</label>
                                        <input type="file" name="images[]" id="images" class="form-control" multiple>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="section" class="form-label">Select Section</label>
                                        <select name="section_id" id="section" class="form-select">
                                            @foreach($sections as $section)
                                                <option value="{{ $section->id }}">{{ $section->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Include the modal and pass galleries -->
                @include('images.image-modal', ['sections' => $sections, 'galleries' => $galleries])
            </div>
            <x-app.footer/>
        </div>
    </main>
</x-app-layout>
