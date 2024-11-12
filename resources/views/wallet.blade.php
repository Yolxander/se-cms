<x-app-layout>
    <main class="main-content max-height-vh-100 h-100">
        <div class="pt-5 pb-6 bg-cover" style="background-image: url('{{ asset('assets/img/header-blue-purple.jpg') }}')"></div>
        <div class="container my-3 py-3">
            <div class="row mt-n6 mb-6">
                <div class="col-lg-3 col-sm-6">
                    <div class="card blur border border-white mb-4 shadow-xs">
                        <div class="card-body p-4">
                            <div class="icon icon-shape bg-white shadow shadow-xs text-center border-radius-md d-flex align-items-center justify-content-center mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" height="19" width="19" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M11.584 2.376a.75.75 0 01.832 0l9 6a.75.75 0 11-.832 1.248L12 3.901 3.416 9.624a.75.75 0 01-.832-1.248l9-6z" />
                                    <path fill-rule="evenodd" d="M20.25 10.332v9.918H21a.75.75 0 010 1.5H3a.75.75 0 010-1.5h.75v-9.918a.75.75 0 01.634-.74A49.109 49.109 0 0112 9c2.59 0 5.134.202 7.616.592a.75.75 0 01.634.74zm-7.5 2.418a.75.75 0 00-1.5 0v6.75a.75.75 0 001.5 0v-6.75zm3-.75a.75.75 0 01.75.75v6.75a.75.75 0 01-1.5 0v-6.75a.75.75 0 01.75-.75zM9 12.75a.75.75 0 00-1.5 0v6.75a.75.75 0 001.5 0v-6.75z" clip-rule="evenodd" />
                                    <path d="M12 7.875a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z" />
                                </svg>
                            </div>
                            <p class="text-sm mb-1">Page Sections</p>
                            <h3 class="mb-0 font-weight-bold">{{ $page->sections->count() }}</h3>
                        </div>
                    </div>
                </div>
                <!-- Add more stat cards here if needed -->
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Edit Page: {{ $page->title }}</h6>
                                    <p class="text-sm mb-sm-0">Update your page content and sections</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('pages.update', $page->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $page->title }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $page->slug }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-control" id="type" name="type" required>
                                        <option value="home" {{ $page->type == 'home' ? 'selected' : '' }}>Home</option>
                                        <option value="rooms" {{ $page->type == 'rooms' ? 'selected' : '' }}>Rooms</option>
                                        <option value="amenities" {{ $page->type == 'amenities' ? 'selected' : '' }}>Amenities</option>
                                        <option value="activities" {{ $page->type == 'activities' ? 'selected' : '' }}>Activities</option>
                                        <option value="contact" {{ $page->type == 'contact' ? 'selected' : '' }}>Contact</option>
                                    </select>
                                </div>
                                <h6 class="font-weight-semibold text-lg mb-0">Sections</h6>
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Section Title</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Order</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($page->sections as $index => $section)
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="sections[{{ $index }}][id]" value="{{ $section->id }}">
                                                    <input type="text" class="form-control" name="sections[{{ $index }}][title]" value="{{ $section->title }}" required>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="sections[{{ $index }}][order]" value="{{ $section->order }}" required>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="collapse" data-bs-target="#section-content-{{ $index }}">Edit Content</button>
                                                </td>
                                            </tr>
                                            <tr class="collapse" id="section-content-{{ $index }}">
                                                <td colspan="3">
                                                    @foreach ($section->content as $contentIndex => $content)
                                                        <div class="mb-3">
                                                            <label for="content_{{ $index }}_{{ $contentIndex }}" class="form-label">Content {{ $contentIndex + 1 }}</label>
                                                            <input type="hidden" name="sections[{{ $index }}][content][{{ $contentIndex }}][id]" value="{{ $content->id }}">
                                                            <textarea class="form-control" id="content_{{ $index }}_{{ $contentIndex }}" name="sections[{{ $index }}][content][{{ $contentIndex }}][content]" rows="3" required>{{ $content->content }}</textarea>
                                                        </div>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="btn btn-primary mt-4">Update Page</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
