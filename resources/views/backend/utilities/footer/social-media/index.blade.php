@extends('backend.layouts.main')

@section('content')
    <div class="row mx-1">
        <!-- Basic Breadcrumb -->
        <nav aria-label="breadcrumb mx-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">Social Media</li>
            </ol>
        </nav>
        <!-- Basic Breadcrumb -->
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="col-lg-12 mb-1">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="card">
            <h3 class="card-head my-2 mx-2 mt-3">Social Media</h3>
            <div class="card-body mx-2">
                <div class="d-flex">
                    <div class="p-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                            Add
                        </button>
                    </div>
                    <div class="p-2">
                        <a href="{{ route('footer.social-media.index') }}" class="btn btn-info">Refresh</a>
                    </div>
                    <div class="ms-auto p-2">{{ $socialMedia->links() }}</div>
                </div>
                <div class="table-responsive text-nowrap" style="padding-bottom: 100px">
                    <table class="table">
                        <thead>
                            <tr align="center">
                                <th width="30px">No</th>
                                <th>Social Media</th>
                                <th>Icon (BS)</th>
                                <th>URL</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @if ($socialMedia->count())
                                @foreach ($socialMedia as $item)
                                    <tr>
                                        <td align="center">{{ $socialMedia->firstItem() - 1 + $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td align="center" class="fs-3"><i class="{{ $item->icon }}"></i></td>
                                        <td><a href="{{ $item->url }}" target="__blank"
                                                class="text-dark">{{ $item->url }}</a></td>
                                        <td align="center">
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#editModal_{{ $item->id }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </button>
                                                    <form action="{{ route('footer.social-media.destroy', $item->id) }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Are you sure?')"><i
                                                                class="bx bx-trash me-1"></i> Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Edit Modal --}}
                                    <div class="modal fade" id="editModal_{{ $item->id }}" tabindex="-1"
                                        data-bs-backdrop="static" aria-hidden="true">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel2">Edit Social Media
                                                        {{ $item->name }}</h5>
                                                </div>
                                                <form action="{{ route('footer.social-media.update', $item->id) }}"
                                                    method="post">
                                                    @method('put')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="name" class="form-label">Name</label>
                                                                <input type="text" name="name" id="name"
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    placeholder="GitHub"
                                                                    value="{{ old('name', $item->name) }}" />
                                                            </div>
                                                        </div>
                                                        <div class="row g-2">
                                                            <div class="col mb-0">
                                                                <label class="form-label" for="icon">Icon (BS)</label>
                                                                <input type="text"
                                                                    class="form-control @error('icon') is-invalid @enderror"
                                                                    name="icon" id="icon" placeholder="bi bi-github"
                                                                    value="{{ old('icon', $item->icon) }}" />
                                                            </div>
                                                            <div class="col mb-0">
                                                                <label for="url" class="form-label">URL</label>
                                                                <input name="url" id="url" type="url"
                                                                    class="form-control @error('url') is-invalid @enderror"
                                                                    placeholder="https://instagram.com/username"
                                                                    value="{{ old('url', $item->url) }}" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="description"
                                                                    class="form-label">Description</label>
                                                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                                                    placeholder="Description" aria-label="Description">{{ old('description', $item->description) }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" align="center">No Data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- Add Modal --}}
    <div class="modal fade" id="createModal" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Add Social Media</h5>
                </div>
                <form action="{{ route('footer.social-media.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="GitHub"
                                    value="{{ old('name') }}" />
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label class="form-label" for="icon">Icon (BS)</label>
                                <input type="text" class="form-control @error('icon') is-invalid @enderror"
                                    name="icon" id="icon" placeholder="bi bi-github"
                                    value="{{ old('icon') }}" />
                            </div>
                            <div class="col mb-0">
                                <label for="url" class="form-label">URL</label>
                                <input name="url" id="url" type="url"
                                    class="form-control @error('url') is-invalid @enderror"
                                    placeholder="https://instagram.com/username" value="{{ old('url') }}" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Description" aria-label="Description">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush

@push('script')
    <script>
        $('#createModal').on('hidden.bs.modal', function() {
            $(this).find('form').trigger('reset');
        })
    </script>
@endpush
