<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    <meta charset="utf-8" />
    <meta name="description" content="Bramanjo Production: Product Better Sell Best" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="Bramanjo Production" />
    <meta property="og:url" content="https://bramanjo.com" />
    <meta property="og:site_name" content="Bramanjo Production: Product Better Sell Best" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon-black.png') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />

    {{-- Tabulator css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabulator/6.2.0/css/tabulator.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tabulator/6.2.0/css/tabulator_bootstrap5.min.css" />

    <script>
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
    @yield('css')
</head>

<body id="kt_body" class="header-fixed">
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>

    <div class="d-flex flex-column flex-root">
        <div class="flex-row bg-gray-200 page d-flex flex-column-fluid">
            @include('layouts.production.sidebar')
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <div id="kt_header" style="" class="header align-items-stretch">
                    <div class="header-brand">
                        <a href="{{ route('dashboard') }}" class="rounded">
                            <img alt="Logo" src="{{ asset('assets/media/logos/favicon-black.svg') }}"
                                class="rounded h-50px h-lg-50px" />
                        </a>

                        <div id="kt_aside_toggle"
                            class="w-auto px-0 btn btn-icon btn-active-color-primary aside-minimize"
                            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                            data-kt-toggle-name="aside-minimize">
                            <i class="ki-duotone ki-entrance-right fs-1 me-n1 minimize-default">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <i class="ki-duotone ki-entrance-left fs-1 minimize-active">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>

                        <div class="d-flex align-items-center d-lg-none me-n2" title="Show aside menu">
                            <div class="btn btn-icon btn-active-color-primary w-30px h-30px"
                                id="kt_aside_mobile_toggle">
                                <i class="ki-duotone ki-abstract-14 fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                        </div>
                    </div>
                    <div class="toolbar d-flex align-items-stretch">
                        <div
                            class="py-6 container-fluid py-lg-0 d-flex flex-column flex-lg-row align-items-lg-stretch justify-content-lg-between">
                            <div class="page-title d-flex justify-content-center flex-column me-5">
                                @yield('header')
                            </div>
                            <div class="pt-3 overflow-auto d-flex align-items-stretch pt-lg-0">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="btn btn-sm btn-icon btn-icon-muted btn-active-icon-primary"
                                        data-kt-menu-trigger="{default:'click', lg: 'hover'}"
                                        data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                        <i class="ki-duotone ki-night-day theme-light-show fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                            <span class="path6"></span>
                                            <span class="path7"></span>
                                            <span class="path8"></span>
                                            <span class="path9"></span>
                                            <span class="path10"></span>
                                        </i>
                                        <i class="ki-duotone ki-moon theme-dark-show fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>

                                    <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold fs-base w-150px"
                                        data-kt-menu="true" data-kt-element="theme-mode-menu">
                                        <div class="px-3 my-0 menu-item">
                                            <a href="#" class="px-3 py-2 menu-link" data-kt-element="mode"
                                                data-kt-value="light">
                                                <span class="menu-icon" data-kt-element="icon">
                                                    <i class="ki-duotone ki-night-day fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                        <span class="path6"></span>
                                                        <span class="path7"></span>
                                                        <span class="path8"></span>
                                                        <span class="path9"></span>
                                                        <span class="path10"></span>
                                                    </i>
                                                </span>
                                                <span class="menu-title">Light</span>
                                            </a>
                                        </div>
                                        <div class="px-3 my-0 menu-item">
                                            <a href="#" class="px-3 py-2 menu-link" data-kt-element="mode"
                                                data-kt-value="dark">
                                                <span class="menu-icon" data-kt-element="icon">
                                                    <i class="ki-duotone ki-moon fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </span>
                                                <span class="menu-title">Dark</span>
                                            </a>
                                        </div>
                                        <div class="px-3 my-0 menu-item">
                                            <a href="#" class="px-3 py-2 menu-link" data-kt-element="mode"
                                                data-kt-value="system">
                                                <span class="menu-icon" data-kt-element="icon">
                                                    <i class="ki-duotone ki-screen fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                    </i>
                                                </span>
                                                <span class="menu-title">System</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="ms-5 d-flex align-items-center"
                                    data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                    <div class="text-end d-none d-sm-flex flex-column justify-content-center me-3">
                                        <span class="#" class="text-gray-500 fs-8 fw-bold">Hello</span>
                                        <a href="#"
                                            class="text-gray-800 text-hover-primary fs-7 fw-bold d-block">{{ auth()->user()->first_name }}</a>
                                    </div>

                                    <div class="cursor-pointer symbol symbol-circle symbol-35px symbol-md-40px">
                                        <img src="{{ asset('assets/media/avatars/' . auth()->user()->gender . '.jpg') }}"
                                            class="rounded-3" alt="user" />
                                        <div
                                            class="bottom-0 mb-1 position-absolute translate-middle start-100 ms-n1 bg-success rounded-circle h-8px w-8px">
                                        </div>
                                    </div>
                                </div>

                                <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold fs-6 w-300px"
                                    data-kt-menu="true">
                                    <div class="px-3 menu-item">
                                        <div class="px-3 menu-content d-flex align-items-center">
                                            <div class="symbol symbol-50px me-5">
                                                <img src="{{ asset('assets/media/avatars/' . auth()->user()->gender . '.jpg') }}"
                                                    class="rounded-3" alt="user" />
                                            </div>

                                            <div class="d-flex flex-column">
                                                <div class="fw-bold d-flex align-items-center fs-5">
                                                    {{ auth()->user()->full_name }} <span
                                                        class="px-2 py-1 badge badge-light-success fw-bold fs-8 ms-2">
                                                        @if (!empty(auth()->user()->getRoleNames()))
                                                            @foreach (auth()->user()->getRoleNames() as $role)
                                                                {{ $role }}
                                                            @endforeach
                                                        @endif
                                                    </span>
                                                </div>

                                                <a href="#"
                                                    class="fw-semibold text-muted text-hover-primary fs-7">
                                                    {{ auth()->user()->email }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="my-2 separator"></div>

                                    <div class="px-5 menu-item">
                                        <a href="#" class="px-5 menu-link">
                                            My Profile
                                        </a>
                                    </div>

                                    <div class="my-2 separator"></div>
                                    <div class="px-5 menu-item">
                                        <a href="{{ route('logout') }}" class="px-5 menu-link"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Sign Out
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column flex-column-fluid" id="kt_content">
                    <div class="mt-5 app-container container-fluid">
                        @yield('main-content')
                    </div>
                </div>
                @include('layouts.production.footer')
            </div>
        </div>
    </div>

    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>

    <script src="{{ asset('assets/js/custom/utils.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tabulator/6.2.0/js/tabulator.min.js"></script>
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
        @if (Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif
        @if (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
    </script>

    @yield('js')
</body>

</html>
