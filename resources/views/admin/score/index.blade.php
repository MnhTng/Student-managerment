@extends('layouts.admin')

@section('title')
    Danh sách lớp
@endsection

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row mb-4">
            <div class="col-12 col-md">
                <h2>Danh sách lớp</h2>

                <div>
                    <nav class="d-flex align-items-center" aria-label="breadcrumb">
                        <ol class="breadcrumb overflow-hidden text-center m-0">
                            <li class="breadcrumb-item d-flex align-items-end">
                                <a class="underline_center link-danger fw-semibold text-decoration-none "
                                    href="{{ route('dashboard') }}">
                                    Trang chủ
                                </a>
                            </li>

                            <li class="breadcrumb-item active d-flex align-items-end" aria-current="page">
                                Danh sách lớp
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
                        <th scope="col">MSV</th>
                        <th scope="col">Họ và tên</th>
                        <th scope="col">Môn học</th>
                        <th scope="col">Điểm</th>
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
@endsection
