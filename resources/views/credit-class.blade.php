@extends('layouts.admin')

@section('title')
    {{ __('Credit Class') }}
@endsection

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row mb-4">
            <div class="col-12 col-md">
                <h2>{{ __('Credit Class') }}</h2>

                <div>
                    <nav class="d-flex align-items-center" aria-label="breadcrumb">
                        <ol class="breadcrumb overflow-hidden text-center m-0">
                            <li class="breadcrumb-item d-flex align-items-end">
                                <a class="underline_center link-danger fw-semibold text-decoration-none "
                                    href="@can('teacher') {{ route('dashboard') }} @endcan @can('student') {{ route('student.dashboard') }} @endcan">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>

                            <li class="breadcrumb-item active d-flex align-items-end" aria-current="page">
                                {{ __('Credit Class') }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @if (!$credit_classes)
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">{{ __('No credit classes yet!') }}</h4>
                <p class="mb-0">{{ __('Please contact the administrator for resolution.') }}</p>
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

                                        <span class="fw-bold">{{ __('School Year') }}:</span>
                                        <span>{{ 'Kỳ ' . $semester . ' năm học ' . $school_term }}</span>
                                    </li>

                                    <li class="list-group-item d-flex flex-nowrap justify-content-between gap-2">
                                        <span class="fw-bold">{{ __('Teacher') }}: </span>
                                        <span>{{ $class->teacher->name }}</span>
                                    </li>

                                    <li class="list-group-item d-flex flex-nowrap justify-content-between gap-2">
                                        @php
                                            $dayOfWeek = [
                                                0 => __('Sunday'),
                                                1 => __('Monday'),
                                                2 => __('Tuesday'),
                                                3 => __('Wednesday'),
                                                4 => __('Thursday'),
                                                5 => __('Friday'),
                                                6 => __('Saturday'),
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

                                        <span class="fw-bold">{{ __('Schedule') }}:</span>
                                        <span>{{ $schedule }}</span>
                                    </li>

                                    <li class="list-group-item d-flex flex-nowrap justify-content-between gap-2">
                                        @php
                                            $start_time = explode(' ', $class->start_time)[1];
                                            $start_time = date('H:i A', strtotime($start_time));
                                        @endphp

                                        <span class="fw-bold">{{ __('Start Time') }}:</span>
                                        <span>{{ $start_time }}</span>
                                    </li>

                                    <li class="list-group-item d-flex flex-nowrap justify-content-between gap-2">
                                        @php
                                            $end_time = explode(' ', $class->end_time)[1];
                                            $end_time = date('H:i A', strtotime($end_time));
                                        @endphp

                                        <span class="fw-bold">{{ __('End Time') }}:</span>
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
                                <th scope="col">{{ __('Subject Code') }}</th>
                                <th scope="col">{{ __('Subject Name') }}</th>
                                <th scope="col">{{ __('Credit') }}</th>
                                <th scope="col">{{ __('Teacher') }}</th>
                                <th scope="col">{{ __('Schedule') }}</th>
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
                                                0 => __('Sunday'),
                                                1 => __('Monday'),
                                                2 => __('Tuesday'),
                                                3 => __('Wednesday'),
                                                4 => __('Thursday'),
                                                5 => __('Friday'),
                                                6 => __('Saturday'),
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
