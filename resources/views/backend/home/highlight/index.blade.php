@extends('backend.layouts.main')

@section('content')
    <div class="row mx-1">
        <!-- Basic Breadcrumb -->
        <nav aria-label="breadcrumb mx-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">Highlight</li>
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
            <h3 class="card-head my-2 mx-2 mt-3">Highlight</h3>
            <div class="card-body mx-2">
                <div class="d-flex">
                    <div class="p-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                            Add
                        </button>
                    </div>
                    <div class="p-2">
                        <a href="{{ route('home.highlight.index') }}" class="btn btn-info">Refresh</a>
                    </div>
                    <div class="ms-auto p-2">{{ $highlight->links() }}</div>
                </div>
                <div class="table-responsive text-nowrap" style="padding-bottom: 100px">
                    <table class="table">
                        <thead>
                            <tr align="center">
                                <th width="30px">No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th width="30px">Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @if ($highlight->count())
                                @foreach ($highlight as $item)
                                    <tr>
                                        <td align="center">{{ $highlight->firstItem() - 1 + $loop->iteration }}</td>
                                        <td>{{ strlen($item->title) >= 12 ? substr($item->title, 0, 12) . '...' : $item->title }}
                                        </td>
                                        <td>{{ strlen($item->description) >= 50 ? substr($item->description, 0, 50) . '...' : $item->description }}
                                        </td>
                                        <td align="center">
                                            @if ($item->status)
                                                <span class="badge badge-center rounded-pill bg-success">&#10003;</span>
                                            @else
                                                <span class="badge badge-center rounded-pill bg-danger">&#10007;</span>
                                            @endif
                                        </td>
                                        <td align="center"><a
                                                href="{{ $item->image ? asset('storage/' . $item->image) : '#' }}"
                                                class="btn btn-primary" target="_blank">View</a></td>
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
                                                    <form action="{{ route('home.highlight.destroy', $item->id) }}"
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
                                                    <h5 class="modal-title" id="exampleModalLabel2">Edit Highlight
                                                        {{ $item->title }}</h5>
                                                </div>
                                                <form action="{{ route('home.highlight.update', $item->id) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @method('put')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="title" class="form-label">Title</label>
                                                                <input type="text" name="title" id="title"
                                                                    class="form-control @error('title') is-invalid @enderror"
                                                                    placeholder="Explore Your Team"
                                                                    value="{{ old('title', $item->title) }}" />
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
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="status" id="status"
                                                                        {{ old('status', $item->status) ? 'checked' : '' }} />
                                                                    <label class="form-check-label"
                                                                        for="status">Status</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="image" class="form-label">Image</label>
                                                                <input
                                                                    class="form-control @error('image') is-invalid @enderror"
                                                                    type="file" name="image" id="image" />
                                                                <div class="form-text">
                                                                    JPG, JPEG or PNG. Maksimal 2mb
                                                                </div>
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
                                    <td colspan="6" align="center">No Data</td>
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
                    <h5 class="modal-title" id="exampleModalLabel2">Add Highlight</h5>
                </div>
                <form action="{{ route('home.highlight.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    placeholder="Explore Your Team" value="{{ old('title') }}" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Description" aria-label="Description">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="status" id="status"
                                        {{ old('status') ? 'checked' : '' }} />
                                    <label class="form-check-label" for="status">Status</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input class="form-control @error('image') is-invalid @enderror" type="file"
                                    name="image" id="image" />
                                <div class="form-text">
                                    JPG, JPEG or PNG. Maksimal 2mb
                                </div>
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

@push('script')
    <script>
        $('#createModal').on('hidden.bs.modal', function() {
            $(this).find('form').trigger('reset');
        })
    </script>
@endpush
