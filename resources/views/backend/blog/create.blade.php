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
                    <a href="{{ route('blog.index') }}">Blog</a>
                </li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
        <!-- Basic Breadcrumb -->

        <div class="card">
            <h3 class="card-head my-2 mx-2 mt-3">Create Blog </h3>
            <div class="card-body mx-2">
                <form action="{{ route('blog.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="title">Title <span
                                class="text-danger fw-bolder">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                id="title" placeholder="Blog's Kuroyasha" value="{{ old('title') }}" />
                            @error('title')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="subtitle">Subtitle </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                                name="subtitle" id="subtitle" placeholder="Kuroyasha" value="{{ old('subtitle') }}" />
                            @error('subtitle')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="article">Article <span
                                class="text-danger fw-bolder">*</span></label>
                        <div class="col-sm-10">
                            <textarea name="article" class="ckeditor" id="article">{{ old('article') }}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="subarticle">Sub Article </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('subarticle') is-invalid @enderror"
                                name="subarticle" id="subarticle" placeholder="Sub Article"
                                value="{{ old('subarticle') }}" />
                            @error('subarticle')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="paragraph">Paragraph </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('paragraph') is-invalid @enderror"
                                name="paragraph" id="paragraph" placeholder="Sub Article" value="{{ old('paragraph') }}" />
                            @error('paragraph')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="image" class="col-sm-2 col-form-label"> Image</label>
                        <div class="col-sm-10">
                            <img src="{{ asset('assets/img/default.png') }}" alt="image"
                                class="img-fluid d-block rounded my-2"
                                style="object-fit: contain; width: 100px; height: 100px;" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="image"
                                    class="btn @error('image')
                                btn-danger
                                @else
                                btn-primary
                                @enderror me-2 mb-2"
                                    tabindex="0">
                                    <span class="d-none d-sm-block">Upload Image</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" name="image" id="image" class="account-file-input" hidden
                                        accept="image/png, image/jpeg, image/jpg" onchange="previewImage()" />
                                </label>
                            </div>
                            <div class="form-text">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @else
                                    JPG, JPEG or PNG. Maksimal 2mb
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="category">Category </label>
                        <div class="col-sm-10">
                            <div class="col-md">
                                @if ($category->count())
                                    @foreach ($category as $item)
                                        <div class="form-check form-check-inline mb-3">
                                            <input class="form-check-input" type="checkbox" name="category[]"
                                                id="{{ $item->id }}" value="{{ $item->id }}" />
                                            <label class="form-check-label"
                                                for="{{ $item->id }}">{{ $item->category }}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="tag">Tag </label>
                        <div class="col-sm-10">
                            <div class="col-md">
                                @if ($tag->count())
                                    @foreach ($tag as $item)
                                        <div class="form-check form-check-inline mb-3">
                                            <input class="form-check-input" type="checkbox" name="tag[]"
                                                id="{{ $item->id }}" value="{{ $item->id }}" />
                                            <label class="form-check-label"
                                                for="{{ $item->id }}">#{{ $item->tag }}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('#uploadedAvatar');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush
