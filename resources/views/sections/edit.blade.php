<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card card-background card-background-after-none align-items-start mt-4 mb-5">
                        <div class="full-background" style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
                        <div class="card-body text-start p-4 w-100">
                            <h3 class="text-white mb-2">Edit Section</h3>
                            <p class="mb-4 font-weight-semibold">
                                Update the details of your section here
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Details Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <h6 class="font-weight-semibold text-lg mb-0">Section Details</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('sections.update', $section->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="page" class="form-control-label">Page</label>
                                            <select class="form-control" id="page" name="page_id">
                                                @foreach($pages as $page)
                                                    <option value="{{ $page->id }}" {{ $section->page_id == $page->id ? 'selected' : '' }}>
                                                        {{ $page->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">Section Name</label>
                                            <input class="form-control" type="text" id="name" name="name" value="{{ $section->name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="order" class="form-control-label">Order</label>
                                            <input class="form-control" type="number" id="order" name="order" value="{{ $section->order }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="component_name" class="form-control-label">Component Name</label>
                                            <input class="form-control" type="text" id="component_name" name="component_name" value="{{ $section->component_name }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- Buttons to cancel or update -->
                                <div class="d-flex justify-content-end mt-4">
                                    <a href="{{ route('sections.index') }}" class="btn btn-light m-0">Cancel</a>
                                    <button type="submit" class="btn btn-dark m-0 ms-2">Update Section</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Content Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <h6 class="font-weight-semibold text-lg mb-0">Content</h6>
                        </div>
                        <div class="card-body">
                            @foreach($section->content as $content)
                                <div class="mb-3">
                                    <label for="{{ 'content_' . $content->id }}" class="form-control-label">{{ ucfirst($content->key) }}</label>

                                    @if($content->type == 'text')
                                        <input type="text"
                                               id="{{ 'content_' . $content->id }}"
                                               name="{{ 'content[' . $content->id . '][value]' }}"
                                               value="{{ $content->value }}"
                                               class="form-control"/>
                                    @elseif($content->type == 'textarea')
                                        <textarea id="{{ 'content_' . $content->id }}"
                                                  name="{{ 'content[' . $content->id . '][value]' }}"
                                                  rows="4"
                                                  class="form-control">{{ $content->value }}</textarea>
                                    @elseif($content->type == 'image')
                                        <input type="file"
                                               id="{{ 'content_' . $content->id }}"
                                               name="{{ 'content[' . $content->id . '][value]' }}"
                                               accept=".jpg,.jpeg,.png"
                                               class="form-control"/>
                                        @if($content->value)
                                            <img src="{{ $content->value }}" alt="{{ $content->key }}"
                                                 style="max-width: 200px;"
                                                 class="mt-2"/>
                                        @endif
                                    @endif

                                    <!-- Hidden fields to store key and type -->
                                    <input type='hidden' name='content[{{ $content->id }}][key]' value='{{ $content->key }}'>
                                    <input type='hidden' name='content[{{ $content->id }}][type]' value='{{ $content->type }}'>
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

        </div>
    </main>
</x-app-layout>
