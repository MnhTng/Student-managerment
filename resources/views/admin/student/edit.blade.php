@extends('layouts.admin')

@section('title')
    Cập nhật sinh viên
@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row mb-4">
            <div class="col-12 col-md">
                <h2>Sinh viên</h2>
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
                                href="{{ route('student.index') }}">
                                Sinh viên
                            </a>
                        </li>

                        <li class="breadcrumb-item active d-flex align-items-end" aria-current="page">
                            <span>Cập nhật sinh viên</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div
                class="container col-md col-12 bg-body-secondary rounded-3 p-4 border-primary border-4 border-bottom-0 border-start-0 border-end-0">
                <h4 class="text-danger mb-3">Cập nhật sinh viên</h4>

                <form class="needs-validation d-grid gap-3" method="POST"
                    action="{{ route('student.update', $student->msv) }}" novalidate>
                    @csrf

                    <div class="row g-3 d-flex justify-content-between">
                        <div class="col-lg-3 col-12">
                            <label for="msv" class="form-label fw-bold">MSV</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <input type="text"
                                    class="form-control @error('msv') is-invalid @enderror @if (old('msv') && !$errors->has('msv')) is-valid @endif"
                                    id="msv" name="msv" placeholder="MSV"
                                    value="{{ old('msv') ?? $student->msv }}">

                                @error('msv')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('msv'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-7 col-12">
                            <label for="name" class="form-label fw-bold">Họ và tên</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <input type="text"
                                    class="form-control @error('name') is-invalid @enderror @if (old('name') && !$errors->has('name')) is-valid @endif"
                                    id="name" name="name" placeholder="Họ và tên"
                                    value="{{ old('name') ?? $student->name }}">

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('name'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 d-flex justify-content-between">
                        <div class="col-lg-4 col-12">
                            <label for="birthday" class="form-label fw-bold">Ngày sinh</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <input type="date"
                                    class="form-control @error('birthday') is-invalid @enderror @if (old('birthday') && !$errors->has('birthday')) is-valid @endif"
                                    id="birthday" name="birthday" placeholder="Ngày sinh"
                                    value="{{ old('birthday') ?? $student->birthday }}">

                                @error('birthday')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('birthday'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <label for="phone" class="form-label fw-bold">Số điện thoại</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <input type="text"
                                    class="form-control @error('phone') is-invalid @enderror @if (old('phone') && !$errors->has('phone')) is-valid @endif"
                                    id="phone" name="phone" placeholder="SDT"
                                    value="{{ old('phone') ?? $student->phone }}">

                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('phone'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-3 col-12">
                            <label for="gender" class="form-label fw-bold">Giới tính</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <select
                                    class="form-select @error('gender') is-invalid @enderror @if (old('gender') && !$errors->has('gender')) is-valid @endif"
                                    id="gender" name="gender" aria-label="Select gender">
                                    <option class="bg-body" value="">Chọn giới tính</option>
                                    <option class="bg-body" value="Nam"
                                        @if ((old('gender') ?? $student->gender) === 'Nam') selected @endif>Nam</option>
                                    <option class="bg-body" value="Nữ"
                                        @if ((old('gender') ?? $student->gender) === 'Nữ') selected @endif>Nữ</option>
                                </select>

                                @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('gender'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <input type="email"
                                    class="form-control @error('email') is-invalid @enderror @if (old('email') && !$errors->has('email')) is-valid @endif"
                                    id="email" name="email" placeholder="Email"
                                    value="{{ old('email') ?? $student->email }}">

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('email'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label fw-bold">Địa chỉ</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <input type="text"
                                    class="form-control @error('address') is-invalid @enderror @if (old('address') && !$errors->has('address')) is-valid @endif"
                                    id="address" name="address" placeholder="Địa chỉ"
                                    value="{{ old('address') ?? $student->address }}">

                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('address'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 d-flex justify-content-between">
                        <div class="col-lg-6 col-12">
                            <label for="cccd" class="form-label fw-bold">CCCD</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <input type="text"
                                    class="form-control @error('cccd') is-invalid @enderror @if (old('cccd') && !$errors->has('cccd')) is-valid @endif"
                                    id="cccd" name="cccd" placeholder="CCCD"
                                    value="{{ old('cccd') ?? $student->cccd }}">

                                @error('cccd')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('cccd'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <label for="ethnicity" class="form-label fw-bold">Dân tộc</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <select
                                    class="form-select @error('ethnicity') is-invalid @enderror @if (old('ethnicity') && !$errors->has('ethnicity')) is-valid @endif"
                                    id="ethnicity" name="ethnicity" aria-label="Select ethnicity">
                                    <option class="bg-body" value="">Chọn dân tộc</option>

                                    @foreach ($ethnicity as $item)
                                        <option class="bg-body" value="{{ $item }}"
                                            @if ((old('ethnicity') ?? $student->ethnicity) === $item) selected @endif>
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('ethnicity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('ethnicity'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 d-flex justify-content-between">
                        <div class="col-lg-3 col-12">
                            <label for="faculty" class="form-label fw-bold">Khoa</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <select
                                    class="form-select @error('faculty') is-invalid @enderror @if (old('faculty') && !$errors->has('faculty')) is-valid @endif"
                                    id="faculty" name="faculty" aria-label="Select faculty">
                                    <option class="bg-body" value="">Chọn khoa</option>

                                    @foreach ($faculties as $faculty)
                                        <option class="bg-body" value="{{ $faculty->faculty_code }}"
                                            @if ((old('faculty') ?? $student->faculty_code) === $faculty->faculty_code) selected @endif>
                                            {{ $faculty->faculty_name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('faculty')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('faculty'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-5 col-12">
                            <label for="major" class="form-label fw-bold">Ngành</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <select
                                    class="form-select @error('major') is-invalid @enderror @if (old('major') && !$errors->has('major')) is-valid @endif"
                                    id="major" name="major" aria-label="Select major">
                                    <option class="bg-body" value="">Chọn ngành</option>

                                    @foreach ($majors as $major)
                                        <option class="bg-body" value="{{ $major->major_code }}"
                                            @if ((old('major') ?? $student->major_code) === $major->major_code) selected @endif>
                                            {{ $major->major_name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('major')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('major'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-3 col-12">
                            <label for="formal_class" class="form-label fw-bold">Lớp</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <select
                                    class="form-select @error('formal_class') is-invalid @enderror @if (old('formal_class') && !$errors->has('formal_class')) is-valid @endif"
                                    id="formal_class" name="formal_class" aria-label="Select formal class">
                                    <option class="bg-body" value="">Chọn lớp</option>

                                    @foreach ($formal_classes as $formal_class)
                                        <option class="bg-body" value="{{ $formal_class->class_code }}"
                                            @if ((old('formal_class') ?? $student->class_code) === $formal_class->class_code) selected @endif>
                                            {{ $formal_class->class_code }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('formal_class')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('formal_class'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-5 col-12">
                            <label for="training_system" class="form-label fw-bold">Hệ đào tạo</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <select
                                    class="form-select @error('training_system') is-invalid @enderror @if (old('training_system') && !$errors->has('training_system')) is-valid @endif"
                                    id="training_system" name="training_system" aria-label="Select training system">
                                    <option class="bg-body" value="">Chọn hệ đào tạo</option>

                                    @foreach ($training_systems as $training_system)
                                        <option class="bg-body" value="{{ $training_system->training_code }}"
                                            @if ((old('training_system') ?? $student->training_code) === $training_system->training_code) selected @endif>
                                            {{ $training_system->training_name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('training_system')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('training_system'))
                                    <div class="valid-feedback">
                                        {{ __('Look good!') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-5 col-12">
                            <label for="academic_year" class="form-label fw-bold">Niên khóa</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text border-0 bg-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                        width="18" height="18" class="text-info">
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </span>
                                <input type="text"
                                    class="form-control @error('academic_year') is-invalid @enderror @if (old('academic_year') && !$errors->has('academic_year')) is-valid @endif"
                                    id="academic_year" name="academic_year" placeholder="Niên khóa"
                                    value="{{ old('academic_year') ?? $student->academic_year }}">

                                @error('academic_year')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if (!$errors->has('academic_year'))
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

                        <a href="{{ route('student.index') }}" class="btn btn-outline-danger rounded-1">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Mask msv
        document.addEventListener('DOMContentLoaded', function() {
            const msv = document.getElementById('msv');
            const maskMSV = {
                mask: '{B}00{DC}aa000',
                lazy: false,
                blocks: {
                    a: {
                        mask: 'a',
                        prepareChar: str => str.toUpperCase(),
                        commit: (value, masked) => {
                            masked._value = value.toLowerCase();
                        },
                    }
                }
            };
            const mask = IMask(msv, maskMSV);
        });

        // Mask phone number
        document.addEventListener('DOMContentLoaded', function() {
            const phone = document.getElementById('phone');
            const maskPhone = {
                mask: '0000-000-000',
                lazy: false,
                placeholderChar: '#'
            };
            const mask = IMask(phone, maskPhone);
        });

        // Mask CCCD
        document.addEventListener('DOMContentLoaded', function() {
            const cccd = document.getElementById('cccd');
            const maskCCCD = {
                mask: '000000000000',
                lazy: false,
                placeholderChar: '*'
            };
            const mask = IMask(cccd, maskCCCD);
        });

        // Mask academic year
        const format_academic_year = function(mask) {
            const value = mask.value;
            const parts = value.split('-');

            // Kiểm tra nếu có đủ hai phần
            if (parts.length === 2 && !(parts[0].includes('_')) && !(parts[1].includes('_'))) {
                let firstPart = parseFloat(parts[0]);
                let secondPart = parseFloat(parts[1]);

                if (!isNaN(firstPart) && !isNaN(secondPart) && firstPart > secondPart) {
                    const tmp = firstPart;
                    firstPart = secondPart;
                    secondPart = tmp;
                }

                if (secondPart - firstPart <= 3) {
                    secondPart = firstPart + 4;
                }

                mask.value = firstPart + '-' + secondPart;
            } else {
                mask.value = '';
            }

            return mask.value;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const academicYear = document.getElementById('academic_year');
            const maskAcademicYear = {
                mask: '20XX-20YY',
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
                        to: 99
                    },
                    YY: {
                        mask: IMask.MaskedRange,
                        from: 0,
                        to: 99
                    }
                },
                autofix: true,
                overwrite: true,
            };
            const mask = IMask(academicYear, maskAcademicYear);

            academicYear.addEventListener('change', function() {
                mask.value = format_academic_year(mask);
            });

            $('form').on('submit', function() {
                mask.value = format_academic_year(mask);
            });
        });

        // Select faculty->major->formal_class by step
        $(document).ready(function() {
            if ($('#faculty').val() === '') {
                $('#major').addClass('pe-none');
                $('#formal_class').addClass('pe-none');
            }

            $(window).on('load', function() {
                $('#major').addClass('pe-none');
                $('#formal_class').addClass('pe-none');
            });

            $('#faculty').on('change', function() {
                const facultyCode = $(this).val();

                if (facultyCode !== '') {
                    $('#major').removeClass('pe-none');
                    $('#major option:first').prop('selected', 'selected');
                    $('#formal_class').addClass('pe-none');
                    $('#formal_class option').removeClass('d-none');
                    $('#formal_class option:first').prop('selected', 'selected');

                    $.ajax({
                        url: "{{ route('student.getMajorByFaculty', 'faculty') }}"
                            .replace('faculty', facultyCode),
                        method: 'GET',
                        data: {
                            facultyCode: facultyCode
                        },
                        success: function(data) {
                            $('#major option').addClass('d-none');

                            let countDisplay = 0;
                            data.forEach(major => {
                                if ($('#major option[value="' + major.major_code +
                                        '"]'))
                                    countDisplay++;

                                $('#major option[value="' + major.major_code + '"]')
                                    .removeClass('d-none');
                            });

                            if (!countDisplay) {
                                $('#major option:first')
                                    .removeClass('d-none')
                                    .prop('selected', 'selected');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.status);
                            console.log(status);
                            console.log(error);
                        }
                    });
                } else {
                    $('#major option').removeClass('d-none');
                    $('#major option:first').prop('selected', 'selected');
                    $('#major').addClass('pe-none');
                    $('#formal_class option').removeClass('d-none');
                    $('#formal_class option:first').prop('selected', 'selected');
                    $('#formal_class').addClass('pe-none');
                }
            });

            $('#major').on('change', function() {
                const majorCode = $(this).val();

                if (majorCode !== '') {
                    $('#formal_class').removeClass('pe-none');
                    $('#formal_class option:first').prop('selected', 'selected');

                    $.ajax({
                        url: "{{ route('student.getFormalClassByMajor', 'major') }}"
                            .replace('major', majorCode),
                        method: 'GET',
                        data: {
                            majorCode: majorCode
                        },
                        success: function(data) {
                            $('#formal_class option').addClass('d-none');

                            let countDisplay = 0;
                            data.forEach(formal_class => {
                                if ($('#formal_class option[value="' + formal_class
                                        .class_code + '"]'))
                                    countDisplay++;

                                $('#formal_class option[value="' + formal_class
                                        .class_code + '"]')
                                    .removeClass('d-none');
                            });

                            if (!countDisplay) {
                                $('#formal_class option:first')
                                    .removeClass('d-none')
                                    .prop('selected', 'selected');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.status);
                            console.log(status);
                            console.log(error);
                        }
                    });
                } else {
                    $('#formal_class option').removeClass('d-none');
                    $('#formal_class option:first').prop('selected', 'selected');
                    $('#formal_class').addClass('pe-none');
                }
            });
        });
    </script>
@endsection
