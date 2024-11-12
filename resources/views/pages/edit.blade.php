<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Edit Page: {{ $page->title }}</h6>
                                    <p class="text-sm mb-sm-0">Update your page content and manage sections</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('pages.update', $page->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $page->title }}" required />
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $page->slug }}" required />
                                </div>

                                <h5 class="card-title mt-4 mb-3">Page Sections</h5>
                                <div class="table-responsive">
                                    <table class="table align-items-center justify-content-center mb-0">
                                        <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Section Title</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Order</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($page->sections as $section)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm">{{ $section->title }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">{{ $section->order }}</p>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-link text-secondary mb-0">
                                                        <i class="fa fa-edit text-xs"></i> Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="submit" class="btn btn-primary">Update Page</button>
                                    <a href="{{ route('sections.create', ['page_id' => $page->id]) }}" class="btn btn-secondary">Add New Section</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>
</x-app-layout>
