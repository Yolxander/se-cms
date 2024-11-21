<div>

    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4">
                <div class="card-header border-bottom pb-0 d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold text-lg mb-2">Content</h6>
                    <button class="btn btn-danger btn-sm" wire:click="deleteSection" onclick="return confirm('Are you sure you want to delete this section and all related data?');">
                        Delete Section
                    </button>
                </div>
                <div class="card-body">
                    @foreach($section->content as $content)
                        <div class="mb-5 border-bottom pb-4">
                            <h6 class="text-secondary mb-3">{{ ucfirst($content->key) }}</h6>

                            @if($content->type == 'list')
                                <!-- Display list items as editable inputs -->
                                @php $listItems = json_decode($content->value, true) ?? []; @endphp
                                <div id="list-container-{{ $content->id }}" class="mb-4">
                                    @foreach($listItems as $index => $item)
                                        <div class="d-flex align-items-center mb-2">
                                            <input type="text"
                                                   class="form-control me-2"
                                                   name="{{ 'content[' . $content->id . '][value][]' }}"
                                                   value="{{ $item }}"
                                                   placeholder="List item {{ $index + 1 }}">
                                            <button type="button" class="btn btn-danger btn-sm remove-list-item">Remove</button>
                                        </div>
                                    @endforeach
                                    <button type="button" class="btn btn-success btn-sm add-list-item" data-content-id="{{ $content->id }}">Add Item</button>
                                </div>
                            @elseif($content->type == 'json' && $content->key === 'header')
                                <!-- Display header JSON as editable fields -->
                                @php $headerData = json_decode($content->value, true) ?? []; @endphp
                                <div id="header-container-{{ $content->id }}" class="mb-4">
                                    <div class="mb-3">
                                        <label for="header-name-{{ $content->id }}" class="form-control-label">Name</label>
                                        <input type="text"
                                               class="form-control"
                                               id="header-name-{{ $content->id }}"
                                               name="content[{{ $content->id }}][value][name]"
                                               value="{{ $headerData['name'] ?? '' }}"
                                               placeholder="Header Name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="header-description-{{ $content->id }}" class="form-control-label">Description</label>
                                        <textarea class="form-control"
                                                  id="header-description-{{ $content->id }}"
                                                  name="content[{{ $content->id }}][value][description]"
                                                  rows="3"
                                                  placeholder="Header Description">{{ $headerData['description'] ?? '' }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="header-image-{{ $content->id }}" class="form-control-label">Image URL</label>
                                        <input type="text"
                                               class="form-control"
                                               id="header-image-{{ $content->id }}"
                                               name="content[{{ $content->id }}][value][image]"
                                               value="{{ $headerData['image'] ?? '' }}"
                                               placeholder="Header Image URL">
                                        @if(!empty($headerData['image']))
                                            <img src="{{ $headerData['image'] }}" alt="Header Image" class="mt-2 img-thumbnail" style="max-width: 300px; height: auto;">
                                        @endif
                                    </div>
                                </div>
                            @elseif($content->type == 'gallery')
                                <!-- Display gallery name and associated images -->
                                @php
                                    $gallery = $content->galleryImages->first()->gallery ?? null;
                                    $images = $gallery ? $gallery->images : [];
                                @endphp

                                <livewire:gallery-manager-component :section="$section" />



                            @else
                                <input type="text"
                                       id="{{ 'content_' . $content->id }}"
                                       name="{{ 'content[' . $content->id . '][value]' }}"
                                       value="{{ $content->value }}"
                                       class="form-control" />
                            @endif

                            <!-- Hidden fields to store key and type -->
                            <input type="hidden" name="content[{{ $content->id }}][key]" value="{{ $content->key }}">
                            <input type="hidden" name="content[{{ $content->id }}][type]" value="{{ $content->type }}">
                        </div>
                    @endforeach
                </div>

                <!-- Buttons to cancel or update -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('sections.index') }}" class="btn btn-light m-0">Cancel</a>
                    <button type="submit" class="btn btn-dark m-0 ms-2">Update Section</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body d-flex">
                    <!-- Image on the left -->
                    <div class="flex-grow-1">
                        <img id="modal-image" src="" alt="Selected Image" class="img-fluid" style="max-height: 80vh;">
                    </div>
                    <!-- Buttons on the right -->
                    <div class="d-flex flex-column align-items-start ms-3">
                        <button id="replace-image-btn" class="btn btn-primary mb-3" data-image-id="">Replace</button>
                        <form id="delete-image-form" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



