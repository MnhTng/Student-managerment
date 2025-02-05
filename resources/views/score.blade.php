@extends('layouts.admin')

@section('title')
    Điểm
@endsection

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row mb-4">
            <div class="col-12 col-md">
                <h2>Điểm</h2>

                <div>
                    <nav class="d-flex align-items-center" aria-label="breadcrumb">
                        <ol class="breadcrumb overflow-hidden text-center m-0">
                            <li class="breadcrumb-item d-flex align-items-end">
                                <a class="underline_center link-danger fw-semibold text-decoration-none "
                                    href="{{ route('student.dashboard') }}">
                                    Trang chủ
                                </a>
                            </li>

                            <li class="breadcrumb-item active d-flex align-items-end" aria-current="page">
                                Điểm
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12 col-md-6">
                <select class="form-select" id="school_year" name="school_year" aria-label="Select school year">
                    @if (!$change_year)
                        @php
                            $curMonth = Carbon::now()->month;
                            $semester = $curMonth < 7 ? 1 : 2;
                        @endphp

                        @foreach ($school_years as $year)
                            <option class="bg-body" value="{{ $year->slug }}"
                                @if (Str::of($year->school_term)->explode('-')[0] == Carbon::now()->year && $year->semester == $semester) selected @endif>
                                {{ 'Kỳ ' . $year->semester . ' năm học ' . $year->school_term }}
                            </option>
                        @endforeach
                    @else
                        @foreach ($school_years as $y)
                            <option class="bg-body" value="{{ $y->slug }}"
                                @if ($y->slug == $year) selected @endif>
                                {{ 'Kỳ ' . $y->semester . ' năm học ' . $y->school_term }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        @if ($scores->isEmpty())
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Chưa có điểm học phần nào!</h4>
                <p>Hãy đảm bảo bạn đã thi hết tất cả học phần.</p>
            </div>
        @else
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
                                <th scope="col">Điểm tổng kết</th>
                                <th scope="col">Điểm hệ 4</th>
                                <th scope="col">Điểm chữ</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @php
                                $i = 1;
                            @endphp

                            @foreach ($scores as $score)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $score->subject_code }}</td>
                                    <td>{{ $score->subject->subject_name }}</td>
                                    <td>{{ $score->subject->credit }}</td>
                                    <td>{{ (float) $score->score }}</td>
                                    <td>{{ number_format($gpa[$i - 2], 1) }}</td>
                                    <td>{{ $rank[$i - 2] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endcan
        @endif
    </div>

    <script>
        // Change school year
        $(document).ready(function() {
            $('#school_year').on('change', function() {
                let school_year = $(this).val();

                $.ajax({
                    url: "{{ route('student.changeSchoolYear', 'year') }}".replace('year',
                        school_year),
                    method: 'GET',
                    data: {
                        school_year: school_year
                    },
                    beforeSend: function() {
                        $('.loading').css('display', 'flex');
                    },
                    success: function(response) {
                        $('.loading').css('display', 'none');

                        window.location.href = "{{ route('student.redirectScore', 'year') }}"
                            .replace('year', response);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.status);
                        console.log(status);
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
