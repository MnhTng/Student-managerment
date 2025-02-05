@extends('layouts.admin')

@section('title')
    Trang chủ
@endsection

@php
    use Carbon\Carbon;
    $now = Carbon::now();
@endphp

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row mb-4">
            <div class="col-12 col-md">
                <h2>Trang chủ</h2>
            </div>
        </div>

        <div class="row gap-3 mb-4">
            <div class="col-12">
                <div class="row mb-5">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card shadow-sm mb-3" style="background: rgb(255, 40, 147);">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="card-title mb-3 text-white">GPA</h5>
                                    </div>

                                    <div class="col-4">
                                        <a href="{{ route('student.score') }}"
                                            class="dashboard-icon d-grid align-items-center justify-content-center rounded-circle text-white overflow-hidden position-relative @can('teacher') pe-none @endcan"
                                            style="width: 3rem; height: 3rem;background :rgb(164, 8, 81);">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                fill="currentColor" width="24" height="24">
                                                <path
                                                    d="M4.1 38.2C1.4 34.2 0 29.4 0 24.6C0 11 11 0 24.6 0L133.9 0c11.2 0 21.7 5.9 27.4 15.5l68.5 114.1c-48.2 6.1-91.3 28.6-123.4 61.9L4.1 38.2zm503.7 0L405.6 191.5c-32.1-33.3-75.2-55.8-123.4-61.9L350.7 15.5C356.5 5.9 366.9 0 378.1 0L487.4 0C501 0 512 11 512 24.6c0 4.8-1.4 9.6-4.1 13.6zM80 336a176 176 0 1 1 352 0A176 176 0 1 1 80 336zm184.4-94.9c-3.4-7-13.3-7-16.8 0l-22.4 45.4c-1.4 2.8-4 4.7-7 5.1L168 298.9c-7.7 1.1-10.7 10.5-5.2 16l36.3 35.4c2.2 2.2 3.2 5.2 2.7 8.3l-8.6 49.9c-1.3 7.6 6.7 13.5 13.6 9.9l44.8-23.6c2.7-1.4 6-1.4 8.7 0l44.8 23.6c6.9 3.6 14.9-2.2 13.6-9.9l-8.6-49.9c-.5-3 .5-6.1 2.7-8.3l36.3-35.4c5.6-5.4 2.5-14.8-5.2-16l-50.1-7.3c-3-.4-5.7-2.4-7-5.1l-22.4-45.4z" />
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                fill="currentColor" class="size-6 position-absolute end-100" width="24"
                                                height="24">
                                                <path
                                                    d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <h2 class="mb-0 fw-bold text-white">{{ number_format($gpa[0]->avg_score, 1) }}/4.0</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card shadow-sm mb-3" style="background: rgb(64, 74, 255);">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="card-title mb-3 text-white">Lớp</h5>
                                    </div>

                                    <div class="col-4">
                                        <a href="{{ route('student.formal-class') }}"
                                            class="dashboard-icon d-grid align-items-center justify-content-center rounded-circle text-white overflow-hidden position-relative @can('teacher') pe-none @endcan"
                                            style="width: 3rem; height: 3rem;background :rgb(46, 15, 184);">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="size-6" width="24" height="24">
                                                <path
                                                    d="M11.644 1.59a.75.75 0 0 1 .712 0l9.75 5.25a.75.75 0 0 1 0 1.32l-9.75 5.25a.75.75 0 0 1-.712 0l-9.75-5.25a.75.75 0 0 1 0-1.32l9.75-5.25Z" />
                                                <path
                                                    d="m3.265 10.602 7.668 4.129a2.25 2.25 0 0 0 2.134 0l7.668-4.13 1.37.739a.75.75 0 0 1 0 1.32l-9.75 5.25a.75.75 0 0 1-.71 0l-9.75-5.25a.75.75 0 0 1 0-1.32l1.37-.738Z" />
                                                <path
                                                    d="m10.933 19.231-7.668-4.13-1.37.739a.75.75 0 0 0 0 1.32l9.75 5.25c.221.12.489.12.71 0l9.75-5.25a.75.75 0 0 0 0-1.32l-1.37-.738-7.668 4.13a2.25 2.25 0 0 1-2.134-.001Z" />
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                fill="currentColor" class="size-6 position-absolute end-100" width="24"
                                                height="24">
                                                <path
                                                    d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <h2 class="mb-0 fw-bold text-white">{{ $student->class_code }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card shadow-sm" style="background: rgb(142, 217, 3);">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="card-title mb-3 text-white">Tín chỉ tích lũy</h5>
                                    </div>

                                    <div class="col-4">
                                        <a href="{{ route('student.credit-class') }}"
                                            class="dashboard-icon d-grid align-items-center justify-content-center rounded-circle text-white overflow-hidden position-relative @can('teacher') pe-none @endcan"
                                            style="width: 3rem; height: 3rem;background :rgb(61, 138, 14);">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                fill="currentColor" width="24" height="24">
                                                <path
                                                    d="M0 96C0 43 43 0 96 0l96 0 0 190.7c0 13.4 15.5 20.9 26 12.5L272 160l54 43.2c10.5 8.4 26 .9 26-12.5L352 0l32 0 32 0c17.7 0 32 14.3 32 32l0 320c0 17.7-14.3 32-32 32l0 64c17.7 0 32 14.3 32 32s-14.3 32-32 32l-32 0L96 512c-53 0-96-43-96-96L0 96zM64 416c0 17.7 14.3 32 32 32l256 0 0-64L96 384c-17.7 0-32 14.3-32 32z" />
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                fill="currentColor" class="size-6 position-absolute end-100" width="24"
                                                height="24">
                                                <path
                                                    d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <h2 class="mb-0 fw-bold text-white">{{ $credit_sum }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <h2 class="text-center fw-bold text-bg-danger rounded-top py-2">Lịch học</h2>
                <div id="calendar" class="col-lg col-12 shadow rounded-3 py-4 px-3"></div>
            </div>
        </div>
    </div>

    <script>
        const credit_classes = @json($credit_classes);
        const subjects = @json($subjects);
        const now = @json($now);
    </script>
    <script src="{{ asset('/js/calendar.js') }}" type="module"></script>
@endsection
