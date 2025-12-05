@extends('backend.layouts.main')

@section('content')
    <div class="row mx-1">
        <!-- Basic Breadcrumb -->
        <nav aria-label="breadcrumb mx-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">Blog</li>
            </ol>
        </nav>
        <!-- Basic Breadcrumb -->

        <div class="card">
            <h3 class="card-head my-2 mx-2 mt-3">Blog</h3>
            <div class="card-body mx-2">
                <div class="d-flex">
                    <div class="p-2">
                        <a href="{{ route('blog.create') }}" class="btn btn-primary">Add</a>
                    </div>
                    <div class="ms-auto p-2">{{ $blog->links() }}</div>
                </div>
                <div class="table-responsive text-nowrap" style="padding-bottom: 200px">
                    <table class="table">
                        <thead>
                            <tr align="center">
                                <th width="30px">No</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Author</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @if ($blog->count())
                                @foreach ($blog as $item)
                                    <tr>
                                        <td align="center">{{ $blog->firstItem() - 1 + $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->subtitle }}</td>
                                        <td>{{ $item->author->name }}</td>
                                        <td align="center">
                                            @if ($item->created_at->diffInWeeks(\Carbon\Carbon::now()) < 1)
                                                {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                            @else
                                                {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('D MMMM Y') }}
                                            @endif
                                        </td>
                                        <td align="center">
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="{{ route('frontend.blog.show', $item->id) }}"
                                                        class="dropdown-item" target="_blank"><i
                                                            class="bx bx-show me-1"></i> Show</a>
                                                    <a href="{{ route('blog.edit', $item->id) }}" class="dropdown-item"><i
                                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                                    <form action="{{ route('blog.destroy', $item->id) }}" method="post">
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

@endsection
