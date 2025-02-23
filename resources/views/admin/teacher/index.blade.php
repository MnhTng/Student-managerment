@extends('layouts.admin')

@section('title')
    {{ __('Teacher') }}
@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">
        @if (session('success'))
            <div class="add-item"></div>
        @endif

        @if (session('error'))
            <div class="error-item"></div>
        @endif

        <div class="row mb-4">
            <div class="col-12 col-md">
                <h2>{{ __('Teacher') }}</h2>

                <div>
                    <nav class="d-flex align-items-center" aria-label="breadcrumb">
                        <ol class="breadcrumb overflow-hidden text-center m-0">
                            <li class="breadcrumb-item d-flex align-items-end">
                                <a class="underline_center link-danger fw-semibold text-decoration-none "
                                    href="{{ route('dashboard') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>

                            <li class="breadcrumb-item active d-flex align-items-end" aria-current="page">
                                {{ __('Teacher') }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="col-12 col-md d-flex justify-content-start justify-content-md-end mt-md-0 mt-3">
                <a href="{{ route('teacher.create') }}" class="btn btn-bd-primary d-flex gap-2 align-items-center p-2"
                    style="height: fit-content;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" class="size-6"
                        width="24" height="24">
                        <path
                            d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                    </svg>

                    <span>{{ __('Add Teacher') }}</span>
                </a>
            </div>
        </div>

        <div class="row table-responsive">
            <table class="data-table table table-striped table-hover" style="--bs-table-hover-bg: rgba(211, 253, 80, 0.2);">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('Teacher Code') }}</th>
                        <th scope="col">{{ __('Full Name') }}</th>
                        <th scope="col">{{ __('Birthday') }}</th>
                        <th scope="col">{{ __('Gender') }}</th>
                        <th scope="col">{{ __('Address') }}</th>
                        <th scope="col">{{ __('Phone') }}</th>
                        <th scope="col">{{ __('Email') }}</th>
                        <th scope="col">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @php
                        $i = 1;
                    @endphp

                    @foreach ($teachers as $teacher)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $teacher->mgv }}</td>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->birthday }}</td>
                            <td>{{ $teacher->gender }}</td>
                            <td>{{ $teacher->address }}</td>
                            <td>{{ $teacher->phone }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>
                                <div class="d-flex flex-nowrap">
                                    <a href="{{ route('teacher.edit', $teacher->mgv) }}"
                                        class="btn btn-sm btn-outline-success border-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor"
                                            width="18" height="18">
                                            <path
                                                d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z" />
                                        </svg>
                                    </a>

                                    <button class="delete-teacher btn btn-sm btn-outline-danger border-0"
                                        data-teacher="{{ $teacher->mgv }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor"
                                            width="18" height="18">
                                            <path
                                                d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- ! Import Excel Form --}}
    <div id="import-excel-form" class="d-none d-flex justify-content-center">
        <form action="{{ route('import.teacher') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="file" class="hover-btn-1">
                <span>{{ __('Import Excel') }}</span>
                <span></span>
            </label>
            <input type="file" id="file" name="file" class="d-none" required>

            <button type="submit" class="visually-hidden">Import</button>
        </form>
    </div>

    <script>
        // Sweet Alert: Delete teacher
        const deleteTeacher = document.querySelectorAll('.delete-teacher');

        deleteTeacher.forEach((teacher) => {
            teacher.addEventListener('click', () => {
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
                                const code = teacher.getAttribute('data-teacher');

                                window.location.href =
                                    "{{ route('teacher.destroy', 'mgv') }}"
                                    .replace('mgv', code);
                            }
                        });
                    }
                });
            });
        });

        // Sweet Alert: Add teacher
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
