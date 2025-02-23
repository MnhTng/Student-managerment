@extends('layouts.admin')

@section('title')
    {{ __('Add Score') }}
@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row mb-4">
            <div class="col-12 col-md">
                <h2>{{ __('Add Score') }}</h2>
            </div>

            <div class="col-12 col-md d-flex justify-content-start justify-content-md-end me-sm-5 me-1">
                <nav class="d-flex align-items-center" aria-label="breadcrumb">
                    <ol class="breadcrumb overflow-hidden text-center m-0">
                        <li class="breadcrumb-item d-flex align-items-end">
                            <a class="underline_center link-danger fw-semibold text-decoration-none "
                                href="{{ route('dashboard') }}">
                                {{ __('Dashboard') }}
                            </a>
                        </li>

                        <li class="breadcrumb-item d-flex align-items-end">
                            <a class="underline_center link-danger fw-semibold text-decoration-none "
                                href="{{ route('teacher.credit-class') }}">
                                {{ __('Credit Class') }}
                            </a>
                        </li>

                        <li class="breadcrumb-item d-flex align-items-end">
                            <a class="underline_center link-danger fw-semibold text-decoration-none "
                                href="{{ route('score.show', $credit_class_id) }}">
                                {{ __('Score') }}
                            </a>
                        </li>

                        <li class="breadcrumb-item active d-flex align-items-end" aria-current="page">
                            <span>{{ __('Add Score') }}</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div
                class="container col-md col-12 bg-body-secondary rounded-3 p-4 border-primary border-4 border-bottom-0 border-start-0 border-end-0">
                <h4 class="text-danger mb-3">{{ __('Add Score') }}</h4>

                <form class="needs-validation d-grid gap-3" method="POST"
                    action="{{ route('score.store', $credit_class_id) }}" novalidate>
                    @csrf

                    <div class="row gap-3 d-flex justify-content-between">
                        <div class="col-lg-5 col-12">
                            <label for="student" class="form-label fw-bold">{{ __('Student') }}</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d=" M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4
                                                                                                                                                    171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9
                                                                                                                                                    31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5
                                                                                                                                                    329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <input type="text" class="pe-none form-control" id="student" name="student"
                                    value="{{ $student->name . '-' . $student->msv }}">
                            </div>
                        </div>

                        <div class="col-lg-5 col-12">
                            <label for="school_year" class="form-label fw-bold">{{ __('School Year') }}</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <select class="form-select pe-none" id="school_year" name="school_year"
                                    aria-label="Select school year">
                                    <option class="bg-body" value="{{ $school_year->slug }}" selected>
                                        {{ 'Kỳ ' . $school_year->semester . ' năm học ' . $school_year->school_term }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 d-flex justify-content-between">
                        <div class="col-lg-8 col-12">
                            <label for="subject" class="form-label fw-bold">{{ __('Subject') }}</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <select class="form-select pe-none" id="subject" name="subject"
                                    aria-label="Select subject">
                                    <option class="bg-body" value="{{ $subject->subject_code }}" selected>
                                        {{ $subject->subject_name }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-12">
                            <label for="score" class="form-label fw-bold">{{ __('Score') }}</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <input type="number" min="0" max="10" step="0.05"
                                    class="form-control @error('score') is-invalid @enderror @if (old('score') && !$errors->has('score')) is-valid @endif"
                                    id="score" name="score" placeholder="{{ __('Score') }}"
                                    value="{{ old('score') }}">


                                @error('score')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('score'))
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

                        <a href="{{ route('score.show', $credit_class_id) }}"
                            class="btn btn-outline-danger rounded-1">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
