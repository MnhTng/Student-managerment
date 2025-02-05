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
            <div class="col-lg-3 col-12">
                <div class="row">
                    <div class="col-lg-12 col-sm-6 col-12 mx-auto">
                        <div class="card shadow-sm mb-3" style="background: rgb(255, 183, 0);">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="card-title mb-3 text-white">Khoa</h5>
                                    </div>

                                    <div class="col-4">
                                        <a href="{{ route('faculty.index') }}"
                                            class="dashboard-icon d-grid align-items-center justify-content-center rounded-circle text-white overflow-hidden position-relative @can('teacher') pe-none @endcan"
                                            style="width: 3rem; height: 3rem;background :rgb(169, 124, 0);">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="size-6" width="24" height="24">
                                                <path
                                                    d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                                                <path
                                                    d="M13.06 15.473a48.45 48.45 0 0 1 7.666-3.282c.134 1.414.22 2.843.255 4.284a.75.75 0 0 1-.46.711 47.87 47.87 0 0 0-8.105 4.342.75.75 0 0 1-.832 0 47.87 47.87 0 0 0-8.104-4.342.75.75 0 0 1-.461-.71c.035-1.442.121-2.87.255-4.286.921.304 1.83.634 2.726.99v1.27a1.5 1.5 0 0 0-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.66a6.727 6.727 0 0 0 .551-1.607 1.5 1.5 0 0 0 .14-2.67v-.645a48.549 48.549 0 0 1 3.44 1.667 2.25 2.25 0 0 0 2.12 0Z" />
                                                <path
                                                    d="M4.462 19.462c.42-.419.753-.89 1-1.395.453.214.902.435 1.347.662a6.742 6.742 0 0 1-1.286 1.794.75.75 0 0 1-1.06-1.06Z" />
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

                                <h2 class="mb-0 fw-bold text-white">{{ $facultyNum }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-6 col-12 mx-auto">
                        <div class="card shadow-sm mb-3" style="background: rgb(255, 40, 147);">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="card-title mb-3 text-white">Lớp</h5>
                                    </div>

                                    <div class="col-4">
                                        <a href="{{ route('formal-class.index') }}"
                                            class="dashboard-icon d-grid align-items-center justify-content-center rounded-circle text-white overflow-hidden position-relative @can('teacher') pe-none @endcan"
                                            style="width: 3rem; height: 3rem;background :rgb(164, 8, 81);">
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

                                <h2 class="mb-0 fw-bold text-white">{{ $formal_classNum }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-6 col-12 mx-auto">
                        <div class="card shadow-sm mb-3" style="background: rgb(64, 74, 255);">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="card-title mb-3 text-white">Sinh Viên</h5>
                                    </div>

                                    <div class="col-4">
                                        <a href="{{ route('student.index') }}"
                                            class="dashboard-icon d-grid align-items-center justify-content-center rounded-circle text-white overflow-hidden position-relative @can('teacher') pe-none @endcan"
                                            style="width: 3rem; height: 3rem;background :rgb(46, 15, 184);">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"
                                                fill="currentColor" width="24" height="24">
                                                <path
                                                    d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l293.1 0c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1l-91.4 0zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z" />
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

                                <h2 class="mb-0 fw-bold text-white">{{ $studentNum }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-6 col-12 mx-auto">
                        <div class="card shadow-sm mb-3" style="background: rgb(16, 198, 205);">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="card-title mb-3 text-white">Giảng Viên</h5>
                                    </div>

                                    <div class="col-4">
                                        <a href="{{ route('teacher.index') }}"
                                            class="dashboard-icon d-grid align-items-center justify-content-center rounded-circle text-white overflow-hidden position-relative @can('teacher') pe-none @endcan"
                                            style="width: 3rem; height: 3rem;background :rgb(7, 119, 123);">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                fill="currentColor" width="24" height="24">
                                                <path
                                                    d="M96 128a128 128 0 1 0 256 0A128 128 0 1 0 96 128zm94.5 200.2l18.6 31L175.8 483.1l-36-146.9c-2-8.1-9.8-13.4-17.9-11.3C51.9 342.4 0 405.8 0 481.3c0 17 13.8 30.7 30.7 30.7l131.7 0c0 0 0 0 .1 0l5.5 0 112 0 5.5 0c0 0 0 0 .1 0l131.7 0c17 0 30.7-13.8 30.7-30.7c0-75.5-51.9-138.9-121.9-156.4c-8.1-2-15.9 3.3-17.9 11.3l-36 146.9L238.9 359.2l18.6-31c6.4-10.7-1.3-24.2-13.7-24.2L224 304l-19.7 0c-12.4 0-20.1 13.6-13.7 24.2z" />
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

                                <h2 class="mb-0 fw-bold text-white">{{ $teacherNum }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-6 col-12 mx-auto">
                        <div class="card shadow-sm" style="background: rgb(142, 217, 3);">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="card-title mb-3 text-white">Môn Học</h5>
                                    </div>

                                    <div class="col-4">
                                        <a href="{{ route('subject.index') }}"
                                            class="dashboard-icon d-grid align-items-center justify-content-center rounded-circle text-white overflow-hidden position-relative @can('teacher') pe-none @endcan"
                                            style="width: 3rem; height: 3rem;background :rgb(61, 138, 14);">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                fill="currentColor" width="24" height="24">
                                                <path
                                                    d="M0 96C0 43 43 0 96 0l96 0 0 190.7c0 13.4 15.5 20.9 26 12.5L272 160l54 43.2c10.5 8.4 26 .9 26-12.5L352 0l32 0 32 0c17.7 0 32 14.3 32 32l0 320c0 17.7-14.3 32-32 32l0 64c17.7 0 32 14.3 32 32s-14.3 32-32 32l-32 0L96 512c-53 0-96-43-96-96L0 96zM64 416c0 17.7 14.3 32 32 32l256 0 0-64L96 384c-17.7 0-32 14.3-32 32z" />
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                fill="currentColor" class="size-6 position-absolute end-100"
                                                width="24" height="24">
                                                <path
                                                    d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <h2 class="mb-0 fw-bold text-white">{{ $subjectNum }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @can('admin')
                <div id="topsv" class="col-lg col-12 shadow rounded-3 py-4">
                    <div class="h2 d-flex align-items-center text-lg-start text-center">
                        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
                        <dotlottie-player src="https://lottie.host/2fd686b1-3f5b-4c42-a338-27a2f02a5ef9/moKNQ1zi6U.json"
                            class="d-inline-block" background="transparent" speed="1.2"
                            style="width: 3rem; height: 3rem;" loop autoplay>
                        </dotlottie-player>

                        Top 10 sinh viên xuất sắc nhất Học Viện
                    </div>

                    <div class="container table-responsive mt-lg-5 mt-3">
                        <table class="table table-hover" style="--bs-table-hover-bg: rgba(211, 253, 80, 0.2);">
                            <thead class="table-danger">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">MSV</th>
                                    <th scope="col">Họ và tên</th>
                                    <th scope="col">Ngành</th>
                                    <th scope="col">Điểm TB</th>
                                    <th scope="col">GPA</th>
                                    <th scope="col">Điểm chữ</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @php
                                    $i = 1;
                                @endphp

                                @foreach ($avgScores as $score)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $score->msv }}</td>
                                        <td>{{ $score->student->name }}</td>
                                        <td>{{ $score->student->major->major_name }}</td>
                                        <td>{{ round($score->avg_score, 2, PHP_ROUND_HALF_UP) }}</td>
                                        <td>{{ number_format($gpa[$i - 2], 1) }}</td>
                                        <td>{{ $rank[$i - 2] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endcan
            @can('teacher')
                <div class="col">
                    <h2 class="text-center fw-bold text-bg-danger rounded-top py-2">Lịch dạy</h2>
                    <div id="calendar" class="col-lg col-12 shadow rounded-3 py-4 px-3"></div>
                </div>
            @endcan
        </div>

        <div class="row d-flex justify-content-between gap-5 bg-body-tertiary rounded-3 py-4">
            <div class="col-lg-5 col-7 mx-auto">
                <h3 class="text-center">Biểu đồ thống kê giới tính sinh viên</h3>

                <canvas id="student-gender" aria-label="pie chart" role="chart"></canvas>
            </div>

            <div class="col-lg-5 col-7 mx-auto">
                <h3 class="text-center">Biểu đồ thống kê giới tính giảng viên</h3>

                <canvas id="teacher-gender" aria-label="pie chart" role="chart"></canvas>
            </div>

            <div class="col-lg-5 col-7 mx-auto">
                <h3 class="text-center">Biểu đồ thống kê điểm</h3>

                <canvas id="score" aria-label="pie chart" role="chart"></canvas>
            </div>

            <div class="col-12">
                <h3 class="text-center">Biểu đồ thống kê số lượng ngành học mỗi khoa</h3>

                <canvas id="faculty" aria-label="pie chart" role="chart"></canvas>
            </div>

            <div class="col-12">
                <h3 class="text-center">Biểu đồ thống kê số lượng sinh viên các ngành</h3>

                <canvas id="major" aria-label="pie chart" role="chart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Chart
        const chart = @json($chart);
        const chartFacultyName = @json($chartFacultyName);
        const chartMajorNum = @json($chartMajorNum);
        const chartMajorName = @json($chartMajorName);
        const chartStudentNum = @json($chartStudentNum);

        // Calendar
        const credit_classes = @json($credit_classes);
        const subjects = @json($subjects);
        const now = @json($now);
    </script>
    <script src="{{ asset('/js/chart.js') }}" type="module"></script>
    <script src="{{ asset('/js/calendar.js') }}" type="module"></script>
@endsection
