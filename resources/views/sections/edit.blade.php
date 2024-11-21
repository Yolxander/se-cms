<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
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
            @if(auth()->user()->isAdmin ?? '')
                <div class="row">
                    <div class="col-12">
                        <div class="card border shadow-xs mb-4">
                            <div class="card-header border-bottom pb-0">
                                <h6 class="font-weight-semibold text-lg mb-0">Section Details</h6>
                            </div>
                            <div class="card-body">
                                <!-- Display validation errors -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Display success message -->
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form action="{{ route('sections.update', $section->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="page" class="form-control-label">Page</label>
                                                <select class="form-control" id="page" name="page_id">
                                                    <option value="">Select a Page</option>
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
                                                <input class="form-control" type="text" id="name" name="name" value="{{ $section->name }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="order" class="form-control-label">Order</label>
                                                <input class="form-control" type="number" id="order" name="order" value="{{ $section->order }}" required>
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
            @endif

            <livewire:edit-section-content :section-id="$section->id" />


        </div>
    </main>
</x-app-layout>
