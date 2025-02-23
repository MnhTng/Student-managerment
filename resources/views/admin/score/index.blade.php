@extends('layouts.admin')

@section('title')
    {{ __('Credit Class List') }}
@endsection

@php
    use Carbon\Carbon;
@endphp

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
                <h2>{{ __('Credit Class List') }}</h2>

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
                                {{ __('Credit Class List') }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row table-responsive">
            <table class="data-table table table-striped table-hover" style="--bs-table-hover-bg: rgba(211, 253, 80, 0.2);">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('Student Code') }}</th>
                        <th scope="col">{{ __('Full Name') }}</th>
                        <th scope="col">{{ __('Subject') }}</th>
                        <th scope="col">{{ __('Score') }}</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @php
                        $i = 1;
                    @endphp

                    @foreach ($scores as $score)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $score->msv }}</td>
                            <td>{{ $score->student->name }}</td>
                            <td>{{ $score->subject->subject_name }}</td>
                            <td>{{ (float) $score->score }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Sweet Alert: Add score
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
