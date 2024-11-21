<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <h6 class="font-weight-semibold text-lg mb-0">Page Details: {{ $page->title }}</h6>
                            <p class="text-sm">Slug: {{ $page->slug }}</p>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-3">Sections</h5>
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
                                                        <h6 class="mb-0 text-sm">{{ $section->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $section->order }}</p>
                                            </td>
                                            <td>
                                                <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-link text-secondary mb-0">
                                                    <i class="fa fa-edit text-xs"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('site-pages.edit', ['site_page' => 1]) }}" class="btn btn-primary">Edit Page</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>
</x-app-layout>
