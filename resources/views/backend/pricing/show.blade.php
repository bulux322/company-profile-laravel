@extends('backend.layouts.main')

@section('content')
    <div class="row mx-1">
        <!-- Basic Breadcrumb -->
        <nav aria-label="breadcrumb mx-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('pricing.index') }}">Pricing</a>
                </li>
                <li class="breadcrumb-item active">Details</li>
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
            <h3 class="card-head my-2 mx-2 mt-3">{{ $title }} - Details</h3>
            <div class="card-body mx-2">
                <div class="d-flex">
                    <div class="p-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                            Add
                        </button>
                    </div>
                    <div class="p-2">
                        <a href="{{ route('pricing.show', $pricing->id) }}" class="btn btn-info">Refresh</a>
                    </div>
                    <div class="p-2">
                        <a href="{{ route('pricing.index', $pricing->id) }}" class="btn btn-info">Kembali</a>
                    </div>
                </div>
                <div class="table-responsive text-nowrap" style="padding-bottom: 100px">
                    <table class="table">
                        <thead>
                            <tr align="center">
                                <th width="30px">No</th>
                                <th>Detail</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @if ($pricing->count())
                                @foreach ($pricing->detail as $item)
                                    <tr>
                                        <td align="center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->list }} </td>
                                        <td align="center">
                                            <form action="{{ route('pricing.detailStore', $item->id) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure?')"><i
                                                        class="bx bx-trash me-1"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" align="center">No Data</td>
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
                    <h5 class="modal-title" id="exampleModalLabel2">Add Detail</h5>
                </div>
                <form action="{{ route('pricing.detailStore', $pricing->id) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="list" class="form-label">Detail</label>
                                <textarea name="list" id="list" class="form-control @error('list') is-invalid @enderror" placeholder="list"
                                    aria-label="list">{{ old('list') }}</textarea>
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
