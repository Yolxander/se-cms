<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body d-flex">
                <!-- Image Section -->
                <div class="flex-shrink-0">
                    <img id="previewImage" src="" alt="Image Preview" style="width: 500px; height: 500px; object-fit: cover;">
                </div>
                <!-- Controls Section -->
                <div class="ms-4 flex-grow-1">
                    <h5 id="previewTitle" class="mb-3"></h5>
                    <div class="d-flex flex-column gap-2">
                        <!-- Replace Image Form -->
                        <form id="replaceForm" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="image_id" id="replaceImageId">
                            <label class="btn btn-primary btn-sm">
                                Replace
                                <input type="file" name="image" id="replaceImageInput" class="d-none">
                            </label>
                        </form>

                        <!-- Copy Path Button -->
                        <button class="btn btn-secondary btn-sm" onclick="copyImageUrl()">Copy Path</button>

                        <!-- Change Section Form -->
                        <form id="changeSectionForm">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="image_id" id="changeSectionImageId">
                            <label for="changeSectionSelect" class="form-label">Change Section</label>
                            <select name="section_id" id="changeSectionSelect" class="form-select">
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                        </form>

                        <!-- Add to Gallery Form -->
                        <form id="addToGalleryForm">
                            @csrf
                            <input type="hidden" name="image_id" id="addToGalleryImageId">
                            <label for="addToGallerySelect" class="form-label">Add to Gallery</label>
                            <select name="gallery_id" id="addToGallerySelect" class="form-select">
                                @foreach($galleries as $gallery)
                                    <option value="{{ $gallery->id }}">{{ $gallery->title }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('imagePreviewModal');

            // Event: Modal show
            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget; // Button that triggered the modal
                const imagePath = button.getAttribute('data-image-path');
                const imageTitle = button.getAttribute('data-image-title');
                const imageId = button.getAttribute('data-image-id');

                // Update the modal's content
                document.getElementById('previewImage').src = imagePath;
                document.getElementById('previewTitle').textContent = imageTitle;

                // Populate hidden fields with image ID
                document.getElementById('replaceImageId').value = imageId;
                document.getElementById('changeSectionImageId').value = imageId;
                document.getElementById('addToGalleryImageId').value = imageId;

                // Update form actions dynamically
                document.getElementById('replaceForm').action = `/images/${imageId}/replace`;
                document.getElementById('changeSectionForm').action = `/images/${imageId}/change-section`;
                document.getElementById('addToGalleryForm').action = `/images/${imageId}/add-to-gallery`;
            });

            // Replace Image AJAX
            const replaceInput = document.getElementById('replaceImageInput');
            replaceInput.addEventListener('change', () => {
                const replaceForm = document.getElementById('replaceForm');
                const formData = new FormData(replaceForm);
                const imageId = document.getElementById('replaceImageId').value;

                fetch(replaceForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update the displayed image in modal and page
                            document.querySelector(`[data-image-id="${imageId}"] img`).src = data.newPath;
                            document.getElementById('previewImage').src = data.newPath;

                            // Update data-image-path attribute
                            const imageElement = document.querySelector(`[data-image-id="${imageId}"]`);
                            imageElement.setAttribute('data-image-path', data.newPath);

                            alert(data.message);
                        } else {
                            alert('Error replacing image');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });

            // Change Section AJAX
            const changeSectionSelect = document.getElementById('changeSectionSelect');
            changeSectionSelect.addEventListener('change', () => {
                const changeSectionForm = document.getElementById('changeSectionForm');
                const formData = new FormData(changeSectionForm);

                fetch(changeSectionForm.action, {
                    method: 'PATCH',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                        } else {
                            alert('Error updating section');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });

            // Add to Gallery AJAX
            const addToGallerySelect = document.getElementById('addToGallerySelect');
            addToGallerySelect.addEventListener('change', () => {
                const addToGalleryForm = document.getElementById('addToGalleryForm');
                const formData = new FormData(addToGalleryForm);

                fetch(addToGalleryForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                        } else {
                            alert('Error updating gallery');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        // Function to copy image URL to clipboard
        function copyImageUrl() {
            const previewImage = document.getElementById('previewImage');
            const imageUrl = previewImage.src;
            navigator.clipboard.writeText(imageUrl).then(() => {
                alert('Image URL copied to clipboard!');
            }).catch(err => {
                console.error('Error copying URL:', err);
            });
        }
    </script>
@endpush
