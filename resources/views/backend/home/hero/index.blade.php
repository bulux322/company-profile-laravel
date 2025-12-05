@extends('backend.layouts.main')

@section('content')
    <div class="row mx-1">
        <!-- Basic Breadcrumb -->
        <nav aria-label="breadcrumb mx-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">Hero</li>
            </ol>
        </nav>
        <!-- Basic Breadcrumb -->

        <div class="card">
            <h3 class="card-head my-2 mx-2 mt-3">Hero </h3>
            <div class="card-body mx-2">
                <form action="{{ route('home.hero.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="title">Title <span
                                class="text-danger fw-bolder">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                id="title" placeholder="Selamat datang di Company Profile"
                                value="{{ old('title', $hero->title ?? '') }}" />
                            @error('title')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="subtitle">Subtitle <span
                                class="text-danger fw-bolder">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                                name="subtitle" id="subtitle" placeholder="default subtitle"
                                value="{{ old('subtitle', $hero->subtitle ?? '') }}" />
                            @error('subtitle')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="image" class="col-sm-2 col-form-label"> Image</label>
                        <div class="col-sm-10">
                            <img src="{{ $hero && $hero->image !== null ? asset('storage/' . $hero->image) : asset('assets/img/default.png') }}"
                                alt="image" class="img-fluid d-block rounded my-2"
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
                        <label for="background_image" class="col-sm-2 col-form-label">Background Image</label>
                        <div class="col-sm-10">
                            <img src="{{ $hero && $hero->background_image !== null ? asset('storage/' . $hero->background_image) : asset('assets/frontend/assets/img/hero-bg.jpg') }}"
                                alt="Background" class="img-fluid d-block rounded my-2"
                                style="object-fit: cover; width: 100px; height: 100px;" id="uploadedBg" />
                            <div class="button-wrapper">
                                <label for="background_image"
                                    class="btn @error('background_image') btn-danger @else btn-primary @enderror me-2 mb-2"
                                    tabindex="0">
                                    <span class="d-none d-sm-block">Upload Background</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" name="background_image" id="background_image" class="account-file-input" hidden
                                        accept="image/png, image/jpeg, image/jpg" onchange="previewBackground()" />
                                </label>
                            </div>
                            <div class="form-text">
                                @error('background_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @else
                                    JPG, JPEG, atau PNG. Maksimal 2MB.
                                @enderror
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
        function previewBackground() {
            const image = document.querySelector('#background_image');
            const imgPreview = document.querySelector('#uploadedBg');
            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush
