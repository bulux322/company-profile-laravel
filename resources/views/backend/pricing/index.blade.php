@extends('backend.layouts.main')

@section('content')
    <div class="row mx-1">
        <!-- Basic Breadcrumb -->
        <nav aria-label="breadcrumb mx-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">Pricing</li>
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
            <h3 class="card-head my-2 mx-2 mt-3">Pricing</h3>
            <div class="card-body mx-2">
                <div class="d-flex">
                    <div class="p-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                            Add
                        </button>
                    </div>
                    <div class="p-2">
                        <a href="{{ route('pricing.index') }}" class="btn btn-info">Refresh</a>
                    </div>
                    <div class="ms-auto p-2">{{ $pricing->links() }}</div>
                </div>
                <div class="table-responsive text-nowrap" style="padding-bottom: 150px">
                    <table class="table">
                        <thead>
                            <tr align="center">
                                <th width="30px">No</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th width="30px">Best Product</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @if ($pricing->count())
                                @foreach ($pricing as $item)
                                    <tr>
                                        <td align="center">{{ $pricing->firstItem() - 1 + $loop->iteration }}</td>
                                        <td>{{ strlen($item->title) >= 25 ? substr($item->title, 0, 25) . '...' : $item->title }}
                                        </td>
                                        <td>{{ strlen($item->category) >= 25 ? substr($item->category, 0, 25) . '...' : $item->category }}
                                        </td>
                                        <td align="center">
                                            @if ($item->best)
                                                <span class="badge badge-center rounded-pill bg-success">&#10003;</span>
                                            @else
                                                <span class="badge badge-center rounded-pill bg-danger">&#10007;</span>
                                            @endif
                                        </td>
                                        <td align="right">
                                            @IDR($item->price)
                                            @if ($item->payment_period == \App\Models\Backend\Pricing\Pricing::MONTHLY_PAYMENT)
                                                / Month
                                            @elseif ($item->payment_period == \App\Models\Backend\Pricing\Pricing::ANNUAL_PAYMENT)
                                                / Year
                                            @endif
                                        </td>
                                        <td align="center">
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="{{ route('pricing.show', $item->id) }}" class="dropdown-item">
                                                        <i class="bx bx-show-alt me-1"></i> Show Detail</a>
                                                    <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#editModal_{{ $item->id }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </button>
                                                    <form action="{{ route('pricing.destroy', $item->id) }}" method="post">
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
                                                    <h5 class="modal-title" id="exampleModalLabel2">Edit Pricing
                                                        {{ $item->title }}</h5>
                                                </div>
                                                <form action="{{ route('pricing.update', $item->id) }}" method="post">
                                                    @method('put')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="title" class="form-label">Title</label>
                                                                <input type="text" name="title" id="title"
                                                                    class="form-control @error('title') is-invalid @enderror"
                                                                    placeholder="Professional"
                                                                    value="{{ old('title', $item->title) }}" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="category" class="form-label">Category</label>
                                                                <input type="text" name="category" id="category"
                                                                    class="form-control @error('category') is-invalid @enderror"
                                                                    placeholder="Most Popular"
                                                                    value="{{ old('category', $item->category) }}" />
                                                            </div>
                                                        </div>
                                                        <div class="row ">
                                                            <div class="col mb-3">
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="best" id="best"
                                                                        {{ old('best', $item->best) ? 'checked' : '' }} />
                                                                    <label class="form-check-label" for="best">Best
                                                                        Product</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="price" class="form-label">Price</label>
                                                                <input type="number" name="price" id="price"
                                                                    class="form-control @error('price') is-invalid @enderror"
                                                                    placeholder="0"
                                                                    value="{{ old('price', $item->price) }}" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="payment_period" class="form-label">Period
                                                                    Payment</label>
                                                                <select
                                                                    class="form-select @error('payment_period') is-invalid @enderror"
                                                                    name="payment_period" id="payment_period">
                                                                    <option selected disabled>Choose one</option>
                                                                    @foreach (\App\Models\Backend\Pricing\Pricing::STATUS_FILTER_CHOICE as $value)
                                                                        <option value="{{ $value }}"
                                                                            {{ old('payment_period', $item->payment_period) == $value ? 'selected' : '' }}>
                                                                            {{ $value }}</option>
                                                                    @endforeach
                                                                </select>
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
                    <h5 class="modal-title" id="exampleModalLabel2">Add Pricing</h5>
                </div>
                <form action="{{ route('pricing.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title') is-invalid @enderror" placeholder="Professional"
                                    value="{{ old('title') }}" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" name="category" id="category"
                                    class="form-control @error('category') is-invalid @enderror"
                                    placeholder="Most Popular" value="{{ old('category') }}" />
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="best" id="best"
                                        {{ old('best') ? 'checked' : '' }} />
                                    <label class="form-check-label" for="best">Best
                                        Product</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" name="price" id="price"
                                    class="form-control @error('price') is-invalid @enderror" placeholder="0"
                                    value="{{ old('price') }}" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="payment_period" class="form-label">Period
                                    Payment</label>
                                <select class="form-select @error('payment_period') is-invalid @enderror"
                                    name="payment_period" id="payment_period">
                                    <option selected disabled>Choose one</option>
                                    @foreach (\App\Models\Backend\Pricing\Pricing::STATUS_FILTER_CHOICE as $value)
                                        <option value="{{ $value }}"
                                            {{ old('payment_period') == $value ? 'selected' : '' }}>
                                            {{ $value }}</option>
                                    @endforeach
                                </select>
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
