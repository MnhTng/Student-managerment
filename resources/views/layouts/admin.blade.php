<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="auto">

<head>
    <script src="{{ asset('/js/color-modes.js') }}"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('/uploads/logo/logo-ptit.png') }}" type="image/x-icon/png">

    {{-- ! Profile --}}
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- ! End Profile --}}

    <link rel="stylesheet" href="{{ asset('/lib/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/lib/js/sweetAlert2/sweetalert2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/lib/jquery/datatable/dataTables.min.css') }}">
    <script src="{{ asset('/lib/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('/lib/jquery/datatable/dataTables.min.js') }}"></script>

    <script src="{{ asset('/lib/js/imask.js') }}"></script>

    <script src="{{ asset('/lib/jquery/fullcalendar/index.global.min.js') }}"></script>
    <script src="{{ asset('/lib/jquery/fullcalendar/core/locales/vi.global.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/effect.css') }}">

    <title>@yield('title')</title>
</head>

<body>
    <!-- Start -->
    <div class="body-container container-fluid d-flex flex-nowrap p-0 overflow-hidden" style="height: 100dvh;">
        <div id="toggle-sidebar">
            <div id="bigBar"
                class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark h-100 @if (session()->has('sidebar') && session()->get('sidebar') === 'sm') d-none @endif">
                <a href="@canany(['admin', 'teacher']) {{ route('dashboard') }} @endcanany @can('student') {{ route('student.dashboard') }} @endcan"
                    class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <img src="{{ asset('/uploads/logo/logo-ptit.png') }}" style="width: 2em;" alt="">
                    <span class="fs-4 ms-2">PTIT</span>
                </a>

                <hr>

                <ul id="sidebar"
                    class="nav nav-pills nav-flush flex-column flex-nowrap mb-auto overflow-y-scroll overflow-x-hidden">
                    <li class="nav-item">
                        <a href="@canany(['admin', 'teacher']) {{ route('dashboard') }} @endcanany @can('student') {{ route('student.dashboard') }} @endcan"
                            class="nav-link text-nowrap text-white d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                width="24" height="24">
                                <path
                                    d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
                            </svg>
                            {{ __('Dashboard') }}
                        </a>
                    </li>
                    @can('admin')
                        <li class="nav-item">
                            <a href="{{ route('faculty.index') }}"
                                class="nav-link text-nowrap text-white d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6" width="24" height="24">
                                    <path
                                        d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                                    <path
                                        d="M13.06 15.473a48.45 48.45 0 0 1 7.666-3.282c.134 1.414.22 2.843.255 4.284a.75.75 0 0 1-.46.711 47.87 47.87 0 0 0-8.105 4.342.75.75 0 0 1-.832 0 47.87 47.87 0 0 0-8.104-4.342.75.75 0 0 1-.461-.71c.035-1.442.121-2.87.255-4.286.921.304 1.83.634 2.726.99v1.27a1.5 1.5 0 0 0-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.66a6.727 6.727 0 0 0 .551-1.607 1.5 1.5 0 0 0 .14-2.67v-.645a48.549 48.549 0 0 1 3.44 1.667 2.25 2.25 0 0 0 2.12 0Z" />
                                    <path
                                        d="M4.462 19.462c.42-.419.753-.89 1-1.395.453.214.902.435 1.347.662a6.742 6.742 0 0 1-1.286 1.794.75.75 0 0 1-1.06-1.06Z" />
                                </svg>
                                {{ __('Faculty') }}
                            </a>
                        </li>
                    @endcan
                    <li class="nav-item">
                        <a href="@can('admin') {{ route('formal-class.index') }} @endcan @can('teacher') {{ route('teacher.formal-class') }} @endcan @can('student') {{ route('student.formal-class') }} @endcan"
                            class="nav-link text-nowrap text-white d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-6" width="24" height="24">
                                <path
                                    d="M11.644 1.59a.75.75 0 0 1 .712 0l9.75 5.25a.75.75 0 0 1 0 1.32l-9.75 5.25a.75.75 0 0 1-.712 0l-9.75-5.25a.75.75 0 0 1 0-1.32l9.75-5.25Z" />
                                <path
                                    d="m3.265 10.602 7.668 4.129a2.25 2.25 0 0 0 2.134 0l7.668-4.13 1.37.739a.75.75 0 0 1 0 1.32l-9.75 5.25a.75.75 0 0 1-.71 0l-9.75-5.25a.75.75 0 0 1 0-1.32l1.37-.738Z" />
                                <path
                                    d="m10.933 19.231-7.668-4.13-1.37.739a.75.75 0 0 0 0 1.32l9.75 5.25c.221.12.489.12.71 0l9.75-5.25a.75.75 0 0 0 0-1.32l-1.37-.738-7.668 4.13a2.25 2.25 0 0 1-2.134-.001Z" />
                            </svg>
                            {{ __('Formal Class') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="@can('admin') {{ route('credit-class.index') }} @endcan @can('teacher') {{ route('teacher.credit-class') }} @endcan @can('student') {{ route('student.credit-class') }} @endcan"
                            class="nav-link text-nowrap text-white d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor"
                                width="24" height="24">
                                <path
                                    d="M184 48l144 0c4.4 0 8 3.6 8 8l0 40L176 96l0-40c0-4.4 3.6-8 8-8zm-56 8l0 40L64 96C28.7 96 0 124.7 0 160l0 96 192 0 128 0 192 0 0-96c0-35.3-28.7-64-64-64l-64 0 0-40c0-30.9-25.1-56-56-56L184 0c-30.9 0-56 25.1-56 56zM512 288l-192 0 0 32c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32-14.3-32-32l0-32L0 288 0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-128z" />
                            </svg>
                            {{ __('Credit Class') }}
                        </a>
                    </li>
                    @can('admin')
                        <li class="nav-item">
                            <a href="{{ route('student.index') }}"
                                class="nav-link text-nowrap text-white d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="currentColor"
                                    width="24" height="24">
                                    <path
                                        d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l293.1 0c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1l-91.4 0zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z" />
                                </svg>
                                {{ __('Student') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('teacher.index') }}"
                                class="nav-link text-nowrap text-white d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor"
                                    width="24" height="24">
                                    <path
                                        d="M96 128a128 128 0 1 0 256 0A128 128 0 1 0 96 128zm94.5 200.2l18.6 31L175.8 483.1l-36-146.9c-2-8.1-9.8-13.4-17.9-11.3C51.9 342.4 0 405.8 0 481.3c0 17 13.8 30.7 30.7 30.7l131.7 0c0 0 0 0 .1 0l5.5 0 112 0 5.5 0c0 0 0 0 .1 0l131.7 0c17 0 30.7-13.8 30.7-30.7c0-75.5-51.9-138.9-121.9-156.4c-8.1-2-15.9 3.3-17.9 11.3l-36 146.9L238.9 359.2l18.6-31c6.4-10.7-1.3-24.2-13.7-24.2L224 304l-19.7 0c-12.4 0-20.1 13.6-13.7 24.2z" />
                                </svg>
                                {{ __('Teacher') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('subject.index') }}"
                                class="nav-link text-nowrap text-white d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor"
                                    width="24" height="24">
                                    <path
                                        d="M0 96C0 43 43 0 96 0l96 0 0 190.7c0 13.4 15.5 20.9 26 12.5L272 160l54 43.2c10.5 8.4 26 .9 26-12.5L352 0l32 0 32 0c17.7 0 32 14.3 32 32l0 320c0 17.7-14.3 32-32 32l0 64c17.7 0 32 14.3 32 32s-14.3 32-32 32l-32 0L96 512c-53 0-96-43-96-96L0 96zM64 416c0 17.7 14.3 32 32 32l256 0 0-64L96 384c-17.7 0-32 14.3-32 32z" />
                                </svg>
                                {{ __('Subject') }}
                            </a>
                        </li>
                    @endcan
                    @canany(['admin', 'student'])
                        <li class="nav-item">
                            <a href="@can('admin') {{ route('score.index') }} @endcan @can('student') {{ route('student.score') }} @endcan"
                                class="nav-link text-nowrap text-white d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor"
                                    width="24" height="24">
                                    <path
                                        d="M4.1 38.2C1.4 34.2 0 29.4 0 24.6C0 11 11 0 24.6 0L133.9 0c11.2 0 21.7 5.9 27.4 15.5l68.5 114.1c-48.2 6.1-91.3 28.6-123.4 61.9L4.1 38.2zm503.7 0L405.6 191.5c-32.1-33.3-75.2-55.8-123.4-61.9L350.7 15.5C356.5 5.9 366.9 0 378.1 0L487.4 0C501 0 512 11 512 24.6c0 4.8-1.4 9.6-4.1 13.6zM80 336a176 176 0 1 1 352 0A176 176 0 1 1 80 336zm184.4-94.9c-3.4-7-13.3-7-16.8 0l-22.4 45.4c-1.4 2.8-4 4.7-7 5.1L168 298.9c-7.7 1.1-10.7 10.5-5.2 16l36.3 35.4c2.2 2.2 3.2 5.2 2.7 8.3l-8.6 49.9c-1.3 7.6 6.7 13.5 13.6 9.9l44.8-23.6c2.7-1.4 6-1.4 8.7 0l44.8 23.6c6.9 3.6 14.9-2.2 13.6-9.9l-8.6-49.9c-.5-3 .5-6.1 2.7-8.3l36.3-35.4c5.6-5.4 2.5-14.8-5.2-16l-50.1-7.3c-3-.4-5.7-2.4-7-5.1l-22.4-45.4z" />
                                </svg>
                                {{ __('Score') }}
                            </a>
                        </li>
                    @endcan
                    @can('admin')
                        <li class="nav-item">
                            <a href="{{ route('training-system.index') }}"
                                class="nav-link text-nowrap text-white d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                    width="24" height="24">
                                    <path
                                        d="M288 0L400 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-79.3 0 89.6 64L512 160c35.3 0 64 28.7 64 64l0 224c0 35.3-28.7 64-64 64l-176 0 0-112c0-26.5-21.5-48-48-48s-48 21.5-48 48l0 112L64 512c-35.3 0-64-28.7-64-64L0 224c0-35.3 28.7-64 64-64l101.7 0L256 95.5 256 32c0-17.7 14.3-32 32-32zm48 240a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM80 224c-8.8 0-16 7.2-16 16l0 64c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-32 0zm368 16l0 64c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zM80 352c-8.8 0-16 7.2-16 16l0 64c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-32 0zm384 0c-8.8 0-16 7.2-16 16l0 64c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-32 0z" />
                                </svg>
                                {{ __('Training System') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('school-year.index') }}"
                                class="nav-link text-nowrap text-white d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor"
                                    width="24" height="24">
                                    <path
                                        d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L64 64C28.7 64 0 92.7 0 128l0 16 0 48L0 448c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-256 0-48 0-16c0-35.3-28.7-64-64-64l-40 0 0-40c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L152 64l0-40zM48 192l80 0 0 56-80 0 0-56zm0 104l80 0 0 64-80 0 0-64zm128 0l96 0 0 64-96 0 0-64zm144 0l80 0 0 64-80 0 0-64zm80-48l-80 0 0-56 80 0 0 56zm0 160l0 40c0 8.8-7.2 16-16 16l-64 0 0-56 80 0zm-128 0l0 56-96 0 0-56 96 0zm-144 0l0 56-64 0c-8.8 0-16-7.2-16-16l0-40 80 0zM272 248l-96 0 0-56 96 0 0 56z" />
                                </svg>
                                {{ __('School Year') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('member.index') }}"
                                class="nav-link text-nowrap text-white d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor"
                                    width="24" height="24">
                                    <path
                                        d="M0 80L0 229.5c0 17 6.7 33.3 18.7 45.3l176 176c25 25 65.5 25 90.5 0L418.7 317.3c25-25 25-65.5 0-90.5l-176-176c-12-12-28.3-18.7-45.3-18.7L48 32C21.5 32 0 53.5 0 80zm112 32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                                </svg>
                                {{ __('Member') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>

            <div id="smallBar"
                class="d-flex flex-column flex-shrink-0 bg-dark h-100 @if ((session()->has('sidebar') && session()->get('sidebar') !== 'sm') || !session()->has('sidebar')) d-none @endif"
                style="width: 4.5rem;">
                <a href="@canany(['admin', 'teacher']) {{ route('dashboard') }} @endcanany @can('student') {{ route('student.dashboard') }} @endcan"
                    class="d-flex align-items-center justify-content-center p-3 text-decoration-none border-bottom mb-3"
                    title="" data-bs-toggle="tooltip" data-bs-placement="right">
                    <img src="{{ asset('/uploads/logo/logo-ptit.png') }}" style="width: 2.5em;" alt="">
                    <span class="visually-hidden">Icon-only</span>
                </a>

                <ul id="smSidebar"
                    class="nav nav-pills nav-flush flex-column flex-nowrap mb-auto text-center overflow-y-scroll overflow-x-hidden">
                    <li class="nav-item">
                        <a href="@canany(['admin', 'teacher']) {{ route('dashboard') }} @endcanany @can('student') {{ route('student.dashboard') }} @endcan"
                            class="nav-link text-info py-3 rounded-0 d-flex justify-content-center"
                            title="{{ __('Dashboard') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                            style="--bs-nav-pills-link-active-bg: #62A93D;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                width="30" height="30">
                                <path
                                    d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
                            </svg>
                        </a>
                    </li>
                    @can('admin')
                        <li class="nav-item">
                            <a href="{{ route('faculty.index') }}"
                                class="nav-link text-info py-3 rounded-0 d-flex justify-content-center"
                                title="{{ __('Faculty') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                                style="--bs-nav-pills-link-active-bg: #62A93D;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    width="30" height="30">
                                    <path
                                        d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                                    <path
                                        d="M13.06 15.473a48.45 48.45 0 0 1 7.666-3.282c.134 1.414.22 2.843.255 4.284a.75.75 0 0 1-.46.711 47.87 47.87 0 0 0-8.105 4.342.75.75 0 0 1-.832 0 47.87 47.87 0 0 0-8.104-4.342.75.75 0 0 1-.461-.71c.035-1.442.121-2.87.255-4.286.921.304 1.83.634 2.726.99v1.27a1.5 1.5 0 0 0-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.66a6.727 6.727 0 0 0 .551-1.607 1.5 1.5 0 0 0 .14-2.67v-.645a48.549 48.549 0 0 1 3.44 1.667 2.25 2.25 0 0 0 2.12 0Z" />
                                    <path
                                        d="M4.462 19.462c.42-.419.753-.89 1-1.395.453.214.902.435 1.347.662a6.742 6.742 0 0 1-1.286 1.794.75.75 0 0 1-1.06-1.06Z" />
                                </svg>
                            </a>
                        </li>
                    @endcan
                    <li class="nav-item">
                        <a href="@can('admin') {{ route('formal-class.index') }} @endcan @can('teacher') {{ route('teacher.formal-class') }} @endcan @can('student') {{ route('student.formal-class') }} @endcan"
                            class="nav-link text-info py-3 rounded-0 d-flex justify-content-center"
                            title="{{ __('Formal Class') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                            style="--bs-nav-pills-link-active-bg: #62A93D;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                width="30" height="30">
                                <path
                                    d="M11.644 1.59a.75.75 0 0 1 .712 0l9.75 5.25a.75.75 0 0 1 0 1.32l-9.75 5.25a.75.75 0 0 1-.712 0l-9.75-5.25a.75.75 0 0 1 0-1.32l9.75-5.25Z" />
                                <path
                                    d="m3.265 10.602 7.668 4.129a2.25 2.25 0 0 0 2.134 0l7.668-4.13 1.37.739a.75.75 0 0 1 0 1.32l-9.75 5.25a.75.75 0 0 1-.71 0l-9.75-5.25a.75.75 0 0 1 0-1.32l1.37-.738Z" />
                                <path
                                    d="m10.933 19.231-7.668-4.13-1.37.739a.75.75 0 0 0 0 1.32l9.75 5.25c.221.12.489.12.71 0l9.75-5.25a.75.75 0 0 0 0-1.32l-1.37-.738-7.668 4.13a2.25 2.25 0 0 1-2.134-.001Z" />
                            </svg>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="@can('admin') {{ route('credit-class.index') }} @endcan @can('teacher') {{ route('teacher.credit-class') }} @endcan @can('student') {{ route('student.credit-class') }} @endcan"
                            class="nav-link text-info py-3 rounded-0 d-flex justify-content-center"
                            title="{{ __('Credit Class') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                            style="--bs-nav-pills-link-active-bg: #62A93D;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor"
                                width="30" height="30">
                                <path
                                    d="M184 48l144 0c4.4 0 8 3.6 8 8l0 40L176 96l0-40c0-4.4 3.6-8 8-8zm-56 8l0 40L64 96C28.7 96 0 124.7 0 160l0 96 192 0 128 0 192 0 0-96c0-35.3-28.7-64-64-64l-64 0 0-40c0-30.9-25.1-56-56-56L184 0c-30.9 0-56 25.1-56 56zM512 288l-192 0 0 32c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32-14.3-32-32l0-32L0 288 0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-128z" />
                            </svg>
                        </a>
                    </li>
                    @can('admin')
                        <li class="nav-item">
                            <a href="{{ route('student.index') }}"
                                class="nav-link text-info py-3 rounded-0 d-flex justify-content-center"
                                title="{{ __('Student') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                                style="--bs-nav-pills-link-active-bg: #62A93D;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="currentColor"
                                    width="30" height="30">
                                    <path
                                        d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l293.1 0c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1l-91.4 0zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z" />
                                </svg>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('teacher.index') }}"
                                class="nav-link text-info py-3 rounded-0 d-flex justify-content-center"
                                title="{{ __('Teacher') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                                style="--bs-nav-pills-link-active-bg: #62A93D;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor"
                                    width="30" height="30">
                                    <path
                                        d="M96 128a128 128 0 1 0 256 0A128 128 0 1 0 96 128zm94.5 200.2l18.6 31L175.8 483.1l-36-146.9c-2-8.1-9.8-13.4-17.9-11.3C51.9 342.4 0 405.8 0 481.3c0 17 13.8 30.7 30.7 30.7l131.7 0c0 0 0 0 .1 0l5.5 0 112 0 5.5 0c0 0 0 0 .1 0l131.7 0c17 0 30.7-13.8 30.7-30.7c0-75.5-51.9-138.9-121.9-156.4c-8.1-2-15.9 3.3-17.9 11.3l-36 146.9L238.9 359.2l18.6-31c6.4-10.7-1.3-24.2-13.7-24.2L224 304l-19.7 0c-12.4 0-20.1 13.6-13.7 24.2z" />
                                </svg>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('subject.index') }}"
                                class="nav-link text-info py-3 rounded-0 d-flex justify-content-center"
                                title="{{ __('Subject') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                                style="--bs-nav-pills-link-active-bg: #62A93D;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor"
                                    width="30" height="30">
                                    <path
                                        d="M0 96C0 43 43 0 96 0l96 0 0 190.7c0 13.4 15.5 20.9 26 12.5L272 160l54 43.2c10.5 8.4 26 .9 26-12.5L352 0l32 0 32 0c17.7 0 32 14.3 32 32l0 320c0 17.7-14.3 32-32 32l0 64c17.7 0 32 14.3 32 32s-14.3 32-32 32l-32 0L96 512c-53 0-96-43-96-96L0 96zM64 416c0 17.7 14.3 32 32 32l256 0 0-64L96 384c-17.7 0-32 14.3-32 32z" />
                                </svg>
                            </a>
                        </li>
                    @endcan
                    @canany(['admin', 'student'])
                        <li class="nav-item">
                            <a href="@can('admin') {{ route('score.index') }} @endcan @can('student') {{ route('student.score') }} @endcan"
                                class="nav-link text-info py-3 rounded-0 d-flex justify-content-center"
                                title="{{ __('Score') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                                style="--bs-nav-pills-link-active-bg: #62A93D;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor"
                                    width="30" height="30">
                                    <path
                                        d="M4.1 38.2C1.4 34.2 0 29.4 0 24.6C0 11 11 0 24.6 0L133.9 0c11.2 0 21.7 5.9 27.4 15.5l68.5 114.1c-48.2 6.1-91.3 28.6-123.4 61.9L4.1 38.2zm503.7 0L405.6 191.5c-32.1-33.3-75.2-55.8-123.4-61.9L350.7 15.5C356.5 5.9 366.9 0 378.1 0L487.4 0C501 0 512 11 512 24.6c0 4.8-1.4 9.6-4.1 13.6zM80 336a176 176 0 1 1 352 0A176 176 0 1 1 80 336zm184.4-94.9c-3.4-7-13.3-7-16.8 0l-22.4 45.4c-1.4 2.8-4 4.7-7 5.1L168 298.9c-7.7 1.1-10.7 10.5-5.2 16l36.3 35.4c2.2 2.2 3.2 5.2 2.7 8.3l-8.6 49.9c-1.3 7.6 6.7 13.5 13.6 9.9l44.8-23.6c2.7-1.4 6-1.4 8.7 0l44.8 23.6c6.9 3.6 14.9-2.2 13.6-9.9l-8.6-49.9c-.5-3 .5-6.1 2.7-8.3l36.3-35.4c5.6-5.4 2.5-14.8-5.2-16l-50.1-7.3c-3-.4-5.7-2.4-7-5.1l-22.4-45.4z" />
                                </svg>
                            </a>
                        </li>
                    @endcan
                    @can('admin')
                        <li class="nav-item">
                            <a href="{{ route('training-system.index') }}"
                                class="nav-link text-info py-3 rounded-0 d-flex justify-content-center"
                                title="{{ __('Training System') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                                style="--bs-nav-pills-link-active-bg: #62A93D;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor"
                                    width="30" height="30">
                                    <path
                                        d="M288 0L400 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-79.3 0 89.6 64L512 160c35.3 0 64 28.7 64 64l0 224c0 35.3-28.7 64-64 64l-176 0 0-112c0-26.5-21.5-48-48-48s-48 21.5-48 48l0 112L64 512c-35.3 0-64-28.7-64-64L0 224c0-35.3 28.7-64 64-64l101.7 0L256 95.5 256 32c0-17.7 14.3-32 32-32zm48 240a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM80 224c-8.8 0-16 7.2-16 16l0 64c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-32 0zm368 16l0 64c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zM80 352c-8.8 0-16 7.2-16 16l0 64c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-32 0zm384 0c-8.8 0-16 7.2-16 16l0 64c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-32 0z" />
                                </svg>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('school-year.index') }}"
                                class="nav-link text-info py-3 rounded-0 d-flex justify-content-center"
                                title="{{ __('School Year') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                                style="--bs-nav-pills-link-active-bg: #62A93D;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor"
                                    width="30" height="30">
                                    <path
                                        d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L64 64C28.7 64 0 92.7 0 128l0 16 0 48L0 448c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-256 0-48 0-16c0-35.3-28.7-64-64-64l-40 0 0-40c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L152 64l0-40zM48 192l80 0 0 56-80 0 0-56zm0 104l80 0 0 64-80 0 0-64zm128 0l96 0 0 64-96 0 0-64zm144 0l80 0 0 64-80 0 0-64zm80-48l-80 0 0-56 80 0 0 56zm0 160l0 40c0 8.8-7.2 16-16 16l-64 0 0-56 80 0zm-128 0l0 56-96 0 0-56 96 0zm-144 0l0 56-64 0c-8.8 0-16-7.2-16-16l0-40 80 0zM272 248l-96 0 0-56 96 0 0 56z" />
                                </svg>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('member.index') }}"
                                class="nav-link text-info py-3 rounded-0 d-flex justify-content-center"
                                title="{{ __('Member') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                                style="--bs-nav-pills-link-active-bg: #62A93D;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor"
                                    width="30" height="30">
                                    <path
                                        d="M0 80L0 229.5c0 17 6.7 33.3 18.7 45.3l176 176c25 25 65.5 25 90.5 0L418.7 317.3c25-25 25-65.5 0-90.5l-176-176c-12-12-28.3-18.7-45.3-18.7L48 32C21.5 32 0 53.5 0 80zm112 32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                                </svg>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </div>

        <!-- Content -->
        <div id="content" class="d-flex flex-column w-100 overflow-y-auto overflow-x-hidden">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow position-sticky top-0"
                aria-label="Offcanvas navbar large" style="z-index: 10000;">
                <div class="container-fluid p-0">
                    <a href="{{ route('sidebar.toggle') }}" id="sidebarToggle"
                        class="navbar-brand btn d-flex align-items-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg" style="z-index: 1;">
                            <path
                                d="M4.99255 12.9841C4.44027 12.9841 3.99255 13.4318 3.99255 13.9841C3.99255 14.3415 4.18004 14.6551 4.46202 14.8319L7.14964 17.5195C7.54016 17.9101 8.17333 17.9101 8.56385 17.5195C8.95438 17.129 8.95438 16.4958 8.56385 16.1053L7.44263 14.9841H14.9926C15.5448 14.9841 15.9926 14.5364 15.9926 13.9841C15.9926 13.4318 15.5448 12.9841 14.9926 12.9841L5.042 12.9841C5.03288 12.984 5.02376 12.984 5.01464 12.9841H4.99255Z"
                                fill="currentColor" />
                            <path
                                d="M19.0074 11.0159C19.5597 11.0159 20.0074 10.5682 20.0074 10.0159C20.0074 9.6585 19.82 9.3449 19.538 9.16807L16.8504 6.48045C16.4598 6.08993 15.8267 6.08993 15.4361 6.48045C15.0456 6.87098 15.0456 7.50414 15.4361 7.89467L16.5574 9.01589L9.00745 9.01589C8.45516 9.01589 8.00745 9.46361 8.00745 10.0159C8.00745 10.5682 8.45516 11.0159 9.00745 11.0159L18.958 11.0159C18.9671 11.016 18.9762 11.016 18.9854 11.0159H19.0074Z"
                                fill="currentColor" />
                        </svg>
                    </a>

                    <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar"
                        aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">MENU</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>

                        <div class="offcanvas-body">
                            <div id="toggler-theme" class="navbar-nav justify-content-end flex-grow-1 mb-lg-0 mb-3">
                                <button id="light-theme" type="button"
                                    class="d-none align-items-center justify-content-center"
                                    data-bs-theme-value="light" aria-pressed="false">
                                    <svg viewBox="0 0 24 24" width="24" height="24"
                                        class="darkToggleIcon_wfgR">
                                        <path fill="currentColor"
                                            d="M9.37,5.51C9.19,6.15,9.1,6.82,9.1,7.5c0,4.08,3.32,7.4,7.4,7.4c0.68,0,1.35-0.09,1.99-0.27C17.45,17.19,14.93,19,12,19 c-3.86,0-7-3.14-7-7C5,9.07,6.81,6.55,9.37,5.51z M12,3c-4.97,0-9,4.03-9,9s4.03,9,9,9s9-4.03,9-9c0-0.46-0.04-0.92-0.1-1.36 c-0.98,1.37-2.58,2.26-4.4,2.26c-2.98,0-5.4-2.42-5.4-5.4c0-1.81,0.89-3.42,2.26-4.4C12.92,3.04,12.46,3,12,3L12,3z">
                                        </path>
                                    </svg>

                                    <span class="visually-hidden">{{ __('Light') }}</span>
                                </button>

                                <button id="dark-theme" type="button"
                                    class="d-none align-items-center justify-content-center"
                                    data-bs-theme-value="dark" aria-pressed="false">
                                    <svg viewBox="0 0 24 24" width="24" height="24"
                                        class="lightToggleIcon_pyhR">
                                        <path fill="currentColor"
                                            d="M12,9c1.65,0,3,1.35,3,3s-1.35,3-3,3s-3-1.35-3-3S10.35,9,12,9 M12,7c-2.76,0-5,2.24-5,5s2.24,5,5,5s5-2.24,5-5 S14.76,7,12,7L12,7z M2,13l2,0c0.55,0,1-0.45,1-1s-0.45-1-1-1l-2,0c-0.55,0-1,0.45-1,1S1.45,13,2,13z M20,13l2,0c0.55,0,1-0.45,1-1 s-0.45-1-1-1l-2,0c-0.55,0-1,0.45-1,1S19.45,13,20,13z M11,2v2c0,0.55,0.45,1,1,1s1-0.45,1-1V2c0-0.55-0.45-1-1-1S11,1.45,11,2z M11,20v2c0,0.55,0.45,1,1,1s1-0.45,1-1v-2c0-0.55-0.45-1-1-1C11.45,19,11,19.45,11,20z M5.99,4.58c-0.39-0.39-1.03-0.39-1.41,0 c-0.39,0.39-0.39,1.03,0,1.41l1.06,1.06c0.39,0.39,1.03,0.39,1.41,0s0.39-1.03,0-1.41L5.99,4.58z M18.36,16.95 c-0.39-0.39-1.03-0.39-1.41,0c-0.39,0.39-0.39,1.03,0,1.41l1.06,1.06c0.39,0.39,1.03,0.39,1.41,0c0.39-0.39,0.39-1.03,0-1.41 L18.36,16.95z M19.42,5.99c0.39-0.39,0.39-1.03,0-1.41c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06c-0.39,0.39-0.39,1.03,0,1.41 s1.03,0.39,1.41,0L19.42,5.99z M7.05,18.36c0.39-0.39,0.39-1.03,0-1.41c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06 c-0.39,0.39-0.39,1.03,0,1.41s1.03,0.39,1.41,0L7.05,18.36z">
                                        </path>
                                    </svg>

                                    <span class="visually-hidden">{{ __('Dark') }}</span>
                                </button>
                            </div>

                            <div class="dropdown">
                                <a class="btn text-white hover-btn-2 mb-3 mb-lg-0 dropdown-toggle float-start d-flex gap-2"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span>
                                        @if (App::isLocale('en'))
                                            {{ __('English') }}
                                        @else
                                            {{ __('Vietnamese') }}
                                        @endif
                                    </span>

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="24"
                                        height="24" fill="currentColor">
                                        <path
                                            d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z" />
                                    </svg>
                                </a>

                                <ul class="dropdown-menu">
                                    <li class="mb-2">
                                        <a class="dropdown-item d-flex gap-3 align-items-center"
                                            href="{{ route('lang', ['en']) }}">
                                            <img src="{{ asset('/uploads/flag/en-flag.png') }}" alt="English"
                                                class="img-fluid" style="width: 1em;">
                                            {{ __('English') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex gap-3 align-items-center"
                                            href="{{ route('lang', ['vi']) }}">
                                            <img src="{{ asset('/uploads/flag/vi-flag.png') }}" alt="Vietnamese"
                                                class="img-fluid" style="width: 1em;">
                                            {{ __('Vietnamese') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="mt-3 mt-lg-0 mb-lg-0 mb-3 mx-lg-3 mx-0">
                                <div class="search input-group">
                                    <input id="search" class="form-control rounded-end-0 focus-ring"
                                        type="search" placeholder="{{ __('Search') }}" aria-label="Search"
                                        style="--bs-focus-ring-width: 0;">

                                    <button class="text-dark d-flex align-items-center px-2" onclick="search()">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" class="size-6" width="24">
                                            <path fill-rule="evenodd"
                                                d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            @php
                                use App\Models\Student;
                                use App\Models\Teacher;

                                $teacher = Teacher::find(Auth::user()->identifier);
                                $student = Student::find(Auth::user()->identifier);
                            @endphp

                            <div id="user-info" class="dropdown me-2">
                                <div class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="@if (Auth::user()->role === 'admin') {{ asset('/uploads/avt/admin.png') }}
                                        @elseif (Auth::user()->role === 'teacher' && $teacher->gender === 'Nam') {{ asset('/uploads/avt/man.png') }}
                                        @elseif (Auth::user()->role === 'teacher' && $teacher->gender === 'Nữ') {{ asset('/uploads/avt/woman.png') }}
                                        @elseif (Auth::user()->role === 'student' && $student->gender === 'Nam') {{ asset('/uploads/avt/boy.png') }}
                                        @else {{ asset('/uploads/avt/girl.png') }} @endif"
                                        alt="" width="36" height="36" class="rounded-circle me-2">
                                    <strong>{{ Auth::user()->name }}</strong>
                                </div>

                                <ul
                                    class="dropdown-menu dropdown-menu-dark dropdown-menu-end mt-2 shadow container-fluid">
                                    <li>
                                        <a class="dropdown-item d-flex align-item-center gap-2"
                                            href="@if (Auth::user()->role === 'admin') {{ route('profile.edit') }}
                                            @elseif (Auth::user()->role === 'teacher') {{ route('profile.teacher') }}
                                            @else {{ route('profile.student') }} @endif">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                fill="rgb(77, 226, 167)" class="size-6" width="20">
                                                <path
                                                    d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z" />
                                            </svg>

                                            {{ __('Profile') }}
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider bg-light">
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf

                                            <a class="dropdown-item d-flex align-item-center gap-2"
                                                href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();">

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="3" stroke="rgb(227, 77, 77)"
                                                    class="size-6" width="20">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9" />
                                                </svg>

                                                {{ __('Log Out') }}
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->

            <!-- Layouts -->
            @yield('content')
            <!-- End Layouts -->
        </div>
    </div>
    <!-- End Content -->
    <div class="loading">
        <div class="circle"></div>
        <div class="circle c2"></div>
        <div class="circle c3"></div>
        <div class="shadow"></div>
        <div class="shadow s2"></div>
        <div class="shadow s3"></div>
    </div>
    <!-- End -->

    <script>
        // Variables in data table
        let sProcessing = @json(__('Processing ...'));
        let sLengthMenu = @json(__('Show _MENU_ items'));
        let sZeroRecords = @json(__('No matching records found'));
        let sInfo = @json(__('Showing _START_ to _END_ of _TOTAL_ items'));
        let sInfoEmpty = @json(__('Showing 0 to 0 of 0 items'));
        let sInfoFiltered = @json(__('(filtered from _MAX_ total items)'));
        let sInfoPostFix = @json(__(''));
        let sSearch = @json(__('Search:'));
        let sUrl = @json('');
        let sEmptyTable = @json(__('No data available in table'));
        let sLoadingRecords = @json(__('Loading ...'));
        let sFirst = @json(__('First'));
        let sLast = @json(__('Last'));
        let sNext = @json(__('Next'));
        let sPrevious = @json(__('Previous'));
        let sSortAscending = @json(__(': activate to sort column ascending'));
        let sSortDescending = @json(__(': activate to sort column descending'));
    </script>

    <script src="{{ asset('/lib/bootstrap/js/masonry.min.js') }}"></script>
    <script src="{{ asset('/lib/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/lib/js/sweetAlert2/sweetalert2.all.min.js') }}"></script>

    <script src="{{ asset('/lib/js/chart.umd.min.js') }}"></script>
    <script src="{{ asset('/lib/js/xlsx.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"
        integrity="sha512-r22gChDnGvBylk90+2e/ycr3RVrDi8DIOkIGNhJlKfuyQM4tIRAI062MaV8sfjQKYVGjOBaZBOA87z+IhZE9DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('/js/sidebar.js') }}"></script>
    <script src="{{ asset('/js/datatable.js') }}"></script>

    <script src="{{ asset('/js/app.js') }}"></script>
</body>

</html>
