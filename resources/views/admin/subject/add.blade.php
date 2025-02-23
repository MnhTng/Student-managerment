@extends('layouts.admin')

@section('title')
    {{ __('Add Subject') }}
@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row mb-4">
            <div class="col-12 col-md">
                <h2>{{ __('Subject') }}</h2>
            </div>

            <div class="col-12 col-md d-flex justify-content-start justify-content-md-end me-sm-5 me-1">
                <nav class="d-flex align-items-center" aria-label="breadcrumb">
                    <ol class="breadcrumb overflow-hidden text-center m-0">
                        <li class="breadcrumb-item d-flex align-items-end">
                            <a class="underline_center link-danger fw-semibold text-decoration-none"
                                href="{{ route('dashboard') }}">
                                {{ __('Dashboard') }}
                            </a>
                        </li>

                        <li class="breadcrumb-item d-flex align-items-end">
                            <a class="underline_center link-danger fw-semibold text-decoration-none"
                                href="{{ route('subject.index') }}">
                                {{ __('Subject') }}
                            </a>
                        </li>

                        <li class="breadcrumb-item active d-flex align-items-end" aria-current="page">
                            <span>{{ __('Add Subject') }}</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div
                class="container col-md col-12 bg-body-secondary rounded-3 p-4 border-primary border-4 border-bottom-0 border-start-0 border-end-0">
                <h4 class="text-danger mb-3">{{ __('Add Subject') }}</h4>

                <form class="needs-validation" method="POST" action="{{ route('subject.store') }}" novalidate>
                    @csrf

                    <div class="row g-3 d-flex justify-content-between">
                        <div class="col-lg-5 col-12">
                            <label for="subject_code" class="form-label fw-bold">{{ __('Subject Code') }}</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <input type="text"
                                    class="form-control @error('subject_code') is-invalid @enderror @if (old('subject_code') && !$errors->has('subject_code')) is-valid @endif"
                                    id="subject_code" name="subject_code" placeholder="{{ __('Subject Code') }}"
                                    value="{{ old('subject_code') }}">

                                @error('subject_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('subject_code'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-3 col-12">
                            <label for="credit" class="form-label fw-bold">{{ __('Credit') }}</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <input type="number" min="0" max="6"
                                    class="form-control @error('credit') is-invalid @enderror @if (old('credit') && !$errors->has('credit')) is-valid @endif"
                                    id="credit" name="credit" placeholder="{{ __('Credit') }}"
                                    value="{{ old('credit') }}">

                                @error('credit')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('credit'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="subject_name" class="form-label fw-bold">{{ __('Subject Name') }}</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <input type="text"
                                    class="form-control @error('subject_name') is-invalid @enderror @if (old('subject_name') && !$errors->has('subject_name')) is-valid @endif"
                                    id="subject_name" name="subject_name" placeholder="{{ __('Subject Name') }}"
                                    value="{{ old('subject_name') }}">

                                @error('subject_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('subject_name'))
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

                        <a href="{{ route('subject.index') }}" class="btn btn-outline-danger rounded-1">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Mask subject_code
        document.addEventListener('DOMContentLoaded', function() {
            const subjectCode = document.getElementById('subject_code');

            const maskCode = {
                mask: 'a0',

                lazy: false,
                blocks: {
                    a: {
                        mask: 'aaa[a]',
                        prepareChar: str => str.toUpperCase(),
                        commit: (value, masked) => {
                            masked._value = value.toLowerCase();
                        }
                    },
                    0: {
                        mask: '000[000]',
                    },
                }
            };
            const mask = IMask(subjectCode, maskCode);
        });

        // Mask credit
        document.addEventListener('DOMContentLoaded', function() {
            const creditClass = document.getElementById('credit');

            const maskClass = {
                mask: IMask.MaskedRange,
                from: 0,
                to: 6,
                autofix: true,
            };
            const mask = IMask(creditClass, maskClass);
        });
    </script>
@endsection
