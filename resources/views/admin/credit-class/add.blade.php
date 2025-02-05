@extends('layouts.admin')

@section('title')
    Thêm lớp tín chỉ
@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">
        @if (session('error'))
            <div class="error-item"></div>
        @endif

        <div class="row mb-4">
            <div class="col-12 col-md">
                <h2>Lớp tín chỉ</h2>
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
                                href="{{ route('credit-class.index') }}">
                                Lớp tín chỉ
                            </a>
                        </li>

                        <li class="breadcrumb-item active d-flex align-items-end" aria-current="page">
                            <span>Thêm lớp tín chỉ</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div
                class="container col-md col-12 bg-body-secondary rounded-3 p-4 border-primary border-4 border-bottom-0 border-start-0 border-end-0">
                <h4 class="text-danger mb-3">Thêm lớp tín chỉ</h4>

                <form class="repeater needs-validation d-grid gap-3" method="POST"
                    action="{{ route('credit-class.store') }}" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="row g-3 d-flex justify-content-between">
                        <div class="col-lg-5 col-12">
                            <label for="room" class="form-label fw-bold">Phòng</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <input type="text"
                                    class="form-control @error('room') is-invalid @enderror @if (old('room') && !$errors->has('room')) is-valid @endif"
                                    id="room" name="room" placeholder="Phòng" value="{{ old('room') }}">

                                @error('room')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('room'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-5 col-12">
                            <label for="school_year" class="form-label fw-bold">Năm học</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <select
                                    class="form-select @error('school_year') is-invalid @enderror @if (old('school_year') && !$errors->has('school_year')) is-valid @endif"
                                    id="school_year" name="school_year" aria-label="Select school year">
                                    <option class="bg-body" value="">Chọn năm học</option>

                                    @foreach ($school_years as $year)
                                        <option class="bg-body" value="{{ $year->slug }}"
                                            @if (old('school_year') === $year->slug) selected @endif>
                                            {{ 'Kỳ ' . $year->semester . ' năm học ' . $year->school_term }}
                                        </option>
                                    @endforeach
                                </select>

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

                    <div class="row g-3 d-flex justify-content-between">
                        <div class="col-12">
                            <label for="teacher" class="form-label fw-bold">Giảng viên</label>

                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <select
                                    class="form-select @error('teacher') is-invalid @enderror @if (old('teacher') && !$errors->has('teacher')) is-valid @endif"
                                    id="teacher" name="teacher" aria-label="Select teacher">
                                    <option value="">Chọn giảng viên</option>

                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->mgv }}"
                                            @if (old('teacher') === $teacher->mgv) selected @endif>
                                            {{ $teacher->name . ' - ' . $teacher->mgv }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('teacher')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('teacher'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="student" class="form-label fw-bold">Sinh viên</label>
                            <div data-repeater-list="students">
                                <div data-repeater-item>
                                    <div class="input-group has-validation mb-3">
                                        <span class="input-group-text border-0 bg-dark">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                                fill="currentColor" width="18" height="18" class="text-info">
                                                <path
                                                    d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                            </svg>
                                        </span>
                                        <input type="text"
                                            class="form-control @error('student') is-invalid @enderror @if (old('student') && !$errors->has('student')) is-valid @endif"
                                            id="student" name="student" placeholder="Họ tên - Mã sinh viên"
                                            list="students" value="{{ old('student') }}">
                                        <datalist id="students">
                                            @foreach ($students as $student)
                                                <option value="{{ $student->name . '-' . $student->msv }}">
                                                    {{ $student->class_code }}
                                                </option>
                                            @endforeach
                                        </datalist>

                                        <input data-repeater-delete type="button" value="Xóa"
                                            class="btn btn-danger p-2" />

                                        @error('student')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        @if (!$errors->has('student'))
                                            <div class="valid-feedback">
                                                {{ __('Look good!') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <input data-repeater-create type="button" value="Thêm sinh viên" class="btn btn-primary" />
                        </div>

                        <div class="col-12">
                            <label for="subject" class="form-label fw-bold">Môn học</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <select
                                    class="form-select @error('subject') is-invalid @enderror @if (old('subject') && !$errors->has('subject')) is-valid @endif"
                                    id="subject" name="subject" aria-label="Select subject">
                                    <option class="bg-body" value="">Chọn môn học</option>

                                    @foreach ($subjects as $subject)
                                        <option class="bg-body" value="{{ $subject->subject_code }}"
                                            @if (old('subject') === $subject->subject_code) selected @endif>
                                            {{ $subject->subject_name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('subject')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('subject'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 d-flex justify-content-between">
                        <div class="col-lg-5 col-12">
                            <label for="start_time" class="form-label fw-bold">Thời gian bắt đầu</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <input type="datetime-local"
                                    class="form-control @error('start_time') is-invalid @enderror @if (old('start_time') && !$errors->has('start_time')) is-valid @endif"
                                    id="start_time" name="start_time" placeholder="Thời gian bắt đầu"
                                    value="{{ old('start_time') }}">

                                @error('start_time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('start_time'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-5 col-12">
                            <label for="end_time" class="form-label fw-bold">Thời gian kết thúc</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <input type="datetime-local"
                                    class="form-control @error('end_time') is-invalid @enderror @if (old('end_time') && !$errors->has('end_time')) is-valid @endif"
                                    id="end_time" name="end_time" placeholder="Thời gian kết thúc"
                                    value="{{ old('end_time') }}">

                                @error('end_time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('end_time'))
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

                        <a href="{{ route('credit-class.index') }}" class="btn btn-outline-danger rounded-1">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('/lib/jquery/jquery.repeater.min.js') }}"></script>
    <script>
        // Mask room
        $(document).ready(function() {
            const room = document.getElementById('room');
            const maskRoom = {
                mask: 'a',
                lazy: false,
                blocks: {
                    a: {
                        mask: /^[\w/\-]{1,}$/,
                        prepareChar: str => str.toUpperCase(),
                        commit: (value, masked) => {
                            masked._value = value.toLowerCase();
                        },
                    }
                }
            };
            const mask = IMask(room, maskRoom);
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

        // Repeater
        $('.repeater').repeater({
            isFirstItemUndeletable: true,
            show: function() {
                $(this).slideDown();
            },
            hide: function(deleteElement) {
                Swal.fire({
                    title: "{{ __('Are you sure?') }}",
                    text: "{{ __("You won't be able to revert this!") }}",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "{{ __('Cancel') }}",
                    confirmButtonText: "{{ __('Yes, delete it!') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: "success",
                            title: "{{ __('Deleted!') }}",
                            text: "{{ __('Your file has been deleted.') }}",
                            confirmButtonText: "{{ __('Confirm') }}"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $(this).slideUp(deleteElement);
                            }
                        });
                    }
                });
            },
            ready: function(setIndexes) {}
        });
    </script>
@endsection
