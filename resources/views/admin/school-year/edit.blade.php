@extends('layouts.admin')

@section('title')
    Cập nhật niên học
@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">
        @if (session('error'))
            <div class="error-item"></div>
        @endif

        <div class="row mb-4">
            <div class="col-12 col-md">
                <h2>Niên học</h2>
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
                                href="{{ route('school-year.index') }}">
                                Niên học
                            </a>
                        </li>

                        <li class="breadcrumb-item active d-flex align-items-end" aria-current="page">
                            <span>Cập nhật niên học</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div
                class="container col-md col-12 bg-body-secondary rounded-3 p-4 border-primary border-4 border-bottom-0 border-start-0 border-end-0">
                <h4 class="text-danger mb-3">Cập nhật niên học</h4>

                <form class="needs-validation" method="POST" action="{{ route('school-year.update', $school_year->slug) }}"
                    novalidate>
                    @csrf

                    <div class="row g-5">
                        <div class="col-lg-4 col-12">
                            <label for="school_year" class="form-label fw-bold">Năm học</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <input type="text"
                                    class="form-control @error('school_year') is-invalid @enderror @if (old('school_year') && !$errors->has('school_year')) is-valid @endif"
                                    id="school_year" name="school_year" placeholder="Năm học"
                                    value="{{ old('school_year') ?? $school_year->school_term }}">

                                @error('school_year')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('school_year'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="my-3">
                        <h4 class="mb-3">Kỳ học tùy chọn</h4>

                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="semester-1" name="semester" value="1"
                                @if ((old('semester') ?? $school_year->semester) == 1) checked @endif>
                            <label class="form-check-label" for="semester-1">Kỳ 1</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="semester-2" name="semester" value="2"
                                @if ((old('semester') ?? $school_year->semester) == 2) checked @endif>
                            <label class="form-check-label" for="semester-2">Kỳ 2</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="semester-3" name="semester" value="3"
                                @if ((old('semester') ?? $school_year->semester) == 3) checked @endif>
                            <label class="form-check-label" for="semester-3">Kỳ
                                3</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="semester-4" name="semester" value="4"
                                @if ((old('semester') ?? $school_year->semester) == 4) checked @endif>
                            <label class="form-check-label" for="semester-4">Kỳ 4</label>
                        </div>

                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="semester-5" name="semester" value="5"
                                @if ((old('semester') ?? $school_year->semester) == 5) checked @endif>
                            <label class="form-check-label" for="semester-5">Kỳ 5</label>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-3">
                        <button class="btn btn-success rounded-1 " type="submit">
                            {{ __('Update') }}
                        </button>

                        <a href="{{ route('school-year.index') }}" class="btn btn-outline-danger rounded-1">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Mask school year
        const format_school_year = function(mask) {
            const value = mask.value;
            const parts = value.split('-');

            // Kiểm tra nếu có đủ hai phần
            if (parts.length === 2 && !(parts[0].includes('_'))) {
                let firstPart = parseFloat(parts[0]);
                let secondPart = firstPart + 1;

                mask.value = firstPart + '-' + secondPart;
            } else {
                mask.value = '';
            }

            return mask.value;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const year = document.getElementById('school_year');

            const maskYear = {
                mask: '20XX-20{YY}',
                lazy: false,
                blocks: {
                    '20': {
                        mask: IMask.MaskedRange,
                        from: 20,
                        to: 20
                    },
                    XX: {
                        mask: IMask.MaskedRange,
                        from: 0,
                        to: 98,
                        autofix: true
                    },
                    YY: {
                        mask: IMask.MaskedRange,
                        from: 00,
                        to: 99,
                    }
                },
                autofix: true,
                overwrite: true,
            };
            const mask = IMask(year, maskYear);

            window.addEventListener('load', function() {
                mask.value = format_school_year(mask);
            });

            year.addEventListener('change', function() {
                mask.value = format_school_year(mask);
            });

            $('form').on('submit', function() {
                mask.value = format_school_year(mask);
            });
        });

        // Sweet Alert: Error Messages
        document.addEventListener('DOMContentLoaded', function() {
            const error_item = document.querySelector('.error-item');

            if (error_item) {
                const Toast = Swal.mixin({
                    toast: true,
                    background: "rgb(255, 235, 235)",
                    color: "rgb(110, 29, 29)",
                    position: "bottom-end",
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    },
                    customClass: {
                        closeButton: 'd-flex text-danger',
                    }
                });
                Toast.fire({
                    icon: "error",
                    title: "{{ session('error') }}"
                });
            }
        });
    </script>
@endsection
