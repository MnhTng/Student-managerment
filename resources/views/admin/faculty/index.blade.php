@extends('layouts.admin')

@section('title')
    Khoa
@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">
        @if (session('success'))
            <div class="add-item"></div>
        @endif

        <div class="row mb-4">
            <div class="col-12 col-md">
                <h2>Khoa</h2>

                <div>
                    <div class="d-flex align-items-center" aria-label="breadcrumb">
                        <ol class="breadcrumb overflow-hidden text-center m-0">
                            <li class="breadcrumb-item d-flex align-items-end">
                                <a class="underline_center link-danger fw-semibold text-decoration-none "
                                    href="{{ route('dashboard') }}">
                                    Trang chủ
                                </a>
                            </li>

                            <li class="breadcrumb-item active d-flex align-items-end" aria-current="page">
                                Khoa
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md d-flex justify-content-start justify-content-md-end mt-md-0 mt-3">
                <a href="{{ route('faculty.create') }}" class="btn btn-bd-primary d-flex gap-2 align-items-center p-2"
                    style="height: fit-content;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" class="size-6"
                        width="24" height="24">
                        <path
                            d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                    </svg>

                    <span>Thêm khoa</span>
                </a>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 gx-4 gy-5">
            @foreach ($faculties as $faculty)
                <div class="faculty-item col position-relative">
                    <div class="faculty-edit position-absolute d-flex align-items-start gap-2">
                        <div class="faculty-action border border-info border-3 rounded p-2">
                            <a href="{{ route('major.create', $faculty->faculty_code) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor"
                                    width="27" height="27">
                                    <path
                                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                                </svg>
                            </a>
                        </div>

                        <div class="faculty-action border border-info border-3 rounded p-2">
                            <a href="{{ route('faculty.edit', $faculty->faculty_code) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor"
                                    width="24" height="24">
                                    <path
                                        d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1 0 32c0 8.8 7.2 16 16 16l32 0zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z" />
                                </svg>
                            </a>
                        </div>

                        <div class="faculty-action delete-faculty border border-info border-3 rounded p-2"
                            data-faculty="{{ $faculty->faculty_code }}">
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor"
                                    width="24" height="24">
                                    <path
                                        d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="card border-primary border-4 border-bottom-0 border-start-0 border-end-0">
                        <div class="card-header text-center fw-bold fs-4">
                            {{ $faculty->faculty_name }}
                        </div>

                        <ul class="list-group list-group-flush">
                            @foreach ($faculty->majors as $major)
                                <li class="list-group-item d-flex flex-nowrap justify-content-between gap-2">
                                    <span>{{ $major->major_name }}</span>

                                    <div class="d-flex flex-nowrap gap-2">
                                        <a href="{{ route('major.edit', $major->major_code) }}"
                                            class="btn btn btn-bd-primary gap-2 align-items-center p-2"
                                            style="height: fit-content;">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                fill="currentColor" width="18" height="18">
                                                <path
                                                    d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z" />
                                            </svg>
                                        </a>

                                        <button class="delete-major btn btn-bd-danger gap-2 align-items-center p-2"
                                            style="height: fit-content;" data-major="{{ $major->major_code }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                fill="currentColor" width="18" height="18">
                                                <path
                                                    d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z" />
                                            </svg>
                                        </button>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        // Sweet Alert: Delete faculty
        const delete_faculty = document.querySelectorAll('.delete-faculty');

        delete_faculty.forEach(faculty => {
            faculty.addEventListener('click', () => {
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
                                const code = faculty.getAttribute('data-faculty');

                                window.location.href =
                                    "{{ route('faculty.destroy', 'faculty_code') }}"
                                    .replace('faculty_code', code);
                            }
                        });
                    }
                });
            });
        });

        // Sweet Alert: Delete major
        const delete_major = document.querySelectorAll('.delete-major');

        delete_major.forEach(major => {
            major.addEventListener('click', () => {
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
                                const code = major.getAttribute('data-major');

                                window.location.href =
                                    "{{ route('major.destroy', 'major_code') }}"
                                    .replace('major_code', code);
                            }
                        });
                    }
                });
            });
        });

        // Sweet Alert: Add faculty
        const add_item = document.querySelector('.add-item');

        window.addEventListener('load', () => {
            if (add_item) {
                const Toast = Swal.mixin({
                    toast: true,
                    background: "rgb(235, 255, 246)",
                    color: "rgb(29, 110, 7)",
                    position: "bottom-end",
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    },
                    customClass: {
                        closeButton: 'd-flex text-success',
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "{{ session('success') }}"
                });
            }
        });

        // Change Card header border color when theme changed
        const card_header = document.querySelectorAll('.card-header');

        window.addEventListener('load', () => {
            const window_theme = document.querySelector('html').getAttribute('data-bs-theme');

            if (window_theme === 'light') {
                card_header.forEach(header => {
                    header.style.borderBottom = '1px solid #343a40';
                });
            } else if (window_theme === 'dark') {
                card_header.forEach(header => {
                    header.style.borderBottom = '1px solid #f8f9fa';
                });
            }
        });

        window.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('[data-bs-theme-value]').forEach(toggle => {
                toggle.addEventListener('click', () => {
                    const theme = toggle.getAttribute('data-bs-theme-value');

                    if (theme === 'light') {
                        card_header.forEach(header => {
                            header.style.borderBottom = '1px solid #343a40';
                        });
                    } else if (theme === 'dark') {
                        card_header.forEach(header => {
                            header.style.borderBottom = '1px solid #f8f9fa';
                        });
                    }
                });
            });
        });
    </script>
@endsection
