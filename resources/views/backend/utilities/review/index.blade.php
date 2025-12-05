@extends('backend.layouts.main')

@section('content')
    <div class="row mx-1">
        <!-- Basic Breadcrumb -->
        <nav aria-label="breadcrumb mx-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">Review</li>
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
            <h3 class="card-head my-2 mx-2 mt-3">Review Customer</h3>
            <div class="card-body mx-2">
                <div class="d-flex">
                    <div class="p-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                            Add
                        </button>
                    </div>
                    <div class="p-2">
                        <a href="{{ route('review.index') }}" class="btn btn-info">Refresh</a>
                    </div>
                    <div class="ms-auto p-2">{{ $review->links() }}</div>
                </div>
                <div class="table-responsive text-nowrap" style="padding-bottom: 100px">
                    <table class="table">
                        <thead>
                            <tr align="center">
                                <th width="30px">No</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th width="30px">Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @if ($review->count())
                                @foreach ($review as $item)
                                    <tr>
                                        <td align="center">{{ $review->firstItem() - 1 + $loop->iteration }}</td>
                                        <td>
                                            {{ $item->name }} ({{ $item->star }} <span class="bi bi-star-fill"
                                                style="color: gold;"></span>)
                                        </td>
                                        <td>{{ strlen($item->subject) >= 12 ? substr($item->subject, 0, 12) . '...' : $item->subject }}
                                        </td>
                                        <td>{{ strlen($item->message) >= 50 ? substr($item->message, 0, 50) . '...' : $item->message }}
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
                                                    <form action="{{ route('review.destroy', $item->id) }}" method="post">
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
                                                    <h5 class="modal-title" id="exampleModalLabel2">Edit Review
                                                        {{ $item->title }}</h5>
                                                </div>
                                                <form action="{{ route('review.update', $item->id) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @method('put')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="name" class="form-label">Name</label>
                                                                <input type="text" name="name" id="name"
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    placeholder="Username"
                                                                    value="{{ old('name', $item->name) }}" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="subject" class="form-label">Subject</label>
                                                                <input type="text" name="subject" id="subject"
                                                                    class="form-control @error('subject') is-invalid @enderror"
                                                                    placeholder="Perfect Company"
                                                                    value="{{ old('subject', $item->subject) }}" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="message" class="form-label">Message</label>
                                                                <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror"
                                                                    placeholder="Message" aria-label="message">{{ old('message', $item->message) }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row g-2">
                                                            <div class="col mb-0">
                                                                <label class="form-label" for="star">Star</label>
                                                                <input type="number"
                                                                    class="form-control @error('star') is-invalid @enderror"
                                                                    name="star" id="star"
                                                                    placeholder="Rate 0 - 5"
                                                                    value="{{ old('star', $item->star) }}" />
                                                            </div>
                                                            <div class="col mb-0">
                                                                <div class="form-check form-switch mt-4 pt-3 ms-4">
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
                                                                    JPG, JPEG or PNG. Maksimal 800kb
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
                                    <td colspan="7" align="center">No Data</td>
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
                    <h5 class="modal-title" id="exampleModalLabel2">Add Review</h5>
                </div>
                <form action="{{ route('review.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Username"
                                    value="{{ old('name') }}" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" name="subject" id="subject"
                                    class="form-control @error('subject') is-invalid @enderror"
                                    placeholder="Perfect Company" value="{{ old('subject') }}" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror"
                                    placeholder="Message" aria-label="message">{{ old('message') }}</textarea>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label class="form-label" for="star">Star</label>
                                <input type="number" class="form-control @error('star') is-invalid @enderror"
                                    name="star" id="star" placeholder="Rate 0 - 5"
                                    value="{{ old('star') }}" />
                            </div>
                            <div class="col mb-0">
                                <div class="form-check form-switch mt-4 pt-3 ms-4">
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
                                    JPG, JPEG or PNG. Maksimal 800kb
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
