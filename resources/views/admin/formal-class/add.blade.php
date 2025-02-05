@extends('layouts.admin')

@section('title')
    Thêm lớp hành chính
@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row mb-4">
            <div class="col-12 col-md">
                <h2>Lớp hành chính</h2>
            </div>

            <div class="col-12 col-md d-flex justify-content-start justify-content-md-end me-sm-5 me-1">
                <nav class="d-flex align-items-center" aria-label="breadcrumb">
                    <ol class="breadcrumb overflow-hidden text-center m-0">
                        <li class="breadcrumb-item d-flex align-items-end">
                            <a class="underline_center link-danger fw-semibold text-decoration-none"
                                href="{{ route('dashboard') }}">
                                Trang chủ
                            </a>
                        </li>

                        <li class="breadcrumb-item d-flex align-items-end">
                            <a class="underline_center link-danger fw-semibold text-decoration-none"
                                href="{{ route('formal-class.index') }}">
                                Lớp hành chính
                            </a>
                        </li>

                        <li class="breadcrumb-item active d-flex align-items-end" aria-current="page">
                            <span>Thêm lớp hành chính</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div
                class="container col-md col-12 bg-body-secondary rounded-3 p-4 border-primary border-4 border-bottom-0 border-start-0 border-end-0">
                <h4 class="text-danger mb-3">Thêm lớp hành chính</h4>

                <form class="needs-validation" method="POST" action="{{ route('formal-class.store') }}" novalidate>
                    @csrf

                    <div class="row g-3 d-flex justify-content-between">
                        <div class="col-lg-6 col-12">
                            <label for="class_code" class="form-label fw-bold">Lớp hành chính</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <input type="text"
                                    class="form-control @error('class_code') is-invalid @enderror @if (old('class_code') && !$errors->has('class_code')) is-valid @endif"
                                    id="class_code" name="class_code" placeholder="Ex: D21CQVT03-B"
                                    value="{{ old('class_code') }}">

                                @error('class_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('class_code'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-5 col-12">
                            <label for="major_code" class="form-label fw-bold">Ngành</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <select
                                    class="form-select @error('major_code') is-invalid @enderror @if (old('major_code') && !$errors->has('major_code')) is-valid @endif"
                                    id="major_code" name="major_code" aria-label="Select major">
                                    <option value="">Chọn ngành</option>
                                    @foreach ($majors as $major)
                                        <option value="{{ $major->major_code }}"
                                            @if (old('major_code') === $major->major_code) selected @endif>
                                            {{ $major->major_name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('major_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('major_code'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="mgv" class="form-label fw-bold">Cố vấn học tập</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <select
                                    class="form-select @error('mgv') is-invalid @enderror @if (old('mgv') && !$errors->has('mgv')) is-valid @endif"
                                    id="mgv" name="mgv" aria-label="Select teacher">
                                    <option value="">Chọn giảng viên</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->mgv }}"
                                            @if (old('mgv') === $teacher->mgv) selected @endif>
                                            {{ $teacher->name . ' - ' . $teacher->mgv }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('mgv')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('mgv'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-3">
                        <button class="btn btn-success rounded-1 " type="submit">
                            {{ __('Update') }}
                        </button>

                        <a href="{{ route('formal-class.index') }}" class="btn btn-outline-danger rounded-1">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Mask formal class
        document.addEventListener('DOMContentLoaded', function() {
            const formalClass = document.getElementById('class_code');
            const maskClass = {
                mask: '{D}00{CQ}aa00{-B}',
                lazy: false,
                blocks: {
                    a: {
                        mask: 'a',
                        prepareChar: str => str.toUpperCase(),
                        commit: (value, masked) => {
                            masked._value = value.toLowerCase();
                        },
                    }
                }
            };
            const mask = IMask(formalClass, maskClass);
        });
    </script>
@endsection
