@extends('layouts.admin')

@section('title')
    Lớp tín chỉ
@endsection

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row mb-4">
            <div class="col-12 col-md">
                <h2>Lớp tín chỉ</h2>

                <div>
                    <nav class="d-flex align-items-center" aria-label="breadcrumb">
                        <ol class="breadcrumb overflow-hidden text-center m-0">
                            <li class="breadcrumb-item d-flex align-items-end">
                                <a class="underline_center link-danger fw-semibold text-decoration-none "
                                    href="@can('teacher') {{ route('dashboard') }} @endcan @can('student') {{ route('student.dashboard') }} @endcan">
                                    Trang chủ
                                </a>
                            </li>

                            <li class="breadcrumb-item active d-flex align-items-end" aria-current="page">
                                Lớp tín chỉ
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @if (!$credit_classes)
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Chưa có lớp tín chỉ nào!</h4>
                <p class="mb-0">Vui lòng liên hệ với quản trị viên để được hỗ trợ.</p>
            </div>
        @else
            @can('teacher')
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 gx-4 gy-5">
                    @foreach ($credit_classes as $class)
                        <div class="credit-item col position-relative">
                            <div class="credit-edit position-absolute d-flex align-items-start gap-2">
                                <div class="credit-action border border-info border-3 rounded p-2">
                                    <a href="{{ route('score.show', $class->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" fill="currentColor"
                                            width="24" height="24">
                                            <path
                                                d="M2 334.5c-3.8 8.8-2 19 4.6 26l136 144c4.5 4.8 10.8 7.5 17.4 7.5s12.9-2.7 17.4-7.5l136-144c6.6-7 8.4-17.2 4.6-26s-12.5-14.5-22-14.5l-72 0 0-288c0-17.7-14.3-32-32-32L128 0C110.3 0 96 14.3 96 32l0 288-72 0c-9.6 0-18.2 5.7-22 14.5z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <div class="card border-primary border-4 border-bottom-0 border-start-0 border-end-0">
                                <div class="card-header text-center fw-bold d-grid">
                                    <div class="col-12 text-danger fs-3">
                                        {{ $class->room }}
                                    </div>

                                    <div class="col-12 fs-5">
                                        {{ $class->subject->subject_name }}
                                    </div>
                                </div>

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex flex-nowrap justify-content-between gap-2">
                                        @php
                                            $school_term = $class->school_years->school_term;
                                            $semester = $class->school_years->semester;
                                        @endphp

                                        <span class="fw-bold">Năm học:</span>
                                        <span>{{ 'Kỳ ' . $semester . ' năm học ' . $school_term }}</span>
                                    </li>

                                    <li class="list-group-item d-flex flex-nowrap justify-content-between gap-2">
                                        <span class="fw-bold">Giảng viên: </span>
                                        <span>{{ $class->teacher->name }}</span>
                                    </li>

                                    <li class="list-group-item d-flex flex-nowrap justify-content-between gap-2">
                                        @php
                                            $dayOfWeek = [
                                                0 => 'Chủ Nhật',
                                                1 => 'Thứ Hai',
                                                2 => 'Thứ Ba',
                                                3 => 'Thứ Tư',
                                                4 => 'Thứ Năm',
                                                5 => 'Thứ Sáu',
                                                6 => 'Thứ Bảy',
                                            ];

                                            $start_time = explode(' ', $class->start_time)[0];
                                            $day = Carbon::parse($start_time)->dayOfWeek;
                                            $day_now = Carbon::today()->startOfWeek();
                                            $schedule =
                                                $dayOfWeek[$day_now->copy()->addDays($day - 1)->dayOfWeek] .
                                                ' ' .
                                                $day_now
                                                    ->copy()
                                                    ->addDays($day - 1)
                                                    ->format('d/m/Y');
                                        @endphp

                                        <span class="fw-bold">Lịch dạy:</span>
                                        <span>{{ $schedule }}</span>
                                    </li>

                                    <li class="list-group-item d-flex flex-nowrap justify-content-between gap-2">
                                        @php
                                            $start_time = explode(' ', $class->start_time)[1];
                                            $start_time = date('H:i A', strtotime($start_time));
                                        @endphp

                                        <span class="fw-bold">Thời gian học:</span>
                                        <span>{{ $start_time }}</span>
                                    </li>

                                    <li class="list-group-item d-flex flex-nowrap justify-content-between gap-2">
                                        @php
                                            $end_time = explode(' ', $class->end_time)[1];
                                            $end_time = date('H:i A', strtotime($end_time));
                                        @endphp

                                        <span class="fw-bold">Thời gian nghỉ:</span>
                                        <span>{{ $end_time }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endcan
            @can('student')
                <div class="row table-responsive">
                    <table class="data-table table table-striped table-hover"
                        style="--bs-table-hover-bg: rgba(211, 253, 80, 0.2);">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Mã HP</th>
                                <th scope="col">Tên HP</th>
                                <th scope="col">Số TC</th>
                                <th scope="col">Giảng viên</th>
                                <th scope="col">Lịch học</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @php
                                $i = 1;
                            @endphp

                            @foreach ($credit_classes as $class)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $class->subject_code }}</td>
                                    <td>{{ $class->subject->subject_name }}</td>
                                    <td>{{ $class->subject->credit }}</td>
                                    <td>{{ $class->teacher->name }}</td>
                                    <td>
                                        @php
                                            $dayOfWeek = [
                                                0 => 'Chủ Nhật',
                                                1 => 'Thứ Hai',
                                                2 => 'Thứ Ba',
                                                3 => 'Thứ Tư',
                                                4 => 'Thứ Năm',
                                                5 => 'Thứ Sáu',
                                                6 => 'Thứ Bảy',
                                            ];

                                            $start_time = explode(' ', $class->start_time)[0];
                                            $day = Carbon::parse($start_time)->dayOfWeek;
                                            $day_now = Carbon::today()->startOfWeek();
                                            $schedule =
                                                $dayOfWeek[$day_now->copy()->addDays($day - 1)->dayOfWeek] .
                                                ' ' .
                                                $day_now
                                                    ->copy()
                                                    ->addDays($day - 1)
                                                    ->format('d/m/Y');
                                        @endphp
                                        <p>{{ $schedule }}</p>
                                        <p>{{ $class->room }}</p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endcan
        @endif
    </div>
@endsection
